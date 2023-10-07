<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Services;
use App\Models\Workers;


class Scheduling extends Controller
{
    //
    public function index(Request $request){

        $sqlFunc = "SELECT * FROM funcionarios";
        $workers = Workers::all();

        $sqlCortes = "SELECT * FROM trabalhos";
        $services = Services::all();


        return view('scheduling.index', compact('workers', 'services'));
    }
}
