<!-- OBGYN History Section -->
<div class="mb-4">
    <h5 class="border-bottom pb-2 mb-3">OBGYN History</h5>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="lmp" class="form-label">Last Menstrual Period (LMP)</label>
            <input type="date" class="form-control" id="lmp" name="lmp">
        </div>
        <div class="col-md-6">
            <label for="pmp" class="form-label">Previous Menstrual Period (PMP)</label>
            <input type="date" class="form-control" id="pmp" name="pmp">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <h6 class="mb-2">OB Score</h6>
        </div>
        <div class="col-md-2">
            <label for="ob_g" class="form-label">G</label>
            <input type="text" class="form-control" id="ob_g" name="ob_g">
        </div>
        <div class="col-md-2">
            <label for="ob_p" class="form-label">P</label>
            <input type="text" class="form-control" id="ob_p" name="ob_p">
        </div>
        <div class="col-md-2">
            <label for="ob_t" class="form-label">T</label>
            <input type="text" class="form-control" id="ob_t" name="ob_t">
        </div>
        <div class="col-md-2">
            <label for="ob_p2" class="form-label">P</label>
            <input type="text" class="form-control" id="ob_p2" name="ob_p2">
        </div>
        <div class="col-md-2">
            <label for="ob_a" class="form-label">A</label>
            <input type="text" class="form-control" id="ob_a" name="ob_a">
        </div>
        <div class="col-md-2">
            <label for="ob_l" class="form-label">L</label>
            <input type="text" class="form-control" id="ob_l" name="ob_l">
        </div>
    </div>

    <!-- Past Pregnancy Table -->
    <div class="row mb-3">
        <div class="col-md-12">
            <h6 class="mb-2">Past Pregnancy</h6>
            <div class="table-responsive">
                <table class="table table-bordered" id="pastPregnancyTable">
                    <thead>
                        <tr>
                            <th>Number</th>
                            <th>Sex</th>
                            <th>Manner of Delivery</th>
                            <th>Disposition/Complications</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
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
                    </tbody>
                </table>
                <button type="button" class="btn btn-success btn-sm" id="addPregnancyRow">
                    <i class="fa-solid fa-plus"></i> Add Row
                </button>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="menarche" class="form-label">Menarche</label>
            <input type="text" class="form-control" id="menarche" name="menarche">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <h6 class="mb-2">Menstrual Details</h6>
        </div>
        <div class="col-md-4">
            <label for="menstrual_interval" class="form-label">Interval</label>
            <input type="text" class="form-control" id="menstrual_interval" name="menstrual_interval">
        </div>
        <div class="col-md-4">
            <label for="menstrual_duration" class="form-label">Duration</label>
            <input type="text" class="form-control" id="menstrual_duration" name="menstrual_duration">
        </div>
        <div class="col-md-4">
            <label for="menstrual_pads" class="form-label">Pads Per Day</label>
            <input type="number" class="form-control" id="menstrual_pads" name="menstrual_pads">
            <div class="form-check form-check-inline mt-2">
                <input class="form-check-input" type="radio" name="menstrual_amount" id="amount_minimal" value="minimally">
                <label class="form-check-label" for="amount_minimal">Minimally</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="menstrual_amount" id="amount_moderate" value="moderately">
                <label class="form-check-label" for="amount_moderate">Moderately</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="menstrual_amount" id="amount_soaked" value="soaked">
                <label class="form-check-label" for="amount_soaked">Soaked</label>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <h6 class="mb-2">Symptoms</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="symptom_dysmenorrhea" name="menstrual_symptoms[]" value="dysmenorrhea">
                <label class="form-check-label" for="symptom_dysmenorrhea">Dysmenorrhea</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="symptom_headache" name="menstrual_symptoms[]" value="headache">
                <label class="form-check-label" for="symptom_headache">Headache</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="symptom_vomiting" name="menstrual_symptoms[]" value="vomiting">
                <label class="form-check-label" for="symptom_vomiting">Vomiting</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="symptom_dyschezia" name="menstrual_symptoms[]" value="dyschezia">
                <label class="form-check-label" for="symptom_dyschezia">Dyschezia</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="symptom_other" name="menstrual_symptoms[]" value="other">
                <label class="form-check-label" for="symptom_other">Others</label>
            </div>
            <div class="mt-2">
                <input type="text" class="form-control" id="symptom_other_details" name="symptom_other_details" placeholder="Other symptoms">
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="coitarche" class="form-label">Coitarche</label>
            <input type="text" class="form-control" id="coitarche" name="coitarche">
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label for="pap_smear" class="form-label">Pap Smear</label>
            <input type="text" class="form-control" id="pap_smear" name="pap_smear">
        </div>
        <div class="col-md-4">
            <label for="total_partners" class="form-label">Total Number of Partners</label>
            <input type="text" class="form-control" id="total_partners" name="total_partners">
        </div>
        <div class="col-md-4">
            <label for="current_partner" class="form-label">Current Partner</label>
            <select class="form-control" id="current_partner" name="current_partner">
                <option value="">Select</option>
                <option value="none">None</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="both">Both males and females</option>
                <option value="other">Other</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <h6 class="mb-2">Contraceptive Method</h6>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="contraceptive_calendar" name="contraceptive_methods[]" value="calendar">
                <label class="form-check-label" for="contraceptive_calendar">Calendar method</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="contraceptive_withdrawal" name="contraceptive_methods[]" value="withdrawal">
                <label class="form-check-label" for="contraceptive_withdrawal">Withdrawal</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input contraceptive-with-details" type="checkbox" id="contraceptive_pills" name="contraceptive_methods[]" value="pills" data-target="pills_details">
                <label class="form-check-label" for="contraceptive_pills">Hormonal pills</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input contraceptive-with-details" type="checkbox" id="contraceptive_depo" name="contraceptive_methods[]" value="depo" data-target="depo_details">
                <label class="form-check-label" for="contraceptive_depo">Depo</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input contraceptive-with-details" type="checkbox" id="contraceptive_implant" name="contraceptive_methods[]" value="implant" data-target="implant_details">
                <label class="form-check-label" for="contraceptive_implant">Implant</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="contraceptive_other_checkbox" name="contraceptive_methods[]" value="other">
                <label class="form-check-label" for="contraceptive_other_checkbox">Others</label>
            </div>
            
            <!-- Details for specific contraceptive methods -->
            <div class="mt-2" id="pills_details" style="display: none;">
                <input type="text" class="form-control" id="contraceptive_pills_details" name="contraceptive_pills_details" placeholder="Hormonal pills details">
            </div>
            
            <div class="mt-2" id="depo_details" style="display: none;">
                <input type="text" class="form-control" id="contraceptive_depo_details" name="contraceptive_depo_details" placeholder="Depo details">
            </div>
            
            <div class="mt-2" id="implant_details" style="display: none;">
                <input type="text" class="form-control" id="contraceptive_implant_details" name="contraceptive_implant_details" placeholder="Implant details">
            </div>
            
            <div class="mt-2">
                <input type="text" class="form-control" id="contraceptive_other" name="contraceptive_other" placeholder="Other contraceptive methods">
            </div>
        </div>
    </div>
</div>

<script>
// Function to initialize contraceptive method toggles
function initializeContraceptiveToggles() {
    // Handle contraceptive method checkboxes with details
    const contraceptiveCheckboxes = document.querySelectorAll('.contraceptive-with-details');
    
    // Function to toggle visibility of detail fields
    function toggleDetailField(checkbox) {
        const targetId = checkbox.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);
        
        if (targetElement) {
            if (checkbox.checked) {
                targetElement.style.display = 'block';
            } else {
                targetElement.style.display = 'none';
                // Don't clear the input when hiding during initialization
                // Only clear when user unchecks manually
                if (!checkbox.hasAttribute('data-initializing')) {
                    const input = targetElement.querySelector('input');
                    if (input) {
                        input.value = '';
                    }
                }
            }
        }
    }
    
    // Initialize the state
    contraceptiveCheckboxes.forEach(function(checkbox) {
        // Mark as initializing to prevent clearing values
        checkbox.setAttribute('data-initializing', 'true');
        toggleDetailField(checkbox);
        checkbox.removeAttribute('data-initializing');
        
        // Remove existing event listeners to prevent duplicates
        checkbox.removeEventListener('change', checkbox._toggleHandler);
        
        // Create new event handler
        checkbox._toggleHandler = function() {
            toggleDetailField(this);
        };
        
        // Add event listener for changes
        checkbox.addEventListener('change', checkbox._toggleHandler);
    });
}

// Initialize on DOM load
document.addEventListener('DOMContentLoaded', function() {
    initializeContraceptiveToggles();
});

// Make function globally available
window.initializeContraceptiveToggles = initializeContraceptiveToggles;
</script>
