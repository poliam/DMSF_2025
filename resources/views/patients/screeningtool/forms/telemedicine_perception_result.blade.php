<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Telemedicine Perception Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TelemedicinePerceptionModal">
            Add Telemedicine Perception
        </button>
    </div>
    <br>
    <div class="alert alert-info">
            <h6 class="alert-heading mb-2 font-weight-bold">Patient and Physician Satisfaction with Monitoring (PPSM-5)</h6>
            <p class="mb-2">The Patient and Physician Satisfaction with Monitoring (PPSM‑5) is a concise, validated 5-item tool derived from the original 17-item Telemedicine Perception Questionnaire (TMPQ), designed to assess satisfaction with telemonitoring systems from both patient and healthcare provider perspectives. It evaluates key aspects such as usability, integration into care, reliability, perceived benefits, and overall satisfaction. Each item is rated using a 5-point Likert scale, with total scores ranging from 5 to 25. Higher scores indicate greater satisfaction with the monitoring system. The PPSM-5 has demonstrated good internal consistency (Cronbach’s α = 0.72 for patients, 0.78 for physicians) and excellent test-retest reliability (ICC = 0.965). It is particularly useful in evaluating telehealth platforms such as remote chronic disease management systems, like those for diabetes.</p>


            <h6 class="alert-heading mb-2 font-weight-bold">Scoring Guide</h6>
            <p class="mb-2">Total score ranges from 5 to 25 (sum of all five items). Higher scores indicate greater satisfaction.</p>

            <table class="table table-sm table-bordered mb-2">
                <thead>
                    <tr>
                        <th>Score Range</th>
                        <th>Degree of Satisfaction</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>5.0 - 11</td>
                        <td>Low Satisfaction</td>
                    </tr>
                    <tr>
                        <td>12 - 18</td>
                        <td>Moderate Satisfaction</td>
                    </tr>
                    <tr>
                        <td>19 - 25</td>
                        <td>High Satisfaction</td>
                    </tr>
                </tbody>
            </table>

            <small class="text-muted">
                Note: Equal Interval Binning was manually performed by Dr. Lyka<br>
                Reference: <a class="text-primary" href="https://pmc.ncbi.nlm.nih.gov/articles/PMC8775421/" target="_blank">PMC Article</a>
            </small>
        </div>

    <!-- Consultation-specific telemedicine perception data table -->
    <div id="tp-data-container" style="display:none;">
        <h6 class="mt-4">Telemedicine Perception Records for Selected Consultation</h6>
        <table class="table table-striped mt-3" id="telemedicine-results-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Satisfaction</th>
                    <th>First Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="telemedicine-results-tbody">
                <!-- Data will be populated by JavaScript -->
            </tbody>
        </table>
    </div>

    <div id="no-tp-consultation-selected" class="alert alert-info mt-3">
        <i class="fas fa-info-circle"></i> Please select a consultation to view telemedicine perception records.
    </div>

</div>
<!-- Telemedicine Perception Modal -->
<div class="modal fade" id="TelemedicinePerceptionModal" tabindex="-1" aria-labelledby="TelemedicinePerceptionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TelemedicinePerceptionModalLabel">Telemedicine Perception Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<!-- Telemedicine Form -->
			    <form id="telemedicine-perception-form">
			        @csrf
			        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
			        <input type="hidden" name="consultation_id" id="tp_consultation_id" value="">
			        <div class="mb-3">
			            <label class="form-label">Is this the first time you are using a telemedicine app?</label>
			            <div>
			                <input type="radio" name="first_time" value="yes" required> Yes
			                <input type="radio" name="first_time" value="no"> No
			            </div>
			        </div>
			        @php
			            $questions = [
			                "This method (telemedicine) gives the physician a good understanding of the patient’s health status.",
			                "This method (telemedicine) does not violate the privacy of the patient’s medical information.",
			                "This method (telemedicine) is a good addition to regular care.",
			                "This method (telemedicine) saves time.",
			                "I would use this method (telemedicine) in the future."
			            ];
			        @endphp

			        @foreach ($questions as $index => $question)
			            <div class="mb-3">
			                <label class="form-label">{{ $index + 1 }}. {{ $question }}</label>
			                <div>
			                    @for ($i = 1; $i <= 5; $i++)
			                        <input style="margin-left: 0.5rem;" type="radio" name="question_{{ $index + 1 }}" value="{{ $i }}" required> {{ $i }}
			                        <br/>
			                    @endfor
			                </div>
			            </div>
			        @endforeach
			        <!-- Submit Button -->
			        <button type="submit" class="btn btn-primary">Submit</button>
			    </form>
            </div>
        </div>
    </div>
</div>

<!-- Telemedicine Perception View Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" aria-labelledby="viewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTestModalLabel">
                    Telemedicine Perception Details 
                    (<strong><span id="data-date"></span></strong>)
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Is this the first time you are using a telemedicine app?: 
                    <strong><span id="data-first"></span></strong>
                </p>
                <hr>
                <p>
                    This method (telemedicine) gives the physician a good understanding 
                    of the patient’s health status.:  
                    <strong><span id="data-q1"></span></strong>
                </p>
                <hr>
                <p>
                    This method (telemedicine) does not violate the privacy of the 
                    patient’s medical information.:  
                    <strong><span id="data-q2"></span></strong>
                </p>
                <hr>
                <p>
                    This method (telemedicine) is a good addition to regular care.: 
                    <strong><span id="data-q3"></span></strong>
                </p>
                <hr>
                <p>
                    This method (telemedicine) saves time.: 
                    <strong><span id="data-q4"></span></strong>
                </p>
                <hr>
                <p>
                    I would use this method (telemedicine) in the future.: 
                    <strong><span id="data-q5"></span></strong>
                </p>
                <hr>
                <p>
                    Satisfaction Level: 
                    <strong><span id="data-satisfaction"></span></strong>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    // Reusable function to populate modal data
    function populateTelemedicineModal(data) {
        $("#data-date").text(data.date);
        $("#data-first").text(data.firstTime);
        $("#data-q1").text(data.q1);
        $("#data-q2").text(data.q2);
        $("#data-q3").text(data.q3);
        $("#data-q4").text(data.q4);
        $("#data-q5").text(data.q5);
        $("#data-satisfaction").text(data.satisfaction);
    }

    $(document).on("click", ".view-details", function () {
        let modalData = {
            date: $(this).data("date"),
            firstTime: $(this).data("first"),
            q1: $(this).data("q1"),
            q2: $(this).data("q2"),
            q3: $(this).data("q3"),
            q4: $(this).data("q4"),
            q5: $(this).data("q5"),
            satisfaction: $(this).data("satisfaction")
        };
        populateTelemedicineModal(modalData);
    });
</script>