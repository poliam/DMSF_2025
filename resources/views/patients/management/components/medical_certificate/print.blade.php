<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        .hospital-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .hospital-address {
            font-size: 12px;
            color: #666;
        }

        .certificate-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
            text-decoration: underline;
        }

        .patient-info {
            margin: 20px 0;
        }

        .info-row {
            margin: 10px 0;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }

        .content {
            margin: 30px 0;
            text-align: justify;
        }

        .findings {
            margin: 20px 0;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
        }

        .signature-section {
            margin-top: 50px;
            text-align: right;
        }

        .signature-line {
            border-top: 1px solid #333;
            width: 200px;
            margin: 20px 0 5px auto;
        }

        .footer {
            margin-top: 50px;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        .certificate-number {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 10px;
            color: #666;
        }

        .status-stamp {
            position: absolute;
            top: 100px;
            right: 50px;
            transform: rotate(-15deg);
            border: 3px solid #28a745;
            color: #28a745;
            padding: 10px 20px;
            font-weight: bold;
            font-size: 16px;
        }

        .revoked-stamp {
            border-color: #dc3545;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="certificate-number">
        Certificate No: MC-{{ str_pad($certificate->id, 6, '0', STR_PAD_LEFT) }}
    </div>

    @if($certificate->status === 'active')
    <div class="status-stamp">VALID</div>
    @elseif($certificate->status === 'revoked')
    <div class="status-stamp revoked-stamp">REVOKED</div>
    @endif

    <div class="header">
        <div class="hospital-name">DAVAO MEDICAL SCHOOL FOUNDATION HOSPITAL</div>
        <div class="hospital-address">
            Gen. Malvar St., Davao City, Philippines<br>
            Tel: (082) 226-4433 | Email: info@dmsf.edu.ph
        </div>
    </div>

    <div class="certificate-title">MEDICAL CERTIFICATE</div>

    <div class="patient-info">
        <div class="info-row">
            <span class="label">Patient Name:</span>
            {{ $certificate->patient->first_name }} {{ $certificate->patient->middle_name }} {{ $certificate->patient->last_name }}
        </div>
        <div class="info-row">
            <span class="label">Date of Birth:</span>
            {{ $certificate->patient->birth_date ? \Carbon\Carbon::parse($certificate->patient->birth_date)->format('F d, Y') : 'N/A' }}
        </div>
        <div class="info-row">
            <span class="label">Patient ID:</span>
            {{ str_pad($certificate->patient->id, 6, '0', STR_PAD_LEFT) }}
        </div>
        <div class="info-row">
            <span class="label">Certificate Type:</span>
            {{ $certificate->certificate_type_display }}
        </div>
        <div class="info-row">
            <span class="label">Date Issued:</span>
            {{ $certificate->date_issued->format('F d, Y') }}
        </div>
        @if($certificate->valid_until)
        <div class="info-row">
            <span class="label">Valid Until:</span>
            {{ $certificate->valid_until->format('F d, Y') }}
        </div>
        @endif
    </div>

    <div class="content">
        <p><strong>TO WHOM IT MAY CONCERN:</strong></p>

        <p>This is to certify that the above-named patient has been examined and found to be:</p>

        <p><strong>Purpose:</strong> {{ $certificate->purpose }}</p>

        @if($certificate->medical_findings)
        <div class="findings">
            <strong>Medical Findings:</strong><br>
            {{ $certificate->medical_findings }}
        </div>
        @endif

        @if($certificate->recommendations)
        <div class="findings">
            <strong>Recommendations/Restrictions:</strong><br>
            {{ $certificate->recommendations }}
        </div>
        @endif

        <p>This certification is issued upon request of the patient for {{ strtolower($certificate->purpose) }} purposes.</p>
    </div>

    <div class="signature-section">
        <div style="margin-bottom: 50px;">
            <div>{{ $certificate->issuing_doctor }}</div>
            <div class="signature-line"></div>
            <div>Attending Physician</div>
            @if($certificate->license_number)
            <div style="font-size: 12px;">License No: {{ $certificate->license_number }}</div>
            @endif
        </div>
    </div>

    @if($certificate->status === 'revoked')
    <div style="margin-top: 30px; padding: 15px; background-color: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;">
        <strong>REVOCATION NOTICE:</strong><br>
        This certificate has been revoked on {{ $certificate->revoked_at->format('F d, Y \a\t g:i A') }}.<br>
        <strong>Reason:</strong> {{ $certificate->revocation_reason }}
    </div>
    @endif

    <div class="footer">
        <p>This is a computer-generated document. No signature is required.</p>
        <p>Generated on {{ now()->format('F d, Y \a\t g:i A') }}</p>
        @if($certificate->digital_signature)
        <p><strong>Digitally Signed Certificate</strong></p>
        @endif
    </div>
</body>

</html>