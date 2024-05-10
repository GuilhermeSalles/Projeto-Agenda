<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Carbon;

use App\Models\Service;
use App\Models\Professional;
use App\Models\Scheduling;



class SchedulingController extends Controller
{
    public function index(Request $request)
    {

        $professionals = Professional::all();

        foreach ($professionals as $professional) {
            // Decodifica a string JSON em um array
            $specializedServiceIds = $professional->specializations;

            // Obtém os serviços especializados com os IDs obtidos
            $services = Service::whereIn('id', $specializedServiceIds)->get();

            // Define os serviços especializados como um atributo do objeto profissional
            $professional->services = $services;

            // Obtém os dias trabalhados do profissional
            $workingHours = $professional->workingHours;

            // Resuma os dias trabalhados em um único atributo de texto
            $workingDays = $workingHours->pluck('day_of_week')->implode(', ');

            // Define os dias trabalhados como um atributo do objeto profissional
            $professional->workingDays = $workingDays;
        }

        $schedulings = Scheduling::all();

        return view('scheduling.index', compact('schedulings', 'professionals'));
    }

    public function all($date = null)
    {

        /*
            É bom fazermos aqui uma verificação de sessão de usuário e se
            não for um usuário verificado ou a sessão tiver acabado que redirecione o
            usuário para fora. Na verdade vou só colocar o middleware na rota e boas. 
            
        */

        /* Como os registros só estão sendo (e serão) visualizados por aqui
           então só devemos aqui atualizar quais registros estão concluidos e quais não.
           simplesmente fazer um update no mysql 
    t      update a coluna fulfilled pra 1 em todos os registros que a date 
           for menor que a data atual
           isso significa que todo o registro onde a data de agendamento estiver 
           no passado a sua coluna 'concluido' será alterada para 
           1 = concluida
           passos: fazer um método a parte pra fazer isso */

        if ($date == null) {
            $date = Carbon::now('America/Sao_Paulo');
        } else {
            $date = Carbon::parse($date);
        }

        // $date = ($date == null) ? Carbon::now('America/Sao_Paulo') : $date;



        $schedulings = Scheduling::whereDate('date', $date->format('Y-m-d'))->get();

        $services = Service::all();

        $soma = 0;

        foreach ($schedulings as $scheduling) {

            if ($scheduling->fulfilled == 1) {
                foreach ($services as $service) {
                    if ($service->id == $scheduling->service) {
                        $soma += $service->value;
                    }
                }
            }
        }


        // Obtém todos os agendamentos
        $schedulingsDates = Scheduling::orderBy('date')->get();

        // Itera sobre cada agendamento
        $schedulingsDates->map(function ($scheduling) {
            // Obtém o serviço correspondente ao serviço do agendamento
            $service = Service::find($scheduling->service);

            // Verifica se o serviço foi encontrado
            if ($service) {
                // Adiciona a coluna 'value' com o valor do serviço ao agendamento
                $scheduling->value = $service->value;
            } else {
                // Define um valor padrão caso o serviço não seja encontrado
                $scheduling->value = 'Valor não encontrado';
            }

            return $scheduling;
        });

        // Agrupa os agendamentos por data
        $schedulingsGroupedByDate = $schedulingsDates->groupBy('date');

        $uniqueDates = $schedulingsGroupedByDate;

        $dates = [];
        foreach ($uniqueDates as $udDate => $schedulingsDates) {
            //$udDate = Carbon::parse($udDate);

            $valueSum = 0;

            foreach ($schedulingsDates as $dated) {

                if ($dated->fulfilled == 1) {
                    $valueSum += $dated->value;
                }
            }


            $schedulingAndDates = ['date' => Carbon::parse($udDate), 'total' => $valueSum];

            array_push($dates, $schedulingAndDates);
        }


        $uniqueDates = $dates;


        $date = ($date->format('Y-m-d') == Carbon::now('America/Sao_Paulo')->format('Y-m-d')) ? null : $date;

        return view('scheduling.all', compact('schedulings', 'soma', 'uniqueDates', 'date'));
    }


    public function create($id)
    {

        $professional = Professional::find($id);

        $professionals = Professional::all();

        $specializedServiceIds = $professional->specializations;

        $services = Service::whereIn('id', $specializedServiceIds)->get();

        return view('scheduling.create', compact('professional', 'professionals', 'services'));
    }

    public function createSelectService($id, $service_id)
    {
        $professional = Professional::find($id);
        $service = Service::find($service_id);

        return view('scheduling.create-final', compact('professional',  'service'));
    }


    public function store(Request $request)
    {
        // Valide os dados recebidos do formulário
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'pro' => 'required|integer',
            'service' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Verificar se há erros de validação
        if ($validatedData instanceof \Illuminate\Contracts\Validation\Validator && $validatedData->fails()) {
            // Dados inválidos, notifique o usuário do erro
            return redirect()->back()->withErrors($validatedData)->withInput();
        } else {
            // Dados válidos, continue com o processamento
            // Por exemplo, salve os dados no banco de dados
        }

        // Crie um novo agendamento com os dados validados
        $scheduling = new Scheduling();
        $scheduling->name = $validatedData['name'];
        $scheduling->phone = $validatedData['phone'];
        $scheduling->pro = $validatedData['pro'];
        $scheduling->service = $validatedData['service'];
        $scheduling->date = $validatedData['date'];
        $scheduling->time = $validatedData['time'];

        // Salve o agendamento no banco de dados
        $scheduling->save();

        // Obter os dados do profissional e do serviço
        $professional = Professional::find($request->input('pro'));
        $service = Service::find($request->input('service'));

        // Passar os dados do agendamento, profissional e serviço para a view
        return view('scheduling.finishing', compact('scheduling', 'professional', 'service'));
    }

    public function cancel(Request $request)
    {

        // Valida os dados da requisição
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Encontra o agendamento pelo ID
        $scheduling = Scheduling::findOrFail($request->input('id'));

        // Atualiza os dados do agendamento
        // fulfilled == 2 = CANCELADO
        $scheduling->fulfilled = 2;

        // Salva as alterações no banco de dados
        $scheduling->save();

        return redirect()->back();
    }

    public function finishe(Request $request)
    {
        // Valida os dados da requisição
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Encontra o agendamento pelo ID
        $scheduling = Scheduling::findOrFail($request->input('id'));

        // Atualiza os dados do agendamento
        // fulfilled == 2 = CANCELADO
        $scheduling->fulfilled = 1;

        // Salva as alterações no banco de dados
        $scheduling->save();

        return redirect()->back();
    }



    public function reset(Request $request)
    {
        // Valida os dados da requisição
        $request->validate([
            'id' => 'required|integer',
        ]);

        // Encontra o agendamento pelo ID
        $scheduling = Scheduling::findOrFail($request->input('id'));

        // Atualiza os dados do agendamento
        // fulfilled == 2 = CANCELADO
        $scheduling->fulfilled = 0;

        // Salva as alterações no banco de dados
        $scheduling->save();

        return redirect()->back();
    }
}
