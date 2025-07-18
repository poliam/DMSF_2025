<div class="sleep-assessment-container">
    <!-- Sleep Screening Form -->
    <div class="card mb-4">
        <div class="card-header bg-warning">
            <h4 class="mb-0 text-dark"><strong>SLEEP</strong></h4>
        </div>
        <div class="card-body">
            <form id="sleep-screening-form">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Sleep Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="sleep_time" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Wake Up Time <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="wake_time" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Usual Sleep Duration (hours) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="sleep_duration" min="0" max="24" step="0.5" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Rate Your Sleep Quality (1 worst – 10 excellent) <span class="text-danger">*</span></label>
                            <select class="form-control" name="sleep_quality" required>
                                <option value="">Select...</option>
                                <option value="1">1 - Very Poor</option>
                                <option value="2">2 - Poor</option>
                                <option value="3">3 - Fair</option>
                                <option value="4">4 - Below Average</option>
                                <option value="5">5 - Average</option>
                                <option value="6">6 - Above Average</option>
                                <option value="7">7 - Good</option>
                                <option value="8">8 - Very Good</option>
                                <option value="9">9 - Excellent</option>
                                <option value="10">10 - Outstanding</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Activities within <2 hours before sleeping:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sleep_activities[]" value="alcohol" id="activity_alcohol">
                        <label class="form-check-label" for="activity_alcohol">Drinking alcoholic beverages</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sleep_activities[]" value="large_meal" id="activity_meal">
                        <label class="form-check-label" for="activity_meal">Eating a large meal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sleep_activities[]" value="coffee" id="activity_coffee">
                        <label class="form-check-label" for="activity_coffee">Drinking coffee</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="sleep_activities[]" value="gadgets" id="activity_gadgets">
                        <label class="form-check-label" for="activity_gadgets">Using gadgets/screen time</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Do you feel unusually sleepy during the daytime? <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="daytime_sleepiness" id="daytime_sleepiness_yes" value="yes" required>
                        <label class="form-check-label" for="daytime_sleepiness_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="daytime_sleepiness" id="daytime_sleepiness_no" value="no" required>
                        <label class="form-check-label" for="daytime_sleepiness_no">No</label>
                    </div>
                </div>

                <!-- P-BANG Features Section -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h6 class="mb-0">P-BANG Features (for STOP-BANG assessment) <span class="text-danger">*</span></h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Blood Pressure (Pressure >130/90) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="blood_pressure" placeholder="Provide Data" readonly value="{{ $patient->blood_pressure ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">BMI (kg/m²) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="bmi" placeholder="Provide Data" readonly value="{{ $patient->calculateBMI() != 'N/A' ? $patient->calculateBMI() : '' }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Age <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="age" placeholder="Provide Data" readonly value="{{ $patient->age ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Neck Circumference (cm) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="neck_circumference" placeholder="Provide Data" readonly value="{{ $patient->neck_circumference ?? '' }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="gender" placeholder="Provide Data" readonly value="{{ $patient->gender ?? '' }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" id="submit-sleep-screening">Submit Sleep Screening</button>
                    <button type="button" class="btn btn-secondary" id="evaluate-sleep">Evaluate Sleep Assessment</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Saved Form Data Display -->
    <div id="saved-form-data" style="display: none;">
        <div class="card mt-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Saved Sleep Screening Data</h5>
            </div>
            <div class="card-body">
                <div id="saved-form-content"></div>
            </div>
        </div>
    </div>

    <!-- Assessment Results and Tab Navigation -->
    <div id="assessment-results" style="display: none;">
        <div class="alert alert-info">
            <h5>Recommended Assessments:</h5>
            <div id="recommended-assessments"></div>
        </div>
    </div>

    <!-- Sub-tabs for Sleep Assessment Tools (initially hidden) -->
    <div id="sleep-assessment-tabs" style="display: none;">
        <ul class="nav nav-tabs" id="sleepAssessmentTabs" role="tablist">
            <li class="nav-item" role="presentation" id="isi-tab-item" style="display: none;">
                <button class="nav-link" id="isi-tab" data-bs-toggle="tab" data-bs-target="#isi-content" type="button" role="tab" aria-controls="isi-content" aria-selected="false">
                    Insomnia Severity Index (ISI-7)
                </button>
            </li>
            <li class="nav-item" role="presentation" id="shi-tab-item" style="display: none;">
                <button class="nav-link" id="shi-tab" data-bs-toggle="tab" data-bs-target="#shi-content" type="button" role="tab" aria-controls="shi-content" aria-selected="false">
                    Sleep Hygiene Index (SHI-13)
                </button>
            </li>
            <li class="nav-item" role="presentation" id="stopbang-tab-item" style="display: none;">
                <button class="nav-link" id="stopbang-tab" data-bs-toggle="tab" data-bs-target="#stopbang-content" type="button" role="tab" aria-controls="stopbang-content" aria-selected="false">
                    STOP-BANG Score
                </button>
            </li>
            <li class="nav-item" role="presentation" id="ess-tab-item" style="display: none;">
                <button class="nav-link" id="ess-tab" data-bs-toggle="tab" data-bs-target="#ess-content" type="button" role="tab" aria-controls="ess-content" aria-selected="false">
                    Epworth Sleepiness Scale (ESS-8)
                </button>
            </li>
        </ul>

    <!-- Tab Content -->
    <div class="tab-content" id="sleepAssessmentTabContent">
        <!-- ISI-7 Content -->
        <div class="tab-pane fade show active" id="isi-content" role="tabpanel" aria-labelledby="isi-tab">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Insomnia Severity Index (ISI-7)</h5>
                </div>
                <div class="card-body">
                    <form id="isi-form">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted mb-3">Please rate the severity of your insomnia problems during the past month.</p>
                                
                                <!-- ISI Questions -->
                                <div class="mb-3">
                                    <label class="form-label">1. Difficulty falling asleep</label>
                                    <select class="form-select" name="isi_1" required>
                                        <option value="">Select...</option>
                                        <option value="0">None (0)</option>
                                        <option value="1">Mild (1)</option>
                                        <option value="2">Moderate (2)</option>
                                        <option value="3">Severe (3)</option>
                                        <option value="4">Very severe (4)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">2. Difficulty staying asleep</label>
                                    <select class="form-select" name="isi_2" required>
                                        <option value="">Select...</option>
                                        <option value="0">None (0)</option>
                                        <option value="1">Mild (1)</option>
                                        <option value="2">Moderate (2)</option>
                                        <option value="3">Severe (3)</option>
                                        <option value="4">Very severe (4)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">3. Problems waking up too early</label>
                                    <select class="form-select" name="isi_3" required>
                                        <option value="">Select...</option>
                                        <option value="0">None (0)</option>
                                        <option value="1">Mild (1)</option>
                                        <option value="2">Moderate (2)</option>
                                        <option value="3">Severe (3)</option>
                                        <option value="4">Very severe (4)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">4. How satisfied/dissatisfied are you with your current sleep pattern?</label>
                                    <select class="form-select" name="isi_4" required>
                                        <option value="">Select...</option>
                                        <option value="0">Very satisfied (0)</option>
                                        <option value="1">Satisfied (1)</option>
                                        <option value="2">Moderately satisfied (2)</option>
                                        <option value="3">Dissatisfied (3)</option>
                                        <option value="4">Very dissatisfied (4)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">5. How noticeable to others do you think your sleep problem is in terms of impairing the quality of your life?</label>
                                    <select class="form-select" name="isi_5" required>
                                        <option value="">Select...</option>
                                        <option value="0">Not at all noticeable (0)</option>
                                        <option value="1">Barely (1)</option>
                                        <option value="2">Somewhat (2)</option>
                                        <option value="3">Much (3)</option>
                                        <option value="4">Very much noticeable (4)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">6. How worried/distressed are you about your current sleep problem?</label>
                                    <select class="form-select" name="isi_6" required>
                                        <option value="">Select...</option>
                                        <option value="0">Not at all worried (0)</option>
                                        <option value="1">Slightly (1)</option>
                                        <option value="2">Moderately (2)</option>
                                        <option value="3">Much (3)</option>
                                        <option value="4">Very much worried (4)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">7. To what extent do you consider your sleep problem to interfere with your daily functioning?</label>
                                    <select class="form-select" name="isi_7" required>
                                        <option value="">Select...</option>
                                        <option value="0">Not at all interfering (0)</option>
                                        <option value="1">A little (1)</option>
                                        <option value="2">Somewhat (2)</option>
                                        <option value="3">Much (3)</option>
                                        <option value="4">Very much interfering (4)</option>
                                    </select>
                                </div>

                                <div class="alert alert-info">
                                    <strong>Total Score: <span id="isi-total">0</span></strong><br>
                                    <small>
                                        <strong>Interpretation:</strong><br>
                                        0-7: No clinically significant insomnia<br>
                                        8-14: Subthreshold insomnia<br>
                                        15-21: Clinical insomnia (moderate severity)<br>
                                        22-28: Clinical insomnia (severe)
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- SHI-13 Content -->
        <div class="tab-pane fade" id="shi-content" role="tabpanel" aria-labelledby="shi-tab">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Sleep Hygiene Index (SHI-13)</h5>
                </div>
                <div class="card-body">
                    <form id="shi-form">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted mb-3">Please indicate how frequently you engage in the following behaviors.</p>
                                
                                <!-- SHI Questions -->
                                <div class="mb-3">
                                    <label class="form-label">1. I take daytime naps lasting 2 or more hours</label>
                                    <select class="form-select shi-question" name="shi_1" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">2. I go to bed at different times from day to day</label>
                                    <select class="form-select shi-question" name="shi_2" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">3. I get out of bed at different times from day to day</label>
                                    <select class="form-select shi-question" name="shi_3" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">4. I exercise to the point of sweating within 1 hour of going to bed</label>
                                    <select class="form-select shi-question" name="shi_4" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">5. I stay in bed when I am awake</label>
                                    <select class="form-select shi-question" name="shi_5" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">6. I use my bed for things other than sleeping (like eating, watching TV, reading, etc.)</label>
                                    <select class="form-select shi-question" name="shi_6" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">7. I sleep on an uncomfortable bed</label>
                                    <select class="form-select shi-question" name="shi_7" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">8. I sleep in an uncomfortable bedroom</label>
                                    <select class="form-select shi-question" name="shi_8" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">9. I have a pre-sleep ritual</label>
                                    <select class="form-select shi-question" name="shi_9" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">10. I use sleep medication</label>
                                    <select class="form-select shi-question" name="shi_10" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">11. I do something active before going to bed (like playing sports, dancing, exercising)</label>
                                    <select class="form-select shi-question" name="shi_11" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">12. I drink something with caffeine in it</label>
                                    <select class="form-select shi-question" name="shi_12" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">13. I smoke something with nicotine in it</label>
                                    <select class="form-select shi-question" name="shi_13" required>
                                        <option value="">Select...</option>
                                        <option value="1">Always (1)</option>
                                        <option value="2">Frequently (2)</option>
                                        <option value="3">Sometimes (3)</option>
                                        <option value="4">Rarely (4)</option>
                                        <option value="5">Never (5)</option>
                                    </select>
                                </div>

                                <div class="alert alert-info">
                                    <strong>Total Score: <span id="shi-total">0</span></strong><br>
                                    <small>
                                        <strong>Interpretation:</strong><br>
                                        Higher scores indicate poorer sleep hygiene<br>
                                        13-26: Good sleep hygiene<br>
                                        27-39: Moderate sleep hygiene<br>
                                        40-65: Poor sleep hygiene
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- STOP-BANG Content -->
        <div class="tab-pane fade" id="stopbang-content" role="tabpanel" aria-labelledby="stopbang-tab">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">STOP-BANG Score for Obstructive Sleep Apnea</h5>
                </div>
                <div class="card-body">
                    <form id="stopbang-form">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted mb-3">Please answer the following questions to assess your risk for obstructive sleep apnea.</p>
                                
                                <!-- STOP-BANG Questions -->
                                <div class="mb-3">
                                    <label class="form-label">S - Snoring: Do you snore loudly (louder than talking or loud enough to be heard through closed doors)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_s" id="stopbang_s_yes" value="1">
                                        <label class="form-check-label" for="stopbang_s_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_s" id="stopbang_s_no" value="0">
                                        <label class="form-check-label" for="stopbang_s_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">T - Tired: Do you often feel tired, fatigued, or sleepy during daytime?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_t" id="stopbang_t_yes" value="1">
                                        <label class="form-check-label" for="stopbang_t_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_t" id="stopbang_t_no" value="0">
                                        <label class="form-check-label" for="stopbang_t_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">O - Observed: Has anyone observed you stop breathing during your sleep?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_o" id="stopbang_o_yes" value="1">
                                        <label class="form-check-label" for="stopbang_o_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_o" id="stopbang_o_no" value="0">
                                        <label class="form-check-label" for="stopbang_o_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">P - Pressure: Do you have or are you being treated for high blood pressure?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_p" id="stopbang_p_yes" value="1">
                                        <label class="form-check-label" for="stopbang_p_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_p" id="stopbang_p_no" value="0">
                                        <label class="form-check-label" for="stopbang_p_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">B - BMI: Is your BMI more than 35 kg/m²?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_b" id="stopbang_b_yes" value="1">
                                        <label class="form-check-label" for="stopbang_b_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_b" id="stopbang_b_no" value="0">
                                        <label class="form-check-label" for="stopbang_b_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">A - Age: Are you older than 50 years?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_a" id="stopbang_a_yes" value="1">
                                        <label class="form-check-label" for="stopbang_a_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_a" id="stopbang_a_no" value="0">
                                        <label class="form-check-label" for="stopbang_a_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">N - Neck: Is your neck circumference greater than 40 cm (16 inches)?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_n" id="stopbang_n_yes" value="1">
                                        <label class="form-check-label" for="stopbang_n_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_n" id="stopbang_n_no" value="0">
                                        <label class="form-check-label" for="stopbang_n_no">No</label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">G - Gender: Are you male?</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_g" id="stopbang_g_yes" value="1">
                                        <label class="form-check-label" for="stopbang_g_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="stopbang_g" id="stopbang_g_no" value="0">
                                        <label class="form-check-label" for="stopbang_g_no">No</label>
                                    </div>
                                </div>

                                <div class="alert alert-info">
                                    <strong>Total Score: <span id="stopbang-total">0</span></strong><br>
                                    <small>
                                        <strong>Risk Assessment:</strong><br>
                                        0-2: Low risk for OSA<br>
                                        3-4: Intermediate risk for OSA<br>
                                        5-8: High risk for OSA
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ESS-8 Content -->
        <div class="tab-pane fade" id="ess-content" role="tabpanel" aria-labelledby="ess-tab">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Epworth Sleepiness Scale (ESS-8)</h5>
                </div>
                <div class="card-body">
                    <form id="ess-form">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-muted mb-3">How likely are you to doze off or fall asleep in the following situations, in contrast to feeling just tired? This refers to your usual way of life in recent times.</p>
                                
                                <!-- ESS Questions -->
                                <div class="mb-3">
                                    <label class="form-label">1. Sitting and reading</label>
                                    <select class="form-select ess-question" name="ess_1" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">2. Watching TV</label>
                                    <select class="form-select ess-question" name="ess_2" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">3. Sitting inactive in a public place (e.g., a theater or a meeting)</label>
                                    <select class="form-select ess-question" name="ess_3" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">4. As a passenger in a car for an hour without a break</label>
                                    <select class="form-select ess-question" name="ess_4" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">5. Lying down to rest in the afternoon when circumstances permit</label>
                                    <select class="form-select ess-question" name="ess_5" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">6. Sitting and talking to someone</label>
                                    <select class="form-select ess-question" name="ess_6" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">7. Sitting quietly after a lunch without alcohol</label>
                                    <select class="form-select ess-question" name="ess_7" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">8. In a car, while stopped for a few minutes in traffic</label>
                                    <select class="form-select ess-question" name="ess_8" required>
                                        <option value="">Select...</option>
                                        <option value="0">Would never doze (0)</option>
                                        <option value="1">Slight chance of dozing (1)</option>
                                        <option value="2">Moderate chance of dozing (2)</option>
                                        <option value="3">High chance of dozing (3)</option>
                                    </select>
                                </div>

                                <div class="alert alert-info">
                                    <strong>Total Score: <span id="ess-total">0</span></strong><br>
                                    <small>
                                        <strong>Interpretation:</strong><br>
                                        0-5: Lower normal daytime sleepiness<br>
                                        6-10: Higher normal daytime sleepiness<br>
                                        11-12: Mild excessive daytime sleepiness<br>
                                        13-15: Moderate excessive daytime sleepiness<br>
                                        16-24: Severe excessive daytime sleepiness
                                    </small>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Sleep Screening Form Submission
    $('#sleep-screening-form').on('submit', function(e) {
        e.preventDefault();
        submitSleepScreening();
    });

    // Sleep Screening Form Evaluation
    $('#evaluate-sleep').on('click', function() {
        evaluateSleepScreening();
    });

    function submitSleepScreening() {
        // Validate form
        if (!validateForm()) {
            return;
        }

        // Get form data
        const formData = new FormData($('#sleep-screening-form')[0]);
        formData.append('patient_id', '{{ $patient->id ?? "" }}');

        // Submit form via AJAX
        $.ajax({
            url: '{{ route("sleep-screenings.store") }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    showSavedFormData(response.data);
                    $('#sleep-screening-form')[0].reset();
                    alert('Sleep screening saved successfully!');
                }
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    displayValidationErrors(errors);
                } else {
                    alert('Error saving sleep screening. Please try again.');
                }
            }
        });
    }

    function validateForm() {
        let isValid = true;
        const requiredFields = [
            'sleep_time', 'wake_time', 'sleep_duration', 'sleep_quality', 
            'daytime_sleepiness', 'blood_pressure', 'bmi', 'age', 
            'neck_circumference', 'gender'
        ];

        requiredFields.forEach(function(field) {
            const value = $(`[name="${field}"]`).val();
            if (!value || value === 'Provide Data') {
                isValid = false;
                $(`[name="${field}"]`).addClass('is-invalid');
            } else {
                $(`[name="${field}"]`).removeClass('is-invalid');
            }
        });

        if (!isValid) {
            alert('Please ensure all required fields have data. Some patient data may be missing.');
        }

        return isValid;
    }

    function displayValidationErrors(errors) {
        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Display new errors
        Object.keys(errors).forEach(function(field) {
            const input = $(`[name="${field}"]`);
            input.addClass('is-invalid');
            input.after(`<div class="invalid-feedback">${errors[field][0]}</div>`);
        });
    }

    function showSavedFormData(data) {
        let html = '<div class="row">';
        
        // Sleep Time and Duration
        html += '<div class="col-md-6"><strong>Sleep Time:</strong> ' + (data.sleep_time || 'N/A') + '</div>';
        html += '<div class="col-md-6"><strong>Wake Up Time:</strong> ' + (data.wake_time || 'N/A') + '</div>';
        html += '<div class="col-md-6"><strong>Sleep Duration:</strong> ' + (data.sleep_duration || 'N/A') + ' hours</div>';
        html += '<div class="col-md-6"><strong>Sleep Quality:</strong> ' + (data.sleep_quality || 'N/A') + '/10</div>';
        
        // Activities
        const activities = data.sleep_activities ? data.sleep_activities.join(', ') : 'None';
        html += '<div class="col-md-12"><strong>Activities before sleep:</strong> ' + activities + '</div>';
        
        // Daytime Sleepiness
        html += '<div class="col-md-6"><strong>Daytime Sleepiness:</strong> ' + (data.daytime_sleepiness || 'N/A') + '</div>';
        
        // P-BANG Features
        html += '<div class="col-md-6"><strong>Blood Pressure:</strong> ' + (data.blood_pressure || 'N/A') + '</div>';
        html += '<div class="col-md-4"><strong>BMI:</strong> ' + (data.bmi || 'N/A') + ' kg/m²</div>';
        html += '<div class="col-md-4"><strong>Age:</strong> ' + (data.age || 'N/A') + ' years</div>';
        html += '<div class="col-md-4"><strong>Neck Circumference:</strong> ' + (data.neck_circumference || 'N/A') + ' cm</div>';
        html += '<div class="col-md-6"><strong>Gender:</strong> ' + (data.gender || 'N/A') + '</div>';
        
        // Recommended Assessments
        const assessments = data.recommended_assessments ? data.recommended_assessments.join(', ') : 'None';
        html += '<div class="col-md-12 mt-3"><strong>Recommended Assessments:</strong> ' + assessments + '</div>';
        
        html += '</div>';
        
        $('#saved-form-content').html(html);
        $('#saved-form-data').show();
    }

    function evaluateSleepScreening() {
        // Get form values
        const sleepDuration = parseFloat($('input[name="sleep_duration"]').val()) || 0;
        const sleepQuality = parseInt($('input[name="sleep_quality"]').val()) || 0;
        const daytimeSleepiness = $('input[name="daytime_sleepiness"]:checked').val();
        const sleepActivities = $('input[name="sleep_activities[]"]:checked').map(function() {
            return $(this).val();
        }).get();
        
        // P-BANG features
        const bloodPressure = $('input[name="blood_pressure"]').val();
        const bmi = parseFloat($('input[name="bmi"]').val()) || 0;
        const age = parseInt($('input[name="age"]').val()) || 0;
        const neckCircumference = parseFloat($('input[name="neck_circumference"]').val()) || 0;
        const gender = $('input[name="gender"]').val();

        // Reset all tabs to hidden
        $('#isi-tab-item, #shi-tab-item, #stopbang-tab-item, #ess-tab-item').hide();
        $('#sleep-assessment-tabs').hide();
        $('#assessment-results').hide();

        let recommendedAssessments = [];

        // Conditional Logic
        // 1. If <7 hours sleep or rating <6 ➔ Show ISI-7
        if (sleepDuration < 7 || sleepQuality < 6) {
            $('#isi-tab-item').show();
            recommendedAssessments.push('Insomnia Severity Index (ISI-7)');
        }

        // 2. If "Yes" to daytime sleepiness ➔ Show ESS-8
        if (daytimeSleepiness === 'yes') {
            $('#ess-tab-item').show();
            recommendedAssessments.push('Epworth Sleepiness Scale (ESS-8)');
        }

        // 3. If poor sleep hygiene activity is marked ➔ Show SHI-13
        if (sleepActivities.length > 0) {
            $('#shi-tab-item').show();
            recommendedAssessments.push('Sleep Hygiene Index (SHI-13)');
        }

        // 4. If P-BANG features (HTN >130/90, BMI >35, Age >50, Neck >40cm, Male) ➔ Show STOP-BANG
        let pBangScore = 0;
        
        // Check blood pressure (format: "140/90")
        if (bloodPressure) {
            const bpParts = bloodPressure.split('/');
            if (bpParts.length === 2) {
                const systolic = parseInt(bpParts[0]);
                const diastolic = parseInt(bpParts[1]);
                if (systolic > 130 || diastolic > 90) pBangScore++;
            }
        }
        
        if (bmi > 35) pBangScore++;
        if (age > 50) pBangScore++;
        if (neckCircumference > 40) pBangScore++;
        if (gender === 'male') pBangScore++;

        if (pBangScore >= 2) { // Show if 2 or more P-BANG features are present
            $('#stopbang-tab-item').show();
            recommendedAssessments.push('STOP-BANG Score for Obstructive Sleep Apnea');
        }

        // Show results and tabs if any assessments are recommended
        if (recommendedAssessments.length > 0) {
            $('#assessment-results').show();
            $('#sleep-assessment-tabs').show();
            
            // Display recommended assessments
            let recommendationsHtml = '<ul>';
            recommendedAssessments.forEach(function(assessment) {
                recommendationsHtml += '<li>' + assessment + '</li>';
            });
            recommendationsHtml += '</ul>';
            $('#recommended-assessments').html(recommendationsHtml);

            // Set the first visible tab as active
            $('.nav-tabs .nav-link:visible').first().addClass('active');
            $('.tab-pane').removeClass('show active');
            $('.tab-pane:visible').first().addClass('show active');
        } else {
            // Show message if no assessments are recommended
            $('#assessment-results').show();
            $('#recommended-assessments').html('<p class="text-success">No specific sleep assessments are recommended based on your screening responses.</p>');
        }
    }

    // ISI-7 Score Calculation
    $('select[name^="isi_"]').on('change', function() {
        calculateISIScore();
    });

    function calculateISIScore() {
        let total = 0;
        $('select[name^="isi_"]').each(function() {
            const value = parseInt($(this).val()) || 0;
            total += value;
        });
        $('#isi-total').text(total);
    }

    // SHI-13 Score Calculation
    $('.shi-question').on('change', function() {
        calculateSHIScore();
    });

    function calculateSHIScore() {
        let total = 0;
        $('.shi-question').each(function() {
            const value = parseInt($(this).val()) || 0;
            total += value;
        });
        $('#shi-total').text(total);
    }

    // STOP-BANG Score Calculation
    $('input[name^="stopbang_"]').on('change', function() {
        calculateStopBangScore();
    });

    function calculateStopBangScore() {
        let total = 0;
        $('input[name^="stopbang_"]:checked').each(function() {
            total += parseInt($(this).val());
        });
        $('#stopbang-total').text(total);
    }

    // ESS-8 Score Calculation
    $('.ess-question').on('change', function() {
        calculateESSScore();
    });

    function calculateESSScore() {
        let total = 0;
        $('.ess-question').each(function() {
            const value = parseInt($(this).val()) || 0;
            total += value;
        });
        $('#ess-total').text(total);
    }
});
</script>
