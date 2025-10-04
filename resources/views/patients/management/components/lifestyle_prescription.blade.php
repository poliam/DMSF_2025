<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="fas fa-heart me-2"></i>
                Lifestyle Prescription Management
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-between">
                    <div class="d-flex gap-2">
                        <button type="button" id="createLifestyleBtn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLifestyleModal">
                            <i class="fas fa-plus me-1"></i>
                            Create Lifestyle Plan
                        </button>
                        <button type="button" id="editLifestyleBtn" class="btn btn-outline-secondary d-none">
                            <i class="fas fa-edit me-1"></i>
                            Edit Lifestyle Plan
                        </button>
                    </div>
                    <div class="d-flex gap-2" id="printDownloadButtons" style="display: none !important;">
                        <button type="button" id="printLifestyleBtn" class="btn btn-outline-primary">
                            <i class="fas fa-print me-1"></i>
                            Print
                        </button>
                        <button type="button" id="downloadLifestyleBtn" class="btn btn-outline-info">
                            <i class="fas fa-download me-1"></i>
                            Download PDF
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-utensils me-1"></i> Dietary Recommendations <span id="dietHeaderType" class="fw-normal"></span></h6>
                        </div>
                        <div class="card-body">
                            <div id="dietBodyNotes" class="mb-3 small text-muted"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-warning">
                        <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-running me-1"></i> Exercise Recommendations <span id="exerciseHeaderType" class="fw-normal"></span></h6>
                        </div>
                        <div class="card-body">
                            <div id="exerciseBodyNotes" class="mb-3 small text-muted"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-bed me-1"></i> Sleep Management</h6>
                        </div>
                        <div class="card-body">
                            <div id="sleepManagement" class="small text-muted"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-secondary">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-brain me-1"></i> Stress Management</h6>
                        </div>
                        <div class="card-body">
                            <div id="stressManagement" class="small text-muted"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card border-success">
                        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-users me-1"></i> Social Connectedness</h6>
                        </div>
                        <div class="card-body">
                            <div id="socialConnectedness" class="small text-muted"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                            <h6 class="mb-0"><i class="fas fa-shield-alt me-1"></i> Substance Use</h6>
                        </div>
                        <div class="card-body">
                            <div id="substanceUse" class="small text-muted"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Lifestyle Plan Modal -->
<div class="modal fade" id="addLifestyleModal" tabindex="-1" aria-labelledby="addLifestyleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLifestyleModalLabel">Create Lifestyle Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="lifestyleForm" method="POST">
                    @csrf
                    <input type="hidden" id="patientId" name="patient_id" value="{{ $patient->id }}">
                    <input type="hidden" id="lifestyleId" value="">
                    <div class="row">
                        <div class="col-md-6">
                            <h6>Dietary Recommendations</h6>
                            <div class="mb-3">
                                <label for="dietType" class="form-label">Diet Type</label>
                                <select class="form-select" id="dietType" name="diet_type">
                                    <option value="">Select diet type</option>
                                    <option value="diabetic">Diabetic Diet</option>
                                    <option value="mediterranean">Mediterranean Diet</option>
                                    <option value="low_carb">Low Carbohydrate</option>
                                    <option value="dash">DASH Diet</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dietNotes" class="form-label">Dietary Notes</label>
                                <textarea class="form-control" id="dietNotes" name="diet_notes" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Exercise Recommendations</h6>
                            <div class="mb-3">
                                <label for="exerciseType" class="form-label">Exercise Type</label>
                                <select class="form-select" id="exerciseType" name="exercise_type">
                                    <option value="">Select exercise type</option>
                                    <option value="aerobic">Aerobic Exercise</option>
                                    <option value="resistance">Resistance Training</option>
                                    <option value="combined">Combined Program</option>
                                    <option value="custom">Custom Plan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="exerciseNotes" class="form-label">Exercise Notes</label>
                                <textarea class="form-control" id="exerciseNotes" name="exercise_notes" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <h6 class="mb-2">Lifestyle Vital Signs</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="sleepManagementInput" class="form-label">Sleep Management</label>
                            <textarea class="form-control" id="sleepManagementInput" name="sleep_management" rows="3" placeholder="• Sleep duration: 7-9 hours nightly&#10;• Regular sleep schedule&#10;• Sleep hygiene practices"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="stressManagementInput" class="form-label">Stress Management</label>
                            <textarea class="form-control" id="stressManagementInput" name="stress_management" rows="3" placeholder="• Stress reduction techniques&#10;• Mindfulness/meditation&#10;• Coping strategies"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="socialConnectednessInput" class="form-label">Social Connectedness</label>
                            <textarea class="form-control" id="socialConnectednessInput" name="social_connectedness" rows="3" placeholder="• Social support systems&#10;• Community involvement&#10;• Family/friend connections"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="substanceUseInput" class="form-label">Substance Use</label>
                            <textarea class="form-control" id="substanceUseInput" name="substance_use" rows="3" placeholder="• Alcohol consumption guidelines&#10;• Smoking cessation support&#10;• Substance use counseling"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="saveLifestyleBtn" class="btn btn-primary">Save Prescription</button>
            </div>
        </div>
    </div>
</div> 

<script>
    $(document).ready(function() {
        function resetForm() {
            $('#lifestyleId').val('');
            $('#dietType').val('');
            $('#dietNotes').val('');
            $('#exerciseType').val('');
            $('#exerciseNotes').val('');
            $('#sleepManagementInput').val('');
            $('#stressManagementInput').val('');
            $('#socialConnectednessInput').val('');
            $('#substanceUseInput').val('');
            $('#addLifestyleModalLabel').text('Create Lifestyle Prescription');
        }

        function fetchLifestylePrescriptions() {
            $.ajax({
                url: '{{ route('lifestyle-prescriptions.index') }}',
                method: 'GET',
                data: { patient_id: '{{ $patient->id }}' },
                success: function(response) {
                    const latest = response.prescriptions && response.prescriptions.length ? response.prescriptions[0] : null;
                    $('#dietHeaderType').text(latest && latest.diet_type ? `(${latest.diet_type})` : '');
                    $('#dietBodyNotes').html(latest && latest.diet_notes ? latest.diet_notes.replace(/\n/g, '<br/>') : '<span class="text-muted">No dietary notes yet.</span>');
                    $('#exerciseHeaderType').text(latest && latest.exercise_type ? `(${latest.exercise_type})` : '');
                    $('#exerciseBodyNotes').html(latest && latest.exercise_notes ? latest.exercise_notes.replace(/\n/g, '<br/>') : '<span class="text-muted">No exercise notes yet.</span>');
                    $('#sleepManagement').html(latest && latest.sleep_management ? latest.sleep_management.replace(/\n/g, '<br/>') : '<span class="text-muted">No sleep management notes yet.</span>');
                    $('#stressManagement').html(latest && latest.stress_management ? latest.stress_management.replace(/\n/g, '<br/>') : '<span class="text-muted">No stress management notes yet.</span>');
                    $('#socialConnectedness').html(latest && latest.social_connectedness ? latest.social_connectedness.replace(/\n/g, '<br/>') : '<span class="text-muted">No social connectedness notes yet.</span>');
                    $('#substanceUse').html(latest && latest.substance_use ? latest.substance_use.replace(/\n/g, '<br/>') : '<span class="text-muted">No substance use notes yet.</span>');
                },
                error: function() {
                    console.error('Failed to load lifestyle prescriptions');
                }
            });
        }

        $('#saveLifestyleBtn').on('click', function() {
            const form = $('#lifestyleForm');
            const payload = form.serialize();
            const currentId = $('#lifestyleId').val();
            const isUpdate = currentId && currentId !== '';
            const url = isUpdate ? `/lifestyle-prescriptions/${currentId}` : `{{ route('lifestyle-prescriptions.store') }}`;
            const method = isUpdate ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                method: method,
                data: payload,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(resp) {
                    $('#addLifestyleModal').modal('hide');
                    form.trigger('reset');
                    resetForm();
                    fetchLifestylePrescriptions();
                },
                error: function(xhr) {
                    alert('Failed to save lifestyle prescription');
                    console.error(xhr.responseText);
                }
            });
        });

        // Single header Edit button to open modal with latest values
        $('#editLifestyleBtn').on('click', function() {
            $.ajax({
                url: '{{ route('lifestyle-prescriptions.index') }}',
                method: 'GET',
                data: { patient_id: '{{ $patient->id }}' },
                success: function(response) {
                    const latest = response.prescriptions && response.prescriptions.length ? response.prescriptions[0] : null;
                    if (latest) {
                        $('#lifestyleId').val(latest.id);
                        $('#dietType').val(latest.diet_type || '');
                        $('#dietNotes').val(latest.diet_notes || '');
                        $('#exerciseType').val(latest.exercise_type || '');
                        $('#exerciseNotes').val(latest.exercise_notes || '');
                        $('#sleepManagementInput').val(latest.sleep_management || '');
                        $('#stressManagementInput').val(latest.stress_management || '');
                        $('#socialConnectednessInput').val(latest.social_connectedness || '');
                        $('#substanceUseInput').val(latest.substance_use || '');
                        $('#addLifestyleModalLabel').text('Edit Lifestyle Prescription');
                    } else {
                        resetForm();
                    }
                    $('#addLifestyleModal').modal('show');
                }
            });
        });

        $('#addLifestyleModal').on('hidden.bs.modal', function () {
            const form = $('#lifestyleForm');
            form.trigger('reset');
            resetForm();
        });

        function toggleHeaderButtons() {
            $.get('{{ route('lifestyle-prescriptions.index') }}', { patient_id: '{{ $patient->id }}' })
                .done(function(resp){
                    const hasData = resp.prescriptions && resp.prescriptions.length > 0;
                    $('#createLifestyleBtn').toggleClass('d-none', hasData);
                    $('#editLifestyleBtn').toggleClass('d-none', !hasData);
                    $('#printDownloadButtons').toggle(hasData).css('display', hasData ? 'flex' : 'none');
                });
        }

        // Print functionality
        $('#printLifestyleBtn').on('click', function() {
            const printContent = generatePrintableContent();
            const printWindow = window.open('', '_blank');
            printWindow.document.write(`
                <html>
                    <head>
                        <title>Lifestyle Prescription - {{ $patient->first_name }} {{ $patient->last_name }}</title>
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
                        <style>
                            @media print {
                                body { font-size: 12px; }
                                .no-print { display: none !important; }
                            }
                            .prescription-header { 
                                border-bottom: 2px solid #28a745; 
                                margin-bottom: 20px; 
                                padding-bottom: 10px; 
                            }
                        </style>
                    </head>
                    <body>
                        ${printContent}
                    </body>
                </html>
            `);
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        });

        // Download PDF functionality
        $('#downloadLifestyleBtn').on('click', function() {
            const patientId = '{{ $patient->id }}';
            window.open(`/lifestyle-prescriptions/${patientId}/download-pdf`, '_blank');
        });

        function generatePrintableContent() {
            const patientName = '{{ $patient->first_name }} {{ $patient->last_name }}';
            const currentDate = new Date().toLocaleDateString();
            
            return `
                <div class="container-fluid">
                    <div class="prescription-header text-center">
                        <h2><i class="fas fa-heart"></i> Lifestyle Prescription</h2>
                        <h4>Patient: ${patientName}</h4>
                        <p>Date: ${currentDate}</p>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <h5><i class="fas fa-utensils"></i> Dietary Recommendations</h5>
                            <div class="mb-3">
                                <strong>Diet Type:</strong> <span>${$('#dietHeaderType').text() || 'Not specified'}</span>
                            </div>
                            <div class="mb-4">
                                <strong>Notes:</strong><br>
                                <div>${$('#dietBodyNotes').html() || 'No dietary notes available'}</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <h5><i class="fas fa-running"></i> Exercise Recommendations</h5>
                            <div class="mb-3">
                                <strong>Exercise Type:</strong> <span>${$('#exerciseHeaderType').text() || 'Not specified'}</span>
                            </div>
                            <div class="mb-4">
                                <strong>Notes:</strong><br>
                                <div>${$('#exerciseBodyNotes').html() || 'No exercise notes available'}</div>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <h5><i class="fas fa-chart-line"></i> Monitoring Guidelines</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6>Blood Sugar Monitoring</h6>
                                    <div>${$('#bloodSugarMonitoring').html() || 'Not specified'}</div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Weight Management</h6>
                                    <div>${$('#weightManagement').html() || 'Not specified'}</div>
                                </div>
                                <div class="col-md-4">
                                    <h6>Follow-up Schedule</h6>
                                    <div>${$('#followUpSchedule').html() || 'Not specified'}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-5 text-center">
                        <p><small>This lifestyle prescription was generated on ${currentDate}</small></p>
                    </div>
                </div>
            `;
        }

        fetchLifestylePrescriptions();
        toggleHeaderButtons();
    });
</script>