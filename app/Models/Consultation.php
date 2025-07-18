<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'consultation_date',
    ];

    protected $casts = [
        'consultation_date' => 'date',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function reviewOfSystems()
    {
        return $this->hasMany(ReviewOfSystem::class);
    }

    /**
     * Get the consultation type based on date relative to first consultation
     */
    public function getConsultationTypeAttribute()
    {
        $firstConsultation = $this->patient->consultations()
            ->orderBy('consultation_date')
            ->first();
        
        if (!$firstConsultation) {
            return 'ROS_1st';
        }

        $daysDiff = $this->consultation_date->diffInDays($firstConsultation->consultation_date);
        
        if ($daysDiff == 0) {
            return 'ROS_1st';
        } elseif ($daysDiff >= 6 && $daysDiff <= 8) { // Allow 1-day flexibility
            return 'ROS_2nd';
        } elseif ($daysDiff >= 29 && $daysDiff <= 32) { // Allow 1-2 day flexibility
            return 'ROS_3rd';
        }
        
        return 'ROS_other';
    }

    /**
     * Create or get the three required consultations for a patient
     */
    public static function ensureThreeConsultations($patientId)
    {
        $patient = Patient::find($patientId);
        if (!$patient) {
            return null;
        }

        $consultations = $patient->consultations()->orderBy('consultation_date')->get();
        
        if ($consultations->count() == 0) {
            // Create all three consultations
            $baseDate = now();
            
            $consultation1st = self::create([
                'patient_id' => $patientId,
                'consultation_date' => $baseDate,
            ]);
            
            $consultation2nd = self::create([
                'patient_id' => $patientId,
                'consultation_date' => $baseDate->copy()->addWeek(),
            ]);
            
            $consultation3rd = self::create([
                'patient_id' => $patientId,
                'consultation_date' => $baseDate->copy()->addMonth(),
            ]);
            
            return [
                'ROS_1st' => $consultation1st,
                'ROS_2nd' => $consultation2nd,
                'ROS_3rd' => $consultation3rd,
            ];
        }
        
        // Return existing consultations mapped by type
        $result = [];
        foreach ($consultations as $consultation) {
            $result[$consultation->consultation_type] = $consultation;
        }
        
        return $result;
    }
} 