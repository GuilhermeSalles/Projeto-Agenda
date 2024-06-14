<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Service;
use App\Models\Scheduling;

class DashboardController extends Controller
{
    public function index($date = null)
    {
        if ($date == null) {
            // Definindo a data atual no fuso horário de São Paulo
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
}
