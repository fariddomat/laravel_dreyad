<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id', 'service', 'teeth_no', 'visits_no', 'date_start', 'date_end',
        'treatment_plan', 'status', 'pricing', 'discount', 'total_cost', 'follow_up',
        'outcome', 'financial_status', 'amount_paid', 'notes',
    ];

    // الربط مع جدول المرضى
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
