<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ServiceController;

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

Route::get('/scheduling', [SchedulingController::class, 'index'])->name('scheduling.index');
Route::get('/places', [PlaceController::class, 'index'])->name('places.all');

/* scheduling routes */
Route::get('/scheduling/create/{id}', [SchedulingController::class, 'create'])->name('scheduling.create');
Route::get('/scheduling/create/{id}/service/{service_id}', [SchedulingController::class, 'createSelectService'])->name('scheduling.create-select-service');
Route::get('/scheduling/all/{date?}', [SchedulingController::class, 'all'])->name('scheduling.all');

Route::post('/scheduling/store', [SchedulingController::class, 'store'])->name('scheduling.store');
// proteger a seguinte rota com o middleware do login do gerente: 
Route::post('/scheduling/cancel', [SchedulingController::class, 'cancel'])->name('scheduling.cancel');
Route::post('/scheduling/finishe', [SchedulingController::class, 'finishe'])->name('scheduling.finishe');
Route::post('/scheduling/reset', [SchedulingController::class, 'reset'])->name('scheduling.reset');

// managing professionals
Route::get('/professionals', [ProfessionalController::class, 'index'])->name('professionals.all');
Route::get('/professionals/create', [ProfessionalController::class, 'create'])->name('professionals.create');
Route::post('/professionals', [ProfessionalController::class, 'store'])->name('professionals.store');
Route::get('/professionals/{id}', [ProfessionalController::class, 'show'])->name('professionals.show');
Route::get('/professionals/{id}/edit', [ProfessionalController::class, 'edit'])->name('professionals.edit');
Route::put('/professionals/{id}', [ProfessionalController::class, 'update'])->name('professionals.update');
Route::delete('/professionals/{id}', [ProfessionalController::class, 'destroy'])->name('professionals.destroy');


// managing services
Route::get('/services', [ServiceController::class, 'index'])->name('services.all');
Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');


// Login
Route::view('/login','login.form')->name('login.form');
Route::post('/auth', [LoginController::class, 'auth']) ->name('login.auth');


Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');




