<div class="container-fluid">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">
                <i class="fas fa-certificate me-2"></i>
                Medical Certificate Management
            </h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCertificateModal">
                        <i class="fas fa-plus me-1"></i>
                        Issue Medical Certificate
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover" id="medical-certificates-table">
                    <thead class="table-dark">
                        <tr>
                            <th>Date Issued</th>
                            <th>Certificate Type</th>
                            <th>Purpose</th>
                            <th>Valid Until</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="certificates-tbody">
                        <!-- Dynamic content will be loaded here -->
                    </tbody>
                </table>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-1"></i> Certificate Templates Available:</h6>
                        <ul class="mb-0">
                            <li><strong>Fitness for Work:</strong> Standard medical clearance for employment</li>
                            <li><strong>Medical Leave:</strong> Certificate for sick leave or medical absence</li>
                            <li><strong>Travel Clearance:</strong> Medical fitness for travel</li>
                            <li><strong>School/Sports:</strong> Physical fitness for activities</li>
                            <li><strong>Custom Certificate:</strong> Tailored medical documentation</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Medical Certificate Modal -->
<div class="modal fade" id="addCertificateModal" tabindex="-1" aria-labelledby="addCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCertificateModalLabel">Issue Medical Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="medical-certificate-form">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="certificateType" class="form-label">Certificate Type</label>
                            <select class="form-select" id="certificateType" name="certificate_type" required>
                                <option value="">Select certificate type</option>
                                <option value="fitness_work">Fitness for Work</option>
                                <option value="medical_leave">Medical Leave</option>
                                <option value="travel_clearance">Travel Clearance</option>
                                <option value="school_sports">School/Sports</option>
                                <option value="custom">Custom Certificate</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="purpose" class="form-label">Purpose</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" placeholder="e.g., Return to work after illness" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="issueDate" class="form-label">Issue Date</label>
                            <input type="date" class="form-control" id="issueDate" name="date_issued" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validUntil" class="form-label">Valid Until</label>
                            <input type="date" class="form-control" id="validUntil" name="valid_until">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="issuingDoctor" class="form-label">Issuing Doctor</label>
                            <input type="text" class="form-control" id="issuingDoctor" name="issuing_doctor" placeholder="Dr. Name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="licenseNumber" class="form-label">License Number</label>
                            <input type="text" class="form-control" id="licenseNumber" name="license_number" placeholder="Medical license number">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="medicalFindings" class="form-label">Medical Findings</label>
                        <textarea class="form-control" id="medicalFindings" name="medical_findings" rows="3" placeholder="Brief medical assessment and findings"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recommendations" class="form-label">Recommendations/Restrictions</label>
                        <textarea class="form-control" id="recommendations" name="recommendations" rows="3" placeholder="Any work restrictions or recommendations"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="digitalSignature" name="digital_signature" value="1">
                        <label class="form-check-label" for="digitalSignature">
                            Apply digital signature
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline-primary" id="preview-certificate-btn">Preview</button>
                <button type="button" class="btn btn-primary" id="issue-certificate-btn">Issue Certificate</button>
            </div>
        </div>
    </div>
</div>

<!-- Revoke Certificate Modal -->
<div class="modal fade" id="revokeCertificateModal" tabindex="-1" aria-labelledby="revokeCertificateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="revokeCertificateModalLabel">Revoke Medical Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="revoke-certificate-form">
                    @csrf
                    <input type="hidden" id="revoke-certificate-id" name="certificate_id">
                    <div class="mb-3">
                        <label for="revocationReason" class="form-label">Reason for Revocation</label>
                        <textarea class="form-control" id="revocationReason" name="revocation_reason" rows="3" placeholder="Please provide reason for revoking this certificate" required></textarea>
                    </div>
                    <div class="alert alert-warning">
                        <strong>Warning:</strong> This action cannot be undone. The certificate will be permanently marked as revoked.
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirm-revoke-btn">Revoke Certificate</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Load certificates on page load
        loadMedicalCertificates();

        // Issue certificate form submission
        $('#issue-certificate-btn').click(function() {
            const form = $('#medical-certificate-form')[0];
            const formData = new FormData(form);

            $.ajax({
                url: "{{ route('medical-certificates.store') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        alert("Medical certificate issued successfully!");
                        $('#addCertificateModal').modal('hide');
                        $('#medical-certificate-form')[0].reset();
                        loadMedicalCertificates();
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

        // Load medical certificates
        function loadMedicalCertificates() {
            $.ajax({
                url: "{{ route('patients.medical-certificates', $patient->id) }}",
                method: "GET",
                success: function(response) {
                    const tbody = $('#certificates-tbody');
                    tbody.empty();

                    if (response.certificates.length === 0) {
                        tbody.append(`
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <em>No medical certificates found. Click "Issue Medical Certificate" to get started.</em>
                            </td>
                        </tr>
                    `);
                    } else {
                        response.certificates.forEach(function(cert) {
                            const statusBadge = getStatusBadge(cert.status);
                            const actions = getActionButtons(cert);

                            tbody.append(`
                            <tr>
                                <td>${formatDate(cert.date_issued)}</td>
                                <td>${getCertificateTypeDisplay(cert.certificate_type)}</td>
                                <td>${cert.purpose}</td>
                                <td>${cert.valid_until ? formatDate(cert.valid_until) : 'No expiry'}</td>
                                <td><span class="badge ${statusBadge}">${cert.status.charAt(0).toUpperCase() + cert.status.slice(1)}</span></td>
                                <td>${actions}</td>
                            </tr>
                        `);
                        });
                    }
                },
                error: function(xhr) {
                    console.error("Error loading medical certificates:", xhr);
                    alert("Error loading medical certificates. Please refresh the page.");
                }
            });
        }

        // Get status badge class
        function getStatusBadge(status) {
            switch (status) {
                case 'active':
                    return 'bg-success';
                case 'revoked':
                    return 'bg-danger';
                case 'expired':
                    return 'bg-secondary';
                default:
                    return 'bg-secondary';
            }
        }

        // Get certificate type display name
        function getCertificateTypeDisplay(type) {
            switch (type) {
                case 'fitness_work':
                    return 'Fitness for Work';
                case 'medical_leave':
                    return 'Medical Leave';
                case 'travel_clearance':
                    return 'Travel Clearance';
                case 'school_sports':
                    return 'School/Sports';
                case 'custom':
                    return 'Custom Certificate';
                default:
                    return type.replace('_', ' ').replace(/\b\w/g, l => l.toUpperCase());
            }
        }

        // Get action buttons
        function getActionButtons(cert) {
            let buttons = `
            <button class="btn btn-sm btn-outline-primary view-pdf-btn" data-id="${cert.id}">View PDF</button>
            <button class="btn btn-sm btn-outline-success download-pdf-btn" data-id="${cert.id}">Download</button>
        `;

            if (cert.status === 'active') {
                buttons += `<button class="btn btn-sm btn-outline-warning revoke-btn" data-id="${cert.id}">Revoke</button>`;
            }

            return buttons;
        }

        // Format date
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        // View PDF button click
        $(document).on('click', '.view-pdf-btn', function() {
            const certId = $(this).data('id');
            window.open(`{{ url('/medical-certificates') }}/${certId}/pdf`, '_blank');
        });

        // Download PDF button click
        $(document).on('click', '.download-pdf-btn', function() {
            const certId = $(this).data('id');
            window.location.href = `{{ url('/medical-certificates') }}/${certId}/download`;
        });

        // Revoke button click
        $(document).on('click', '.revoke-btn', function() {
            const certId = $(this).data('id');
            $('#revoke-certificate-id').val(certId);
            $('#revokeCertificateModal').modal('show');
        });

        // Confirm revoke button click
        $('#confirm-revoke-btn').click(function() {
            const certId = $('#revoke-certificate-id').val();
            const reason = $('#revocationReason').val();

            if (!reason.trim()) {
                alert("Please provide a reason for revocation.");
                return;
            }

            $.ajax({
                url: `{{ url('/medical-certificates') }}/${certId}/revoke`,
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    revocation_reason: reason
                },
                success: function(response) {
                    if (response.success) {
                        alert("Medical certificate revoked successfully!");
                        $('#revokeCertificateModal').modal('hide');
                        $('#revoke-certificate-form')[0].reset();
                        loadMedicalCertificates();
                    }
                },
                error: function(xhr) {
                    alert("An error occurred while revoking the certificate. Please try again.");
                }
            });
        });

        // Preview certificate functionality
        $('#preview-certificate-btn').click(function() {
            alert("Preview functionality will be implemented in future updates.");
        });
    });
</script>