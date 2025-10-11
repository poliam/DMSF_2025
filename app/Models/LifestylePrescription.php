<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifestylePrescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'control_number',
        'diet_type',
        'diet_notes',
        'exercise_type',
        'exercise_notes',
        'sleep_recommendations',
        'stress_recommendations',
        'social_connectedness_recommendations',
        'substance_avoidance_recommendations',
    ];

    public function patient()
    {
        return $this->belongsTo(\App\Models\Patient::class);
    }
}
