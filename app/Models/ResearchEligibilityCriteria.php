<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchEligibilityCriteria extends Model
{
    use HasFactory;
    protected $table = 'research_eligibility_criteria';

    protected $fillable = [
        'patient_id', 'read_and_write_consent', 'consent_for_info', 
        'consent_for_teleconsultation', 'laboratory_finding', 
        'fbs_result', 'rbs_result', 'polyuria', 'polydipsia', 'polyphagia'
    ];

    // Assuming you have a Patient model to link to
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
