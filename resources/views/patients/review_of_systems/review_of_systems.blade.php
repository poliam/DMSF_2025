@php
    $sections = [
        'GENERAL' => [
            'weight loss', 'weight gain', 'insomnia', 'fatigue', 'anorexia', 'fever', 'night sweats'
        ],
        'SKIN' => [
            'pruritus', 'vasomotor changes'
        ],
        'HEAD' => [
            'headache', 'dizziness', 'lightheadedness', 'pruritus'
        ],
        'EYES' => [
            'blurring of vision', 'double vision', 'flashing lights', 'photosensitivity', 'spots/specks', 'pain', 'itching'
        ],
        'EARS' => [
            'vertigo', 'tinnitus', 'hearing loss', 'Pain', 'pruritus'
        ],
        'NOSE' => [
            'pruritus', 'nasal congestion', 'sinus pain', 'anosmia', 'obstruction'
        ],
        'MOUTH & THROAT' => [
            'changes in taste', 'ageusia', 'pain', 'dry mouth', 'loose teeth', 'Sores', 'difficulty swallowing', 'odynophagia'
        ],
        'BREAST' => [
            'engorgement', 'pain', 'nipple discharge'
        ],
        'RESPIRATORY' => [
            'dyspnea', 'wheezing', 'cough', 'sputum production', 'hemoptysis', 'pleuritic pain', 'back pain'
        ],
        'CARDIOVASCULAR' => [
            'shortness of breath', 'exertional dyspnea', 'paroxysmal nocturnal dyspnea', 'palpitations', 'syncope', 'orthopnea', 'nocturnal dyspnea', 'nape pain', 'chest pain or discomfort'
        ],
        'GASTROINTESTINAL' => [
            'nausea', 'vomiting', 'dysphagia', 'retching', 'hiccups', 'excessive burping', 'hematemesis', 'regurgitation', 'heartburn', 'distention', 'diarrhea', 'constipation', 'excessive flatulence', 'tenesmus', 'dyschezia', 'melena', 'hematochezia', 'abdominal pain (specify)'
        ],
        'PERIPHERAL-VASCULAR' => [
            'pain', 'cramps', 'swelling', 'claudication'
        ],
        'GENITO-URINARY' => [
            'decreased urine flow', 'urinary urgency', 'urinary frequency', 'incontinence', 'dysuria', 'hematuria', 'nocturia', 'decreased libido', 'hypogastric pain', 'flank pain', 'pelvic pain', 'Inguinal pain', 'scrotal pain', 'dysmenorrhea', 'dyspareunia', 'pruritus'
        ],
        'MUSCULO-SKELETAL' => [
            'neck pain', 'back pain', 'muscle pain', 'joint pain', 'stiffness', 'trauma'
        ],
        'NEUROLOGIC' => [
            'paresthesia', 'sensory perversions', 'seizures', 'head trauma'
        ],
        'HEMATOLOGIC' => [
            'pica', 'abnormal bleeding', 'easy bruising'
        ],
        'ENDOCRINE' => [
            'voice changes', 'heat intolerance', 'cold intolerance', 'polydipsia', 'polyphagia', 'polyuria'
        ]
    ];
@endphp

<div class="container-fluid">
    <!-- Consultation Tabs -->
    <ul class="nav nav-tabs" id="rosConsultationTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ros-1st-tab" data-bs-toggle="tab" data-bs-target="#ros-1st" type="button" role="tab" aria-controls="ros-1st" aria-selected="true">
                <i class="fas fa-calendar-day"></i> 1st Consultation
                <span class="badge bg-secondary ms-1" id="ros-1st-date">Loading...</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ros-2nd-tab" data-bs-toggle="tab" data-bs-target="#ros-2nd" type="button" role="tab" aria-controls="ros-2nd" aria-selected="false">
                <i class="fas fa-calendar-week"></i> 2nd Consultation
                <span class="badge bg-secondary ms-1" id="ros-2nd-date">Loading...</span>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ros-3rd-tab" data-bs-toggle="tab" data-bs-target="#ros-3rd" type="button" role="tab" aria-controls="ros-3rd" aria-selected="false">
                <i class="fas fa-calendar-days"></i> 3rd Consultation
                <span class="badge bg-secondary ms-1" id="ros-3rd-date">Loading...</span>
            </button>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="rosConsultationTabsContent">
        @foreach(['ROS_1st', 'ROS_2nd', 'ROS_3rd'] as $index => $consultationType)
        <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="{{ strtolower(str_replace('_', '-', $consultationType)) }}" role="tabpanel" aria-labelledby="{{ strtolower(str_replace('_', '-', $consultationType)) }}-tab">
            <div class="mt-3">
                <form class="reviewOfSystemsForm" data-consultation-type="{{ $consultationType }}">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <input type="hidden" name="consultation_type" value="{{ $consultationType }}">

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="alert alert-info mb-3">
                            <i class="fas fa-info-circle"></i>
                                <strong>Review of Systems (ROS) Consultations:</strong> This form tracks symptoms across three consultations: 
                                Initial, One Week Follow-up , and One Month Follow-up.
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>

                    <div class="row">
                        @foreach($sections as $section => $symptoms)
                            <div class="col-md-4 mb-3">
                                <div class="card h-100">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0">{{ $section }}</h6>
                                    </div>
                                    <div class="card-body py-2">
                                        @foreach($symptoms as $symptom)
                                            @php
                                                $sectionKey = strtolower(str_replace(' ', '_', $section));
                                                $inputId = $consultationType . '_' . strtolower(str_replace([' ', '&', '(', ')', '-'], '_', $symptom));
                                            @endphp
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" 
                                                       name="symptoms[{{ $sectionKey }}][]" 
                                                       value="{{ $symptom }}" 
                                                       id="{{ $inputId }}">
                                                <label class="form-check-label small" for="{{ $inputId }}">
                                                    {{ ucfirst($symptom) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
.card {
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

.card:hover {
    box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
}

.form-check-label {
    font-size: 0.875rem;
    line-height: 1.2;
}

.card-body {
    max-height: 300px;
    overflow-y: auto;
}

/* Alert Modal Styles */
#alertModal .modal-content {
    border-radius: 15px;
    overflow: hidden;
}

#alertModal .modal-header {
    border-radius: 15px 15px 0 0;
}

#alertModal .modal-body {
    font-size: 1.1rem;
}

#alertModal .btn {
    border-radius: 25px;
    padding: 8px 20px;
    font-weight: 500;
}

/* Pulse animation for success */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

#alertModal.success .modal-content {
    animation: pulse 0.6s ease-in-out;
}

/* Loading button styles */
.btn:disabled {
    opacity: 0.7;
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Tab badges */
.nav-tabs .nav-link .badge {
    font-size: 0.7rem;
}

.nav-tabs .nav-link:hover .badge {
    background-color: #6c757d !important;
}

.nav-tabs .nav-link.active .badge {
    background-color: #0d6efd !important;
}
</style>

<script>
$(document).ready(function() {
    let consultationsData = {};

    // Load consultations data on page load
    loadConsultations();

    // Handle form submissions
    $('.reviewOfSystemsForm').on('submit', function(e) {
        e.preventDefault();
        
        const form = $(this);
        const consultationType = form.data('consultation-type');
        const submitBtn = form.find('button[type="submit"]');
        let formData = form.serialize();
        
        // If no checkboxes are checked, send empty symptoms array
        if (!formData.includes('symptoms')) {
            formData += '&symptoms[]=';
        }
        
        // Show loading state
        const originalBtnText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-1"></i>Saving...');
        
        $.ajax({
            url: `/patients/{{ $patient->id }}/review-of-systems`,
            method: 'POST',
            data: formData,
            success: function(response) {
                // Show success message
                showAlert('success', response.message);
                
                // Update the consultation date display
                form.find('.consultation-date-display').text(response.consultation_date);
            },
            error: function(xhr) {
                const errorMsg = xhr.responseJSON?.message || 'Error saving Review of Systems';
                showAlert('error', errorMsg);
            },
            complete: function() {
                // Restore button state
                submitBtn.prop('disabled', false).html(originalBtnText);
            }
        });
    });

    // Load consultations and populate forms
    function loadConsultations() {
        $.ajax({
            url: `/patients/{{ $patient->id }}/consultations`,
            method: 'GET',
            success: function(response) {
                consultationsData = response;
                populateConsultationTabs();
                populateForms();
            },
            error: function(xhr) {
                showAlert('error', 'Error loading consultation data');
            }
        });
    }

    // Populate consultation tab dates
    function populateConsultationTabs() {
        ['ROS_1st', 'ROS_2nd', 'ROS_3rd'].forEach(function(type) {
            const consultation = consultationsData[type];
            if (consultation && consultation.consultation_date) {
                const date = new Date(consultation.consultation_date);
                const formattedDate = date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                $(`#${type.toLowerCase().replace('_', '-')}-date`).text(formattedDate);
            }
        });
    }

    // Populate forms with existing symptoms
    function populateForms() {
        ['ROS_1st', 'ROS_2nd', 'ROS_3rd'].forEach(function(consultationType) {
            const consultation = consultationsData[consultationType];
            const form = $(`.reviewOfSystemsForm[data-consultation-type="${consultationType}"]`);
            
            if (consultation) {
                // Update consultation date display
                if (consultation.consultation_date) {
                    const date = new Date(consultation.consultation_date);
                    const formattedDate = date.toLocaleDateString('en-US', { 
                        year: 'numeric', 
                        month: 'long', 
                        day: 'numeric' 
                    });
                    form.find('.consultation-date-display').text(formattedDate);
                }

                // Populate symptoms
                const symptoms = consultation.symptoms || {};
                form.find('input[type="checkbox"]').prop('checked', false); // Clear all first
                
                Object.keys(symptoms).forEach(function(section) {
                    const sectionSymptoms = symptoms[section];
                    if (Array.isArray(sectionSymptoms)) {
                        sectionSymptoms.forEach(function(symptom) {
                            const checkbox = form.find(`input[name="symptoms[${section}][]"][value="${symptom}"]`);
                            checkbox.prop('checked', true);
                        });
                    }
                });
            }
        });
    }

    // Show alert messages as a modal popup
    function showAlert(type, message) {
        const isSuccess = type === 'success';
        const modalClass = isSuccess ? 'modal-success' : 'modal-error';
        const iconClass = isSuccess ? 'fa-check-circle' : 'fa-exclamation-circle';
        const bgColor = isSuccess ? 'bg-success' : 'bg-danger';
        const title = isSuccess ? 'Success!' : 'Error!';
        
        // Remove any existing alert modal
        $('#alertModal').remove();
        
        const alertModal = $(`
            <div class="modal fade ${isSuccess ? 'success' : ''}" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">
                        <div class="modal-header ${bgColor} text-white border-0">
                            <h5 class="modal-title" id="alertModalLabel">
                                <i class="fas ${iconClass} me-2"></i>${title}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center py-4">
                            <p class="mb-0 fs-6">${message}</p>
                        </div>
                        <div class="modal-footer border-0 justify-content-center">
                            <button type="button" class="btn ${isSuccess ? 'btn-success' : 'btn-danger'}" data-bs-dismiss="modal">
                                <i class="fas fa-check me-1"></i>OK
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `);
        
        $('body').append(alertModal);
        
        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('alertModal'));
        modal.show();
        
        // Auto dismiss after 4 seconds for success messages
        if (isSuccess) {
            setTimeout(function() {
                modal.hide();
            }, 4000);
        }
        
        // Remove modal from DOM when hidden
        $('#alertModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    }

    // Handle tab switches to reload data if needed
    $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
        const targetTab = $(e.target).attr('data-bs-target');
        const consultationType = targetTab.replace('#', '').replace('-', '_').toUpperCase();
        
        // Refresh data for the active tab if needed
        if (!consultationsData[consultationType]) {
            loadConsultations();
        }
    });
});
</script> 