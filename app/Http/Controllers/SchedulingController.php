<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Service;
use App\Models\Professional;
use App\Models\Scheduling;

use App\Models\WeeklySchedule;

use App\Models\ProhibitedDay;



class SchedulingController extends Controller
{
    public function index(Request $request)
    {
        // Obtém os dias de funcionamento da loja
        $workingDays = WeeklySchedule::where('working', true)->pluck('day_of_week')->toArray();

        // Carregar os profissionais e seus serviços
        $professionals = Professional::all();
        foreach ($professionals as $professional) {
            $specializedServiceIds = $professional->specializations;
            $services = Service::whereIn('id', $specializedServiceIds)->get();
            $professional->services = $services;
        }

        $schedulings = Scheduling::all();

        return view('scheduling.index', compact('schedulings', 'professionals', 'workingDays'));
    }


    public function all($date = null)
    {
        if ($date == null) {
            $date = Carbon::now('America/Sao_Paulo');
        } else {
            $date = Carbon::parse($date);
        }

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

        $schedulingsDates = Scheduling::orderBy('date')->get();

        $schedulingsDates->map(function ($scheduling) {
            $service = Service::find($scheduling->service);
            $scheduling->value = $service ? $service->value : 'Valor não encontrado';
            return $scheduling;
        });

        $schedulingsGroupedByDate = $schedulingsDates->groupBy('date');
        $uniqueDates = $schedulingsGroupedByDate->map(function ($schedulings, $date) {
            $valueSum = $schedulings->filter(function ($scheduling) {
                return $scheduling->fulfilled == 1;
            })->sum('value');

            return [
                'date' => Carbon::parse($date),
                'total' => $valueSum
            ];
        })->values()->all();

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

    public function createSelectService($id, $service_id, Request $request)
    {
        $professional = Professional::find($id);
        $service = Service::find($service_id);

        $date = $request->query('date', Carbon::now('America/Sao_Paulo')->format('Y-m-d'));
        $schedulings = Scheduling::where('pro', $id)
            ->whereDate('date', $date) // Certifique-se de que a coluna da data seja correta
            ->with('services')
            ->get();

        // Obtendo horários de abertura e fechamento
        $defaultSchedule = WeeklySchedule::where('special_day', false)->first();
        if ($defaultSchedule) {
            $opening_time = Carbon::createFromFormat('H:i:s', $defaultSchedule->opening_time)->format('H:i');
            $closing_time = Carbon::createFromFormat('H:i:s', $defaultSchedule->closing_time)->format('H:i');
        } else {
            // Definir horários padrão se não houver horários definidos
            $opening_time = '09:00';
            $closing_time = '19:00';
        }

        return view('scheduling.create-final', compact('professional', 'service', 'schedulings', 'service_id', 'id', 'date', 'opening_time', 'closing_time'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'pro' => 'required|integer',
            'service' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $scheduling = new Scheduling();
        $scheduling->name = $validatedData['name'];
        $scheduling->phone = $validatedData['phone'];
        $scheduling->pro = $validatedData['pro'];
        $scheduling->service = $validatedData['service'];
        $scheduling->date = $validatedData['date'];
        $scheduling->time = $validatedData['time'];
        $scheduling->save();

        $professional = Professional::find($request->input('pro'));
        $service = Service::find($request->input('service'));

        return view('scheduling.finishing', compact('scheduling', 'professional', 'service'));
    }

    public function cancel(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $scheduling = Scheduling::findOrFail($request->input('id'));
        $scheduling->fulfilled = 2;
        $scheduling->save();

        return redirect()->back();
    }

    public function finishe(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $scheduling = Scheduling::findOrFail($request->input('id'));
        $scheduling->fulfilled = 1;
        $scheduling->save();

        return redirect()->back();
    }

    public function reset(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $scheduling = Scheduling::findOrFail($request->input('id'));
        $scheduling->fulfilled = 0;
        $scheduling->save();

        return redirect()->back();
    }

    public function times(Request $request)
    {
        $weeklySchedules = WeeklySchedule::all();

        // Buscar os horários padrão para os dias não especiais
        $defaultSchedule = WeeklySchedule::where('special_day', false)->first();

        // Verificar se há um horário padrão
        if ($defaultSchedule) {
            $opening_time = \DateTime::createFromFormat('H:i:s', $defaultSchedule->opening_time)->format('H:i');
            $closing_time = \DateTime::createFromFormat('H:i:s', $defaultSchedule->closing_time)->format('H:i');
        } else {
            // Definir horários padrão se nenhum estiver definido
            $opening_time = '09:00';
            $closing_time = '19:00';
        }

        // Buscar os dias proibidos
        $prohibitedDays = ProhibitedDay::all()->groupBy('type');

        return view('scheduling.times', compact('weeklySchedules', 'opening_time', 'closing_time', 'prohibitedDays'));
    }





    public function storeHours(Request $request)
    {
        // Valide os dados
        $request->validate([
            'opening_time' => 'required|date_format:H:i',
            'closing_time' => 'required|date_format:H:i',
        ]);

        // Apaga os horários anteriores para os dias não especiais
        DB::table('weekly_schedule')->where('special_day', false)->delete();

        // Salve os dados no banco de dados para cada dia da semana que não é especial
        $daysOfWeek = [
            'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'
        ];

        foreach ($daysOfWeek as $day) {
            DB::table('weekly_schedule')->insert([
                'day_of_week' => $day,
                'opening_time' => $request->opening_time,
                'closing_time' => $request->closing_time,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Horas de funcionamento salvas com sucesso para todos os dias da semana, exceto os dias especiais!');
    }

    public function storeSpecialHours(Request $request)
    {
        // Valide os dados
        $request->validate([
            'day_of_week' => 'required|string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            'special_opening_time' => 'required|date_format:H:i',
            'special_closing_time' => 'required|date_format:H:i',
        ]);

        // Recupere os dados do formulário
        $dayOfWeek = $request->day_of_week;
        $specialOpeningTime = $request->special_opening_time;
        $specialClosingTime = $request->special_closing_time;

        // Verifique se já existe um registro para o dia da semana especificado
        $weeklySchedule = WeeklySchedule::where('day_of_week', $dayOfWeek)->first();

        // Se já existir, atualize os horários especiais
        if ($weeklySchedule) {
            $weeklySchedule->opening_time = $specialOpeningTime;
            $weeklySchedule->closing_time = $specialClosingTime;
            $weeklySchedule->special_day = true; // Marque como um special_day
            $weeklySchedule->save();
        } else {
            // Se não existir, crie um novo registro com os horários especiais
            WeeklySchedule::create([
                'day_of_week' => $dayOfWeek,
                'opening_time' => $specialOpeningTime,
                'closing_time' => $specialClosingTime,
                'special_day' => true, // Marque como um special_day
            ]);
        }

        return redirect()->back()->with('success', 'Horário especial salvo com sucesso!');
    }

    public function storeDays(Request $request)
    {
        // Valide os dados
        $request->validate([
            'days' => 'required|array',  // Deve ser um array
            'days.*' => 'string|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',  // Cada item do array deve ser um dia da semana válido
        ]);

        // Obter todos os dias da semana do formulário
        $selectedDays = $request->input('days');

        // Obter todos os dias da semana da tabela
        $daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        // Marcar todos os dias como não trabalhados inicialmente
        DB::table('weekly_schedule')->whereIn('day_of_week', $daysOfWeek)->update(['working' => false]);

        // Atualizar ou inserir os dias selecionados
        foreach ($selectedDays as $day) {
            DB::table('weekly_schedule')
                ->updateOrInsert(
                    ['day_of_week' => $day],
                    ['working' => true]
                );
        }

        // Remover os dias não selecionados
        $notSelectedDays = array_diff($daysOfWeek, $selectedDays);
        DB::table('weekly_schedule')->whereIn('day_of_week', $notSelectedDays)->delete();

        return redirect()->back()->with('success', 'Dias da semana salvos com sucesso!');
    }





    public function storeOffDays(Request $request)
    {
        // Valide os dados
        $request->validate([
            'off_days' => 'required|array',
            'off_days.*' => 'date',
        ]);

        // Salve os dados no banco de dados
        foreach ($request->off_days as $date) {
            ProhibitedDay::create([
                'date' => $date,
                'type' => 'off_day',
            ]);
        }

        return redirect()->back()->with('success', 'Folgas salvas com sucesso!');
    }

    public function storeVacation(Request $request)
    {
        // Valide os dados
        $request->validate([
            'vacation_start' => 'required|date',
            'vacation_end' => 'required|date',
        ]);

        // Apaga quaisquer registros de início e fim de férias existentes
        ProhibitedDay::where('type', 'vacation_start')->delete();
        ProhibitedDay::where('type', 'vacation_end')->delete();

        // Salva os novos dados no banco de dados
        ProhibitedDay::create([
            'date' => $request->vacation_start,
            'type' => 'vacation_start',
        ]);

        ProhibitedDay::create([
            'date' => $request->vacation_end,
            'type' => 'vacation_end',
        ]);

        return redirect()->back()->with('success', 'Férias salvas com sucesso!');
    }


    public function storeHolidays(Request $request)
    {
        // Valide os dados
        $request->validate([
            'holidays' => 'required|array',
            'holidays.*' => 'date',
        ]);

        // Salve os dados no banco de dados
        foreach ($request->holidays as $date) {
            ProhibitedDay::create([
                'date' => $date,
                'type' => 'holiday',
            ]);
        }

        return redirect()->back()->with('success', 'Feriados salvos com sucesso!');
    }

    public function deleteDay(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'type' => 'required|string|in:off_day,vacation_start,vacation_end,holiday',
        ]);

        ProhibitedDay::where('date', $request->date)->where('type', $request->type)->delete();

        return redirect()->back()->with('success', 'Dia proibido deletado com sucesso!');
    }



    public function adminCreate($id){

        $professional = Professional::find($id);
        $professionals = Professional::all();
        $specializedServiceIds = $professional->specializations;
        $services = Service::whereIn('id', $specializedServiceIds)->get();

        return view('scheduling.create-admin', compact('professional', 'professionals', 'services'));

        return true;
    }

    public function adminCreateSelectService($id, $service_id, Request $request)
    {
        $professional = Professional::find($id);
        $service = Service::find($service_id);

        $date = $request->query('date', Carbon::now('America/Sao_Paulo')->format('Y-m-d'));
        $schedulings = Scheduling::where('pro', $id)
            ->whereDate('date', $date) // Certifique-se de que a coluna da data seja correta
            ->with('services')
            ->get();

        // Obtendo horários de abertura e fechamento
        $defaultSchedule = WeeklySchedule::where('special_day', false)->first();
        if ($defaultSchedule) {
            $opening_time = Carbon::createFromFormat('H:i:s', $defaultSchedule->opening_time)->format('H:i');
            $closing_time = Carbon::createFromFormat('H:i:s', $defaultSchedule->closing_time)->format('H:i');
        } else {
            // Definir horários padrão se não houver horários definidos
            $opening_time = '09:00';
            $closing_time = '19:00';
        }

        return view('scheduling.create-admin-final', compact('professional', 'service', 'schedulings', 'service_id', 'id', 'date', 'opening_time', 'closing_time'));
    }

    public function adminStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'pro' => 'required|integer',
            'service' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        $scheduling = new Scheduling();
        $scheduling->name = $validatedData['name'];
        $scheduling->phone = $validatedData['phone'];
        $scheduling->pro = $validatedData['pro'];
        $scheduling->service = $validatedData['service'];
        $scheduling->date = $validatedData['date'];
        $scheduling->time = $validatedData['time'];
        $scheduling->save();

        $professional = Professional::find($request->input('pro'));
        $service = Service::find($request->input('service'));

        return redirect(route('scheduling.all'));

        //return view('scheduling.finishing', compact('scheduling', 'professional', 'service'));
    }
}
