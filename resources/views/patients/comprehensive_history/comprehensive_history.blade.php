<div class="container-fluid">
    <style>
        .card-body {
            height: auto !important;
            min-height: fit-content;
            overflow: visible;
        }
    </style>
    <div>
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-white">Comprehensive History</h6>
            <button class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300" type="button" id="saveComprehensiveHistoryBtn">Save</button>
        </div>
        <div class="card card-body">
            <form id="comprehensiveHistoryForm">
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->id }}">

                @include('patients.comprehensive_history.components.informant_section')

                @include('patients.comprehensive_history.components.chief_concern_section')

                @include('patients.comprehensive_history.components.past_medical_history_section')

                @include('patients.comprehensive_history.components.family_history_section')

                <!-- Allergies Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Allergies</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="food_allergies" class="form-label">Food Allergies</label>
                            <input type="text" class="form-control" id="food_allergies" name="food_allergies">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="drug_allergies" class="form-label">Drug Allergies</label>
                            <input type="text" class="form-control" id="drug_allergies" name="drug_allergies">
                        </div>
                    </div>
                </div>

                <!-- Previous and Current Medications Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Previous and Current Medications</h5>
                    <div class="mb-3">
                        <label for="medications" class="form-label">List All Medications</label>
                        <textarea class="form-control" id="medications" name="medications" rows="4"></textarea>
                    </div>
                </div>

                <!-- Previous Hospitalization Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Previous Hospitalization</h5>
                    <div class="mb-3">
                        <table class="table table-bordered" id="hospitalizationTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Year</th>
                                    <th>Diagnosis</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" id="addHospitalizationRow">
                            <i class="fa-solid fa-plus"></i> Add Row
                        </button>
                    </div>
                </div>

                <!-- Surgical History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Surgical History</h5>
                    <div class="mb-3">
                        <table class="table table-bordered" id="surgicalTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Year</th>
                                    <th>Diagnosis</th>
                                    <th>Procedure</th>
                                    <th>Biopsy Result</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" id="addSurgicalRow">
                            <i class="fa-solid fa-plus"></i> Add Row
                        </button>
                    </div>
                </div>

                <!-- Health Maintenance Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Health Maintenance</h5>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">COVID-19 Vaccination</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="covid_year" class="form-label">Year</label>
                                    <input type="date" class="form-control" id="covid_year" name="covid_year">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="covid_brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control" id="covid_brand" name="covid_brand">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="covid_boosters" class="form-label">Boosters</label>
                                    <input type="text" class="form-control" id="covid_boosters" name="covid_boosters">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Other Vaccinations</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="pcv_vaccine" class="form-label">PCV</label>
                                    <input type="text" class="form-control" id="pcv_vaccine" name="pcv_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="flu_vaccine" class="form-label">Flu</label>
                                    <input type="text" class="form-control" id="flu_vaccine" name="flu_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hepb_vaccine" class="form-label">HepB</label>
                                    <input type="text" class="form-control" id="hepb_vaccine" name="hepb_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="hpv_vaccine" class="form-label">HPV</label>
                                    <input type="text" class="form-control" id="hpv_vaccine" name="hpv_vaccine">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="other_vaccines" class="form-label">Others</label>
                                    <input type="text" class="form-control" id="other_vaccines" name="other_vaccines">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

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
                        <div class="col-md-4">
                            <label for="pap_smear" class="form-label">Pap Smear</label>
                            <input type="text" class="form-control" id="pap_smear" name="pap_smear">
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
                                <input class="form-check-input" type="checkbox" id="contraceptive_pills" name="contraceptive_methods[]" value="pills">
                                <label class="form-check-label" for="contraceptive_pills">Hormonal pills</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_depo" name="contraceptive_methods[]" value="depo">
                                <label class="form-check-label" for="contraceptive_depo">Depo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_implant" name="contraceptive_methods[]" value="implant">
                                <label class="form-check-label" for="contraceptive_implant">Implant</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="contraceptive_other_checkbox" name="contraceptive_methods[]" value="other">
                                <label class="form-check-label" for="contraceptive_other_checkbox">Others</label>
                            </div>
                            <div class="mt-2">
                                <input type="text" class="form-control" id="contraceptive_other" name="contraceptive_other" placeholder="Other contraceptive methods">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Psychiatric Illness Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Psychiatric Illness</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_anxiety" name="psychiatric_illness[]" value="anxiety">
                                <label class="form-check-label" for="psychiatric_anxiety">Anxiety</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_depression" name="psychiatric_illness[]" value="depression">
                                <label class="form-check-label" for="psychiatric_depression">Depression</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_mood" name="psychiatric_illness[]" value="mood_disorders">
                                <label class="form-check-label" for="psychiatric_mood">Mood Disorders</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_hallucinations" name="psychiatric_illness[]" value="hallucinations">
                                <label class="form-check-label" for="psychiatric_hallucinations">Hallucinations</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="psychiatric_delusions" name="psychiatric_illness[]" value="delusions">
                                <label class="form-check-label" for="psychiatric_delusions">Delusions</label>
                            </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="psychiatric_others" name="psychiatric_illness[]" value="others">
                            <label class="form-check-label" for="psychiatric_others">Others</label>
                        </div>
                        <div class="mt-2">
                            <input type="text" class="form-control" id="psychiatric_others_details" name="psychiatric_others_details" placeholder="Other psychiatric conditions">
                        </div>
                        </div>
                    </div>
                </div>

                <!-- Personal-Social History Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3">Personal-Social History</h5>

                    <!-- Cigarette User -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="cigarette_user" name="cigarette_user" value="1">
                                <label class="form-check-label" for="cigarette_user">Cigarette User</label>
                            </div>
                        </div>
                        <div class="card-body" id="cigarette-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Started</label>
                                    <input type="text" class="form-control" name="cigarette_year_started">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Discontinued</label>
                                    <input type="text" class="form-control" name="cigarette_year_discontinued">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="current_smoker" name="current_smoker" value="1">
                                        <label class="form-check-label" for="current_smoker">Current Smoker</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Sticks Per Day</label>
                                    <input type="number" class="form-control" id="sticks_per_day" name="sticks_per_day">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Years Smoking</label>
                                    <input type="text" class="form-control" id="years_smoking" name="years_smoking" readonly>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pack Years</label>
                                    <input type="text" class="form-control" id="pack_years" name="pack_years" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alcohol Beverage Drinker -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="alcohol_drinker" name="alcohol_drinker" value="1">
                                <label class="form-check-label" for="alcohol_drinker">Alcohol Beverage Drinker</label>
                            </div>
                        </div>
                        <div class="card-body" id="alcohol-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Started</label>
                                    <input type="text" class="form-control" name="alcohol_year_started">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Discontinued</label>
                                    <input type="text" class="form-control" name="alcohol_year_discontinued">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="current_drinker" name="current_drinker" value="1">
                                        <label class="form-check-label" for="current_drinker">Current Drinker</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="alcohol_type">
                                        <option value="">Select</option>
                                        <option value="tuba">Tuba</option>
                                        <option value="beer">Beer</option>
                                        <option value="wine">Wine</option>
                                        <option value="shots">Shots</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Standard Drinks</label>
                                    <input type="number" class="form-control" name="alcohol_sd" placeholder="Amount">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Frequency</label>
                                    <select class="form-select" name="alcohol_frequency">
                                        <option value="">Select</option>
                                        <option value="per_day">Per Day</option>
                                        <option value="per_week">Per Week</option>
                                        <option value="per_session">Per Session</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Illicit Drug User -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="drug_user" name="drug_user" value="1">
                                <label class="form-check-label" for="drug_user">Illicit Drug User</label>
                            </div>
                        </div>
                        <div class="card-body" id="drug-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <input type="text" class="form-control" name="drug_type">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Started</label>
                                    <input type="text" class="form-control" name="drug_year_started">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Year Discontinued</label>
                                    <input type="text" class="form-control" name="drug_year_discontinued">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="current_drug_user" name="current_drug_user" value="1">
                                        <label class="form-check-label" for="current_drug_user">Current Drug User</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coffee User -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="coffee_user" name="coffee_user" value="1">
                                <label class="form-check-label" for="coffee_user">Coffee User</label>
                            </div>
                        </div>
                        <div class="card-body" id="coffee-details">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="coffee_type">
                                        <option value="">Select</option>
                                        <option value="instant">Instant</option>
                                        <option value="brewed">Brewed</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Amount</label>
                                    <select class="form-select" name="coffee_amount">
                                        <option value="">Select</option>
                                        <option value="240ml">240ml</option>
                                        <option value="360ml">360ml</option>
                                        <option value="500ml">500ml</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Cups Per Day</label>
                                    <select class="form-select" name="coffee_cups">
                                        <option value="">Select</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5+">5+</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Alternative Therapies -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Alternative Therapies</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_hilot" name="alternative_therapies[]" value="hilot">
                                        <label class="form-check-label" for="therapy_hilot">Hilot</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_quack" name="alternative_therapies[]" value="quack_doctor">
                                        <label class="form-check-label" for="therapy_quack">Quack Doctor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_chiro" name="alternative_therapies[]" value="chiropractor">
                                        <label class="form-check-label" for="therapy_chiro">Chiropractor</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_acupuncture" name="alternative_therapies[]" value="acupuncture">
                                        <label class="form-check-label" for="therapy_acupuncture">Acupuncture</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="therapy_other_checkbox" name="alternative_therapies[]" value="other">
                                        <label class="form-check-label" for="therapy_other_checkbox">Others</label>
                                    </div>
                                    <div class="mt-2">
                                        <input type="text" class="form-control" id="therapy_other" name="therapy_other" placeholder="Other alternative therapies">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Other Social History -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h6 class="mb-0">Other Social History</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="schooling" class="form-label">Schooling</label>
                                    <textarea class="form-control" id="schooling" name="schooling" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="job_history" class="form-label">Job History</label>
                                    <textarea class="form-control" id="job_history" name="job_history" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="financial_situation" class="form-label">Financial Situation</label>
                                    <textarea class="form-control" id="financial_situation" name="financial_situation" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="marriage_children" class="form-label">Marriage/Children</label>
                                    <textarea class="form-control" id="marriage_children" name="marriage_children" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="home_situation" class="form-label">Home Situation</label>
                                    <textarea class="form-control" id="home_situation" name="home_situation" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="daily_activities" class="form-label">Daily Activities</label>
                                    <textarea class="form-control" id="daily_activities" name="daily_activities" rows="2"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="environment" class="form-label">Environment</label>
                                    <textarea class="form-control" id="environment" name="environment" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Load comprehensive history data when the tab is clicked
    $('#comprehensive-history-tab').on('click', function() {
        console.log('Comprehensive History tab clicked - loading data...');
        loadComprehensiveHistoryData();
    });

    // Also load data if the comprehensive history tab is already active on page load
    if ($('#comprehensive-history-tab').hasClass('active') || $('#comprehensive-history-tab-pane').hasClass('active')) {
        console.log('Comprehensive History tab is already active - loading data...');
        loadComprehensiveHistoryData();
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
                console.log('Comprehensive history data loaded:', response);
                if (response) {
                    populateFormWithData(response);
                } else {
                    console.log('No existing comprehensive history data found.');
                }
            },
            error: function(xhr) {
                console.log('Error loading comprehensive history data:', xhr.responseJSON?.message || 'Unknown error');
            }
        });
    }

    // Function to populate form with loaded data
    function populateFormWithData(data) {
        console.log('Populating form with data:', data);

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

        // Handle simple text fields
        Object.keys(data).forEach(function(key) {
            if (!['informant', 'childhood_illness', 'adult_illness', 'family_illness', 'other_conditions',
                  'family_other_conditions', 'menstrual_symptoms', 'contraceptive_methods',
                  'psychiatric_illness', 'alternative_therapies', 'cigarette_user', 'alcohol_drinker',
                  'drug_user', 'coffee_user', 'hospitalization', 'surgical_history',
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
