<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('medicalRecord.patient')->get();
        return view('dashboard.payments.index', compact('payments'));
    }

    public function userPayments($patientId)
    {
        // Retrieve the patient and their payments through medical records
        $patient = Patient::findOrFail($patientId);

        // Fetch payments related to the patient's medical records
        $payments = Payment::whereHas('medicalRecord', function ($query) use ($patientId) {
            $query->where('patient_id', $patientId);
        })->latest()->get();

        return view('dashboard.payments.user-payments', compact('patient', 'payments'));
    }


    public function create()
    {
        $medicalRecords = MedicalRecord::all();
        return view('dashboard.payments.create', compact('medicalRecords'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        Payment::create($data);
        return redirect()->route('dashboard.payments.index')->with('success', 'Payment added successfully.');
    }

    public function show(Payment $payment)
    {
        return view('dashboard.payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        $medicalRecords = MedicalRecord::all();
        return view('dashboard.payments.edit', compact('payment', 'medicalRecords'));
    }

    public function update(Request $request, Payment $payment)
    {
        $data = $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'payment_method' => 'required|string',
            'amount' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'payment_date' => 'required|date',
            'status' => 'required|string',
        ]);

        $payment->update($data);
        return redirect()->route('dashboard.payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('dashboard.payments.index')->with('success', 'Payment deleted successfully.');
    }
}
