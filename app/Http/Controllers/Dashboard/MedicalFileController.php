<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\MedicalFile;
use App\Models\Patient;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\Storage;

class MedicalFileController extends Controller
{
    protected $imageHelper;

    public function __construct(ImageHelper $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    // Display a listing of the medical files for a specific patient
    public function index(Patient $patient)
    {
        $medicalFiles = $patient->medicalFiles()->get();
        return view('dashboard.medical_files.index', compact('medicalFiles', 'patient'));
    }

    // Show the form for creating a new medical file
    public function create(Patient $patient)
    {
        return view('dashboard.medical_files.create', compact('patient'));
    }

    // Store a newly created medical file in storage

    public function store(Request $request, Patient $patient)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_path' => 'required|image',
            'description' => 'nullable|string',
        ]);

        $patientId = $patient->id;
        $directory = 'images/patient_files/' . $patientId;

        // Use ImageHelper to store the image
        $imagePath = $this->imageHelper->storeImageInPublicDirectory(
            $request->file('file_path'),
            $directory,
            800,
            600
        );

        // Save the medical file record
        MedicalFile::create([
            'patient_id' => $patientId,
            'file_type' => $request->input('file_type'),
            'file_path' => $imagePath,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('dashboard.patients.medical_files.index', $patient)->with('success', 'Medical file added successfully.');
    }

    // Display the specified medical file
    public function show(Patient $patient, MedicalFile $medicalFile)
    {
        return view('dashboard.medical_files.show', compact('medicalFile', 'patient'));
    }

    // Show the form for editing the specified medical file
    public function edit(Patient $patient, MedicalFile $medicalFile)
    {
        return view('dashboard.medical_files.edit', compact('medicalFile', 'patient'));
    }

    public function update(Request $request,Patient $patient, MedicalFile $medicalFile)
    {
        $request->validate([
            'file_type' => 'required|string',
            'file_path' => 'nullable|image',
            'description' => 'nullable|string',
        ]);

        $patientId = $medicalFile->patient_id;
        $directory = 'images/patient_files/' . $patientId;

        // Check if a new image is uploaded
        if ($request->hasFile('file_path')) {
            // Remove the old image
            $this->imageHelper->removeImageInPublicDirectory($medicalFile->file_path);

            // Store the new image
            $imagePath = $this->imageHelper->storeImageInPublicDirectory(
                $request->file('file_path'),
                $directory,
                800,
                600
            );

            // Update the file path
            $medicalFile->file_path = $imagePath;
        }

        $medicalFile->file_type = $request->input('file_type');
        $medicalFile->description = $request->input('description');
        $medicalFile->save();

        return redirect()->route('dashboard.patients.medical_files.index',$patient)->with('success', 'Medical file updated successfully.');
    }

    // Remove the specified medical file from storage
    public function destroy(MedicalFile $medicalFile, Patient $patient)
    {
        // Delete the image file
        $this->imageHelper->removeImageInPublicDirectory($medicalFile->file_path);

        // Delete the medical file record
        $medicalFile->delete();

        return redirect()->route('dashboard.patients.medical_files.index', $patient)->with('success', 'Medical file deleted successfully.');
    }
}
