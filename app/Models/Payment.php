<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    protected $fillable = [
        'medical_record_id',
        'payment_method',
        'amount',
        'discount',
        'payment_date',
        'status',
    ];

    // Define relationship with MedicalRecord
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    protected static function boot()
{
    parent::boot();

    static::created(function ($payment) {
        $payment->medicalRecord->update([
            'amount_paid' => $payment->medicalRecord->payments->sum('amount'),
        ]);
    });

    static::updated(function ($payment) {
        $payment->medicalRecord->update([
            'amount_paid' => $payment->medicalRecord->payments->sum('amount'),
        ]);
    });

    static::deleted(function ($payment) {
        $payment->medicalRecord->update([
            'amount_paid' => $payment->medicalRecord->payments->sum('amount'),
        ]);
    });
}

}
