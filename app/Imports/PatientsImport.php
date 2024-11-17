<?php

namespace App\Imports;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class PatientsImport implements ToCollection
{
    /**
     * Convert Excel serial date to MySQL date format.
     *
     * @param mixed $serialDate
     * @return string|null
     */
    function convertExcelDateToMySQLDate($serialDate)
    {
        if (is_numeric($serialDate)) {
            // Convert Excel serial number to PHP DateTime object
            $date = \DateTime::createFromFormat('Y-m-d', '1899-12-30')->modify("+{$serialDate} days");
            return $date->format('Y-m-d'); // Format to MySQL DATE
        }

        // If already in a valid date format or null, return as is
        if (\DateTime::createFromFormat('Y-m-d', $serialDate)) {
            return $serialDate;
        }

        return null; // Invalid date
    }

    public function collection(Collection $rows)
    {
        $currentPatientId = null;

        DB::beginTransaction();
        try {
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
                        'date_contacted' => $this->convertExcelDateToMySQLDate($dateContacted),
                        'date_start' => $this->convertExcelDateToMySQLDate($dateStart),
                        'date_end' => $this->convertExcelDateToMySQLDate($dateEnd),
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
            DB::commit();

            return response()->json(['message' => 'Import completed successfully!']);
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Log the error for debugging
            \Log::error('Import failed: ' . $e->getMessage());

            // Return an error message to the user
            return response()->json(['error' => 'Import failed! Please try again.']);
        }
    }
}
