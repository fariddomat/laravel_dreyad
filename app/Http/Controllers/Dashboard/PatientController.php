<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
   // عرض جميع المرضى
   public function index()
   {
       $patients = Patient::all();
       return view('dashboard.patients.index', compact('patients'));
   }

   // عرض نموذج إضافة مريض جديد
   public function create()
   {
       return view('dashboard.patients.create');
   }

   // تخزين مريض جديد في قاعدة البيانات
   public function store(Request $request)
   {
       $request->validate([
           'file_number' => 'required|unique:patients,file_number',
           'name' => 'required|string|max:255',
           'phone' => 'nullable|string|max:255',
           'birth_date' => 'nullable|date',
           'source' => 'nullable|string|max:255',
           'status' => 'nullable|string',
           'clinic' => 'nullable|string|max:255',
           'notes' => 'nullable|string',
       ]);

       Patient::create($request->all());

       return redirect()->route('dashboard.patients.index')->with('success', 'تم إضافة المريض بنجاح');
   }

   // عرض بيانات مريض معين
   public function show(Patient $patient)
   {
       return view('dashboard.patients.show', compact('patient'));
   }

   // عرض نموذج تعديل بيانات مريض معين
   public function edit(Patient $patient)
   {
       return view('dashboard.patients.edit', compact('patient'));
   }

   // تحديث بيانات المريض
   public function update(Request $request, Patient $patient)
   {
       $request->validate([
           'file_number' => 'required|unique:patients,file_number,' . $patient->id,
           'name' => 'required|string|max:255',
           'phone' => 'nullable|string|max:255',
           'birth_date' => 'nullable|date',
           'source' => 'nullable|string|max:255',
           'status' => 'nullable|string',
           'clinic' => 'nullable|string|max:255',
           'notes' => 'nullable|string',
       ]);

       $patient->update($request->all());

       return redirect()->route('dashboard.patients.index')->with('success', 'تم تحديث بيانات المريض بنجاح');
   }

   // حذف مريض معين
   public function destroy(Patient $patient)
   {
       $patient->delete();
       return redirect()->route('dashboard.patients.index')->with('success', 'تم حذف المريض بنجاح');
   }
}
