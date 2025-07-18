<div class="card shadow-lg p-4 border-0">
    <!-- Flex container for heading and button -->
    <div class="d-flex justify-content-between align-items-center">
        <h5>Telemedicine Perception Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TelemedicinePerceptionModal">
            Add Telemedicine Perception
        </button>
    </div>
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
    @if($patient->telemedicinePerceptionTests()->exists())
    <table class="table table-striped mt-3">    
        <thead>
            <tr>
                <th>Date</th>
                <th>Satisfaction</th>
                <th>First Time</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patient->telemedicinePerceptionTests as $test)
            <tr>
                <td>{{ \Carbon\Carbon::parse($test->created_at)->format('M d, Y') }}</td>
                <td>{{ $test->satisfaction }}</td>
                <td>{{ $test->first_time}}</td>
                <td>
                    <button class="btn btn-info btn-sm view-details" 
                            data-date="{{ \Carbon\Carbon::parse($test->created_at)->format('M d, Y') }}"
                            data-first="{{ $test->first_time }}"
                            data-q1="{{ $test->question_1 }}"
                            data-q2="{{ $test->question_2 }}"
                            data-q3="{{ $test->question_3 }}"
                            data-q4="{{ $test->question_4 }}"
                            data-q5="{{ $test->question_5 }}"
                            data-satisfaction="{{ $test->satisfaction }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#viewTestModal">
                        View Details
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p class="text-muted text-center mt-3">No test results available.</p>
    @endif
    
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
			        <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
			        <!-- Submit Button -->
			        <button type="submit" class="btn btn-primary">Submit</button>
			    </form>
            </div>
        </div>
    </div>
</div>

<!--Telemedicine Perception View Modal -->
<div class="modal fade" id="viewTestModal" tabindex="-1" aria-labelledby="viewTestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewTestModalLabel">Telemedicine Perception Details (<strong><span id="test-date"></span></strong>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Is this the first time you are using a telemedicine app?: <strong><span id="test-first"></span></strong>  </p>
                <hr>
                <p>This method (telemedicine) gives the physician a good understanding of the patient’s health status.:  <strong><span id="test-q1"></span></strong></p>
                <hr>
                <p>This method (telemedicine) does not violate the privacy of the patient’s medical information.:  <strong><span id="test-q2"></span></strong></p>
                <hr>
                <p>This method (telemedicine) is a good addition to regular care.: <strong><span id="test-q3"></span></strong></p>
                <hr>
                <p>This method (telemedicine) saves time.: <strong><span id="test-q4"></span></strong></p>
                <hr>
                <p>I would use this method (telemedicine) in the future.: <strong><span id="test-q5"></span></strong></p>
                <hr>
                <p>Satisfaction Level: <strong><span id="test-satisfaction"></span></strong></p>
            </div>
        </div>
    </div>
</div>