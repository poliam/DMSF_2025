<!-- Management View (Default) -->
<div id="management-view" class="container-fluid">
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

<!-- Certificate Print View (Hidden by default) -->
<div id="certificate-view" class="medical-certificate-container" style="display: none;">
    <div class="certificate-page">
        <!-- Header Section -->
        <div class="certificate-header">
            <div class="logo-section">
                <div class="medical-logo">
                    <img src="{{ asset('images/dmsf_logo_transparent.png') }}" alt="DMSF Logo">
                </div>
            </div>
            <div class="institution-info">
                <h2 class="institution-name">DAVAO MEDICAL SCHOOL FOUNDATION</h2>
                <h3 class="institution-location">DAVAO CITY</h3>
                <h1 class="certificate-title">MEDICAL CERTIFICATE</h1>
            </div>
            <div class="date-section">
                <div class="date-field">
                    <span class="date-value" id="cert-date">{{ date('F j, Y') }}</span>
                    <div class="underline"></div>
                    <span class="field-label">Date</span>
                </div>
            </div>
        </div>

        <!-- Certificate Body -->
        <div class="certificate-body">
            <div class="salutation">
                <strong>TO WHOM IT MAY CONCERN:</strong>
            </div>

            <div class="certification-text">
                <p style="margin-left: 90px">This is to certify that
                    <span class="field-value name-field" id="cert-patient-name">{{ $patient->first_name ?? '' }} {{ $patient->middle_name ?? '' }} {{ $patient->last_name ?? '' }}</span>,
                    <span class="field-value short" id="cert-patient-age">{{ $patient->age ?? '' }}</span> years old
                </p>
                <p>of
                    <span class="field-value long" id="cert-patient-address">{{ $patient->address ?? '' }}</span> has been treated/examined last
                    <span class="field-value medium" id="cert-exam-date"></span>
                </p>
            </div>

            <!-- Diagnosis Section -->
            <div class="section-block">
                <div class="section-header">
                    <strong>DIAGNOSIS:</strong>
                </div>
                <div class="section-content">
                    <div class="content-line">
                        <span class="field-value full-width" id="cert-diagnosis"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                </div>
            </div>

            <!-- Remarks Section -->
            <div class="section-block">
                <div class="section-header">
                    <strong>REMARKS:</strong>
                </div>
                <div class="section-content">
                    <div class="content-line">
                        <span class="field-value full-width" id="cert-remarks"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                    <div class="content-line">
                        <span class="field-value full-width"></span>
                    </div>
                </div>
            </div>

            <!-- Physician Signature Section -->
            <div class="signature-section">
                <div class="signature-block">
                    <div class="signature-line">
                        <span class="field-value signature-field" id="cert-physician"></span>
                    </div>
                    <div class="signature-label">Physician</div>
                </div>

                <div class="credentials-block">
                    <div class="credential-line">
                        <span class="credential-label">License No.</span>
                        <span class="field-value credential-field" id="cert-license"></span>
                    </div>
                    <div class="credential-line">
                        <span class="credential-label">PTR No.</span>
                        <span class="field-value credential-field" id="cert-ptr"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Print Controls -->
    <div class="print-controls d-print-none text-center">
        <button type="button" class="btn btn-secondary me-2" onclick="showManagementView()">
            <i class="fas fa-arrow-left me-1"></i>
            Back to Management
        </button>
        <button type="button" class="btn btn-primary" onclick="window.print()">
            <i class="fas fa-print me-1"></i>
            Print Certificate
        </button>
    </div>
</div>
<style>
    .medical-certificate-container {
        max-width: 8.5in;
        margin: 0 auto 3rem auto;
        background: white;
        font-family: 'Times New Roman', serif;
        color: #000;
        line-height: 1.2;
        padding-bottom: 2rem;
    }

    .certificate-page {
        padding: 0.5in;
        min-height: 5.5in;
        background: white;
        page-break-inside: avoid;
        margin-bottom: 0;
    }

    /* Header Styles */
    .certificate-header {
        display: flex;
        align-items: flex-start;
        margin-bottom: 1rem;
        position: relative;
    }

    .logo-section {
        flex: 0 0 100px;
        margin-right: 15px;
    }

    .medical-logo {
        width: 100px;
        height: 100px;
        margin-left: 20px;
        margin-bottom: 20px;
    }

    .medical-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .institution-info {
        flex: 1;
        text-align: center;
        margin-top: 5px;
    }

    .institution-name {
        font-size: 14px;
        font-weight: bold;
        margin: 0;
        letter-spacing: 0.5px;
    }

    .institution-location {
        font-size: 12px;
        font-weight: bold;
        margin: 3px 0 10px 0;
        letter-spacing: 0.3px;
    }

    .certificate-title {
        font-size: 16px;
        font-weight: bold;
        margin: 0;
        letter-spacing: 1px;
    }

    .date-section {
        flex: 0 0 120px;
        text-align: right;
        margin-top: 10px;
    }

    .date-field {
        text-align: center;
    }

    .date-value {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
    }

    .underline {
        height: 1px;
        background: #000;
        margin: 2px 0;
    }

    .field-label {
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Body Styles */
    .certificate-body {
        margin-top: 1rem;
    }

    .salutation {
        margin-bottom: 1rem;
        font-size: 12px;
    }

    .certification-text p {
        margin: 0.5rem 0;
        font-size: 12px;
    }

    .field-value {
        font-weight: bold;
        display: inline-block;
        min-width: 80px;
        border-bottom: 1px solid #000;
        padding-bottom: 1px;
        margin: 0 2px;
    }

    .field-value.short {
        min-width: 50px;
        width: 50px;
        text-align: center;
    }

    .field-value.medium {
        min-width: 115px;
        width: 115px;
        text-align: center;
    }

    .field-value.long {
        min-width: 430px;
        width: 430px;
    }

    .field-value.full-width {
        min-width: 100%;
        width: 100%;
        margin: 0;
    }

    .field-value.name-field {
        min-width: 50%;
        width: 65%;
        text-align: center;
    }

    .field-value.signature-field {
        min-width: 150px;
        width: 150px;
        text-align: center;
    }

    .field-value.credential-field {
        min-width: 120px;
        width: 120px;
    }

    .underline-field {
        display: inline-block;
        border-bottom: 1px solid #000;
        margin: 0 3px;
        min-height: 16px;
    }

    /* Section Styles */
    .section-block {
        margin: 1rem 0;
    }

    .section-header {
        font-size: 12px;
        margin-bottom: 0.3rem;
    }

    .content-line {
        margin: 0.5rem 0;
        min-height: 15px;
    }

    /* Signature Section */
    .signature-section {
        margin-top: 2rem;
        margin-bottom: 4rem;
        display: flex;
        justify-content: flex-end;
        align-items: flex-start;
    }

    .signature-block {
        text-align: center;
        margin-right: 1.5rem;
    }

    .signature-line {
        margin-bottom: 0.3rem;
    }

    .signature-underline {
        width: 150px;
        height: 1px;
        background: #000;
        margin: 3px auto;
    }

    .signature-label {
        font-size: 10px;
        margin-top: 3px;
    }

    .credentials-block {
        text-align: left;
    }

    .credential-line {
        margin: 0.3rem 0;
        display: flex;
        align-items: center;
    }

    .credential-label {
        font-size: 10px;
        margin-right: 8px;
        min-width: 60px;
    }

    .credential-underline {
        flex: 1;
        height: 1px;
        background: #000;
        margin-left: 8px;
        max-width: 120px;
    }

    /* Print controls positioning */
    .print-controls {
        margin-top: 1rem !important;
        padding: 3rem 0;
        border-top: 1px solid #dee2e6;
        clear: both;
    }

    /* Print Styles */
    @media print {

        /* Hide everything except the certificate */
        body * {
            visibility: hidden;
        }

        #certificate-view,
        #certificate-view * {
            visibility: visible;
        }

        #certificate-view {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }

        .medical-certificate-container {
            margin: 0;
            max-width: none;
            width: 100%;
            padding-bottom: 0;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }

        .certificate-page {
            padding: 0.5in;
            margin: 0;
            box-shadow: none;
            height: auto;
            min-height: auto;
            max-height: none;
            width: 100%;
            page-break-after: avoid;
            page-break-before: avoid;
            page-break-inside: avoid;
        }

        .certificate-header {
            margin-bottom: 0.8rem;
            page-break-after: avoid;
        }

        .certificate-body {
            margin-top: 0.8rem;
            page-break-inside: avoid;
        }

        .section-block {
            margin: 0.8rem 0;
            page-break-inside: avoid;
        }

        .signature-section {
            margin-top: 1.5rem;
            page-break-before: avoid;
        }

        body {
            background: white !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
        }

        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        @page {
            size: 11in 8.5in;
            margin: 0;
        }

        @page :first {
            margin: 0;
        }
    }

    /* Empty field styling for better visibility */
    .field-value:empty::after {
        content: "\00a0";
        text-decoration: underline;
        display: inline-block;
        width: 80px;
    }
</style>

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
                        <label for="medicalFindings" class="form-label">Medical Findings/Diagnosis</label>
                        <textarea class="form-control" id="medicalFindings" name="medical_findings" rows="3" placeholder="Brief medical assessment and findings"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="recommendations" class="form-label">Recommendations/Remarks</label>
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
            <button class="btn btn-sm btn-outline-primary view-certificate-btn" data-cert='${JSON.stringify(cert)}'>View</button>
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

        // View Certificate button click
        $(document).on('click', '.view-certificate-btn', function() {
            const cert = $(this).data('cert');
            showCertificateView(cert);
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
            const formData = new FormData($('#medical-certificate-form')[0]);
            const cert = {
                date_issued: formData.get('date_issued'),
                medical_findings: formData.get('medical_findings'),
                recommendations: formData.get('recommendations'),
                issuing_doctor: formData.get('issuing_doctor'),
                license_number: formData.get('license_number')
            };
            showCertificateView(cert, true);
        });
    });

    // Function to show certificate view
    function showCertificateView(cert, isPreview = false) {
        // Populate certificate data
        $('#cert-date').text(formatCertDate(cert.date_issued));
        $('#cert-diagnosis').text(cert.medical_findings || '');
        $('#cert-remarks').text(cert.recommendations || '');
        $('#cert-physician').text(cert.issuing_doctor || '');
        $('#cert-license').text(cert.license_number || '');
        $('#cert-ptr').text(cert.ptr_number || '');
        $('#cert-exam-date').text(cert.examination_date || formatCertDate(cert.date_issued));

        // Hide management view and show certificate view
        $('#management-view').hide();
        $('#certificate-view').show();
    }

    // Function to show management view
    function showManagementView() {
        $('#certificate-view').hide();
        $('#management-view').show();
    }

    // Format date for certificate
    function formatCertDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }
</script>