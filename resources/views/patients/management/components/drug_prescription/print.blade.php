<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            font-size: 10pt;
        }
        .page {
            page-break-after: always;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .header, .footer {
            text-align: center;
        }
        .rx-title {
            font-size: 24pt;
            font-weight: bold;
            margin: 10px 0;
        }
        .medicine-table {
            width: 100%;
            border-collapse: collapse;
        }
        .medicine-table td {
            padding: 4px;
            vertical-align: top;
        }
    </style>
    <style>
        @page {
            margin: 10px;
        }

        body {
            font-family: 'Figtree', sans-serif;
            font-size: 10pt;
            position: relative;
        }
        
        /* Create watermark overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ public_path("images/system_logo.png") }}');
            background-repeat: repeat;
            background-size: 72px 90px;
            background-position: center;
            opacity: 0.08;
            filter: grayscale(100%) contrast(1.5);
            z-index: -1;
            pointer-events: none;
        }

        .page {
            page-break-after: auto;
            padding: 10px;
            position: relative;
            z-index: 1;
            background: transparent;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        /* Optional: add white background for text blocks if needed for readability */
        .white-box {
            background: white;
            padding: 10px;
            border-radius: 5px;
        }
    </style>



</head>
<body>
    @php
        $details = $prescription->details;
        $patient = $prescription->patient;
        $hasDetails = $details && $details->count() > 0;
        $pages = $hasDetails ? $details->chunk(5) : collect([collect([])]);
    @endphp

    @foreach ($pages as $index => $chunk)
    <div class="page {{ !$loop->last ? 'page-break' : '' }}">
        <table width="100%" style="margin-bottom: 10px;">
            <tr>
                {{-- Left Logo --}}
                <td width="20%" style="text-align: left;">
                    <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" width="60">
                </td>

                {{-- Center Info --}}
                <td width="60%" style="text-align: center;">
                    <strong style="font-size: 12pt;">DAVAO MEDICAL SCHOOL FOUNDATION, INC.</strong><br>
                    <span style="font-size: 10pt;">Medical School Drive, Bajada, Davao City</span><br>
                    <span style="font-size: 10pt;">Tel No: (082) 225-7278</span><br>
                    <strong style="font-size: 10pt;">LAnTAW - DABAW Project</strong>
                </td>

                {{-- Right Logo and Control Number --}}
                <td width="20%" style="text-align: right; vertical-align: top;">
                    <img src="{{ public_path('images/system_logo.png') }}" width="60"><br>
                    @if($prescription->control_number)
                        <div style="margin-top: 5px; font-size: 9pt; font-weight: bold; white-space: nowrap;">
                            {{ $prescription->control_number }}
                        </div>
                    @endif
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top:10px;">
            <tr>
                <td><strong>NAME:</strong> {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}</td>
                <td style="text-align:right;"><strong>DATE:</strong> {{ \Carbon\Carbon::parse($prescription->created_at)->format('F j, Y') }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>AGE/SEX:</strong> {{ $patient->age }} / {{ strtoupper($patient->sex ?? $patient->gender) }}</td>
            </tr>
        </table>

        <div class="rx-title">Rx</div>

        @if($hasDetails)
        <table class="medicine-table">
            @foreach ($chunk as $i => $detail)
                <tr>
                    <td width="5%">{{ $i + 1 }}</td>
                    <td width="65%">
                        <strong>{{ optional($detail->medicine)->name ?? '—' }}</strong><br>
                        Sig. {{ optional($detail->medicine)->rx_english_instructions ?? '—' }}
                    </td>
                    <td width="10%">#{{ optional($detail->medicine)->quantity ?? '—' }}</td>
                </tr>
            @endforeach
        </table>
        @else
        <div style="margin-top: 20px; font-style: italic;">No medicines found for this prescription.</div>
        @endif

        <div class="footer" style="position: absolute; bottom: 20px; right: 20px; margin-top:30px; text-align: right;">
            @php($user = auth()->user())
            @if($user && $user->signature_path)
                <img src="{{ public_path('storage/' . $user->signature_path) }}" style="width: 150px; height: auto;"><br>
            @endif
            <strong>{{ strtoupper($user?->display_name ?? ($prescription->doctor_name ?? '')) }}</strong><br>
            LAnTAW Project Physician<br>
            @if(!empty($user?->license_number))
                License No.: {{ $user->license_number }}
            @endif
        </div>
    </div>
    @endforeach
</body>
</html>
