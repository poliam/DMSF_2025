<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'doctor_name', 'control_number'];

    // Define relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class); // A prescription belongs to a patient
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class); // A prescription belongs to a medicine
    }

    public function details()
    {
        return $this->hasMany(PrescriptionDetail::class);
    }

}