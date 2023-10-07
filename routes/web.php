<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Scheduling;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/site', [Site::class, 'index'])->name('site.index');
Route::get('/login', [Login::class, 'index'])->name('auth.index');
Route::get('/scheduling', [Scheduling::class, 'index'])->name('scheduling.index');

