<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function patient() {
        return $this->belongsTo(Patient::class);
    }
}
