<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Define the relationship with MedicalRecord.
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class, 'service', 'name');
    }
}
