@php
    // Get consultations passed from parent
    $consultations = [
        1 => $consultation1 ?? null,
        2 => $consultation2 ?? null,
        3 => $consultation3 ?? null
    ];
    
    // Default to first consultation if available
    $activeConsultation = $consultation1 ?? $consultation2 ?? $consultation3 ?? null;
@endphp

<style>
    .progress-tabs {
        padding: 20px 5%;
        position: relative;
        font-family: 'Lato', sans-serif;
    }

    /* Tab bar container */
    .tab-bar-container {
        margin: 1.5rem 0;
    }

    /* Make tabs scroll horizontally on small screens */
    .nav-tabs.flex-nowrap {
        overflow-x: auto;
        overflow-y: hidden;
        white-space: nowrap;
        flex-wrap: nowrap;
    }

    .nav-tabs .nav-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
        height: 50px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: 600;
        text-align: center;
    }

    .nav-tabs .nav-link .step-title {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 2px;
        line-height: 1.1;
    }

    .nav-tabs .nav-link .step-subtitle {
        font-size: 11px;
        opacity: 0.8;
        font-weight: 400;
        line-height: 1;
    }

    .nav-tabs .nav-link.active {
        color: #fff;
        background-color: #236477;
        border-color: #173042 #173042 transparent;
    }

    .nav-tabs .nav-link {
        color: #236477;
    }

    .lifestyle-content {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 2rem;
        margin-top: 0; /* Tighten spacing since tabs already add margin */
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="progress-tabs">
            <div class="tab-bar-container">
                <ul class="nav nav-tabs flex-nowrap" id="lifestyle-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-sleep" data-bs-toggle="tab" data-bs-target="#list-sleep" type="button" role="tab" aria-controls="list-sleep" aria-selected="true">
                            <span>
                                <div class="step-title">Sleep Assessment</div>
                                <div class="step-subtitle">Rest evaluation</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-stress-management" data-bs-toggle="tab" data-bs-target="#list-stress-management" type="button" role="tab" aria-controls="list-stress-management" aria-selected="false">
                            <span>
                                <div class="step-title">Stress Management</div>
                                <div class="step-subtitle">Mental health</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-social-connectedness" data-bs-toggle="tab" data-bs-target="#list-social-connectedness" type="button" role="tab" aria-controls="list-social-connectedness" aria-selected="false">
                            <span>
                                <div class="step-title">Social Connectedness</div>
                                <div class="step-subtitle">Community support</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-substance-use" data-bs-toggle="tab" data-bs-target="#list-substance-use" type="button" role="tab" aria-controls="list-substance-use" aria-selected="false">
                            <span>
                                <div class="step-title">Substance Use</div>
                                <div class="step-subtitle">Usage screening</div>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="lifestyle-content">
            <div class="tab-content" id="lifestyle-measures-tabContent">
                <div class="tab-pane fade show active" id="list-sleep" role="tabpanel" aria-labelledby="list-sleep-list">
                    @include('patients.otherlmandvs.components.sleep_assessment', [
                        'patient' => $patient,
                        'consultation' => $activeConsultation,
                        'consultations' => $consultations
                    ])
                </div>
                <div class="tab-pane fade" id="list-stress-management" role="tabpanel" aria-labelledby="list-stress-management-list">
                    @include('patients.otherlmandvs.components.stress_management', [
                        'patient' => $patient,
                        'consultation' => $activeConsultation,
                        'consultations' => $consultations
                    ])
                </div>
                <div class="tab-pane fade" id="list-social-connectedness" role="tabpanel" aria-labelledby="list-social-connectedness-list">
                    @include('patients.otherlmandvs.components.social_connectedness', [
                        'patient' => $patient,
                        'consultation' => $activeConsultation,
                        'consultations' => $consultations
                    ])
                </div>
                <div class="tab-pane fade" id="list-substance-use" role="tabpanel" aria-labelledby="list-substance-use-list">
                    @include('patients.otherlmandvs.components.substance_use', [
                        'patient' => $patient,
                        'consultation' => $activeConsultation,
                        'consultations' => $consultations
                    ])
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Listen for consultation changes from parent
document.addEventListener('consultationChanged', function(event) {
    const { consultationId, consultationNumber } = event.detail;
    
    // Store active consultation data for lifestyle measures components
    window.lifestyleMeasuresConsultation = {
        id: consultationId,
        number: consultationNumber
    };
    
    // Notify all lifestyle measures components about the consultation change
    const lifestyleChangeEvent = new CustomEvent('lifestyleMeasuresConsultationChanged', {
        detail: {
            consultationId: consultationId,
            consultationNumber: consultationNumber
        }
    });
    document.dispatchEvent(lifestyleChangeEvent);
});

// No extra JS required for tab switching; Bootstrap handles it via data attributes.
// Keep consultation data available globally on initial load as well, if present.
$(document).ready(function() {
    window.lifestyleMeasuresConsultation = {
        id: window.currentConsultationId,
        number: window.currentConsultationNumber
    };
});
</script> 