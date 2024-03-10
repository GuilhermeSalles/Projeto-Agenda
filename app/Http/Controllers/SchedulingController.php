<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Service;
use App\Models\Professional;
use App\Models\Scheduling;



class SchedulingController extends Controller
{
    public function index(Request $request){
        
        $professionals = Professional::all();

        foreach ($professionals as $professional) {
            // Decodifica a string JSON em um array
            $specializedServiceIds = json_decode($professional->specializations);
        
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


    public function create($id){

      $professional = Professional::find($id);

        $professionals = Professional::all();

        $specializedServiceIds = json_decode($professional->specializations);

        $services = Service::whereIn('id', $specializedServiceIds)->get();

        return view('scheduling.create', compact('professional', 'professionals', 'services'));
    
    }

    public function createSelectService($id, $service_id){
        $professional = Professional::find($id);
        $services = Service::find($service_id);

        return view('scheduling.create-final', compact('professional',  'services'));
    
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

        // Redirecione de volta para a página de origem com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Agendamento criado com sucesso!');
        //return view('scheduling.create');

    }
}
