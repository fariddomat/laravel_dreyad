<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role; // Import the correct Role model


class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'usersCount' => User::count(),
            'rolesCount' => Role::count(),
            'servicesCount' => Service::count(),
            'paymentsCount' => Payment::count(),
            'patientsCount' => Patient::count(), // Assuming you have a Patient model
            'medicalRecordsCount' => MedicalRecord::count(), // Assuming you have a MedicalRecord model
        ]);
    }
}
