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
            $specializedServiceIds = $professional->specializations;
            $services = Service::whereIn('id', $specializedServiceIds)->get();
            $professional->services = $services;
            $workingHours = $professional->workingHours;
            $workingDays = $workingHours->pluck('day_of_week')->implode(', ');
            $professional->workingDays = $workingDays;
        }

        $schedulings = Scheduling::all();

        return view('scheduling.index', compact('schedulings', 'professionals'));
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

    public function createSelectService($id, $service_id)
    {
        $professional = Professional::find($id);
        $service = Service::find($service_id);
       // $schedulings = Scheduling::where('pro', $id)->get();
        $schedulings = Scheduling::where('pro', $id)->with('services')->get();

        return view('scheduling.create-final', compact('professional',  'service'));
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
}
