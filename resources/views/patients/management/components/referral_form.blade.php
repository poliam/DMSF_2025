<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">
                <i class="fas fa-share-square me-2"></i>
                Referral Form Management
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addReferralModal">
                        <i class="fas fa-plus me-1"></i>
                        Create Referral
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="referral-forms-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Referred To</th>
                            <th>Specialty</th>
                            <th>Priority</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="referrals-tbody">
                        <!-- Dynamic content will be loaded here -->
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card border-primary">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0"><i class="fas fa-hospital me-1"></i> Common Referral Destinations</h6>
                        </div>
                        <div class="card-body" id="specialties-stats">
                            <!-- Dynamic specialty statistics will be loaded here -->
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white">
                            <h6 class="mb-0"><i class="fas fa-chart-pie me-1"></i> Referral Status Overview</h6>
                        </div>
                        <div class="card-body" id="status-stats">
                            <!-- Dynamic status statistics will be loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Referral Modal -->
<div class="modal fade" id="addReferralModal" tabindex="-1" aria-labelledby="addReferralModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addReferralModalLabel">Create Medical Referral</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="referral-form">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="referralDate" class="form-label">Referral Date</label>
                            <input type="date" class="form-control" id="referralDate" name="referral_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select" id="priority" name="priority" required>
                                <option value="routine">Routine</option>
                                <option value="urgent">Urgent</option>
                                <option value="emergency">Emergency</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="specialty" class="form-label">Specialty</label>
                            <select class="form-select" id="specialty" name="specialty" required>
                                <option value="">Select specialty</option>
                                <option value="endocrinology">Endocrinology</option>
                                <option value="cardiology">Cardiology</option>
                                <option value="ophthalmology">Ophthalmology</option>
                                <option value="nephrology">Nephrology</option>
                                <option value="neurology">Neurology</option>
                                <option value="orthopedics">Orthopedics</option>
                                <option value="dermatology">Dermatology</option>
                                <option value="psychiatry">Psychiatry</option>
                                <option value="pulmonology">Pulmonology</option>
                                <option value="gastroenterology">Gastroenterology</option>
                                <option value="oncology">Oncology</option>
                                <option value="urology">Urology</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="referredDoctor" class="form-label">Referred To (Doctor/Clinic)</label>
                            <input type="text" class="form-control" id="referredDoctor" name="referred_doctor" placeholder="Dr. Name or Clinic Name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="institution" class="form-label">Institution/Hospital</label>
                            <input type="text" class="form-control" id="institution" name="institution" placeholder="Hospital or clinic name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contactInfo" class="form-label">Contact Information</label>
                            <input type="text" class="form-control" id="contactInfo" name="contact_info" placeholder="Phone number or email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="referringDoctor" class="form-label">Referring Doctor</label>
                            <input type="text" class="form-control" id="referringDoctor" name="referring_doctor" placeholder="Your name as referring physician">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="reasonForReferral" class="form-label">Reason for Referral</label>
                        <textarea class="form-control" id="reasonForReferral" name="reason_for_referral" rows="3" placeholder="Detailed reason for referral, including current symptoms and concerns" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="relevantHistory" class="form-label">Relevant Medical History</label>
                        <textarea class="form-control" id="relevantHistory" name="relevant_history" rows="3" placeholder="Relevant past medical history, current medications, and investigations"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="urgencyReason" class="form-label">Urgency/Timeline</label>
                        <textarea class="form-control" id="urgencyReason" name="urgency_reason" rows="2" placeholder="If urgent, explain why immediate attention is needed"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="includeReports" name="include_reports" value="1">
                        <label class="form-check-label" for="includeReports">
                            Include recent test results and imaging reports
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" id="preview-referral-btn">Preview</button>
                <button type="button" class="btn btn-primary" id="create-referral-btn">Create Referral</button>
            </div>
        </div>
    </div>
</div>

<!-- Track Referral Modal -->
<div class="modal fade" id="trackReferralModal" tabindex="-1" aria-labelledby="trackReferralModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trackReferralModalLabel">Track Referral Progress</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tracking-form">
                    @csrf
                    <input type="hidden" id="track-referral-id" name="referral_id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="trackingStatus" class="form-label">Current Status</label>
                            <select class="form-select" id="trackingStatus" name="status" required>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="appointmentDate" class="form-label">Appointment Date</label>
                            <input type="date" class="form-control" id="appointmentDate" name="appointment_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="trackingNotes" class="form-label">Tracking Notes</label>
                        <textarea class="form-control" id="trackingNotes" name="tracking_notes" rows="3" placeholder="Update on referral progress, appointment details, etc."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="outcome" class="form-label">Outcome (if completed)</label>
                        <textarea class="form-control" id="outcome" name="outcome" rows="3" placeholder="Final outcome, recommendations, follow-up required, etc."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="update-tracking-btn">Update Tracking</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Load referrals and statistics on page load
        loadReferralForms();
        loadReferralStatistics();

        // Create referral form submission
        $('#create-referral-btn').click(function() {
            const form = $('#referral-form')[0];
            const formData = new FormData(form);

            $.ajax({
                url: "{{ route('referral-forms.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert("Referral form created successfully!");
                        $('#addReferralModal').modal('hide');
                        $('#referral-form')[0].reset();
                        loadReferralForms();
                        loadReferralStatistics();
                    }
                },
                error: function(xhr) {
                    let errorMessage = "An error occurred. Please try again.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    alert(errorMessage);
                }
            });
        });

        // Load referral forms
        function loadReferralForms() {
            $.ajax({
                url: "{{ route('patients.referral-forms', $patient->id) }}",
                method: "GET",
                success: function(response) {
                    const tbody = $('#referrals-tbody');
                    tbody.empty();

                    if (response.referrals.length === 0) {
                        tbody.append(`
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                <em>No referrals found. Click "Create Referral" to get started.</em>
                            </td>
                        </tr>
                    `);
                    } else {
                        response.referrals.forEach(function(referral) {
                            const priorityBadge = getPriorityBadge(referral.priority);
                            const statusBadge = getStatusBadge(referral.status);
                            const actions = getActionButtons(referral);

                            tbody.append(`
                            <tr>
                                <td>${formatDate(referral.referral_date)}</td>
                                <td>${referral.referred_doctor}</td>
                                <td>${getSpecialtyDisplay(referral.specialty)}</td>
                                <td><span class="badge ${priorityBadge}">${getPriorityDisplay(referral.priority)}</span></td>
                                <td>${truncateText(referral.reason_for_referral, 50)}</td>
                                <td><span class="badge ${statusBadge}">${getStatusDisplay(referral.status)}</span></td>
                                <td>${actions}</td>
                            </tr>
                        `);
                        });
                    }
                },
                error: function(xhr) {
                    console.error("Error loading referral forms:", xhr);
                    alert("Error loading referral forms. Please refresh the page.");
                }
            });
        }

        // Load referral statistics
        function loadReferralStatistics() {
            $.ajax({
                url: "{{ route('patients.referral-statistics', $patient->id) }}",
                method: "GET",
                success: function(response) {
                    // Update status statistics
                    const statusStats = $('#status-stats');
                    statusStats.html(`
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Pending</span>
                        <span class="badge bg-warning">${response.statistics.pending}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>In Progress</span>
                        <span class="badge bg-info">${response.statistics.in_progress}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Completed</span>
                        <span class="badge bg-success">${response.statistics.completed}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span>Cancelled</span>
                        <span class="badge bg-danger">${response.statistics.cancelled}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <strong>Total Referrals</strong>
                        <strong><span class="badge bg-primary">${response.statistics.total}</span></strong>
                    </div>
                `);

                    // Update specialty statistics
                    const specialtyStats = $('#specialties-stats');
                    if (response.specialties.length > 0) {
                        let specialtyHtml = '<ul class="list-group list-group-flush">';
                        response.specialties.forEach(function(specialty) {
                            specialtyHtml += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ${getSpecialtyDisplay(specialty.specialty)}
                                <span class="badge bg-primary rounded-pill">${specialty.count}</span>
                            </li>
                        `;
                        });
                        specialtyHtml += '</ul>';
                        specialtyStats.html(specialtyHtml);
                    } else {
                        specialtyStats.html('<p class="text-muted">No referrals yet</p>');
                    }
                },
                error: function(xhr) {
                    console.error("Error loading referral statistics:", xhr);
                }
            });
        }

        // Helper functions
        function getPriorityBadge(priority) {
            switch (priority) {
                case 'routine':
                    return 'bg-success';
                case 'urgent':
                    return 'bg-warning';
                case 'emergency':
                    return 'bg-danger';
                default:
                    return 'bg-secondary';
            }
        }

        function getStatusBadge(status) {
            switch (status) {
                case 'pending':
                    return 'bg-warning';
                case 'in_progress':
                    return 'bg-info';
                case 'completed':
                    return 'bg-success';
                case 'cancelled':
                    return 'bg-danger';
                default:
                    return 'bg-secondary';
            }
        }

        function getPriorityDisplay(priority) {
            return priority.charAt(0).toUpperCase() + priority.slice(1);
        }

        function getStatusDisplay(status) {
            return status === 'in_progress' ? 'In Progress' : status.charAt(0).toUpperCase() + status.slice(1);
        }

        function getSpecialtyDisplay(specialty) {
            return specialty.charAt(0).toUpperCase() + specialty.slice(1);
        }

        function getActionButtons(referral) {
            return `
            <button class="btn btn-sm btn-outline-primary view-referral-btn" data-id="${referral.id}">View</button>
            <button class="btn btn-sm btn-outline-success print-referral-btn" data-id="${referral.id}">Print</button>
            <button class="btn btn-sm btn-outline-info track-referral-btn" data-id="${referral.id}">Track</button>
        `;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        function truncateText(text, maxLength) {
            return text.length > maxLength ? text.substring(0, maxLength) + '...' : text;
        }

        // Action button handlers
        $(document).on('click', '.view-referral-btn', function() {
            const referralId = $(this).data('id');
            window.open(`{{ url('/referral-forms') }}/${referralId}/print`, '_blank');
        });

        $(document).on('click', '.print-referral-btn', function() {
            const referralId = $(this).data('id');
            window.location.href = `{{ url('/referral-forms') }}/${referralId}/download`;
        });

        $(document).on('click', '.track-referral-btn', function() {
            const referralId = $(this).data('id');
            $('#track-referral-id').val(referralId);

            // Load current referral data
            $.ajax({
                url: `{{ url('/referral-forms') }}/${referralId}`,
                method: "GET",
                success: function(response) {
                    const referral = response.referral;
                    $('#trackingStatus').val(referral.status);
                    $('#appointmentDate').val(referral.appointment_date);
                    $('#trackingNotes').val(referral.tracking_notes || '');
                    $('#outcome').val(referral.outcome || '');
                    $('#trackReferralModal').modal('show');
                }
            });
        });

        // Update tracking form submission
        $('#update-tracking-btn').click(function() {
            const referralId = $('#track-referral-id').val();
            const formData = {
                _token: "{{ csrf_token() }}",
                status: $('#trackingStatus').val(),
                appointment_date: $('#appointmentDate').val(),
                tracking_notes: $('#trackingNotes').val(),
                outcome: $('#outcome').val()
            };

            $.ajax({
                url: `{{ url('/referral-forms') }}/${referralId}/tracking`,
                method: "PUT",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert("Tracking information updated successfully!");
                        $('#trackReferralModal').modal('hide');
                        loadReferralForms();
                        loadReferralStatistics();
                    }
                },
                error: function(xhr) {
                    alert("An error occurred while updating tracking information. Please try again.");
                }
            });
        });

        // Preview referral functionality
        $('#preview-referral-btn').click(function() {
            const form = $('#referral-form')[0];
            const formData = new FormData(form);

            // Basic client-side validation before preview
            const requiredFields = ['patient_id', 'referral_date', 'priority', 'specialty', 'referred_doctor', 'reason_for_referral'];
            let isValid = true;
            let missingFields = [];

            requiredFields.forEach(function(field) {
                const value = formData.get(field);
                if (!value || value.trim() === '') {
                    isValid = false;
                    missingFields.push(field.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase()));
                }
            });

            if (!isValid) {
                alert('Please fill in the following required fields before preview:\n' + missingFields.join('\n'));
                return;
            }

            // Show loading state
            const originalText = $(this).html();
            $(this).html('<i class="fas fa-spinner fa-spin me-1"></i>Generating Preview...');
            $(this).prop('disabled', true);

            // Submit form for preview
            $.ajax({
                url: "{{ route('referral-forms.preview') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                xhrFields: {
                    responseType: 'blob'
                },
                success: function(data, status, xhr) {
                    // Create blob URL and open in new tab
                    const blob = new Blob([data], {
                        type: 'application/pdf'
                    });
                    const url = window.URL.createObjectURL(blob);
                    window.open(url, '_blank');

                    // Clean up
                    setTimeout(() => window.URL.revokeObjectURL(url), 100);
                },
                error: function(xhr) {
                    let errorMessage = "An error occurred while generating preview. Please check your form data.";
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        const errors = xhr.responseJSON.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                    alert(errorMessage);
                },
                complete: function() {
                    // Restore button state
                    $('#preview-referral-btn').html(originalText);
                    $('#preview-referral-btn').prop('disabled', false);
                }
            });
        });
    });
</script>