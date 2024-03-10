<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SiteController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\PlaceController;

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


Route::get('/', [SiteController::class, 'index'])->name('site.index');
Route::get('/login', [LoginController::class, 'index'])->name('auth.index');
Route::get('/scheduling', [SchedulingController::class, 'index'])->name('scheduling.index');
Route::get('/places', [PlaceController::class, 'index'])->name('places.all');

/* scheduling routes */
Route::get('/scheduling/create/{id}', [SchedulingController::class, 'create'])->name('scheduling.create');
Route::get('/scheduling/create/{id}/service/{service_id}', [SchedulingController::class, 'createSelectService'])->name('scheduling.create-select-service');
Route::post('/scheduling/store', [SchedulingController::class, 'store'])->name('scheduling.store');




