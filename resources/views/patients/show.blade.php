<x-app-layout>
    <style type="text/css">
        .cardTop {
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #496C83;
        }
        .bg-marilog {
            background-image: url('{{ asset("background/marilog_bckg.png") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .fa {
            color: white;
        }

            /* Tabs Styles */

                .nav-tabs {
                padding: 1rem 1rem;
                gap: 0.5rem;
                font-weight: 500;
                border-bottom: none; /* cleaner separation */
                margin-bottom: 1rem;
            }
                .nav-link-bot {
                border-radius: 50px;
                padding: 0.5rem 1rem;
                font-weight: 500;
                background:  linear-gradient(to right, #486C33, #7CAD3E);
                color: white;
                border: none;
                transition: transform 0.2s ease;
            }
                .nav-link-bot:hover {
                transform: translateY(-2px);
            }
                .nav-tabs .nav-link-bot.active {
                background: #1A5D77;
            }
                .tab-content {
                margin-top: .5rem;
                margin-bottom: .5rem;
            }
            .bg-overlay {
                        position: fllex;
                        inset: 0;
                        background-color: rgba(0, 0, 0, 0.5); /* Dark overlay */
                        z-index: 1;
                    }
    </style>

    <div class="bg-marilog bg-fixed">
        <div class="bg-overlay"></div>
        <div class="mx-auto p-4">
            <div class="cardTop shadow-lg p-4 border-0" style="width: 100%; border-radius: 2rem;">
                <div class="row g-4">
                <!-- Left Section (Profile Image & Basic Info) -->
                <div class="col-md-3 text-left border-end">
                    <a href="{{ route('patients.index') }}">
                        <button type="button" class="mb-3 border border-white text-white hover:bg-[#1A5D77] hover:text-white transition-colors duration-300 rounded-full px-3 py-1">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </button>
                    </a>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">Edit Patient</a>
                    <h5 class="fw-bold mb-1 mt-5 text-center text-white">
                        {{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                    </h5>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Age: {{ \Carbon\Carbon::parse($patient->birth_date)->age }} years old</p>
                    </div>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Sex: {{ $patient->sex }}</p>
                    </div>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Status: {{ $patient->marital_status }}</p>
                    </div>
                    <div class="p-1 text-center text-white">
                        <p class="mb-0">Religion: {{ $patient->religion }}</p>
                    </div>
                    <div class="bg-light p-1 rounded border text-center">
                        <p class="mb-0">{{ $patient->reference_number ?? 'Not set' }}</p>
                    </div>

                    <p class="pt-3 text-white mb-2 text-center">
                        Diagnosis
                        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#diagnosisModal">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </p>
                    <p class="text-center text-white">{{ $patient->diagnosis ?? 'Diagnosis not set'}}</p>
                </div>

                <!-- Right Section -->
                <div class="col-md-9" style="border-left: 1px solid black;">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="measurementsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1-content" type="button" role="tab" aria-controls="tab1-content" aria-selected="true">
                                <span class="tab-date">{{ \Carbon\Carbon::parse($tab1Date)->format('M d, Y') }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2-content" type="button" role="tab" aria-controls="tab2-content" aria-selected="false">
                                <span class="tab-date">{{ \Carbon\Carbon::parse($tab2Date)->format('M d, Y') }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3-content" type="button" role="tab" aria-controls="tab3-content" aria-selected="false">
                                <span class="tab-date">{{ \Carbon\Carbon::parse($tab3Date)->format('M d, Y') }}</span>
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="measurementsTabContent">
                        <!-- Tab 1 Content -->
                        <div class="tab-pane fade show active" id="tab1-content" role="tabpanel" aria-labelledby="tab1-tab">
                            <!-- Anthropometric Measurements Section -->
                            <div class="p-2 mb-6">
                                <h5 class="border-bottom pb-2 mb-3">Anthropometric Measurements</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Height (m)</p>
                                        <p class="fw-bold editable-measurement" data-field="height" data-tab="1">{{ $tab1Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Weight (kg)</p>
                                        <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="1">{{ $tab1Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab1">{{ $tab1Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Waist Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="1">{{ $tab1Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Hip Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="1">{{ $tab1Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Neck Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="1">{{ $tab1Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div>
                                <h5 class="border-bottom pb-2 mb-3">Vital Signs</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Temperature (°C)</p>
                                        <p class="fw-bold editable-measurement" data-field="temperature" data-tab="1">{{ $tab1Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Heart Rate (BPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="1">{{ $tab1Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">O2 Saturation (%)</p>
                                        <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="1">{{ $tab1Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Respiratory Rate (CPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="1">{{ $tab1Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Blood Pressure (mmHg)</p>
                                        <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="1">{{ $tab1Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 2 Content (Hidden by default) -->
                        <div class="tab-pane fade" id="tab2-content" role="tabpanel" aria-labelledby="tab2-tab">
                            <!-- Anthropometric Measurements Section -->
                            <div class="p-2 mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Anthropometric Measurements</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Height (m)</p>
                                        <p class="fw-bold editable-measurement" data-field="height" data-tab="2">{{ $tab2Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Weight (kg)</p>
                                        <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="2">{{ $tab2Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">BMI (kg/m²)</p>
                                        <p class="fw-bold" id="bmi-tab2">{{ $tab2Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Waist Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="2">{{ $tab2Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Hip Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="2">{{ $tab2Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Neck Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="2">{{ $tab2Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div>
                                <h5 class="border-bottom pb-2 mb-3">Vital Signs</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Temperature (°C)</p>
                                        <p class="fw-bold editable-measurement" data-field="temperature" data-tab="2">{{ $tab2Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Heart Rate (BPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="2">{{ $tab2Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">O2 Saturation (%)</p>
                                        <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="2">{{ $tab2Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Respiratory Rate (CPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="2">{{ $tab2Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Blood Pressure (mmHg)</p>
                                        <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="2">{{ $tab2Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3 Content (Hidden by default) -->
                        <div class="tab-pane fade" id="tab3-content" role="tabpanel" aria-labelledby="tab3-tab">
                            <!-- Anthropometric Measurements Section -->
                            <div class="p-2 mb-6">
                                <h5 class="border-bottom pb-2.5 mb-4 text-white">Anthropometric Measurements</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Height (m)</p>
                                        <p class="fw-bold editable-measurement" data-field="height" data-tab="3">{{ $tab3Measurements?->getHeightInMeters() ?? $patient->getHeightInMeters() ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Weight (kg)</p>
                                        <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="3">{{ $tab3Measurements?->weight_kg ?? $patient->weight_kg ?? 'N/A'}}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text mb-1 text-white">BMI (kg/m²)</p>
                                        <p class="fw-bold bg-light p-1 rounded border" id="bmi-tab3">{{ $tab3Measurements?->calculateBMI() ?? $patient->calculateBMI() }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Waist Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="3">{{ $tab3Measurements?->waist_circumference ?? $patient->waist_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Hip Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="3">{{ $tab3Measurements?->hip_circumference ?? $patient->hip_circumference ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Neck Circumference (cm)</p>
                                        <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="3">{{ $tab3Measurements?->neck_circumference ?? $patient->neck_circumference ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vital Signs Section -->
                            <div>
                                <h5 class="border-bottom pb-2 mb-3 text-white">Vital Signs</h5>
                                <div class="row">
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Temperature (°C)</p>
                                        <p class="fw-bold editable-measurement" data-field="temperature" data-tab="3">{{ $tab3Measurements?->temperature ?? $patient->temperature ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Heart Rate (BPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="3">{{ $tab3Measurements?->heart_rate ?? $patient->heart_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">O2 Saturation (%)</p>
                                        <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="3">{{ $tab3Measurements?->o2_saturation ?? $patient->o2_saturation ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Respiratory Rate (CPM)</p>
                                        <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="3">{{ $tab3Measurements?->respiratory_rate ?? $patient->respiratory_rate ?? 'N/A' }}</p>
                                    </div>
                                    <div class="col-4 mb-3">
                                        <p class="text-muted mb-1">Blood Pressure (mmHg)</p>
                                        <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="3">{{ $tab3Measurements?->blood_pressure ?? $patient->blood_pressure ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>

                    <!-- Tabs for Patient Details -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot active" id="first-encounter-tab" data-bs-toggle="tab" data-bs-target="#first-encounter-tab-pane" type="button" role="tab" aria-controls="first-encounter-tab-pane" aria-selected="true">First Encounter</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">LD Screening Tools</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="comprehensive-history-tab" data-bs-toggle="tab" data-bs-target="#comprehensive-history-tab-pane" type="button" role="tab" aria-controls="comprehensive-history-tab-pane" aria-selected="false">History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="review-of-systems-tab" data-bs-toggle="tab" data-bs-target="#review-of-systems-tab-pane" type="button" role="tab" aria-controls="review-of-systems-tab-pane" aria-selected="false">ROS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="physical-exam-tab" data-bs-toggle="tab" data-bs-target="#physical-exam-tab-pane" type="button" role="tab" aria-controls="physical-exam-tab-pane" aria-selected="false">Physical Exam</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="other-lm-vs-tab" data-bs-toggle="tab" data-bs-target="#other-lm-vs-tab-pane" type="button" role="tab" aria-controls="other-lm-vs-tab-pane" aria-selected="false">Other LM VS</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="assessment-tab" data-bs-toggle="tab" data-bs-target="#assessment-tab-pane" type="button" role="tab" aria-controls="assessment-tab-pane" aria-selected="false">Assessment</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="false">Management</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" type="button" role="tab" aria-controls="notes-tab-pane" aria-selected="false">Notes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="laboratory-tab" data-bs-toggle="tab" data-bs-target="#laboratory-tab-pane" type="button" role="tab" aria-controls="laboratory-tab-pane" aria-selected="false">Laboratory</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="prescription-tab" data-bs-toggle="tab" data-bs-target="#prescription-tab-pane" type="button" role="tab" aria-controls="prescription-tab-pane" aria-selected="false">Prescription</button>
                        </li>
                    </ul>

                    <style>
                        .tab-content.active {
                            background-color: #7CAD3E;
                        }
                    </style>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="first-encounter-tab-pane" role="tabpanel" aria-labelledby="first-encounter-tab" tabindex="0">
                            <br/>
                            @include('patients.first_encounter.first_encounter_screening', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="laboratory-tab-pane" role="tabpanel" aria-labelledby="laboratory-tab" tabindex="0">
                            <br/>
                            @include('patients.laboratory.laboratory', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                            <br/>
                            @include('patients.screeningtool.screeningtool', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="prescription-tab-pane" role="tabpanel" aria-labelledby="prescription-tab" tabindex="0">
                            <br/>
                            @include('prescriptions.prescription_patient', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="review-of-systems-tab-pane" role="tabpanel" aria-labelledby="review-of-systems-tab" tabindex="0">
                            <br/>
                            @include('patients.review_of_systems.review_of_systems', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="comprehensive-history-tab-pane" role="tabpanel" aria-labelledby="comprehensive-history-tab" tabindex="0">
                            <br/>
                            @include('patients.comprehensive_history.comprehensive_history', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="assessment-tab-pane" role="tabpanel" aria-labelledby="assessment-tab" tabindex="0">
                            <br/>
                            @include('patients.screeningtool.forms.assessment_form', ['patient' => $patient])
                        </div>
                        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!-- TDEE Modal -->
            <div class="modal fade" id="tdeeModal" tabindex="-1" aria-labelledby="tdeeModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tdeeModalLabel">Calculate TDEE</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="tdeeForm">
                                @csrf
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                                <label class="fw-bold">Activity Level</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activity_level" value="sedentary" required>
                                    <label class="form-check-label">Sedentary (Little to no exercise)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activity_level" value="lightly active">
                                    <label class="form-check-label">Lightly active (1-3 days/week)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activity_level" value="moderately active">
                                    <label class="form-check-label">Moderately active (3-5 days/week)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activity_level" value="very active">
                                    <label class="form-check-label">Very active (6-7 days/week)</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="activity_level" value="extra active">
                                    <label class="form-check-label">Extra active (Physical job & sports)</label>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Save TDEE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Macronutrient Modal -->
            <div class="modal fade" id="macroModal" tabindex="-1" aria-labelledby="macroModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="macroModalLabel">Macronutrient Breakdown</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Goal for Fat Loss = <span id="tdee-value"></span> kcal/day</strong></p>
                            <table class="table table-bordered text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>Protein <br> (0.8g per kg bodyweight)</th>
                                        <th>Fat <br> (15% of total calories)</th>
                                        <th>Carbohydrates <br> (Remaining Calories)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>= 0.8g x <span id="weight-kg"></span> kg = <strong><span id="protein-grams"></span> g</strong> <br>
                                            x 4 kcal/g = <strong><span id="protein-calories"></span> kcal</strong>
                                        </td>
                                        <td>= 0.15 x <span id="tdee-value-fat"></span> = <strong><span id="fat-calories"></span> kcal</strong> <br>
                                            ÷ 9 kcal/g = <strong><span id="fat-grams"></span> g</strong>
                                        </td>
                                        <td>= <span id="tdee-value-carbs"></span> kcal – (<span id="protein-calories"></span> kcal protein) + (<span id="fat-calories"></span> kcal fat) <br>
                                            = <strong><span id="carbs-calories"></span> kcal</strong> ÷ 4 kcal/g = <strong><span id="carbs-grams"></span> g</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View Meal Plan Modal-->
            <div class="modal fade" id="mealPlanModal" tabindex="-1" aria-labelledby="mealPlanLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mealPlanLabel">Sample Meal Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Meal Type</th>
                                        <th>Protein (g)</th>
                                        <th>Fat (g)</th>
                                        <th>Carbohydrates (g)</th>
                                    </tr>
                                </thead>
                                <tbody id="mealPlanTableBody">
                                    <tr>
                                        <td colspan="5" class="text-center">No records available.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary open-add-meal-modal"><i class="fa-solid fa-plus"></i> Add Meal Plan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add Meal Plan Modal-->
            <div class="modal fade" id="addMealPlanModal" tabindex="-1" aria-labelledby="addMealPlanLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMealPlanLabel">Add Meal Plan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="addMealPlanForm">
                                @csrf
                                <input type="hidden" id="patient_id" value="{{ $patient->id }}">
                                <div class="mb-3">
                                    <label class="form-label">Date</label>
                                    <input type="date" id="mealPlanDate" class="form-control" name="mealPlanDate" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Meal Type</label>
                                    <select  id="meal_type" class="form-control" name="meal_type">
                                        <option value="Breakfast">Breakfast</option>
                                        <option value="Lunch">Lunch</option>
                                        <option value="PM Snacks">PM Snacks</option>
                                        <option value="Dinner">Dinner</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Protein (g)</label>
                                    <input type="number" id="protein" class="form-control" name="protein" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fat (g)</label>
                                    <input type="number" id="fat" class="form-control" name="fat" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Carbohydrates (g)</label>
                                    <input type="number" id="carbohydrates" class="form-control" name="carbohydrates" required>
                                </div>
                                <button type="submit" id="saveMealPlanBtn" class="btn btn-success">Save Meal Plan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Add Diagnosis Modal -->
    <div class="modal fade" id="diagnosisModal" tabindex="-1" aria-labelledby="diagnosisModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="diagnosisModalLabel">Edit Diagnosis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="diagnosisForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="diagnosis" class="form-label">Diagnosis</label>
                            <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" required>{{ $patient->diagnosis }}</textarea>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Diagnosis</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Date Edit Modal -->
    <div class="modal fade" id="dateEditModal" tabindex="-1" aria-labelledby="dateEditModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dateEditModalLabel">Edit Date</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="dateEditForm">
                        <div class="mb-3">
                            <label for="tabDate" class="form-label">Date</label>
                            <input type="date" class="form-control" id="tabDate" required>
                        </div>
                        <input type="hidden" id="currentTab">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveDateBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#tdeeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('tdee.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#tdeeModal').modal('hide'); // Close modal
                    $('#tdeeValue').text(response.tdee + ' kcal/day'); // Update display
                    alert(response.message);
                },
                error: function(xhr) {
                    alert('Something went wrong!');
                }
            });
        });

        $(".open-macro-modal").click(function () {
            let patientId = $(this).data("patient-id"); // Get patient ID from button

            $.ajax({
                url: "/patient/" + patientId + "/macronutrients", // Pass ID in URL
                type: "GET",
                success: function (response) {
                    $("#tdee-value, #tdee-value-fat, #tdee-value-carbs").text(response.tdee);
                    $("#weight-kg").text(response.weight_kg);

                    // Macronutrient values
                    $("#protein-grams").text(response.protein_grams);
                    $("#protein-calories").text(response.protein_calories);
                    $("#fat-grams").text(response.fat_grams);
                    $("#fat-calories").text(response.fat_calories);
                    $("#carbs-grams").text(response.carbs_grams);
                    $("#carbs-calories").text(response.carbs_calories);

                    // Show modal
                    $("#macroModal").modal("show");
                },
                error: function () {
                    alert("Error fetching macronutrient data.");
                }
            });
        });

        // Open meal plan modal
        $(".open-meal-plan-modal").click(function () {
            let patientId = $(this).data("patient-id"); // Get patient ID from button attribute

            $.ajax({
                url: "/get-meal-plans/" + patientId,  // Pass patient_id in the URL
                type: "GET",
                success: function (response) {
                    let tableBody = $("#mealPlanTableBody");
                    tableBody.empty();

                    if (response.length > 0) {
                        response.forEach(meal => {
                            tableBody.append(`
                                <tr>
                                    <td>${meal.date}</td>
                                    <td>${meal.meal_type}</td>
                                    <td>${meal.protein} g</td>
                                    <td>${meal.fat} g</td>
                                    <td>${meal.carbohydrates} g</td>
                                </tr>
                            `);
                        });
                    } else {
                        tableBody.append('<tr><td colspan="5" class="text-center">No records available.</td></tr>');
                    }

                    $("#mealPlanModal").modal("show"); // Show modal
                },
                error: function () {
                    alert("Error fetching meal plans.");
                }
            });
        });


        // Open add meal modal
        $(".open-add-meal-modal").click(function () {
            $("#mealPlanModal").modal("hide");
            $("#addMealPlanModal").modal("show");
        });

        // Save new meal plan
        $("#saveMealPlanBtn").click(function () {
            let formData = {
                patient_id: $("#patient_id").val(),
                meal_type: $("#meal_type").val(),
                protein: $("#protein").val(),
                fat: $("#fat").val(),
                carbohydrates: $("#carbohydrates").val(),
                date: $("#mealPlanDate").val(),
                _token: $('meta[name="csrf-token"]').attr("content"), // Include CSRF token
            };

            $.ajax({
                url: "/save-meal-plan", // Ensure this matches your web.php route
                type: "POST",
                data: formData,
                success: function (response) {
                    alert("Meal Plan saved successfully!");
                    // $("#mealPlanModal").modal("hide");
                    // location.reload();
                },
                error: function (xhr) {
                    alert("Error saving meal plan: " + xhr.responseText);
                },
            });
        });

        // Diagnosis form submission
        $('#diagnosisForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('patients.update-diagnosis', $patient->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#diagnosisModal').modal('hide');
                    // Update the diagnosis display
                    $('.text-center').last().text(response.diagnosis);
                    alert('Diagnosis updated successfully!');
                    // Refresh the page
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error updating diagnosis: ' + xhr.responseText);
                }
            });
        });

        // Function to format date
        function formatDate(date) {
            return new Date(date).toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }

        // Double click to edit date - ONLY for measurement tabs (private to right section)
        $('#measurementsTab .nav-link').on('dblclick', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const tabNum = $(this).attr('id').replace('tab', '').replace('-tab', '');
            const currentDate = $(this).find('.tab-date').text();
            
            // Validate that this is actually a measurement tab (tab1, tab2, tab3)
            if (!['1', '2', '3'].includes(tabNum)) {
                console.warn('Date editing not allowed for this tab:', tabNum);
                return;
            }
            
            // Convert displayed date to ISO format
            let isoDate;
            try {
                isoDate = new Date(currentDate).toISOString().split('T')[0];
            } catch (error) {
                // Fallback to today's date if parsing fails
                isoDate = new Date().toISOString().split('T')[0];
                console.warn('Date parsing failed, using today:', error);
            }

            $('#currentTab').val(tabNum);
            // Store the original date as well
            $('#currentTab').attr('data-original-date', isoDate);
            $('#tabDate').val(isoDate);
            $('#dateEditModal').modal('show');
        });

        // Save date changes
        $('#saveDateBtn').click(function() {
            const tabNum = $('#currentTab').val();
            const oldDate = $('#currentTab').attr('data-original-date');
            const newDate = $('#tabDate').val();

            console.log('Date save attempt:', { tabNum, oldDate, newDate });

            if (oldDate === newDate) {
                console.log('No date change detected, closing modal');
                $('#dateEditModal').modal('hide');
                return;
            }

            const formData = {
                tab_number: tabNum,
                old_date: oldDate,
                new_date: newDate,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            console.log('Sending request with data:', formData);

            $.ajax({
                url: "{{ route('patients.update-measurement-date', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    console.log('Server response:', response);
                    if (response.success) {
                        $(`#tab${tabNum}-tab .tab-date`).text(formatDate(newDate));
                        $('#dateEditModal').modal('hide');
                        alert('Date updated successfully!');
                        // Optionally reload the tab content to show updated data
                        location.reload();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error('AJAX error:', xhr);
                    let errorMessage = 'Error updating date';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        errorMessage = xhr.responseText;
                    }
                    alert(errorMessage);
                }
            });
        });

        // Prevent tab switching when double clicking - ONLY for measurement tabs
        $('#measurementsTab .nav-link').on('dblclick', function(e) {
            e.stopPropagation();
        });

        // Inline editing for measurement fields
        $('.editable-measurement').on('dblclick', function() {
            var $span = $(this);
            var originalValue = $span.text().replace(/[^\d.\/-]/g, '');
            var field = $span.data('field');
            var tab = $span.data('tab');
            var inputType = (field === 'blood_pressure') ? 'text' : 'number';
            var step = (field === 'height' || field === 'weight_kg' || field.includes('circumference') || field === 'temperature') ? '0.01' : '1';
            var $input = $('<input type="' + inputType + '" class="form-control form-control-sm" style="width:80px;display:inline;" />')
                .val(originalValue)
                .attr('step', step)
                .on('blur', saveMeasurement)
                .on('keydown', function(e) { if (e.key === 'Enter') { saveMeasurement.call(this); } });
            $span.hide().after($input);
            $input.focus();
            function saveMeasurement() {
                var newValue = $input.val();
                if (newValue === originalValue) { $input.remove(); $span.show(); return; }
            $.ajax({
                url: "{{ route('patients.update-measurement', $patient->id) }}",
                method: "POST",
                    data: {
                        tab_number: tab,
                        field_name: field,
                        field_value: newValue,
                _token: $('meta[name="csrf-token"]').attr('content')
                    },
                success: function(response) {
                        $span.text(newValue + (field === 'height' ? ' m' : field === 'weight_kg' ? ' kg' : field.includes('circumference') ? ' cm' : field === 'temperature' ? ' °C' : field === 'heart_rate' ? ' BPM' : field === 'o2_saturation' ? ' %' : field === 'respiratory_rate' ? ' CPM' : field === 'blood_pressure' ? ' mmHg' : ''));
                        $input.remove();
                        $span.show();
                        // If height or weight changed, update BMI
                        if (field === 'height' || field === 'weight_kg') {
                            updateBMI(tab);
                        }
                },
                error: function(xhr) {
                        alert('Error updating ' + field + ': ' + xhr.responseText);
                        $input.remove();
                        $span.show();
                    }
                });
            }
        });
        function updateBMI(tab) {
            // Optionally, fetch updated measurement and recalculate BMI
            $.ajax({
                url: '/patients/{{ $patient->id }}/measurements/' + tab,
                method: 'GET',
                success: function(response) {
                    var m = response.measurement;
                    if (m && m.height && m.weight_kg) {
                        var bmi = (m.weight_kg / (m.height * m.height)).toFixed(2);
                        $('#bmi-tab' + tab).text(bmi + ' kg/m²');
                    }
                }
            });
        }
    });
    </script>

</x-app-layout>
