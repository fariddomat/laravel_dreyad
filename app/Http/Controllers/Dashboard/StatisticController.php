<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Payment;

class StatisticController extends Controller
{
    public function index(Request $request)
{
    // Default date filter: Current month and year
    $month = $request->get('month', Carbon::now()->month);
    $year = $request->get('year', Carbon::now()->year);

    // Filter patients based on the selected month and year
    $patientsCount = Patient::whereYear('date_contacted', $year)
                            ->whereMonth('date_contacted', $month)
                            ->count();

    // Filter medical records based on the selected month and year
    $medicalRecordsCount = MedicalRecord::whereYear('created_at', $year)
                                        ->whereMonth('created_at', $month)
                                        ->count();

    // Filter payments based on the selected month and year
    $totalPayments = Payment::whereYear('created_at', $year)
                            ->whereMonth('created_at', $month)
                            ->sum('amount');

    // Optional: Get the total payment and other stats
    $totalMedicalRecordPayments = MedicalRecord::whereYear('created_at', $year)
                                               ->whereMonth('created_at', $month)
                                               ->sum('amount_paid');

    return view('dashboard.statistics.index', compact('patientsCount', 'medicalRecordsCount', 'totalPayments', 'totalMedicalRecordPayments', 'month', 'year'));
}

public function show(Request $request)
{
    // Default date filter: Current month and year
    $month = $request->get('month', Carbon::now()->month);
    $year = $request->get('year', Carbon::now()->year);

    // Fetch statistics for all months
    $allMonthsData = [];

    foreach (range(1, 12) as $m) {
        $allMonthsData[$m] = [
            'patients_count' => Patient::whereYear('date_contacted', $year)
                                       ->whereMonth('date_contacted', $m)
                                       ->count(),
            'medical_records_count' => MedicalRecord::whereYear('created_at', $year)
                                                    ->whereMonth('created_at', $m)
                                                    ->count(),
            'total_payments' => Payment::whereYear('created_at', $year)
                                       ->whereMonth('created_at', $m)
                                       ->sum('amount'),
            'total_medical_record_payments' => MedicalRecord::whereYear('created_at', $year)
                                                            ->whereMonth('created_at', $m)
                                                            ->sum('amount_paid'),
        ];
    }

    // Fetch statistics for the specific selected month
    $currentMonthData = [
        'patients_count' => Patient::whereYear('date_contacted', $year)
                                  ->whereMonth('date_contacted', $month)
                                  ->count(),
        'medical_records_count' => MedicalRecord::whereYear('created_at', $year)
                                               ->whereMonth('created_at', $month)
                                               ->count(),
        'total_payments' => Payment::whereYear('created_at', $year)
                                   ->whereMonth('created_at', $month)
                                   ->sum('amount'),
        'total_medical_record_payments' => MedicalRecord::whereYear('created_at', $year)
                                                        ->whereMonth('created_at', $month)
                                                        ->sum('amount_paid'),
    ];

    return view('dashboard.statistics.show', compact('allMonthsData', 'currentMonthData', 'month', 'year'));
}
}
