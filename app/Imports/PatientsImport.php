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
     * Clean a field to remove non-numeric characters.
     *
     * @param string|null $field
     * @return string|null
     */
    private function cleanNumberField(?string $field): ?string
    {
        return $field ? preg_replace('/\D/', '', $field) : '0';
    }

    /**
     * Convert various date formats to MySQL date format.
     *
     * @param mixed $date
     * @return string|null
     */
    function convertExcelDateToMySQLDate($date)
    {
        // Handle Excel serial date (numeric format)
        if (is_numeric($date)) {
            $baseDate = \DateTime::createFromFormat('Y-m-d', '1899-12-30');
            if ($baseDate) {
                $date = $baseDate->modify("+{$date} days");
                return $date->format('Y-m-d'); // Format to MySQL DATE
            }
        }

        // Replace `\` with `/` for consistent delimiter handling
        if (is_string($date)) {
            $date = str_replace('\\', '/', $date);
        }

        // List of possible date formats (flexible parsing)
        $possibleFormats = [
            'd/m/Y',
            'd/m/y',   // Day/Month/Year
            'j/n/Y',
            'j/n/y',   // Single-digit day/month
            'Y-m-d',            // ISO format
        ];

        // Attempt to parse the date using each format
        foreach ($possibleFormats as $format) {
            $parsedDate = \DateTime::createFromFormat($format, $date);
            if ($parsedDate && $parsedDate->format($format) === $date) {
                return $parsedDate->format('Y-m-d'); // Convert to MySQL DATE format
            }
        }

        // Log invalid date for debugging
        // \Log::warning("Invalid date format: {$date}");

        return '2025-01-01'; // Return null if no valid format is matched
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
                $totalCost = $this->cleanNumberField($row[13]);
                $discount = $row[14];
                $treatmentPlan = $row[15];
                $level = $row[16];
                $status = $row[17];
                $pricing = is_numeric($this->cleanNumberField($row[18])) ? (int) $this->cleanNumberField($row[18]) : 0;
                $followUp = $row[19];
                $outcome = $row[20];
                $financialStatus = $row[21];
                $amountPaid = $this->cleanNumberField($row[22]);
                $notes = $row[23];



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

                            'date_contacted' => $this->convertExcelDateToMySQLDate($dateContacted) ?? $this->convertExcelDateToMySQLDate($dateStart),

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
