<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    //

    public function index(Request $request){
        $places = Place::all();

        return view('places.index', compact('places'));
    }
}
