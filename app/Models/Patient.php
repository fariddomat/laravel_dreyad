<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'file_number',
        'name',
        'gender',
        'mob1',
        'mob2',
        'date_contacted',
        'source',
        'level',
        'notes'
    ];


    public function medical_records()
    {
        return $this->hasMany(MedicalRecord::class);
    }
    public function medicalFiles()
    {
        return $this->hasMany(MedicalFile::class);
    }

    public function getTotalAmountPaidAttribute()
{
    $medicalRecordsPaid = $this->medical_records->sum('amount_paid');
    $paymentsPaid = $this->medical_records->flatMap->payments->sum('amount');
    return $medicalRecordsPaid + $paymentsPaid;
}


}
