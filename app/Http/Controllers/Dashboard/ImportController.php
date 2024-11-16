<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\PatientsImport;
use App\Imports\MedicalRecordsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function index()
    {
        return view('dashboard.import.import');
    }

    public function importPatients(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new PatientsImport, $request->file('file'));

        return back()->with('success', 'Patients data imported successfully!');
    }
}
