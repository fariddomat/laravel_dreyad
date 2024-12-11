<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ImportController;
use App\Http\Controllers\Dashboard\MedicalFileController;
use App\Http\Controllers\Dashboard\MedicalRecordController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\StatisticController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

 });
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::resource('users', UserController::class);
});

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::prefix('patients/{patient}')->name('patients.')->group(function () {
        Route::resource('medical_files', MedicalFileController::class);
    });
    Route::resource('patients', PatientController::class);
    Route::resource('medical_records', MedicalRecordController::class);
    Route::get('/medical_records/user/{id}', [MedicalRecordController::class, 'patient'])->name('medical_records.user');

    Route::resource('payments', PaymentController::class);
    Route::get('/payments/user/{id}', [PaymentController::class, 'userPayments'])->name('payments.user');

    Route::get('/import-patients', [ImportController::class, 'index'])->name('import.patient');
    Route::post('/import-patients', [ImportController::class, 'importPatients'])->name('import.patients');

    Route::resource('services', ServiceController::class);
    Route::get('/statistics', [StatisticController::class, 'index'])->name('statistics');
    Route::get('/statistics/show', [StatisticController::class, 'show'])->name('statistics.show');

    // suggestion
});

require __DIR__.'/auth.php';
