<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'referral_date',
        'priority',
        'specialty',
        'referred_doctor',
        'institution',
        'contact_info',
        'reason_for_referral',
        'relevant_history',
        'urgency_reason',
        'include_reports',
        'status',
        'tracking_notes',
        'appointment_date',
        'outcome',
        'referring_doctor'
    ];

    protected $casts = [
        'referral_date' => 'date',
        'appointment_date' => 'date',
        'include_reports' => 'boolean'
    ];

    // Define relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Scope for pending referrals
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Scope for completed referrals
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Get priority badge color
    public function getPriorityBadgeAttribute()
    {
        return match ($this->priority) {
            'routine' => 'bg-warning',
            'urgent' => 'bg-danger',
            'emergency' => 'bg-dark',
            default => 'bg-secondary'
        };
    }

    // Get status badge color
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending' => 'bg-warning',
            'in_progress' => 'bg-info',
            'completed' => 'bg-success',
            'cancelled' => 'bg-danger',
            default => 'bg-secondary'
        };
    }

    // Get priority display name
    public function getPriorityDisplayAttribute()
    {
        return ucfirst($this->priority);
    }

    // Get status display name
    public function getStatusDisplayAttribute()
    {
        return match ($this->status) {
            'in_progress' => 'In Progress',
            default => ucfirst($this->status)
        };
    }

    // Get specialty display name
    public function getSpecialtyDisplayAttribute()
    {
        return ucfirst($this->specialty);
    }
}
