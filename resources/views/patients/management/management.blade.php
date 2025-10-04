<style>
    .progress-tabs {
        padding: 20px 5%;
        position: relative;
        font-family: 'Lato', sans-serif;
    }
    .tab-bar-container { margin: 1.5rem 0; }
    .nav-tabs.flex-nowrap { overflow-x: auto; overflow-y: hidden; white-space: nowrap; flex-wrap: nowrap; }
    .nav-tabs .nav-link {
        display: flex; align-items: center; justify-content: center;
        min-width: 160px; height: 50px; padding: 10px 20px;
        font-size: 13px; font-weight: 600; text-align: center; color: #236477;
    }
    .nav-tabs .nav-link .step-title { font-weight: 600; font-size: 13px; margin-bottom: 2px; line-height: 1.1; }
    .nav-tabs .nav-link .step-subtitle { font-size: 10px; opacity: .8; font-weight: 400; line-height: 1; }
    .nav-tabs .nav-link.active { color: #fff; background-color: #236477; border-color: #173042 #173042 transparent; }
    .management-content { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,.1); padding: 2rem; margin-top: 0; }
</style>

<div class="row">
    <div class="col-12">
        <div class="progress-tabs">
            <div class="tab-bar-container">
                <ul class="nav nav-tabs flex-nowrap" id="management-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-drug-prescription" data-bs-toggle="tab" data-bs-target="#list-drug-prescription" type="button" role="tab" aria-controls="list-drug-prescription" aria-selected="true">
                            <span>
                                <div class="step-title">Drug Prescription</div>
                                <div class="step-subtitle">Medication orders</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-diagnostic-request" data-bs-toggle="tab" data-bs-target="#list-diagnostic-request" type="button" role="tab" aria-controls="list-diagnostic-request" aria-selected="false">
                            <span>
                                <div class="step-title">Diagnostic Request</div>
                                <div class="step-subtitle">Lab & imaging</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-lifestyle-prescription" data-bs-toggle="tab" data-bs-target="#list-lifestyle-prescription" type="button" role="tab" aria-controls="list-lifestyle-prescription" aria-selected="false">
                            <span>
                                <div class="step-title">Lifestyle Prescription</div>
                                <div class="step-subtitle">Health recommendations</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-medical-certificate" data-bs-toggle="tab" data-bs-target="#list-medical-certificate" type="button" role="tab" aria-controls="list-medical-certificate" aria-selected="false">
                            <span>
                                <div class="step-title">Medical Certificate</div>
                                <div class="step-subtitle">Official documentation</div>
                            </span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-referral-form" data-bs-toggle="tab" data-bs-target="#list-referral-form" type="button" role="tab" aria-controls="list-referral-form" aria-selected="false">
                            <span>
                                <div class="step-title">Referral Form</div>
                                <div class="step-subtitle">Specialist referral</div>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="management-content">
            <div class="tab-content" id="management-nav-tabContent">
                <div class="tab-pane fade show active" id="list-drug-prescription" role="tabpanel" aria-labelledby="list-drug-prescription-list">
                    @include('patients.management.components.drug_prescription.drug_prescription', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-diagnostic-request" role="tabpanel" aria-labelledby="list-diagnostic-request-list">
                    @include('patients.management.components.diagnostic_request.diagnostic_request', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-lifestyle-prescription" role="tabpanel" aria-labelledby="list-lifestyle-prescription-list">
                    @include('patients.management.components.lifestyle_prescription', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-medical-certificate" role="tabpanel" aria-labelledby="list-medical-certificate-list">
                    @include('patients.management.components.medical_certificate', ['patient' => $patient])
                </div>
                <div class="tab-pane fade" id="list-referral-form" role="tabpanel" aria-labelledby="list-referral-form-list">
                    @include('patients.management.components.referral_form', ['patient' => $patient])
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// No custom JS needed; Bootstrap's tab functionality handles switching via data attributes.
</script>