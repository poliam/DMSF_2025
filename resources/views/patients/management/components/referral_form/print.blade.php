<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Referral Form</title>
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

        .form-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 30px 0;
            text-decoration: underline;
        }

        .section {
            margin: 20px 0;
        }

        .section-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .info-row {
            margin: 8px 0;
            display: flex;
        }

        .label {
            font-weight: bold;
            display: inline-block;
            width: 200px;
            vertical-align: top;
        }

        .value {
            flex: 1;
        }

        .priority-urgent {
            color: #dc3545;
            font-weight: bold;
        }

        .priority-emergency {
            color: #6f42c1;
            font-weight: bold;
        }

        .priority-routine {
            color: #28a745;
        }

        .text-content {
            margin: 15px 0;
            padding: 10px;
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
        }

        .footer {
            margin-top: 50px;
            font-size: 10px;
            color: #666;
            text-align: center;
        }

        .referral-number {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 10px;
            color: #666;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .signature-box {
            text-align: center;
            width: 45%;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin: 30px 0 5px 0;
        }

        .checkbox {
            width: 15px;
            height: 15px;
            border: 1px solid #333;
            display: inline-block;
            margin-right: 5px;
            vertical-align: middle;
        }

        .checkbox.checked::after {
            content: "✓";
            font-weight: bold;
            font-size: 12px;
            line-height: 13px;
            text-align: center;
            display: block;
        }
    </style>
</head>

<body>
    <div class="referral-number">
        Referral No: RF-{{ str_pad($referral->id, 6, '0', STR_PAD_LEFT) }}
    </div>

    <div class="header">
        <div class="hospital-name">DAVAO MEDICAL SCHOOL FOUNDATION HOSPITAL</div>
        <div class="hospital-address">
            Gen. Malvar St., Davao City, Philippines<br>
            Tel: (082) 226-4433 | Email: info@dmsf.edu.ph
        </div>
    </div>

    <div class="form-title">MEDICAL REFERRAL FORM</div>

    <div class="section">
        <div class="section-title">PATIENT INFORMATION</div>
        <div class="info-row">
            <span class="label">Patient Name:</span>
            <span class="value">{{ $referral->patient->first_name }} {{ $referral->patient->middle_name }} {{ $referral->patient->last_name }}</span>
        </div>
        <div class="info-row">
            <span class="label">Date of Birth:</span>
            <span class="value">{{ $referral->patient->birth_date ? \Carbon\Carbon::parse($referral->patient->birth_date)->format('F d, Y') : 'N/A' }}</span>
        </div>
        <div class="info-row">
            <span class="label">Patient ID:</span>
            <span class="value">{{ str_pad($referral->patient->id, 6, '0', STR_PAD_LEFT) }}</span>
        </div>
        <div class="info-row">
            <span class="label">Gender:</span>
            <span class="value">{{ $referral->patient->gender ?? 'N/A' }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">REFERRAL DETAILS</div>
        <div class="info-row">
            <span class="label">Referral Date:</span>
            <span class="value">{{ $referral->referral_date->format('F d, Y') }}</span>
        </div>
        <div class="info-row">
            <span class="label">Priority:</span>
            <span class="value priority-{{ $referral->priority }}">{{ $referral->priority_display }}</span>
        </div>
        <div class="info-row">
            <span class="label">Specialty:</span>
            <span class="value">{{ $referral->specialty_display }}</span>
        </div>
        <div class="info-row">
            <span class="label">Referred To:</span>
            <span class="value">{{ $referral->referred_doctor }}</span>
        </div>
        @if($referral->institution)
        <div class="info-row">
            <span class="label">Institution:</span>
            <span class="value">{{ $referral->institution }}</span>
        </div>
        @endif
        @if($referral->contact_info)
        <div class="info-row">
            <span class="label">Contact Information:</span>
            <span class="value">{{ $referral->contact_info }}</span>
        </div>
        @endif
        @if($referral->referring_doctor)
        <div class="info-row">
            <span class="label">Referring Doctor:</span>
            <span class="value">{{ $referral->referring_doctor }}</span>
        </div>
        @endif
    </div>

    <div class="section">
        <div class="section-title">CLINICAL INFORMATION</div>

        <div style="margin-bottom: 15px;">
            <strong>Reason for Referral:</strong>
            <div class="text-content">
                {{ $referral->reason_for_referral }}
            </div>
        </div>

        @if($referral->relevant_history)
        <div style="margin-bottom: 15px;">
            <strong>Relevant Medical History:</strong>
            <div class="text-content">
                {{ $referral->relevant_history }}
            </div>
        </div>
        @endif

        @if($referral->urgency_reason)
        <div style="margin-bottom: 15px;">
            <strong>Urgency/Timeline:</strong>
            <div class="text-content">
                {{ $referral->urgency_reason }}
            </div>
        </div>
        @endif

        <div style="margin-top: 20px;">
            <div class="checkbox {{ $referral->include_reports ? 'checked' : '' }}"></div>
            <strong>Include recent test results and imaging reports</strong>
        </div>
    </div>

    @if($referral->tracking_notes || $referral->appointment_date || $referral->outcome)
    <div class="section">
        <div class="section-title">TRACKING INFORMATION</div>

        <div class="info-row">
            <span class="label">Current Status:</span>
            <span class="value">{{ $referral->status_display }}</span>
        </div>

        @if($referral->appointment_date)
        <div class="info-row">
            <span class="label">Appointment Date:</span>
            <span class="value">{{ $referral->appointment_date->format('F d, Y') }}</span>
        </div>
        @endif

        @if($referral->tracking_notes)
        <div style="margin-bottom: 15px;">
            <strong>Tracking Notes:</strong>
            <div class="text-content">
                {{ $referral->tracking_notes }}
            </div>
        </div>
        @endif

        @if($referral->outcome)
        <div style="margin-bottom: 15px;">
            <strong>Outcome:</strong>
            <div class="text-content">
                {{ $referral->outcome }}
            </div>
        </div>
        @endif
    </div>
    @endif

    <div class="signature-section">
        <div class="signature-box">
            <div>Referring Physician</div>
            <div class="signature-line"></div>
            <div>{{ $referral->referring_doctor ?? 'Name and Signature' }}</div>
            <div style="font-size: 12px; margin-top: 5px;">Date: {{ $referral->referral_date->format('F d, Y') }}</div>
        </div>

        <div class="signature-box">
            <div>Receiving Physician</div>
            <div class="signature-line"></div>
            <div>{{ $referral->referred_doctor }}</div>
            <div style="font-size: 12px; margin-top: 5px;">Date: _________________</div>
        </div>
    </div>

    <div class="footer">
        <p>This is a computer-generated referral form.</p>
        <p>Generated on {{ now()->format('F d, Y \a\t g:i A') }}</p>
        <p><strong>IMPORTANT:</strong> Please bring this referral form and any relevant medical records to your appointment.</p>
    </div>
</body>

</html>