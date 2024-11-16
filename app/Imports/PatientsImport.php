<?php

namespace App\Imports;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class PatientsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        $currentPatientId = null;

        foreach ($rows as $index => $row) {
            // Skip header row
            if (collect($row)->filter()->isEmpty()) {
                // If all values are null, break out of the loop
                break;
            }
            if ($index === 0) {
                continue;
            }

            // Map Excel fields to database fields
            $fileNo = $row[1];
            $name = $row[2];
            $gender = $row[3];
            $mob1 = $row[4];
            $mob2 = $row[5];
            $service = $row[6];
            $teethNo = $row[7];
            $visitsNo = $row[8];
            $dateContacted = $row[9];
            $dateStart = $row[10];
            $dateEnd = $row[11];
            $source = $row[12];
            $totalCost = $row[13];
            $discount = $row[14];
            $treatmentPlan = $row[15];
            $level = $row[16];
            $status = $row[17];
            $pricing = $row[18];
            $followUp = $row[19];
            $outcome = $row[20];
            $financialStatus = $row[21];
            $amountPaid = $row[22];
            $notes = $row[23];

            // If patient data is null, skip to the next patient
            if (is_null($name) && is_null($mob1)) {
                // $currentPatientId = null; // Reset patient tracking
                // continue;
            }

            // If patient data is not null, check or create patient
            if (!is_null($name)) {
                $patient = Patient::firstOrCreate(
                    [
                        'file_number' => $fileNo ?? (string) \Illuminate\Support\Str::uuid(),
                    ],
                    [
                        'name' => $name,
                        'gender' => $gender,
                        'mob1' => $mob1,
                        'mob2' => $mob2,
                        'source' => $source,
                        'notes' => $notes,
                        // Add other patient fields as needed
                    ]
                );

                $currentPatientId = $patient->id;
            }

            // Create medical record for the current patient
            if ($currentPatientId) {
                MedicalRecord::create([
                    'patient_id' => $currentPatientId,
                    'service' => $service,
                    'teeth_no' => $teethNo,
                    'visits_no' => $visitsNo,
                    'date_contacted' => $dateContacted,
                    'date_start' => $dateStart,
                    'date_end' => $dateEnd,
                    'total_cost' => $totalCost,
                    'discount' => $discount,
                    'treatment_plan' => $treatmentPlan,
                    'level' => $level,
                    'status' => $status,
                    'pricing' => $pricing,
                    'follow_up' => $followUp,
                    'outcome' => $outcome,
                    'financial_status' => $financialStatus,
                    'amount_paid' => $amountPaid,
                    // Add other medical record fields as needed
                ]);
            }
        }
    }
}

