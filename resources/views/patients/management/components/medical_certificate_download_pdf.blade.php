<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Certificate - {{ $certificate->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', serif;
            color: #000;
            line-height: 1.2;
            background: white;
            margin: 0;
            padding: 45px 0 0;
        }

        .medical-certificate-container {
            width: 8.5in;
            height: 7.5in;
            margin: 0;
            padding: 0;
            background: white;
        }

        .certificate-page {
            padding: 0.3in 0.5in;
            height: 7.5in;
            background: white;
            overflow: hidden;
        }

        /* Header Styles */
        .certificate-header {
            display: table;
            width: 100%;
            margin-bottom: 0.5rem;
        }

        .logo-section {
            display: table-cell;
            width: 80px;
            vertical-align: top;
            padding-right: 15px;
        }

        .medical-logo {
            width: 60px;
            height: 60px;
        }

        .medical-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .institution-info {
            display: table-cell;
            text-align: center;
            vertical-align: top;
            padding-top: 5px;
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
            display: table-cell;
            width: 120px;
            text-align: center;
            vertical-align: top;
            padding-top: 10px;
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
            margin-top: 0.5rem;
        }

        .salutation {
            margin-bottom: 0.5rem;
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

        /* Section Styles */
        .section-block {
            margin: 0.5rem 0;
        }

        .section-header {
            font-size: 12px;
            margin-bottom: 0.2rem;
        }

        .content-line {
            margin: 0.3rem 0;
            min-height: 15px;
        }

        /* Signature Section */
        .signature-section {
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            text-align: right;
        }

        .signature-block {
            display: inline-block;
            text-align: center;
            margin-right: 1.5rem;
            vertical-align: top;
        }

        .signature-line {
            margin-bottom: 0.3rem;
        }

        .signature-label {
            font-size: 10px;
            margin-top: 3px;
        }

        .credentials-block {
            display: inline-block;
            text-align: left;
            vertical-align: top;
        }

        .credential-line {
            margin: 0.3rem 0;
        }

        .credential-label {
            font-size: 10px;
            margin-right: 8px;
            display: inline-block;
            min-width: 60px;
        }

        @page {
            size: 8.5in 7.5in landscape;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="medical-certificate-container">
        <div class="certificate-page">
            <!-- Header Section -->
            <div class="certificate-header">
                <div class="logo-section">
                    <div class="medical-logo" style="margin-left: 20px; width:100px; height:100px; margin-bottom:20px;">
                        <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" alt="DMSF Logo">
                    </div>
                </div>
                <div class="institution-info">
                    <h2 class="institution-name">DAVAO MEDICAL SCHOOL FOUNDATION</h2>
                    <h3 class="institution-location">DAVAO CITY</h3>
                    <h1 class="certificate-title">MEDICAL CERTIFICATE</h1>
                </div>
                <div class="date-section">
                    <div class="date-field">
                        <span class="date-value">{{ \Carbon\Carbon::parse($certificate->date_issued)->format('F j, Y') }}</span>
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
                        <span class="field-value name-field">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</span>,
                        <span class="field-value short">{{ $patient->age ?? '' }}</span> years old
                    </p>
                    <p>of
                        <span class="field-value long">{{ $patient->address ?? '' }}</span> has been treated/examined last
                        <span class="field-value medium">{{ \Carbon\Carbon::parse($certificate->date_issued)->format('F j, Y') }}</span>
                    </p>
                </div>

                <!-- Diagnosis Section -->
                <div class="section-block">
                    <div class="section-header">
                        <strong>DIAGNOSIS:</strong>
                    </div>
                    <div class="section-content">
                        <div class="content-line">
                            <span class="field-value full-width">{{ $certificate->medical_findings ?? '' }}</span>
                        </div>
                        <div class="content-line">
                            <span class="field-value full-width">&nbsp;</span>
                        </div>
                        <div class="content-line">
                            <span class="field-value full-width">&nbsp;</span>
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
                            <span class="field-value full-width">{{ $certificate->recommendations ?? '' }}</span>
                        </div>
                        <div class="content-line">
                            <span class="field-value full-width">&nbsp;</span>
                        </div>
                        <div class="content-line">
                            <span class="field-value full-width">&nbsp;</span>
                        </div>
                        <div class="content-line">
                            <span class="field-value full-width">&nbsp;</span>
                        </div>
                    </div>
                </div>

                <!-- Physician Signature Section -->
                <div class="signature-section">
                    <div class="signature-block">
                        <div class="signature-line">
                            <span class="field-value signature-field">{{ $certificate->issuing_doctor }}</span>
                        </div>
                        <div class="signature-label">Physician</div>
                    </div>

                    <div class="credentials-block">
                        <div class="credential-line">
                            <span class="credential-label">License No.</span>
                            <span class="field-value credential-field">{{ $certificate->license_number ?? '' }}</span>
                        </div>
                        <div class="credential-line">
                            <span class="credential-label">PTR No.</span>
                            <span class="field-value credential-field">&nbsp;</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>