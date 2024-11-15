<?php

use App\Http\Controllers\Dashboard\MedicalFileController;
use App\Http\Controllers\Dashboard\MedicalRecordController;
use App\Http\Controllers\Dashboard\PatientController;
use App\Http\Controllers\Dashboard\PaymentController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::prefix('patients/{patient}')->name('patients.')->group(function () {
        Route::resource('medical_files', MedicalFileController::class);
    });
    Route::resource('patients', PatientController::class);
    Route::resource('medical_records', MedicalRecordController::class);
    Route::resource('payments', PaymentController::class);


    Route::resource('services', ServiceController::class);
    // suggestion
});

require __DIR__.'/auth.php';
