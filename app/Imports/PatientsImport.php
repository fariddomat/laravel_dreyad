<?php

namespace App\Imports;

use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;

class PatientsImport implements ToCollection
{
    /**
     * Convert Excel serial date to MySQL date format.
     *
     * @param mixed $serialDate
     * @return string|null
     */
    public function convertExcelDateToMySQLDate($serialDate)
    {
        if (is_numeric($serialDate)) {
            $date = \DateTime::createFromFormat('Y-m-d', '1899-12-30')->modify("+{$serialDate} days");
            return $date->format('Y-m-d');
        }

        if (\DateTime::createFromFormat('Y-m-d', $serialDate)) {
            return $serialDate;
        }

        return null;
    }

    public function collection(Collection $rows)
    {
        DB::beginTransaction();

        try {
            foreach ($rows as $index => $row) {
                // Skip header row or empty rows
                if ($index === 0 || collect($row)->filter()->isEmpty()) {
                    continue;
                }

                try {
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

                    // Skip if patient data is null
                    if (is_null($name) && is_null($mob1)) {
                        continue;
                    }

                    // Create or fetch patient
                    $patient = Patient::firstOrCreate(
                        ['file_number' => $fileNo ?? (string) \Illuminate\Support\Str::uuid()],
                        [
                            'name' => $name,
                            'gender' => $gender,
                            'mob1' => $mob1,
                            'mob2' => $mob2,
                            'source' => $source,
                            'notes' => $notes,
                        ]
                    );

                    // Create medical record for the patient
                    MedicalRecord::create([
                        'patient_id' => $patient->id,
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
                    ]);
                } catch (\Exception $e) {
                    // Log the error for the problematic row and continue
                    Log::error("Error processing row $index: " . $e->getMessage());
                    continue;
                }
            }

            DB::commit();

            return response()->json(['message' => 'Import completed successfully, with some rows skipped due to errors.']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Import failed: ' . $e->getMessage());

            return response()->json(['error' => 'Import failed! Please check the logs for details.']);
        }
    }
}
