<!-- Past Medical History Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">Past Medical History</h5>

    <!-- Childhood Illness -->
    <h6 class="mb-3">Childhood Illness</h6>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="measles" name="childhood_illness[]" value="measles">
                <label class="form-check-label" for="measles">Measles</label>
            </div>
            <div class="illness-details" id="measles-details">
                <div class="mb-2">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="measles_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="measles_other_information" placeholder="Other information">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="mumps" name="childhood_illness[]" value="mumps">
                <label class="form-check-label" for="mumps">Mumps</label>
            </div>
            <div class="illness-details" id="mumps-details">
                <div class="mb-2">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="mumps_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="mumps_complications" placeholder="Other information">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="chicken_pox" name="childhood_illness[]" value="chicken_pox">
                <label class="form-check-label" for="chicken_pox">Chicken Pox</label>
            </div>
            <div class="illness-details" id="chicken_pox-details">
                <div class="mb-2">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="chicken_pox_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="chicken_pox_complications" placeholder="Other information">
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="polio" name="childhood_illness[]" value="polio">
                <label class="form-check-label" for="polio">Polio</label>
            </div>
            <div class="illness-details" id="polio-details">
                <div class="mb-2">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="polio_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="polio_complications" placeholder="Other information">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="tuberculosis" name="childhood_illness[]" value="tuberculosis">
                <label class="form-check-label" for="tuberculosis">Tuberculosis</label>
            </div>
            <div class="illness-details" id="tuberculosis-details">
                <div class="mb-2">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="tuberculosis_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="tuberculosis_complications" placeholder="Other information">
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="childhood_asthma" name="childhood_illness[]" value="childhood_asthma">
                <label class="form-check-label" for="childhood_asthma">Asthma</label>
            </div>
            <div class="illness-details" id="childhood_asthma-details">
                <div class="mb-2">
                    <label class="form-label">Year</label>
                    <select class="form-select" name="childhood_asthma_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="childhood_asthma_complications" placeholder="Other information">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input childhood-illness" type="checkbox" id="childhood_others" name="childhood_illness[]" value="childhood_others">
                <label class="form-check-label" for="childhood_others">Others</label>
            </div>
            <div class="illness-details" id="childhood_others-details">
                <div class="mb-2">
                    <label class="form-label">Other Information</label>
                    <input type="text" class="form-control" name="childhood_others_details" placeholder="Other childhood illnesses">
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" id="completed_vaccinations" name="completed_vaccinations" value="1">
                <label class="form-check-label" for="completed_vaccinations">Completed childhood vaccinations</label>
            </div>
        </div>
    </div>

    {{-- File Upload Section for Childhood Illness --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'childhood_illness', 
        'title' => 'Childhood Illness Supporting Documents',
        'patient' => $patient ?? null
    ])

    <!-- Adult Illnesses -->
    <h6 class="mb-3 mt-4">Adult Illnesses</h6>

    <!-- Hypertension -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input adult-illness" type="checkbox" id="hypertension" name="adult_illness[]" value="hypertension">
                <label class="form-check-label" for="hypertension">Hypertension</label>
            </div>
        </div>
        <div class="card-body illness-details" id="hypertension-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="hypertension_type">
                        <option value="">Select</option>
                        <option value="primary">Primary</option>
                        <option value="secondary">Secondary</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Stage</label>
                    <select class="form-select" name="hypertension_stage">
                        <option value="">Select</option>
                        <option value="stage1">Stage I</option>
                        <option value="stage2">Stage II</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Control Status</label>
                    <select class="form-select" name="hypertension_control">
                        <option value="">Select</option>
                        <option value="controlled">Controlled</option>
                        <option value="uncontrolled">Uncontrolled</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select" name="hypertension_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Medication Status</label>
                    <select class="form-select" name="hypertension_med_status">
                        <option value="">Select</option>
                        <option value="self-medicated">Self-medicated</option>
                        <option value="prescribed">Prescribed</option>
                        <option value="no-meds">No medications</option>
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medications and other information</label>
                    <input type="text" class="form-control" name="hypertension_medications" placeholder="Medications and other information">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Compliance</label>
                    <select class="form-select" name="hypertension_compliance">
                        <option value="">Select</option>
                        <option value="compliant">Compliant</option>
                        <option value="partially-compliant">Partially compliant</option>
                        <option value="poorly-compliant">Poorly compliant</option>
                        <option value="noncompliant">Noncompliant</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Diabetes -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input adult-illness" type="checkbox" id="diabetes" name="adult_illness[]" value="diabetes">
                <label class="form-check-label" for="diabetes">Diabetes</label>
            </div>
        </div>
        <div class="card-body illness-details" id="diabetes-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Insulin Requirement</label>
                    <select class="form-select" name="diabetes_insulin">
                        <option value="">Select</option>
                        <option value="non-insulin">Non Insulin-requiring</option>
                        <option value="insulin">Insulin-requiring</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Type</label>
                    <select class="form-select" name="diabetes_type">
                        <option value="">Select</option>
                        <option value="type1">Type 1</option>
                        <option value="type2">Type 2</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Control Status</label>
                    <select class="form-select" name="diabetes_control">
                        <option value="">Select</option>
                        <option value="controlled">Controlled</option>
                        <option value="uncontrolled">Uncontrolled</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select" name="diabetes_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Medication Status</label>
                    <select class="form-select" name="diabetes_med_status">
                        <option value="">Select</option>
                        <option value="self-medicated">Self-medicated</option>
                        <option value="prescribed">Prescribed</option>
                        <option value="no-meds">No medications</option>
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medications and other information</label>
                    <input type="text" class="form-control" name="diabetes_medications" placeholder="Medications and other information">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Compliance</label>
                    <select class="form-select" name="diabetes_compliance">
                        <option value="">Select</option>
                        <option value="compliant">Compliant</option>
                        <option value="partially-compliant">Partially compliant</option>
                        <option value="poorly-compliant">Poorly compliant</option>
                        <option value="noncompliant">Noncompliant</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Bronchial Asthma -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input adult-illness" type="checkbox" id="bronchial_asthma" name="adult_illness[]" value="bronchial_asthma">
                <label class="form-check-label" for="bronchial_asthma">Bronchial Asthma</label>
            </div>
        </div>
        <div class="card-body illness-details" id="bronchial_asthma-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Control Status</label>
                    <select class="form-select" name="asthma_control">
                        <option value="">Select</option>
                        <option value="controlled">Controlled</option>
                        <option value="uncontrolled">Uncontrolled</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select" name="asthma_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Medication Status</label>
                    <select class="form-select" name="asthma_med_status">
                        <option value="">Select</option>
                        <option value="self-medicated">Self-medicated</option>
                        <option value="prescribed">Prescribed</option>
                        <option value="no-meds">No medications</option>
                    </select>
                </div>
                <div class="col-md-8 mb-3">
                    <label class="form-label">Medications and other information</label>
                    <input type="text" class="form-control" name="asthma_medications" placeholder="Medications and other information">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Compliance</label>
                    <select class="form-select" name="asthma_compliance">
                        <option value="">Select</option>
                        <option value="compliant">Compliant</option>
                        <option value="partially-compliant">Partially compliant</option>
                        <option value="poorly-compliant">Poorly compliant</option>
                        <option value="noncompliant">Noncompliant</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Dyslipidemia -->
    <div class="card mb-3">
        <div class="card-header">
            <div class="form-check">
                <input class="form-check-input adult-illness" type="checkbox" id="dyslipidemia" name="adult_illness[]" value="dyslipidemia">
                <label class="form-check-label" for="dyslipidemia">Dyslipidemia</label>
            </div>
        </div>
        <div class="card-body illness-details" id="dyslipidemia-details">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Year Diagnosed</label>
                    <select class="form-select" name="dyslipidemia_year">
                        <option value="">Select Year</option>
                        @for($year = date('Y'); $year >= 1950; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Medication Status</label>
                    <select class="form-select" name="dyslipidemia_med_status">
                        <option value="">Select</option>
                        <option value="self-medicated">Self-medicated</option>
                        <option value="prescribed">Prescribed</option>
                        <option value="no-meds">No medications</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Compliance</label>
                    <select class="form-select" name="dyslipidemia_compliance">
                        <option value="">Select</option>
                        <option value="compliant">Compliant</option>
                        <option value="partially-compliant">Partially compliant</option>
                        <option value="poorly-compliant">Poorly compliant</option>
                        <option value="noncompliant">Noncompliant</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Medications</label>
                    <input type="text" class="form-control" name="dyslipidemia_medications" placeholder="Medications and other information">
                </div>
            </div>
        </div>
    </div>

    <!-- Other Adult Conditions -->
    <div class="card mb-3">
        <div class="card-header">
            <h6 class="mb-0">Other Conditions</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="cancer" name="other_conditions[]" value="cancer">
                        <label class="form-check-label" for="cancer">Cancer</label>
                    </div>
                    <div class="mt-2">
                        <select class="form-select" name="cancer_status">
                            <option value="">Select Status</option>
                            <option value="relapse">Relapse</option>
                            <option value="ongoing_treatment">Ongoing Treatment</option>
                            <option value="remission">Remission</option>
                        </select>
                    </div>
                    <input type="text" class="form-control mt-2" name="cancer_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="neurologic" name="other_conditions[]" value="neurologic">
                        <label class="form-check-label" for="neurologic">Neurologic problems</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="neurologic_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="liver" name="other_conditions[]" value="liver">
                        <label class="form-check-label" for="liver">Liver problems</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="liver_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="kidney" name="other_conditions[]" value="kidney">
                        <label class="form-check-label" for="kidney">Kidney problems</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="kidney_details" placeholder="Details">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="other_condition" name="other_conditions[]" value="other">
                        <label class="form-check-label" for="other_condition">Others</label>
                    </div>
                    <input type="text" class="form-control mt-2" name="other_condition_details" placeholder="Details">
                </div>
            </div>
        </div>
    </div>

    {{-- File Upload Section for Adult Illness --}}
    @include('patients.comprehensive_history.components.file_upload_section', [
        'section' => 'adult_illness', 
        'title' => 'Adult Illness Supporting Documents',
        'patient' => $patient ?? null
    ])
</div>

<style>
.form-select:focus,
.form-control:focus {
    border-color: #7CAD3E;
    box-shadow: 0 0 0 0.2rem rgba(124, 173, 62, 0.25);
}

.card-header .form-check-label {
    font-weight: 500;
    color: #495057;
}

.illness-details {
    background-color: #f8f9fa;
    border-radius: 0.375rem;
    padding: 1rem;
    margin-top: 0.5rem;
}

.form-select {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.card {
    transition: box-shadow 0.15s ease-in-out;
}

.card:hover {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}
</style>

<script>
$(document).ready(function() {
    // Add visual feedback when year dropdowns change
    $('select[name$="_year"]').on('change', function() {
        if ($(this).val() !== '') {
            $(this).addClass('border-success');
            setTimeout(() => {
                $(this).removeClass('border-success');
            }, 1000);
        }
    });
    
    // Add hover effects to cards
    $('.card').hover(
        function() {
            $(this).addClass('shadow-sm');
        },
        function() {
            $(this).removeClass('shadow-sm');
        }
    );
});
</script>
