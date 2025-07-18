<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Diagnostic Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }
        .bold-text {
            font-weight: bold;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
        }
        .logo-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
        }
        .logo-right {
            position: absolute;
            right: 0;
            top: 0;
            width: 80px;
        }
        .info-table {
            width: 100%;
            margin-top: 20px;
        }
        .diagnostic-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .diagnostic-table td, .diagnostic-table th {
            border: 1px solid #ccc;
            padding: 8px;
            vertical-align: top;
        }
        .diagnostic-table th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .category-header {
            background-color: #e8f4f8;
            font-weight: bold;
            text-align: center;
        }
        .test-list {
            padding-left: 10px;
        }
        .footer {
            margin-top: 50px;
            width: 100%;
        }
        .doctor {
            float: right;
            text-align: right;
        }
        .date {
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/dmsf_logo_transparent.png') }}" class="logo-left">
        <img src="{{ public_path('images/system_logo.png') }}" class="logo-right">

        <h3>LANTAW-DABAW PROJECT</h3>
        <h3>A Telelifestyle Monitoring Project for Dabawenyos</h3>
        <p>Medical School Drive, Bajada, Davao City<br>
        Tel No.: (082) 225-7278</p>
        <h4>DIAGNOSTIC REQUEST</h4>
        <p class="date">DATE: {{ \Carbon\Carbon::parse($diagnostic->diagnostic_date)->format('F j, Y') }}</p>
    </div>
    <hr>
    <table class="info-table">
        <tr>
            <td><strong>NAME:</strong> {{ $diagnostic->patient->last_name }}, {{ $diagnostic->patient->first_name }} {{ $diagnostic->patient->middle_name ?? '' }} </td>
        </tr>
        <tr>
            <td><strong>AGE/SEX:</strong> {{ $diagnostic->patient->age }} / {{ $diagnostic->patient->sex ?? $diagnostic->patient->gender }}</td>
        </tr>
        <tr>
            <td><strong>REQUESTING PHYSICIAN:</strong> {{ $diagnostic->requesting_physician }}</td>
        </tr>
    </table>
    
    <br/>
    
    <table class="diagnostic-table">
        @if(!empty($diagnostic->hematology) && count($diagnostic->hematology) > 0)
        <tr>
            <td class="category-header">🩸 HEMATOLOGY (Dugo)</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->hematology as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>

                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan mag-puasa (fasting).</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Likayi ang kusog nga lihok o ehersisyo sa wala pa ang test.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mas maayo magpa-test buntag.</p>

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->clinical_microscopy) && count($diagnostic->clinical_microscopy) > 0)
        <tr>
            <td class="category-header">CLINICAL MICROSCOPY (Ihi, Semilya, Ihi Para sa Buntis)</td>
        </tr>
        <tr>
            <td class="test-list">
                • 
                @foreach($diagnostic->clinical_microscopy as $test)
                    {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br><br>
            @if(in_array('urinalysis', $diagnostic->clinical_microscopy))
            <p class="bold-text">• Urinalysis(Ihi):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektaha ang tunga-tunga nga ihi gamit ang limpyo nga botelya.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mas maayo gamiton ang unang ihi sa buntag</p>
            @endif

            @if(in_array('pregnancy_test', $diagnostic->clinical_microscopy))
            <p class="bold-text">• Pregnancy Test (Ihi Para sa Buntis):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Gamiton ang unang ihi sa buntag para mas klaro ang resulta.</p>
            @endif

            @if(in_array('semen_analysis', $diagnostic->clinical_microscopy))
            <p class="bold-text">• Semen Analysis (Semilya):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Likayi ang pakighilawas sulod sa 2–7 ka adlaw sa wala pa magpa-test.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektaha ang semilya sa limpyo nga botelya..</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dalha dayon sa laboratoryo sulod sa 30–60 minutos, itipig duol sa lawas para dili mabugnaw.</p>
            @endif
            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->blood_chemistry) && count($diagnostic->blood_chemistry) > 0)
        <tr>
            <td class="category-header">BLOOD CHEMISTRY (Dugo para sa asukal ug uban pa)</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->blood_chemistry as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="width: 50%; vertical-align: top; border: none; padding-right: 10px;">
                            @if(in_array('fbs_rbs', $diagnostic->blood_chemistry))
                            <p class="bold-text">• FBS/RBS (Blood Sugar):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Fasting: Walay kaon o imnon gawas sa tubig sulod sa 8–10 ka oras.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Random: Dili kinahanglan maglaming/fasting</p>
                            @endif

                            @if(in_array('lipid_profile', $diagnostic->blood_chemistry))
                            <p class="bold-text">• Lipid Profile:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Maglaming/fasting sulod sa 10–12 ka oras.</p>
                            @endif

                            @if(in_array('bun', $diagnostic->blood_chemistry) || in_array('creatinine', $diagnostic->blood_chemistry) || in_array('uric_acid', $diagnostic->blood_chemistry))
                            <p class="bold-text">• BUN / Creatinine / Uric Acid:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Maglaming/fasting sulod sa 8–10 ka oras.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Inom lang ug tubig kung tugutan sa health worker.</p>
                            @endif

                            @if(in_array('sgot', $diagnostic->blood_chemistry) || in_array('sgpt', $diagnostic->blood_chemistry))
                            <p class="bold-text">• SGOT / SGPT (Atay):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Wala'y espesyal nga preparasyon.</p>
                            @endif
                        </td>
                        
                        <td style="width: 50%; vertical-align: top; border: none; padding-left: 10px;">
                            @if(in_array('hba1c', $diagnostic->blood_chemistry))
                            <p class="bold-text">• HbA1c (Asukal sa Dugo sa Miaging 3 Ka Buwan):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan maglaming/fasting.</p>
                            @endif

                            @if(in_array('ogtt', $diagnostic->blood_chemistry))
                            <p class="bold-text">• OGTT (Oral Glucose Tolerance Test):</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Maglaming/fasting sulod sa 8–10 ka oras.</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Human kuhaan og dugo, painmon ka nila og glucose solution (tam-is kaayo nga tubig).</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kuhaon usab ug dugo human sa 1 ka oras ug 2 ka oras na pud.</p>
                            @endif

                            @if(in_array('serum_electrolytes', $diagnostic->blood_chemistry))
                            <p class="bold-text">• Serum Electrolytes:</p>
                            <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan maglaming/fasting.</p>
                            @endif
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->microbiology) && count($diagnostic->microbiology) > 0)
        <tr>
            <td class="category-header">MICROBIOLOGY (Plema, Panit, Uban Pa)</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->microbiology as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                
                @if(in_array('gram_stain', $diagnostic->microbiology))
                <p class="bold-text">• Gram Stain:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Sundon ang instruction sa health worker depende sa sample.</p>
                @endif

                @if(in_array('sputum_afb', $diagnostic->microbiology) || in_array('genexpert', $diagnostic->microbiology))
                <p class="bold-text">• Sputum AFB / GeneXpert (Plema para sa TB):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektaha ang plema buntag sa wala pa magkaon o magtoothbrush.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Hugasi ang baba gamit tubig, dayon hikapa ang lalom nga ubo para mugawas ang plema (ayaw apila ang laway).</p>
                @endif

                @if(in_array('koh_test', $diagnostic->microbiology) || in_array('sss', $diagnostic->microbiology))
                <p class="bold-text">• KOH Test / SSS (Slit Skin Smear para sa Panit):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Walay preparasyon, ang health worker ang mukuha sa sample</p>
                @endif

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->immunology_serology) && count($diagnostic->immunology_serology) > 0)
        <tr>
            <td class="category-header">IMMUNOLOGY/SEROLOGY (Dugo para sa TB, HIV, Syphilis, RPR, Dengue, Malaria)</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->immunology_serology as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                <p class="bold-text">• HBsAg / HIV / Syphilis / RPR:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan maglaming/fasting.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Mag counseling bag-o ug paghuman sa test so ayaw sa ug uli dayon.</p>
                <p class="bold-text">• Dengue RDT / Malaria RDT:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Dili kinahanglan maglaming/fasting.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Ingna ang staff kung naay hilanat, rashes/pantal-pantal kalibanga, o kasukaon.</p>
            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->stool_tests) && count($diagnostic->stool_tests) > 0)
        <tr>
            <td class="category-header">STOOL TESTS (Tae)</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->stool_tests as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                
                @if(in_array('fecalysis', $diagnostic->stool_tests))
                <p class="bold-text">• Fecalysis:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Kolektaha ang bag-ong tae sa limpyo nga sudlanan ug sirad-a kini ug tarong. Siguraduha maghugas ug kamot pagkahuman.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• I-hatag dayon sulod sa 1 ka oras, o ibutang sa ref kung madugay.</p>
                @endif

                @if(in_array('fobt', $diagnostic->stool_tests))
                <p class="bold-text">• Fecal Occult Blood Test (FOBT):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Likayi ang pagkaon og pula nga karne, dahonon nga gulay, ug vitamin C sulod sa 2–3 ka adlaw kung gikinahanglan.</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Sundon ang instruction kung gi-tagaan og kit.</p>
                @endif

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->blood_typing_bsmp) && count($diagnostic->blood_typing_bsmp) > 0)
        <tr>
            <td class="category-header">BLOOD TYPING / BSMP</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                @foreach($diagnostic->blood_typing_bsmp as $test)
                     {{ ucwords(str_replace('_', ' ', $test)) }} |
                @endforeach
                <br>
                
                @if(in_array('blood_typing', $diagnostic->blood_typing_bsmp))
                <p class="bold-text">• Blood Typing:</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Wala’y espesyal nga preparasyon.</p>
                @endif

                @if(in_array('bsmp', $diagnostic->blood_typing_bsmp))
                <p class="bold-text">• BSMP (Barangay Systematic Medical Profiling):</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;• Sundon ang instruction sa health worker.</p>
                @endif

            </td>
        </tr>
        @endif

        @if(!empty($diagnostic->others))
        <tr>
            <td class="category-header">OTHERS</td>
        </tr>
        <tr>
            <td class="test-list">
                •
                {{ $diagnostic->others }}
            </td>
        </tr>
        @endif

        <tr>
            <td class="category-header" style="color: #b22222;">IMPORTANTE NGA PANUMDOM</td>
        </tr>
        <tr>
            <td class="test-list">
                <ul style="margin-bottom: 0;">
                    <li>Dad-a ang valid ID ug lab request form.</li>
                    <li>Moabot sayo kung kinahanglan maglaming/fasting.</li>
                    <li>Sul-ob og hapsay ug komportableng sinina nga dali ra makuhaan ug dugo.</li>
                    <li>Ingna ang health staff kung buntis, naay tambal nga ginainom, o adunay sakit nga kinahanglan ipahibalo.</li>
                </ul>
            </td>
        </tr>
    </table>

    <div class="footer">
        <div class="doctor">
           <div style="text-align: right; margin-top: 50px;">
            <img src="{{ public_path('images/esignature.png') }}" style="width: 150px; height: auto;">
            <div style="font-weight: bold;">{{ $diagnostic->requesting_physician }}</div>
        </div>
            School Clinic Physician<br>
            License No.: 0152234</p>
        </div>
    </div>

</body>
</html>
