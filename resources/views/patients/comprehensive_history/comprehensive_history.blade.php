<div class="container-fluid">
    <style>
        /* Custom Accordion Styling */
        .accordion-header {
            cursor: pointer;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 1rem;
            margin-bottom: 0;
            font-weight: 600;
            color: #333;
            text-decoration: none;
            user-select: none;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .accordion-header::after {
            content: '+';
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.2em;
            font-weight: bold;
            transition: transform 0.3s ease;
        }
        
        .accordion-header.active::after {
            content: '−';
            transform: translateY(-50%) rotate(180deg);
        }
        
        .accordion-header:hover {
            background-color: #e9ecef;
        }
        
        .accordion-header.active {
            background-color: #7CAD3E;
            color: white;
            box-shadow: 0 2px 4px rgba(124, 173, 62, 0.2);
        }
        
        .accordion-content {
            padding: 1.5rem;
            border: 1px solid #dee2e6;
            border-top: none;
            background: white;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        /* Card styling */
        .card {
            border: none;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }
        
        /* Sticky navigation styles */
        .sticky-nav {
            position: sticky;
            top: 20px;
            z-index: 1000;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-height: calc(100vh - 40px);
            overflow-y: auto;
        }
        
        .form-content-area {
            position: relative;
            z-index: 1;
            background: white;
        }
        
        .nav-link {
            color: #666;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 4px;
            transition: all 0.3s ease;
            font-size: 14px;
        }
        
        .nav-link:hover, .nav-link.active {
            background-color: #7CAD3E;
            color: white;
            text-decoration: none;
        }
        
        .nav-link.completed {
            background-color: #28a745;
            color: white;
        }
        
        .progress-indicator {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .progress-indicator.completed {
            background-color: #28a745;
            color: white;
        }
        
        .progress-indicator.active {
            background-color: #7CAD3E;
            color: white;
        }
    </style>
    
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center" style="background-color: #7CAD3E;">
            <h6 class="m-0 font-weight-bold text-white">Comprehensive History</h6>
            <button class="btn btn-light" type="button" id="saveComprehensiveHistoryBtn">Save</button>
        </div>
        <div class="p-3">
            <div class="row">
                <!-- Sticky Navigation -->
                <div class="col-md-3">
                    <nav class="sticky-nav p-3">
                        <h6 class="mb-3 text-muted">Sections</h6>
                        <div class="nav flex-column">
                            <a href="#section-informant" class="nav-link" data-section="informant">
                                <span class="progress-indicator" id="indicator-informant">1</span>
                                Informant
                            </a>
                            <a href="#section-chief-concern" class="nav-link" data-section="chief-concern">
                                <span class="progress-indicator" id="indicator-chief-concern">2</span>
                                Chief Concern
                            </a>
                            <a href="#section-past-medical" class="nav-link" data-section="past-medical">
                                <span class="progress-indicator" id="indicator-past-medical">3</span>
                                Past Medical History
                            </a>
                            <a href="#section-family-history" class="nav-link" data-section="family-history">
                                <span class="progress-indicator" id="indicator-family-history">4</span>
                                Family History
                            </a>
                            <a href="#section-allergies" class="nav-link" data-section="allergies">
                                <span class="progress-indicator" id="indicator-allergies">5</span>
                                Allergies
                            </a>
                            <a href="#section-medications" class="nav-link" data-section="medications">
                                <span class="progress-indicator" id="indicator-medications">6</span>
                                Medications
                            </a>
                            <a href="#section-hospitalization" class="nav-link" data-section="hospitalization">
                                <span class="progress-indicator" id="indicator-hospitalization">7</span>
                                Hospitalization
                            </a>
                            <a href="#section-surgical" class="nav-link" data-section="surgical">
                                <span class="progress-indicator" id="indicator-surgical">8</span>
                                Surgical History
                            </a>
                            <a href="#section-health-maintenance" class="nav-link" data-section="health-maintenance">
                                <span class="progress-indicator" id="indicator-health-maintenance">9</span>
                                Health Maintenance
                            </a>
                            <a href="#section-obgyn" class="nav-link" data-section="obgyn">
                                <span class="progress-indicator" id="indicator-obgyn">10</span>
                                OBGYN History
                            </a>
                            <a href="#section-psychiatric" class="nav-link" data-section="psychiatric">
                                <span class="progress-indicator" id="indicator-psychiatric">11</span>
                                Psychiatric Illness
                            </a>
                            <a href="#section-personal-social" class="nav-link" data-section="personal-social">
                                <span class="progress-indicator" id="indicator-personal-social">12</span>
                                Personal-Social History
                            </a>
                            <a href="#section-alternative" class="nav-link" data-section="alternative">
                                <span class="progress-indicator" id="indicator-alternative">13</span>
                                Alternative Therapies
                            </a>
                            <a href="#section-other-social" class="nav-link" data-section="other-social">
                                <span class="progress-indicator" id="indicator-other-social">14</span>
                                Other Social History
                            </a>
                        </div>
                    </nav>
                </div>
                
                <!-- Form Content -->
                <div class="col-md-9 form-content-area">
                    <form id="comprehensiveHistoryForm">
                        @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                        <!-- Custom Accordion -->
                        <div id="comprehensiveHistoryAccordion">
                            
                            <!-- Informant Section -->
                            <div class="card mb-2" id="section-informant">
                                <div class="accordion-header" data-section="informant">
                                    <span class="progress-indicator me-2" id="header-indicator-informant">1</span>
                                    Informant
                                </div>
                                <div id="content-informant" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.informant_section')
                                </div>
                            </div>

                            <!-- Chief Concern Section -->
                            <div class="card mb-2" id="section-chief-concern">
                                <div class="accordion-header" data-section="chief-concern">
                                    <span class="progress-indicator me-2" id="header-indicator-chief-concern">2</span>
                                    Chief Concern
                                </div>
                                <div id="content-chief-concern" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.chief_concern_section')
                                </div>
                            </div>

                            <!-- Past Medical History Section -->
                            <div class="card mb-2" id="section-past-medical">
                                <div class="accordion-header" data-section="past-medical">
                                    <span class="progress-indicator me-2" id="header-indicator-past-medical">3</span>
                                    Past Medical History
                                </div>
                                <div id="content-past-medical" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.past_medical_history_section')
                                </div>
                            </div>

                            <!-- Family History Section -->
                            <div class="card mb-2" id="section-family-history">
                                <div class="accordion-header" data-section="family-history">
                                    <span class="progress-indicator me-2" id="header-indicator-family-history">4</span>
                                    Family History
                                </div>
                                <div id="content-family-history" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.family_history_section')
                                </div>
                            </div>

                            <!-- Allergies Section -->
                            <div class="card mb-2" id="section-allergies">
                                <div class="accordion-header" data-section="allergies">
                                    <span class="progress-indicator me-2" id="header-indicator-allergies">5</span>
                                    Allergies
                                </div>
                                <div id="content-allergies" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.allergies_section')
                                </div>
                            </div>

                            <!-- Medications Section -->
                            <div class="card mb-2" id="section-medications">
                                <div class="accordion-header" data-section="medications">
                                    <span class="progress-indicator me-2" id="header-indicator-medications">6</span>
                                    Previous and Current Medications
                                </div>
                                <div id="content-medications" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.medications_section')
                                </div>
                            </div>

                            <!-- Hospitalization Section -->
                            <div class="card mb-2" id="section-hospitalization">
                                <div class="accordion-header" data-section="hospitalization">
                                    <span class="progress-indicator me-2" id="header-indicator-hospitalization">7</span>
                                    Previous Hospitalization
                                </div>
                                <div id="content-hospitalization" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.hospitalization_section')
                                </div>
                            </div>

                            <!-- Surgical History Section -->
                            <div class="card mb-2" id="section-surgical">
                                <div class="accordion-header" data-section="surgical">
                                    <span class="progress-indicator me-2" id="header-indicator-surgical">8</span>
                                    Surgical History
                                </div>
                                <div id="content-surgical" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.surgical_history_section')
                                </div>
                            </div>

                            <!-- Health Maintenance Section -->
                            <div class="card mb-2" id="section-health-maintenance">
                                <div class="accordion-header" data-section="health-maintenance">
                                    <span class="progress-indicator me-2" id="header-indicator-health-maintenance">9</span>
                                    Health Maintenance
                                </div>
                                <div id="content-health-maintenance" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.health_maintenance_section')
                                </div>
                            </div>

                            <!-- OBGYN History Section -->
                            <div class="card mb-2" id="section-obgyn">
                                <div class="accordion-header" data-section="obgyn">
                                    <span class="progress-indicator me-2" id="header-indicator-obgyn">10</span>
                                    OBGYN History
                                </div>
                                <div id="content-obgyn" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.obgyn_history_section')
                                </div>
                            </div>

                            <!-- Psychiatric Illness Section -->
                            <div class="card mb-2" id="section-psychiatric">
                                <div class="accordion-header" data-section="psychiatric">
                                    <span class="progress-indicator me-2" id="header-indicator-psychiatric">11</span>
                                    Psychiatric Illness
                                </div>
                                <div id="content-psychiatric" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.psychiatric_illness_section')
                                </div>
                            </div>

                            <!-- Personal-Social History Section -->
                            <div class="card mb-2" id="section-personal-social">
                                <div class="accordion-header" data-section="personal-social">
                                    <span class="progress-indicator me-2" id="header-indicator-personal-social">12</span>
                                    Personal-Social History
                                </div>
                                <div id="content-personal-social" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.personal_social_history_section')
                                </div>
                            </div>

                            <!-- Alternative Therapies Section -->
                            <div class="card mb-2" id="section-alternative">
                                <div class="accordion-header" data-section="alternative">
                                    <span class="progress-indicator me-2" id="header-indicator-alternative">13</span>
                                    Alternative Therapies
                                </div>
                                <div id="content-alternative" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.alternative_therapies_section')
                                </div>
                            </div>

                            <!-- Other Social History Section -->
                            <div class="card mb-2" id="section-other-social">
                                <div class="accordion-header" data-section="other-social">
                                    <span class="progress-indicator me-2" id="header-indicator-other-social">14</span>
                                    Other Social History
                                </div>
                                <div id="content-other-social" class="accordion-content" style="display: none;">
                                    @include('patients.comprehensive_history.components.other_social_history_section')
                                </div>
                            </div>

                        </div> <!-- End Accordion -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Custom accordion implementation with slideUp/slideDown
    $('.accordion-header').on('click', function() {
        const $header = $(this);
        const section = $header.data('section');
        const $content = $header.next('.accordion-content');
        const isCurrentlyActive = $header.hasClass('active');
        
        // Close all other sections first
        $('.accordion-header').removeClass('active');
        $('.accordion-content').slideUp(300);
        
        if (!isCurrentlyActive) {
            // Open this section
            $header.addClass('active');
            $content.slideDown(300);
            
            // Update navigation
            $('.nav-link').removeClass('active');
            $(`.nav-link[data-section="${section}"]`).addClass('active');
            updateProgressIndicator(section, 'active');
            
        } else {
            // If it was active, just close it (already done above)
            
            // Update progress indicator for closed section
            if (isSectionCompleted(section)) {
                updateProgressIndicator(section, 'completed');
            } else {
                updateProgressIndicator(section, 'default');
            }
        }
    });
    
    // Navigation click handler
    $('.nav-link[data-section]').on('click', function(e) {
        e.preventDefault();
        const section = $(this).data('section');
        const $targetHeader = $(`.accordion-header[data-section="${section}"]`);
        
        if ($targetHeader.length) {
            $targetHeader.click(); // Trigger custom accordion
        }
    });
    
    // Load comprehensive history data when the tab is clicked
    $('#comprehensive-history-tab').on('click', function() {
        loadComprehensiveHistoryData();
    });

    // Also load data if the comprehensive history tab is already active on page load
    if ($('#comprehensive-history-tab').hasClass('active') || $('#comprehensive-history-tab-pane').hasClass('active')) {
        loadComprehensiveHistoryData();
    }
    
    // Check if a section has any filled content
    function isSectionCompleted(sectionId) {
        const section = $(`#section-${sectionId}`);
        let hasContent = false;
        
        section.find('input, select, textarea').each(function() {
            const $el = $(this);
            if ($el.attr('type') === 'checkbox' || $el.attr('type') === 'radio') {
                if ($el.is(':checked')) {
                    hasContent = true;
                    return false;
                }
            } else if ($el.val() && $el.val().trim() !== '') {
                hasContent = true;
                return false;
            }
        });
        
        return hasContent;
    }
    
    // Update progress indicator
    function updateProgressIndicator(sectionId, status) {
        const indicator = $(`#indicator-${sectionId}`);
        const btnIndicator = $(`#btn-indicator-${sectionId}`);
        const headerIndicator = $(`#header-indicator-${sectionId}`);
        const navLink = $(`.nav-link[data-section="${sectionId}"]`);
        
        // Update all indicators (navigation, button, and header)
        [indicator, btnIndicator, headerIndicator].forEach($ind => {
            if ($ind.length) {
                $ind.removeClass('completed active');
            }
        });
        navLink.removeClass('completed');
        
        if (status === 'completed') {
            [indicator, btnIndicator, headerIndicator].forEach($ind => {
                if ($ind.length) {
                    $ind.addClass('completed').html('✓');
                }
            });
            navLink.addClass('completed');
        } else if (status === 'active') {
            [indicator, btnIndicator, headerIndicator].forEach($ind => {
                if ($ind.length) {
                    $ind.addClass('active');
                }
            });
        } else {
            // Reset to number
            const number = navLink.index() + 1;
            [indicator, btnIndicator, headerIndicator].forEach($ind => {
                if ($ind.length) {
                    $ind.html(number);
                }
            });
        }
    }

    // Function to load comprehensive history data
    function loadComprehensiveHistoryData() {
        var patientId = $('input[name="patient_id"]').val();
        
        $.ajax({
            url: '/patients/' + patientId + '/comprehensive-history/data',
            type: 'GET',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response) {
                    populateFormWithData(response);
                    // Update progress indicators after loading data
                    updateAllProgressIndicators();
                }
            },
            error: function(xhr) {
                // Handle error silently or show user-friendly message
            }
        });
    }
    
    // Update all progress indicators based on current form state
    function updateAllProgressIndicators() {
        $('.nav-link[data-section]').each(function() {
            const sectionId = $(this).data('section');
            if (isSectionCompleted(sectionId)) {
                updateProgressIndicator(sectionId, 'completed');
            }
        });
    }

    // Function to populate form with loaded data
    function populateFormWithData(data) {
        // Handle arrays
        if (data.informant) {
            data.informant.forEach(function(value) {
                $(`input[name="informant[]"][value="${value}"]`).prop('checked', true);
            });
        }

        if (data.childhood_illness) {
            Object.keys(data.childhood_illness).forEach(function(illness) {
                $(`#${illness}`).prop('checked', true);
                $(`#${illness}-details`).show();
                if (data.childhood_illness[illness].year) {
                    $(`input[name="${illness}_year"]`).val(data.childhood_illness[illness].year);
                }
                if (data.childhood_illness[illness].complications) {
                    $(`input[name="${illness}_complications"]`).val(data.childhood_illness[illness].complications);
                }
            });
        }

        if (data.adult_illness) {
            data.adult_illness.forEach(function(illness) {
                $(`#${illness}`).prop('checked', true);
                $(`#${illness}-details`).show();
            });
        }

        if (data.family_illness) {
            data.family_illness.forEach(function(illness) {
                $(`#family_${illness}`).prop('checked', true);
                $(`#family_${illness}-details`).show();
            });
        }

        if (data.other_conditions) {
            data.other_conditions.forEach(function(condition) {
                $(`input[name="other_conditions[]"][value="${condition}"]`).prop('checked', true);
            });
        }

        if (data.family_other_conditions) {
            data.family_other_conditions.forEach(function(condition) {
                $(`input[name="family_other_conditions[]"][value="${condition}"]`).prop('checked', true);
            });
        }

        if (data.menstrual_symptoms) {
            data.menstrual_symptoms.forEach(function(symptom) {
                $(`input[name="menstrual_symptoms[]"][value="${symptom}"]`).prop('checked', true);
            });
        }

        if (data.contraceptive_methods) {
            data.contraceptive_methods.forEach(function(method) {
                $(`input[name="contraceptive_methods[]"][value="${method}"]`).prop('checked', true);
            });
        }

        // Load contraceptive detail fields - ensure they're loaded
        if (data.contraceptive_pills_details) {
            $('#contraceptive_pills_details').val(data.contraceptive_pills_details);
            // Ensure the container is visible if there's data
            if (data.contraceptive_pills_details.trim() !== '') {
                $('#pills_details').show();
            }
        }
        if (data.contraceptive_depo_details) {
            $('#contraceptive_depo_details').val(data.contraceptive_depo_details);
            // Ensure the container is visible if there's data
            if (data.contraceptive_depo_details.trim() !== '') {
                $('#depo_details').show();
            }
        }
        if (data.contraceptive_implant_details) {
            $('#contraceptive_implant_details').val(data.contraceptive_implant_details);
            // Ensure the container is visible if there's data
            if (data.contraceptive_implant_details.trim() !== '') {
                $('#implant_details').show();
            }
        }

        // Initialize contraceptive method toggles after both checkboxes and values are set
        if (typeof window.initializeContraceptiveToggles === 'function') {
            setTimeout(function() {
                window.initializeContraceptiveToggles();
            }, 50); // Small delay to ensure DOM is updated
        }

        if (data.psychiatric_illness) {
            data.psychiatric_illness.forEach(function(illness) {
                $(`input[name="psychiatric_illness[]"][value="${illness}"]`).prop('checked', true);
            });
        }

        if (data.alternative_therapies) {
            data.alternative_therapies.forEach(function(therapy) {
                $(`input[name="alternative_therapies[]"][value="${therapy}"]`).prop('checked', true);
            });
        }

        // Handle boolean fields and show/hide details
        if (data.cigarette_user) {
            $('#cigarette_user').prop('checked', true);
            $('#cigarette-details').show();
        }
        if (data.alcohol_drinker) {
            $('#alcohol_drinker').prop('checked', true);
            $('#alcohol-details').show();
        }
        if (data.drug_user) {
            $('#drug_user').prop('checked', true);
            $('#drug-details').show();
        }
        if (data.coffee_user) {
            $('#coffee_user').prop('checked', true);
            $('#coffee-details').show();
        }

        // Handle hospitalization data
        if (data.hospitalization && data.hospitalization.length > 0) {
            $('#hospitalizationTable tbody').empty(); // Clear existing rows
            data.hospitalization.forEach(function(hospital) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="hospitalization_year[]" value="${hospital.year || ''}"></td>
                        <td><input type="text" class="form-control" name="hospitalization_diagnosis[]" value="${hospital.diagnosis || ''}"></td>
                        <td><input type="text" class="form-control" name="hospitalization_notes[]" value="${hospital.notes || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#hospitalizationTable tbody').append(newRow);
            });
        }

        // Handle surgical history data
        if (data.surgical_history && data.surgical_history.length > 0) {
            $('#surgicalTable tbody').empty(); // Clear existing rows
            data.surgical_history.forEach(function(surgery) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="surgical_year[]" value="${surgery.year || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_diagnosis[]" value="${surgery.diagnosis || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_procedure[]" value="${surgery.procedure || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_biopsy[]" value="${surgery.biopsy || ''}"></td>
                        <td><input type="text" class="form-control" name="surgical_notes[]" value="${surgery.notes || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#surgicalTable tbody').append(newRow);
            });
        }

        // Handle past pregnancy data
        if (data.past_pregnancy && data.past_pregnancy.length > 0) {
            $('#pastPregnancyTable tbody').empty(); // Clear existing rows
            data.past_pregnancy.forEach(function(pregnancy) {
                let newRow = `
                    <tr>
                        <td><input type="text" class="form-control" name="pregnancy_number[]" value="${pregnancy.number || ''}"></td>
                        <td>
                            <select class="form-control" name="pregnancy_sex[]">
                                <option value="">Select</option>
                                <option value="male" ${pregnancy.sex === 'male' ? 'selected' : ''}>Male</option>
                                <option value="female" ${pregnancy.sex === 'female' ? 'selected' : ''}>Female</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control" name="pregnancy_delivery[]">
                                <option value="">Select</option>
                                <option value="nsd" ${pregnancy.delivery === 'nsd' ? 'selected' : ''}>Normal Spontaneous Delivery</option>
                                <option value="cs" ${pregnancy.delivery === 'cs' ? 'selected' : ''}>Cesarean Section</option>
                                <option value="vacuum" ${pregnancy.delivery === 'vacuum' ? 'selected' : ''}>Vacuum Extraction</option>
                                <option value="forceps" ${pregnancy.delivery === 'forceps' ? 'selected' : ''}>Forceps Delivery</option>
                                <option value="breech" ${pregnancy.delivery === 'breech' ? 'selected' : ''}>Breech Delivery</option>
                                <option value="other" ${pregnancy.delivery === 'other' ? 'selected' : ''}>Other</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="pregnancy_complications[]" value="${pregnancy.complications || ''}"></td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm remove-row">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#pastPregnancyTable tbody').append(newRow);
            });
        }

        // Handle simple text fields
        Object.keys(data).forEach(function(key) {
            if (!['informant', 'childhood_illness', 'adult_illness', 'family_illness', 'other_conditions',
                  'family_other_conditions', 'menstrual_symptoms', 'contraceptive_methods',
                  'contraceptive_pills_details', 'contraceptive_depo_details', 'contraceptive_implant_details',
                  'psychiatric_illness', 'alternative_therapies', 'cigarette_user', 'alcohol_drinker',
                  'drug_user', 'coffee_user', 'hospitalization', 'surgical_history', 'past_pregnancy',
                  'id', 'patient_id', 'created_at', 'updated_at'].includes(key)) {

                var element = $(`[name="${key}"]`);
                if (element.length > 0) {
                    if (element.is(':checkbox')) {
                        element.prop('checked', data[key]);
                    } else {
                        element.val(data[key]);
                    }
                }
            }
        });

        // Handle complex nested data for adult illnesses
        ['hypertension', 'diabetes', 'bronchial_asthma'].forEach(function(illness) {
            Object.keys(data).forEach(function(key) {
                if (key.startsWith(illness + '_') && key !== illness + '_user') {
                    $(`[name="${key}"]`).val(data[key]);
                }
            });
        });

        // Handle family illness nested data
        ['hypertension', 'diabetes', 'asthma', 'cancer'].forEach(function(illness) {
            Object.keys(data).forEach(function(key) {
                if (key.includes('_family_') || key.includes('_relation') || key.includes('_side')) {
                    $(`[name="${key}"]`).val(data[key]);
                }
            });
        });
    }

    // Initially hide all illness details
    $('.illness-details').hide();
    $('.family-illness-details').hide();
    $('#cigarette-details').hide();
    $('#alcohol-details').hide();
    $('#drug-details').hide();
    $('#coffee-details').hide();

    // Show/hide illness details when checkboxes are clicked
    $('.childhood-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    $('.adult-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    $('.family-illness').on('change', function() {
        var detailsId = $(this).attr('id') + '-details';
        if($(this).is(':checked')) {
            $('#' + detailsId).show();
        } else {
            $('#' + detailsId).hide();
        }
    });

    // Show/hide habits details
    $('#cigarette_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#cigarette-details').show();
        } else {
            $('#cigarette-details').hide();
        }
    });

    $('#alcohol_drinker').on('change', function() {
        if($(this).is(':checked')) {
            $('#alcohol-details').show();
        } else {
            $('#alcohol-details').hide();
        }
    });

    $('#drug_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#drug-details').show();
        } else {
            $('#drug-details').hide();
        }
    });

    $('#coffee_user').on('change', function() {
        if($(this).is(':checked')) {
            $('#coffee-details').show();
        } else {
            $('#coffee-details').hide();
        }
    });

    // Calculate smoking pack years
    $('#sticks_per_day, #cigarette_year_started, #cigarette_year_discontinued, #current_smoker').on('change', function() {
        calculatePackYears();
    });

    function calculatePackYears() {
        let sticksPerDay = parseFloat($('#sticks_per_day').val()) || 0;
        let yearStarted = parseInt($('input[name="cigarette_year_started"]').val());
        let yearDiscontinued = parseInt($('input[name="cigarette_year_discontinued"]').val());
        let currentSmoker = $('#current_smoker').is(':checked');

        if (yearStarted) {
            let yearsSmoking;
            if (currentSmoker) {
                yearsSmoking = new Date().getFullYear() - yearStarted;
            } else if (yearDiscontinued) {
                yearsSmoking = yearDiscontinued - yearStarted;
            } else {
                yearsSmoking = 0;
            }

            if (yearsSmoking > 0) {
                $('#years_smoking').val(yearsSmoking);

                // Calculate pack years: (sticks per day / 20) * years smoking
                let packYears = (sticksPerDay / 20) * yearsSmoking;
                $('#pack_years').val(packYears.toFixed(2));
            }
        }
    }

    // Add row to hospitalization table
    $('#addHospitalizationRow').on('click', function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="hospitalization_year[]"></td>
                <td><input type="text" class="form-control" name="hospitalization_diagnosis[]"></td>
                <td><input type="text" class="form-control" name="hospitalization_notes[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#hospitalizationTable tbody').append(newRow);
    });

    // Add row to surgical table
    $('#addSurgicalRow').on('click', function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="surgical_year[]"></td>
                <td><input type="text" class="form-control" name="surgical_diagnosis[]"></td>
                <td><input type="text" class="form-control" name="surgical_procedure[]"></td>
                <td><input type="text" class="form-control" name="surgical_biopsy[]"></td>
                <td><input type="text" class="form-control" name="surgical_notes[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#surgicalTable tbody').append(newRow);
    });

    // Add row to past pregnancy table
    $('#addPregnancyRow').on('click', function() {
        let newRow = `
            <tr>
                <td><input type="text" class="form-control" name="pregnancy_number[]"></td>
                <td>
                    <select class="form-control" name="pregnancy_sex[]">
                        <option value="">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="pregnancy_delivery[]">
                        <option value="">Select</option>
                        <option value="nsd">Normal Spontaneous Delivery</option>
                        <option value="cs">Cesarean Section</option>
                        <option value="vacuum">Vacuum Extraction</option>
                        <option value="forceps">Forceps Delivery</option>
                        <option value="breech">Breech Delivery</option>
                        <option value="other">Other</option>
                    </select>
                </td>
                <td><input type="text" class="form-control" name="pregnancy_complications[]"></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        $('#pastPregnancyTable tbody').append(newRow);
    });

    // Remove row from tables
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
    });

    // Form submission
    $('#saveComprehensiveHistoryBtn').on('click', function() {
        let formData = $('#comprehensiveHistoryForm').serialize();

        $.ajax({
            url: '/patients/' + $('input[name="patient_id"]').val() + '/comprehensive-history',
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    alert('Comprehensive history saved successfully!');
                    // Update all progress indicators after saving
                    updateAllProgressIndicators();
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr) {
                alert('Error saving comprehensive history: ' + (xhr.responseJSON?.message || 'Unknown error'));
            }
        });
    });
});
</script>

{{-- Include File Upload and Viewer Modals --}}
@include('patients.comprehensive_history.components.file_modals')
