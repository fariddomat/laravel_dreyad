<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Service;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::with('patient')->get();
        return view('dashboard.medical_records.index', compact('medicalRecords'));
    }
    public function patient($id)
    {


        // Filter medical records by patient ID if provided
        $medicalRecords = MedicalRecord::where('patient_id', $id)
            ->paginate(25);

        return view('dashboard.medical_records.index', compact('medicalRecords'));
    }


    public function create()
    {

        $services = Service::all();
        $patients = Patient::all(); // جلب المرضى لإختيار المريض عند إضافة سجل طبي جديد
        return view('dashboard.medical_records.create', compact('patients', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'service' => 'required|string',
            'teeth_no' => 'required|string',
            'visits_no' => 'required|integer',
            'date_start' => 'required|date',
            // 'date_end' => 'date',
            'treatment_plan' => 'required|string',
            'status' => 'required|string',
            'pricing' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total_cost' => 'required|numeric',
            'follow_up' => 'nullable|string',
            'outcome' => 'nullable|string',
            'financial_status' => 'required|string',
            'amount_paid' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('dashboard.medical_records.index')->with('success', 'تم إضافة السجل الطبي بنجاح');
    }

    public function show(MedicalRecord $medicalRecord)
    {

        return view('dashboard.medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {

        $services = Service::all();
        $patients = Patient::all(); // جلب المرضى لتعديل السجل الطبي
        return view('dashboard.medical_records.edit', compact('medicalRecord', 'patients', 'services'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'service' => 'required|string',
            'teeth_no' => 'required|string',
            'visits_no' => 'required|integer',
            'date_start' => 'required|date',
            // 'date_end' => 'date',
            'treatment_plan' => 'required|string',
            'status' => 'required|string',
            'pricing' => 'required|numeric',
            'discount' => 'nullable|numeric',
            'total_cost' => 'required|numeric',
            'follow_up' => 'nullable|string',
            'outcome' => 'nullable|string',
            'financial_status' => 'required|string',
            'amount_paid' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('dashboard.medical_records.index')->with('success', 'تم تحديث السجل الطبي بنجاح');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('dashboard.medical_records.index')->with('success', 'تم حذف السجل الطبي');
    }
}
