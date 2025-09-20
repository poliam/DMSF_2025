<x-app-layout>
    <style type="text/css">
        .cardTop {
            border-radius: 12px;
            padding: 20px;
            background-color: rgba(242, 242, 242, 0.3);
        }
        .bg-marilog {
            background-image: url('{{ asset("images/marilog-bg.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .fa {
            color: white;
        }

        /* Enhanced Measurement Tabs Styles */
        #measurementsTab {
            border-bottom: none;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 0.5rem;
            margin-bottom: 1rem;
        }

        #measurementsTab .nav-link {
            border: none;
            border-radius: 8px;
            margin: 0 2px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #2c3e50;
            position: relative;
            overflow: hidden;
        }

        #measurementsTab .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        #measurementsTab .nav-link:hover::before {
            left: 100%;
        }

        #measurementsTab .nav-link:hover {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }

        #measurementsTab .nav-link:hover .text-dark {
            color: white !important;
        }

        #measurementsTab .nav-link:hover .tab-date {
            color: #ecf0f1 !important;
        }

        #measurementsTab .nav-link.active {
            background: #173042;
            color: white;
            transform: translateY(-1px);
        }

        #measurementsTab .nav-link.active .text-dark {
            color: white !important;
        }

        #measurementsTab .nav-link.active .tab-date {
            color: #ecf0f1 !important;
        }

        /* Enhanced Badge Styles */
        .badge {
            transition: all 0.3s ease;
            border-radius: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge.bg-success {
            background: linear-gradient(96.59deg, #7CAD3E -6.14%, #4A6C2F 91.45%) !important;
            box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
        }

        .badge.bg-warning {
            background: linear-gradient(96.59deg, #FFD500 -6.14%, #FF9500 91.45%) !important;
            box-shadow: 0 2px 8px rgba(243, 156, 18, 0.3);
        }

        /* Pulse animation for "No Data" badges */
        .badge.bg-warning {
            animation: pulse-warning 2s infinite;
        }

        @keyframes pulse-warning {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        /* Enhanced Tab Date Styling */
        .tab-date {
            color: #34495e;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        /* Consultation header improvements */
        .consultation-header {
            font-size: 1.5rem;
        }

        /* Enhanced measurement editing styles */
        .edit-mode-btn {
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            border: none;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            box-shadow: 0 2px 8px rgba(52, 152, 219, 0.3);
        }

        .edit-mode-btn:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }

        .edit-mode-btn.active {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            animation: pulse-success 1.5s infinite;
        }

        @keyframes pulse-success {
            0%, 100% { box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3); }
            50% { box-shadow: 0 4px 16px rgba(39, 174, 96, 0.6); }
        }

        .measurement-section {
            position: relative;
            transition: all 0.3s ease;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .measurement-section.edit-mode {
            background: rgba(52, 152, 219, 0.1);
            border: 2px dashed #3498db;
            transform: scale(1.02);
        }

        .measurement-input {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 2px solid #3498db !important;
            border-radius: 6px !important;
            transition: all 0.3s ease !important;
            font-weight: bold !important;
        }

        .measurement-input:focus {
            border-color: #27ae60 !important;
            box-shadow: 0 0 0 0.2rem rgba(39, 174, 96, 0.25) !important;
        }

        .save-section-btn {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            animation: pulse-save 2s infinite;
        }

        @keyframes pulse-save {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .cancel-edit-btn {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        /* Loading animation for tabs */
        #measurementsTab .nav-link.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        #measurementsTab .nav-link.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #fff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

            .patient-photo {
                transition: transform 0.2s ease-in-out;
                cursor: pointer;
            }

            .patient-photo:hover {
                transform: scale(1.1);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .no-photo-placeholder {
                transition: all 0.2s ease-in-out;
            }

            .no-photo-placeholder:hover {
                background-color: #e9ecef;
                border-color: #7CAD3E;
            }

            /* Image Modal Styles */
            .image-modal .modal-content {
                border-radius: 15px;
                border: none;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }

            .image-modal .modal-header {
                background-color: #7CAD3E;
                color: white;
                border-bottom: none;
                border-radius: 15px 15px 0 0;
            }

            .image-modal .modal-body {
                padding: 0;
                text-align: center;
            }

            .image-modal .modal-body img {
                max-width: 100%;
                height: auto;
                border-radius: 0 0 15px 15px;
            }

            .image-modal .btn-close {
                filter: invert(1) brightness(100);
            }

            .editable-measurement {
                background: white;
                padding: 12px 15px;
                border: 2px solid #e9ecef;
                border-radius: 8px;
                min-height: 20px;
                color: #6c757d;
            }
    </style>

    <div class="bg-marilog">
        <div class="mx-auto px-20 pt-10">
            <!-- Back to Patient List Button -->
            <a href="{{ route('patients.index') }}">
                <button type="button" class="mb-3 border border-white text-white hover:bg-[#1A5D77] hover:text-white transition-colors duration-300 rounded-full px-3 py-1">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i>
                 </button>
             </a>
             
            <div class="cardTop p-4 border-0" style="width: 100%; border-radius: 1rem; height: fit-content">
                <div class="row g-4 h-fit">
                    <!-- Left Section (Profile Image & Basic Info) -->
                    <div class="col-md-3 text-left border-end h-100" style="border-radius: 8px;">
                        <div class="bg-white rounded-2xl p-4 flex items-center space-x-6">
                            <div class="flex-grow-1 d-flex flex-column justify-content-center align-items-center">
                            
                            @if(auth()->user()->role === 'bhw_s3' || auth()->user()->role === 'bhw_s6' || auth()->user()->role === 'doctor' || auth()->user()->role === 'admin')
                                <a href="{{ route('patients.edit', $patient->id) }}"
                                    class="flex items-center justify-center h-10 w-100 mx-auto 
                                            bg-[#1A5D77] hover:bg-[#7CAD3E] text-white 
                                            border-none py-3 rounded-full text-sm 
                                            mt-2 cursor-pointer transition-colors duration-300">

                                    <!-- Icon (left side) -->
                                    <i class="fa-solid fa-user-pen px-2"></i>

                                    Edit Patient Details
                                </a>
                            @endif

                            @if($patient->image_path)
                                <img src="{{ asset($patient->image_path) }}" alt="Patient Photo"
                                    class="patient-photo mt-4"
                                    style="width: 160px; height: 160px; object-fit: cover; border-radius: 50%; border: 6px solid #7CAD3E;"
                                    onclick="viewPatientImage('{{ asset($patient->image_path) }}', '{{ $patient->first_name }} {{ $patient->last_name }}')"
                                    title="Click to view larger image">
                            @else
                                <div class="no-photo-placeholder mt-4"
                                    style="width: 160px; height: 160px; border-radius: 50%; background-color: #f8f9fa; border: 6px dashed #dee2e6; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user text-muted" style="font-size: 64px;"></i>
                                </div>
                            @endif

                                <!-- Patient Name -->
                                <h4 class="d-inline-block py-4 text-center fw-bold text-uppercase">
                                    <span class="text-black text-3xl md:text-2xl font-extrabold uppercase">
                                        <strong>{{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}</strong>
                                    </span>
                                </h4>

                                <div class="flex justify-center gap-3 mb-3">
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                    <div class="w-10 h-10 rounded-full bg-gray-300"></div>
                                </div>

                                <!-- Reference Number -->
                                <h4 class="d-flex justify-content-between align-items-center py-3 border-bottom border-top border-gray w-100">
                                    <span style="color: #696969;">Reference Number:</span>
                                    <span class="text-black">{{ $patient->reference_number ?? 'Not set' }}</span>
                                </h4>

                                <!-- Age -->
                                <h4 class="d-flex justify-content-between align-items-center py-2 pt-3 w-100">
                                    <span style="color: #696969;">Age: </span>
                                    <span class="text-black uppercase">
                                        {{ \Carbon\Carbon::parse($patient->birth_date)->age }}  years old 
                                    </span>
                                </h4>

                                <!-- Sex -->
                                <h4 class="d-flex justify-content-between align-items-center py-2  w-100">
                                    <span style="color: #696969;">Sex: </span>
                                    <span class="text-black uppercase">
                                        {{ $patient->gender }}
                                    </span>
                                </h4>

                                <!-- Marital Status -->
                                <h4 class="d-flex justify-content-between align-items-center py-2 w-100">
                                    <span style="color: #696969;">Status:</span>
                                    <span class="text-black uppercase">
                                        {{ $patient->marital_status }}
                                    </span>
                                </h4>

                                <!-- Religion -->
                                <h4 class="d-flex justify-content-between align-items-center py-2 w-100">
                                    <span style="color: #696969;">Religion:</span>
                                    <span class="text-black uppercase">
                                        {{ $patient->religion }}
                                    </span>
                                </h4>
                                
                                <!-- Occupation -->
                                <h4 class="d-flex justify-content-between align-items-center py-2 pb-3 border-bottom border-gray w-100">
                                    <span style="color: #696969;">Occupation:</span>
                                    <span class="text-black uppercase">
                                        {{ $patient->occupation }}
                                    </span>
                                </h4>

                                <!-- Diabetes Status -->
                                <h4 class="d-flex justify-content-between align-items-center py-2 pt-3 w-100">
                                    <span style="color: #696969;">Diabetes Status:</span>
                                </h4>
                                <button 
                                        type="button" 
                                        class="btn btn-sm text-white text-uppercase fw-extrsabold px-3 mb-1 rounded w-100 h-10"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#diabetesStatusModal"
                                        style="
                                            @if($patient->diabetes_status == 'Not Diabetic') background-color: #668E33;
                                            @elseif($patient->diabetes_status == 'Prediabetes') background-color: #DE7E17;
                                            @elseif($patient->diabetes_status == 'DM Type I') background-color: #25628D; 
                                            @elseif($patient->diabetes_status == 'DM Type II') background-color: #922222; 
                                            @elseif($patient->diabetes_status == 'Gestational DM') background-color: #5D1241; 
                                            @elseif($patient->diabetes_status == 'Other Hyperglycemic States') background-color: #313131; 
                                            @elseif($patient->diabetes_status == 'Pending') background-color: #690B46; 
                                            @endif
                                        "
                                    >
                                        <strong>{{ $patient->diabetes_status }}</strong>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right Section -->
                    <div class="col-md-9 text-left border-end p-0 pr-3">
                        <!-- Top Row: Consultation Tab Navigation -->
                        <div class="col-md-12 px-0">
                            <div class="p-3 bg-light rounded-2xl">
                                <ul class="nav nav-tabs flex-row m-0 p-0" id="measurementsTab" role="tablist">
                                    <li class="nav-item col m-0 p-0" role="presentation">
                                        <button class="nav-link active w-100" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1-content" type="button" role="tab" aria-controls="tab1-content" aria-selected="true" data-consultation-id="{{ $consultation1?->id }}" data-consultation-number="{{ $consultation1?->consultation_number }}">
                                            <div class="d-flex flex-column align-items-center">
                                                <small class="text-dark mb-1">Consultation {{ $consultation1?->consultation_number ?? '1' }}</small>
                                                <span class="tab-date fw-bold"  style="font-size: 1.1rem;">{{ \Carbon\Carbon::parse($tab1Date)->format('F d, Y') }}</span>
                                                @if($consultation1?->hasMeasurementData())
                                                    <span class="badge  bg-success text-white mt-1" style="font-size: 0.6rem;">✓ Has Data</span>
                                                @else
                                                    <span class="badge bg-warning text-black mt-1" style="font-size: 0.6rem;">No Data</span>
                                                @endif
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item col m-0 p-0" role="presentation">
                                        <button class="nav-link w-100" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2-content" type="button" role="tab" aria-controls="tab2-content" aria-selected="false" data-consultation-id="{{ $consultation2?->id }}" data-consultation-number="{{ $consultation2?->consultation_number }}">
                                            <div class="d-flex flex-column align-items-center">
                                                <small class="text-dark mb-1">Consultation {{ $consultation2?->consultation_number ?? '2' }}</small>
                                                <span class="tab-date fw-bold"  style="font-size: 1.1rem;">{{ \Carbon\Carbon::parse($tab2Date)->format('F d, Y') }}</span>
                                                @if($consultation2?->hasMeasurementData())
                                                    <span class="badge bg-success text-white mt-1" style="font-size: 0.6rem;">Has Data</span>
                                                @else
                                                    <span class="badge bg-warning text-black mt-1" style="font-size: 0.6rem;">No Data</span>
                                                @endif
                                            </div>
                                        </button>
                                    </li>
                                    <li class="nav-item col m-0 p-0" role="presentation">
                                        <button class="nav-link w-100" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3-content" type="button" role="tab" aria-controls="tab3-content" aria-selected="false" data-consultation-id="{{ $consultation3?->id }}" data-consultation-number="{{ $consultation3?->consultation_number }}">
                                            <div class="d-flex flex-column align-items-center">
                                                <small class="text-dark mb-1">Consultation {{ $consultation3?->consultation_number ?? '3' }}</small>
                                                <span class="tab-date fw-bold"  style="font-size: 1.1rem;">{{ \Carbon\Carbon::parse($tab3Date)->format('F d, Y') }}</span>
                                                @if($consultation3?->hasMeasurementData())
                                                    <span class="badge bg-success text-white mt-1" style="font-size: 0.6rem;">Has Data</span>
                                                @else
                                                    <span class="badge bg-warning text-black mt-1" style="font-size: 0.6rem;">No Data</span>
                                                @endif
                                            </div>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Bottom Row: Tab Content -->
                        <div class="col-md-12 px-0 mt-3">
                            <div class="p-3 bg-light rounded-2xl">
                                <div class="col-md-12">
                                    @if(auth()->user()->role === 'bhw_s3' || auth()->user()->role === 'bhw_s4' || auth()->user()->role === 'bhw_s5' || auth()->user()->role === 'bhw_s6' || auth()->user()->role === 'doctor' || auth()->user()->role === 'admin')
                                    <div class="tab-content" id="measurementsTabContent">
                                        <div class="tab-pane fade show active" id="tab1-content" role="tabpanel" aria-labelledby="tab1-tab">
                                            
                                            <div class="consultation-header mb-3 mt-2">
                                                <h6 class="text-black mb-1">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    Consultation {{ $consultation1?->consultation_number ?? '1' }} - <strong>{{ \Carbon\Carbon::parse($tab1Date)->format('F d, Y') }}</strong>
                                                </h6>
                                            </div>

                                            <div class="flex">
                                                <x-anthropometric-measurements :tabNumber="1" :consultation="$consultation1" :measurements="$tab1Measurements" :patient="$patient"/>
                                                <x-vital-signs :tabNumber="1" :consultation="$consultation1" :measurements="$tab1Measurements" :patient="$patient"/>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="tab2-content" role="tabpanel" aria-labelledby="tab2-tab">
                                            <div class="consultation-header mb-3 mt-2">
                                                <h6 class="text-black mb-1">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    Consultation {{ $consultation2?->consultation_number ?? '2' }} - <strong>{{ \Carbon\Carbon::parse($tab2Date)->format('F d, Y') }}</strong>
                                                </h6>
                                            </div>
                                            
                                            <div class="flex">
                                                <x-anthropometric-measurements :tabNumber="2" :consultation="$consultation2" :measurements="$tab2Measurements" :patient="$patient"/>
                                                <x-vital-signs :tabNumber="2" :consultation="$consultation2" :measurements="$tab2Measurements" :patient="$patient"/>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="tab3-content" role="tabpanel" aria-labelledby="tab3-tab">
                                            <div class="consultation-header mb-3 mt-2">
                                                <h6 class="text-black mb-1">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    Consultation {{ $consultation3?->consultation_number ?? '3' }} - <strong>{{ \Carbon\Carbon::parse($tab3Date)->format('F d, Y') }}</strong>
                                                </h6>
                                            </div>

                                            <div class="flex">
                                                <x-anthropometric-measurements :tabNumber="3" :consultation="$consultation3" :measurements="$tab3Measurements" :patient="$patient"/>
                                                <x-vital-signs :tabNumber="3" :consultation="$consultation3" :measurements="$tab3Measurements" :patient="$patient"/>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
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

                        @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3' && auth()->user()->role !== 'bhw_s4')
                            <li class="nav-item" role="presentation">
                                <button class="nav-link-bot" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">LD Screening Tools</button>
                            </li>
                            
                            @if(auth()->user()->role !== 'bhw_s5')
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
                                @if(auth()->user()->role !== 'bhw_s6')
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link-bot" id="assessment-tab" data-bs-toggle="tab" data-bs-target="#assessment-tab-pane" type="button" role="tab" aria-controls="assessment-tab-pane" aria-selected="false">Assessment</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link-bot" id="management-tab" data-bs-toggle="tab" data-bs-target="#management-tab-pane" type="button" role="tab" aria-controls="management-tab-pane" aria-selected="false">Management</button>
                                    </li>
                                @endif
                            @endif
                        @endif
                        
                        <li class="nav-item" role="presentation">
                            <button class="nav-link-bot" id="notes-tab" data-bs-toggle="tab" data-bs-target="#notes-tab-pane" type="button" role="tab" aria-controls="notes-tab-pane" aria-selected="false">Notes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            
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

                        @if(auth()->user()->role !== 'bhw_s1' && auth()->user()->role !== 'bhw_s3')
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <br/>
                                @include('patients.screeningtool.screeningtool', ['patient' => $patient])
                            </div>
                            <div class="tab-pane fade" id="review-of-systems-tab-pane" role="tabpanel" aria-labelledby="review-of-systems-tab" tabindex="0">
                                <br/>
                                @include('patients.review_of_systems.review_of_systems', ['patient' => $patient])
                            </div>
                            <div class="tab-pane fade" id="physical-exam-tab-pane" role="tabpanel" aria-labelledby="physical-exam-tab" tabindex="0">
                                <br/>
                                @include('patients.physical_examination.physicalExamination', ['patient' => $patient])
                            </div>
                            <div class="tab-pane fade" id="comprehensive-history-tab-pane" role="tabpanel" aria-labelledby="comprehensive-history-tab" tabindex="0">
                                <br/>
                                @include('patients.comprehensive_history.comprehensive_history', ['patient' => $patient])
                            </div>
                            @if(auth()->user()->role !== 'bhw_s6')
                                <div class="tab-pane fade" id="assessment-tab-pane" role="tabpanel" aria-labelledby="assessment-tab" tabindex="0">
                                    <br/>
                                    @include('patients.screeningtool.forms.assessment_form', ['patient' => $patient])
                                </div>
                                <div class="tab-pane fade" id="management-tab-pane" role="tabpanel" aria-labelledby="management-tab" tabindex="0">
                                    <br/>
                                    @include('patients.management.management', ['patient' => $patient])
                                </div>
                            @endif
                            <div class="tab-pane fade" id="other-lm-vs-tab-pane" role="tabpanel" aria-labelledby="other-lm-vs-tab" tabindex="0">
                                <br/>
                                @include('patients.otherlmandvs.lifestyle_measures', ['patient' => $patient])
                            </div>
                        @endif
                        
                        <div class="tab-pane fade" id="notes-tab-pane" role="tabpanel" aria-labelledby="notes-tab" tabindex="0">
                            <br/>
                            @include('patients.notes.notes', ['patient' => $patient])
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
                                <button type="button" id="saveMealPlanBtn" class="btn btn-success">Save Meal Plan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Add Diabetes Status Modal -->
    <div class="modal fade" id="diabetesStatusModal" tabindex="-1" aria-labelledby="diabetesStatusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="diabetesStatusModalLabel">Edit Diabetes Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="diabetesStatusForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        <div class="mb-3">
                            <label for="diabetes_status" class="form-label">Diabetes Status</label>
                            <select class="form-control" id="diabetes_status" name="diabetes_status" required>
                                <option value="Not Diabetic" {{ $patient->diabetes_status == 'Not Diabetic' ? 'selected' : '' }}>Not Diabetic</option>
                                <option value="Prediabetes" {{ $patient->diabetes_status == 'Prediabetes' ? 'selected' : '' }}>Prediabetes</option>
                                <option value="DM Type I" {{ $patient->diabetes_status == 'DM Type I' ? 'selected' : '' }}>DM Type I</option>
                                <option value="DM Type II" {{ $patient->diabetes_status == 'DM Type II' ? 'selected' : '' }}>DM Type II</option>
                                <option value="Gestational DM" {{ $patient->diabetes_status == 'Gestational DM' ? 'selected' : '' }}>Gestational DM</option>
                                <option value="Other Hyperglycemic States" {{ $patient->diabetes_status == 'Other Hyperglycemic States' ? 'selected' : '' }}>Other Hyperglycemic States</option>
                                <option value="Pending" {{ $patient->diabetes_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Diabetes Status</button>
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

    <!-- Image View Modal -->
    <div class="modal fade image-modal" id="imageViewModal" tabindex="-1" aria-labelledby="imageViewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageViewModalLabel">Patient Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalPatientImage" src="" alt="Patient Photo">
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Enhanced edit mode functionality
        $('.edit-mode-btn').on('click', function() {
            const $btn = $(this);
            const section = $btn.data('section');
            const tab = $btn.data('tab');
            const $sectionDiv = $btn.closest('.measurement-section');
            const isEditMode = $btn.hasClass('active');

            if (!isEditMode) {
                // Enter edit mode
                $btn.addClass('active')
                    .html('<i class="fas fa-save me-1"></i>Save Changes');

                $sectionDiv.addClass('edit-mode');

                // Convert measurements to inputs
                $sectionDiv.find('.editable-measurement').each(function() {
                    const $measurement = $(this);
                    const currentValue = $measurement.text().trim();
                    const field = $measurement.data('field');

                    // Always create input, even for N/A values
                    const cleanValue = currentValue === 'N/A' ? '' : currentValue.replace(/[^\d.-]/g, '');
                    const inputType = (field === 'blood_pressure') ? 'text' : 'number';
                    const $input = $('<input>', {
                        type: inputType,
                        step: field === 'height' ? '0.01' : '1',
                        value: cleanValue,
                        placeholder: currentValue === 'N/A' ? 'Enter value' : '',
                        class: 'form-control measurement-input',
                        'data-field': field,
                        'data-original': currentValue
                    });

                    $measurement.html($input);

                    // Auto-focus first input
                    if ($sectionDiv.find('.measurement-input').length === 1) {
                        $input.focus().select();
                    }
                });

                // Add save/cancel buttons
                const $buttonContainer = $('<div class="text-end mt-3"></div>');
                const $saveBtn = $('<button class="save-section-btn"><i class="fas fa-check me-1"></i>Save Section</button>');
                const $cancelBtn = $('<button class="cancel-edit-btn"><i class="fas fa-times me-1"></i>Cancel</button>');

                $buttonContainer.append($saveBtn, $cancelBtn);
                $sectionDiv.append($buttonContainer);

                // Handle save section
                $saveBtn.on('click', function() {
                    saveSection($sectionDiv, $btn, section, tab);
                });

                // Handle cancel
                $cancelBtn.on('click', function() {
                    cancelEdit($sectionDiv, $btn);
                });

                // Handle Enter key to save
                $sectionDiv.find('.measurement-input').on('keypress', function(e) {
                    if (e.which === 13) {
                        saveSection($sectionDiv, $btn, section, tab);
                    }
                });

            } else {
                // Save and exit edit mode
                saveSection($sectionDiv, $btn, section, tab);
            }
        });

        function saveSection($sectionDiv, $btn, section, tab) {
            const $inputs = $sectionDiv.find('.measurement-input');
            const changes = {};
            let hasChanges = false;

            // Collect changes
            $inputs.each(function() {
                const $input = $(this);
                const field = $input.data('field');
                const newValue = $input.val().trim();
                const originalValue = $input.data('original');

                // Consider any non-empty value as a change from N/A, or actual value changes
                if (newValue !== originalValue && (originalValue === 'N/A' || newValue !== '')) {
                    changes[field] = newValue;
                    hasChanges = true;
                }
            });

            if (hasChanges) {
                // Show saving animation
                $btn.html('<i class="fas fa-spinner fa-spin me-1"></i>Saving...')
                    .prop('disabled', true);

                // Get consultation ID from the first measurement in the section
                const consultationId = $inputs.first().closest('.editable-measurement').data('consultation-id');

                // Create array of promises for each field update
                const savePromises = [];

                Object.keys(changes).forEach(fieldName => {
                    const fieldValue = changes[fieldName];

                    const promise = $.ajax({
                        url: "{{ route('patients.update-measurement', $patient->id) }}",
                        method: "POST",
                        data: {
                            tab_number: tab,
                            field_name: fieldName,
                            field_value: fieldValue,
                            consultation_id: consultationId,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    savePromises.push(promise);
                });

                // Wait for all saves to complete
                Promise.all(savePromises)
                    .then(responses => {
                        // Update display values
                        $inputs.each(function() {
                            const $input = $(this);
                            const $measurement = $input.closest('.editable-measurement');
                            const newValue = $input.val().trim();
                            const displayValue = newValue === '' ? 'N/A' : newValue;

                            $measurement.html(displayValue).css({
                                'background: white';
                                'padding: 12px 15px';
                                'border: 2px solid #e9ecef';
                                'border-radius: 8px';
                                'min-height: 20px';
                                'color: #6c757d';
                            });

                            // Flash effect
                            setTimeout(() => {
                                $measurement.css({
                                    'background': 'transparent',
                                    'padding': '0'
                                });
                            }, 2000);
                        });

                        // Update measurement status badge
                        const tabButton = $(`#tab${tab}-tab`);
                        const statusBadge = tabButton.find('.badge');
                        statusBadge.removeClass('bg-warning').addClass('bg-success').text('Has Data');

                        // Auto-update BMI if height or weight were changed
                        const changedFields = Object.keys(changes);
                        if (changedFields.includes('height') || changedFields.includes('weight_kg')) {
                            updateBMI(tab);
                        }

                        exitEditMode($sectionDiv, $btn);

                        // Show success message
                        showNotification('✅ Section saved successfully!', 'success');
                    })
                    .catch(xhr => {
                        console.error('Save error:', xhr);

                        $btn.html('<i class="fas fa-edit me-1"></i>Edit Mode')
                            .removeClass('active')
                            .prop('disabled', false);

                        let errorMessage = 'Error saving measurements';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            errorMessage = xhr.responseText;
                        }

                        showNotification('❌ ' + errorMessage, 'error');
                        alert('Error saving: ' + errorMessage);
                    });
            } else {
                exitEditMode($sectionDiv, $btn);
            }
        }

        function cancelEdit($sectionDiv, $btn) {
            $sectionDiv.find('.measurement-input').each(function() {
                const $input = $(this);
                const $measurement = $input.closest('.editable-measurement');
                const originalValue = $input.data('original');

                $measurement.html(originalValue);
            });

            exitEditMode($sectionDiv, $btn);
            showNotification('❌ Changes cancelled', 'info');
        }

        function exitEditMode($sectionDiv, $btn) {
            $btn.removeClass('active')
                .html('<i class="fas fa-edit me-1"></i>Edit Mode')
                .prop('disabled', false);

            $sectionDiv.removeClass('edit-mode');
            $sectionDiv.find('.text-end').remove();
        }

        function showNotification(message, type) {
            const alertType = type === 'success' ? 'success' : type === 'error' ? 'danger' : 'info';
            const $notification = $('<div class="alert alert-' + alertType + ' position-fixed" style="top: 20px; right: 20px; z-index: 9999; max-width: 300px;">' + message + '</div>');

            $('body').append($notification);

            setTimeout(() => {
                $notification.fadeOut(() => $notification.remove());
            }, 3000);
        }

        // Enhanced tab switching with loading animation
        $('#measurementsTab .nav-link').on('click', function() {
            const $this = $(this);

            // Add loading state
            $this.addClass('loading');

            // Remove loading after animation
            setTimeout(() => {
                $this.removeClass('loading');
            }, 300);
        });

        // Add click sound effect (optional)
        $('#measurementsTab .nav-link').on('click', function() {
            // Create a subtle click sound using Web Audio API
            try {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();

                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);

                oscillator.frequency.setValueAtTime(800, audioContext.currentTime);
                oscillator.frequency.exponentialRampToValueAtTime(400, audioContext.currentTime + 0.1);

                gainNode.gain.setValueAtTime(0.1, audioContext.currentTime);
                gainNode.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + 0.1);

                oscillator.start(audioContext.currentTime);
                oscillator.stop(audioContext.currentTime + 0.1);
            } catch (e) {
                // Silently fail if Web Audio API is not supported
            }
        });

        // Add smooth scroll to tab content
        $('#measurementsTab .nav-link').on('shown.bs.tab', function() {
            $('html, body').animate({
                scrollTop: $('#measurementsTabContent').offset().top - 100
            }, 500);
        });

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

        // Diabetes Status form submission
        $('#diabetesStatusForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('patients.update-diabetes-status', $patient->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#diabetesStatusModal').modal('hide');
                    // Update the diabetes status display
                    $('.text-center').last().text(response.diabetes_status);
                    alert('Diabetes Status updated successfully!');
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

        // Save date changes
        $('#saveDateBtn').click(function() {
            const tabNum = $('#currentTab').val();
            const oldDate = $('#currentTab').attr('data-original-date');
            const newDate = $('#tabDate').val();

            if (oldDate === newDate) {
                $('#dateEditModal').modal('hide');
                return;
            }

            const formData = {
                tab_number: tabNum,
                old_date: oldDate,
                new_date: newDate,
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            $.ajax({
                url: "{{ route('patients.update-measurement-date', $patient->id) }}",
                method: "POST",
                data: formData,
                success: function(response) {
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

    $("#saveMealPlanBtn").click(function () {
        let formData = {
            patient_id: $("#patient_id").val(),
            meal_type: $("#meal_type").val(),
            protein: $("#protein").val(),
            fat: $("#fat").val(),
            carbohydrates: $("#carbohydrates").val(),
            date: $("#mealPlanDate").val(),
            _token: $('meta[name="csrf-token"]').attr("content") // required for 419 fix
        };

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });


        $.ajax({
            url: "/save-meal-plan",   // ✅ matches your route
            type: "POST",
            data: formData,
            success: function (response) {
                alert("Meal Plan Saved Successfully!");
                $("#addMealPlanModal").modal("hide");
                $("#addMealPlanForm")[0].reset();
            },
            error: function (xhr) {
                console.error("Error:", xhr.responseText);
                alert("Failed to save meal plan.");
            }
        });
    });

    // Function to view patient image in modal
    function viewPatientImage(imagePath, patientName) {
            // Set the modal title with patient name
            document.getElementById('imageViewModalLabel').textContent = `Photo of ${patientName}`;

            // Set the image source
            document.getElementById('modalPatientImage').src = imagePath;

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('imageViewModal'));
            modal.show();
        }   
    </script>

</x-app-layout>
