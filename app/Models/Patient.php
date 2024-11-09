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
        'phone',
        'birth_date',
        'source',
        'status',
        'clinic',
        'notes',
    ];

}
