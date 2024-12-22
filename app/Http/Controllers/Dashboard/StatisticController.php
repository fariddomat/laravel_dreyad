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

        $medicalRecordsCount = MedicalRecord::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count();

        $totalPayments = Payment::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('amount');

        $totalMedicalRecordPayments = MedicalRecord::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('amount_paid');

        // Calculate yearly statistics
        $yearlyStatistics = [];
        foreach (range(now()->year - 5, now()->year) as $y) {
            $yearlyStatistics[$y] = [
                'patients_count' => Patient::whereYear('date_contacted', $y)->count(),
                'medical_records_count' => MedicalRecord::whereYear('created_at', $y)->count(),
                'total_payments' => Payment::whereYear('created_at', $y)->sum('amount'),
                'total_medical_record_payments' => MedicalRecord::whereYear('created_at', $y)->sum('amount_paid'),
            ];
        }

        return view('dashboard.statistics.index', compact(
            'patientsCount',
            'medicalRecordsCount',
            'totalPayments',
            'totalMedicalRecordPayments',
            'month',
            'year',
            'yearlyStatistics' // Pass the yearly statistics to the view
        ));
    }


    public function show(Request $request)
    {
        // Get filters from request or use defaults
        $year = $request->get('year', Carbon::now()->year);

        // Fetch all months' data for the selected year
        $allMonthsData = Patient::selectRaw('MONTH(date_contacted) as month, COUNT(*) as patients_count')
            ->whereYear('date_contacted', $year)
            ->groupBy('month')
            ->pluck('patients_count', 'month')
            ->toArray();

        $medicalRecordsData = MedicalRecord::selectRaw('MONTH(created_at) as month, COUNT(*) as medical_records_count, SUM(amount_paid) as total_medical_record_payments')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->get()
            ->keyBy('month')
            ->toArray();

        $paymentsData = Payment::selectRaw('MONTH(created_at) as month, SUM(amount) as total_payments')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->pluck('total_payments', 'month')
            ->toArray();

        // Combine data into a single array
        $statistics = [];
        foreach (range(1, 12) as $month) {
            $statistics[$month] = [
                'patients_count' => $allMonthsData[$month] ?? 0,
                'medical_records_count' => $medicalRecordsData[$month]['medical_records_count'] ?? 0,
                'total_medical_record_payments' => $medicalRecordsData[$month]['total_medical_record_payments'] ?? 0,
                'total_payments' => $paymentsData[$month] ?? 0,
            ];
        }

        return view('dashboard.statistics.show', compact('statistics', 'year'));
    }
}
