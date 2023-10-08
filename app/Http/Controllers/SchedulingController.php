<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Services;
use App\Models\Workers;
use App\Models\Scheduling;


class SchedulingController extends Controller
{
    //
    public function index(Request $request){

        
        $workers = Workers::all();
        $services = Services::all();
        $schedulings = Scheduling::all();



        return view('scheduling.index', compact('workers', 'services', 'schedulings'));
    }
}
