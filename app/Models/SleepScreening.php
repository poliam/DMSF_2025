<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepScreening extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'sleep_time',
        'wake_time',
        'sleep_duration',
        'sleep_quality',
        'sleep_activities',
        'daytime_sleepiness',
        'blood_pressure',
        'bmi',
        'age',
        'neck_circumference',
        'gender',
        'recommended_assessments',
    ];

    protected $casts = [
        'sleep_time' => 'datetime:H:i',
        'wake_time' => 'datetime:H:i',
        'sleep_duration' => 'decimal:1',
        'sleep_quality' => 'integer',
        'sleep_activities' => 'array',
        'bmi' => 'decimal:2',
        'age' => 'integer',
        'neck_circumference' => 'decimal:1',
        'recommended_assessments' => 'array',
    ];

    /**
     * Get the patient that owns the sleep screening.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
