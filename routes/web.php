<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['web'])->group(function () {
    Route::get('/', [SiteController::class, 'index'])->name('site.index');

    Route::get('/scheduling', [SchedulingController::class, 'index'])->name('scheduling.index');
    Route::get('/places', [PlaceController::class, 'index'])->name('places.all');

    /* Scheduling routes */
    Route::get('/scheduling/create/{id}', [SchedulingController::class, 'create'])->name('scheduling.create');
    Route::get('/scheduling/create/{id}/service/{service_id}', [SchedulingController::class, 'createSelectService'])->name('scheduling.create-select-service');
    Route::get('/scheduling/all/{date?}', [SchedulingController::class, 'all'])->name('scheduling.all');

    Route::post('/scheduling/store', [SchedulingController::class, 'store'])->name('scheduling.store');

    // Protegendo as rotas com middleware auth
    Route::middleware('auth')->group(function () {
        Route::post('/scheduling/cancel', [SchedulingController::class, 'cancel'])->name('scheduling.cancel');
        Route::post('/scheduling/finishe', [SchedulingController::class, 'finishe'])->name('scheduling.finishe');
        Route::post('/scheduling/reset', [SchedulingController::class, 'reset'])->name('scheduling.reset');

        // Managing professionals
        Route::get('/professionals', [ProfessionalController::class, 'index'])->name('professionals.all');
        Route::get('/professionals/create', [ProfessionalController::class, 'create'])->name('professionals.create');
        Route::post('/professionals', [ProfessionalController::class, 'store'])->name('professionals.store');
        Route::get('/professionals/{id}', [ProfessionalController::class, 'show'])->name('professionals.show');
        Route::get('/professionals/{id}/edit', [ProfessionalController::class, 'edit'])->name('professionals.edit');
        Route::put('/professionals/{id}', [ProfessionalController::class, 'update'])->name('professionals.update');
        Route::delete('/professionals/{id}', [ProfessionalController::class, 'destroy'])->name('professionals.destroy');

        // Managing services
        Route::get('/services', [ServiceController::class, 'index'])->name('services.all');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
        Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
        Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
        Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
        Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

        // Admin routes
        Route::get('/admin/dashboard/{date?}', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/services', [ServiceController::class, 'index'])->name('admin.services');
        Route::get('/admin/profissionais', [ProfessionalController::class, 'index'])->name('admin.profissionais');

        Route::get('/admin/times', [SchedulingController::class, 'times'])->name('admin.times');


        Route::post('/scheduling/store/hours', [SchedulingController::class, 'storeHours'])->name('scheduling.store.hours');
        Route::post('/scheduling/store/days', [SchedulingController::class, 'storeDays'])->name('scheduling.store.days');
        Route::post('/scheduling/store/off_days', [SchedulingController::class, 'storeOffDays'])->name('scheduling.store.off_days');
        Route::post('/scheduling/store/vacation', [SchedulingController::class, 'storeVacation'])->name('scheduling.store.vacation');
        Route::post('/scheduling/store/holidays', [SchedulingController::class, 'storeHolidays'])->name('scheduling.store.holidays');
        Route::post('/scheduling/store-special-hours', [SchedulingController::class, 'storeSpecialHours'])->name('scheduling.store.special_hours');
        Route::post('/scheduling/delete-day', [SchedulingController::class, 'deleteDay'])->name('scheduling.delete.day');

        Route::get('/scheduling/admin/create/{id}', [SchedulingController::class, 'adminCreate'])->name('scheduling.admin.create');
        Route::get('/scheduling/admin/create/{id}/service/{service_id}', [SchedulingController::class, 'adminCreateSelectService'])->name('scheduling.admin.create-select-service');
        Route::post('/scheduling/admin/store', [SchedulingController::class, 'adminStore'])->name('scheduling.admin.store');



    });

    // Login routes
    Route::view('/login', 'login.form')->name('login.form');
    Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
});
