<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCertificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'date_issued',
        'certificate_type',
        'purpose',
        'valid_until',
        'issuing_doctor',
        'license_number',
        'medical_findings',
        'recommendations',
        'digital_signature',
        'status',
        'revocation_reason',
        'revoked_at'
    ];

    protected $casts = [
        'date_issued' => 'date',
        'valid_until' => 'date',
        'digital_signature' => 'boolean',
        'revoked_at' => 'datetime'
    ];

    // Define relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Scope for active certificates
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Check if certificate is expired
    public function getIsExpiredAttribute()
    {
        return $this->valid_until && $this->valid_until->isPast();
    }

    // Get status badge color
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'active' => 'bg-success',
            'revoked' => 'bg-danger',
            'expired' => 'bg-secondary',
            default => 'bg-secondary'
        };
    }

    // Get certificate type display name
    public function getCertificateTypeDisplayAttribute()
    {
        return match ($this->certificate_type) {
            'fitness_work' => 'Fitness for Work',
            'medical_leave' => 'Medical Leave',
            'travel_clearance' => 'Travel Clearance',
            'school_sports' => 'School/Sports',
            'custom' => 'Custom Certificate',
            default => ucfirst(str_replace('_', ' ', $this->certificate_type))
        };
    }
}
