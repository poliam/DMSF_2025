<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewOfSystem extends Model
{
    protected $fillable = [
        'patient_id',
        'consultation_id',
        'symptoms'
    ];

    protected $casts = [
        'symptoms' => 'array'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
} 