<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('admin.dashboard');
    }
    public function services() {
        return view('admin.services');
    }
    public function prof() {
        return view('admin.profissionais');
    }
}