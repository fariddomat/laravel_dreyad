<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
{
    $query = Patient::query();

    if ($request->has('search') && !empty($request->search)) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('file_number', 'like', '%' . $request->search . '%');
    }

    $patients = $query->paginate(25); // Paginate the results

    if ($request->ajax()) {
        return response()->json([
            'html' => view('dashboard.patients.partials.patient_table', compact('patients'))->render(),
            'pagination' => (string) $patients->links(),
        ]);
    }

    return view('dashboard.patients.index', compact('patients'));
}


    public function create()
    {
        return view('dashboard.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_number' => 'required|unique:patients',
            'name' => 'required',
            'gender' => 'required|in:male,female',
        ]);

        Patient::create($request->all());
        return redirect()->route('dashboard.patients.index')->with('success', 'تم إضافة المريض بنجاح');
    }

    public function show(Patient $patient)
    {

    $medicalRecordsCount = $patient->medical_records->count();
    $paymentsCount = $patient->medical_records->flatMap->payments->count();
        return view('dashboard.patients.show', compact('patient', 'medicalRecordsCount', 'paymentsCount'));
    }

    public function edit(Patient $patient)
    {
        return view('dashboard.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'file_number' => 'required|unique:patients,file_number,' . $patient->id,
            'name' => 'required',
            'gender' => 'required|in:male,female',
        ]);

        $patient->update($request->all());
        return redirect()->route('dashboard.patients.index')->with('success', 'تم تحديث بيانات المريض بنجاح');
    }

    public function destroy(Patient $patient)
    {
        $patient->medicalRecords()->delete();
        $patient->delete();
        return redirect()->route('dashboard.patients.index')->with('success', 'تم حذف المريض بنجاح');
    }
}
