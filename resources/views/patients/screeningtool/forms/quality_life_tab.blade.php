<style>
    .white-bordered-table,
    .white-bordered-table th,
    .white-bordered-table td {
        border: 1px solid #fff !important;
    }
</style>
<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Quality of Life Results</h5>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#QualityOfLifeModal">
            Add Quality of Life
        </button>
    </div>
    <br>
		<div class="alert alert-info">
            <h6 class="alert-heading mb-2 font-weight-bold">EQ-5D-5L Health Status Assessment</h6>
            <p class="mb-2">The EQ-5D-5L is a widely used generic measure of health status consisting of two parts. The first part (the descriptive system) assesses health in five dimensions (MOBILITY, SELF-CARE, USUAL ACTIVITIES, PAIN / DISCOMFORT, ANXIETY / DEPRESSION), each of which has five levels of response (no problems, slight problems, moderate problems, severe problems, extreme problems/unable to). This part of the EQ-5D questionnaire provides a descriptive profile that can be used to generate a health state profile. The second part of the questionnaire consists of a visual analogue scale (VAS) on which the patient rates his/her perceived health from 0 (the worst imaginable health) to 100 (the best imaginable health). Patients are grouped based on their EQ-5D-5L index, Level Sum Score (LSS), or Visual Analogue Scale (EQ-VAS).</p>
			<br>
            <h6 class="alert-heading mb-2 font-weight-bold">Scoring System</h6>
            <table class="table table-bordered mb-3 white-bordered-table">
                <thead>
                    <tr>
                        <th>Index Score</th>
                        <th>Interpretation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>&gt;0.8 – 1.0</td>
                        <td>High Quality of Life</td>
                    </tr>
                    <tr>
                        <td>0.5 – 0.79</td>
                        <td>Moderate Quality of Life</td>
                    </tr>
                    <tr>
                        <td>&lt;0.5</td>
                        <td>Low Quality of Life</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered white-bordered-table">
                <thead>
                    <tr>
                        <th>VAS Score</th>
                        <th>Health Perception</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>80 – 100</td>
                        <td>High Perceived Health</td>
                    </tr>
                    <tr>
                        <td>50 – 79</td>
                        <td>Moderate Perceived Health</td>
                    </tr>
                    <tr>
                        <td>0 – 49</td>
                        <td>Low Perceived Health</td>
                    </tr>
                </tbody>
            </table>
            <br>

            <h6 class="alert-heading mb-2">Reference Materials</h6>
            <ul class="mb-2">
                <li><a href="https://docs.google.com/spreadsheets/d/1r11CX2F7N8sA1sbG-_vMw_YiVNUzEZfU/edit?usp=sharing&ouid=107953619828181291909&rtpof=true&sd=true" target="_blank">Philippines Value Set Estimation</a></li>
                <li><a href="https://euroqol.org/wp-content/uploads/2023/11/EQ-5D-5LUserguide-23-07.pdf" target="_blank">EQ-5D-5L User Guide</a></li>
                <li><a href="https://pmc.ncbi.nlm.nih.gov/articles/PMC9356948/#sec22" target="_blank">Research Article</a></li>
            </ul>

            <h6 class="alert-heading mb-2">Common ICD-10 Diagnoses</h6>
            <div class="row">
                <div class="col-md-6">
                    <ul class="mb-2">
                        <li>Z73.6 - Limitation of activities due to disability</li>
                        <li>Z73.2 - Lack of relaxation and leisure</li>
                        <li>M54.5 - Chronic low back pain</li>
                        <li>Z73.1 - Burn-out</li>
                        <li>Z56.6 - Other physical and mental strain related to work</li>
                        <li>R53.1 - Weakness and fatigue</li>
                        <li>M79.1 - Myalgia</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="mb-2">
                        <li>F41.9 - Anxiety disorder, unspecified</li>
                        <li>F32.0 - Mild depressive episode</li>
                        <li>F32.1 - Moderate depressive episode</li>
                        <li>F32.2 - Severe depressive episode without psychotic symptoms</li>
                        <li>F32.3 - Severe depressive episode with psychotic symptoms</li>
                        <li>F43.2 - Adjustment disorder with depressed mood</li>
                        <li>F43.21 - Adjustment disorder with mixed anxiety and depressed mood</li>
                        <li>F41.2 - Mixed anxiety and depressive disorder</li>
                        <li>R45.2 - Unhappiness</li>
                    </ul>
                </div>
            </div>
        </div>

    <!-- Consultation-specific quality of life data table -->
    <div id="qol-data-container" style="display:none;">
        <h6 class="mt-4">Quality of Life Records for Selected Consultation</h6>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Score</th>
                    <th>Health Today</th>
                    <th>ICD-10</th>
                </tr>
            </thead>
            <tbody id="qualityOfLifeTableBody">
                <!-- Data will be inserted here dynamically -->
            </tbody>
        </table>
    </div>

    <div id="no-qol-consultation-selected" class="alert alert-info mt-3">
        <i class="fas fa-info-circle"></i> Please select a consultation to view quality of life records.
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="QualityOfLifeModal" tabindex="-1" aria-labelledby="QualityOfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="QualityofLifeModalLabel">Quality of Life Questionnaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="qualityOfLifeForm" method="POST">
                	@csrf
                	<input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
                	<input type="hidden" name="consultation_id" id="qol_consultation_id" value="">
                    <div class="mb-3">
				        <p class="fw-bold">MOBILITY</p>
				        <label class="form-check"><input type="radio" name="mobility" value="1" required> No problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="2"> Slight problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="3"> Moderate problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="4"> Severe problems walking</label>
				        <label class="form-check"><input type="radio" name="mobility" value="5"> Unable to walk</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">SELF-CARE</p>
				        <label class="form-check"><input type="radio" name="self_care" value="1" required> No problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="2"> Slight problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="3"> Moderate problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="4"> Severe problems washing or dressing myself</label>
				        <label class="form-check"><input type="radio" name="self_care" value="5"> Unable to wash or dress myself</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">USUAL ACTIVITIES (e.g., work, study, household, family or leisure activities)</p>
				        <label class="form-check"><input type="radio" name="usual_activities" value="1" required> No problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="2"> Slight problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="3"> Moderate problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="4"> Severe problems doing my usual activities</label>
				        <label class="form-check"><input type="radio" name="usual_activities" value="5"> Unable to do my usual activities</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">PAIN/DISCOMFORT</p>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="1" required> No pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="2"> Slight pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="3"> Moderate pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="4"> Severe pain or discomfort</label>
				        <label class="form-check"><input type="radio" name="pain_discomfort" value="5"> Extreme pain or discomfort</label>
				    </div>

				    <div class="mb-3">
				        <p class="fw-bold">ANXIETY/DEPRESSION</p>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="1" required> Not anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="2"> Slightly anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="3"> Moderately anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="4"> Very anxious or depressed</label>
				        <label class="form-check"><input type="radio" name="anxiety_depression" value="5"> Extremely anxious or depressed</label>
				    </div>

				     <div class="mb-3">
                            <label class="fw-bold">Health Today (0-100)</label>
                            <input type="number" name="health_today" class="form-control" min="0" max="100" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">ICD-10 Code</label>
                            <input type="text" name="icd_10" class="form-control" value="">
                        </div>

                    <div class="mb-3">
				        <button type="submit" class="btn btn-primary">Submit</button>
				    </div>
                </form>
            </div>
        </div>
    </div>
</div>
