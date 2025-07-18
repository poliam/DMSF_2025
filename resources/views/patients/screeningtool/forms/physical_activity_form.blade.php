<style>
.bg-dark-blue {
    background-color: #102A3C !important;
    color: white !important;
}
</style>

<div class="card shadow-lg p-4 border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h5>Physical Activity Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PhysicalActivityModal">
            Add Physical Activity
        </button>
    </div>
    <br/>
	<div class="alert alert-info">
            <h6 class="alert-heading mb-2 font-weight-bold">Short Questionnaire to Assess Health-Enhancing Physical Activity (SQUASH-4)</h6>
            <p class="mb-2">The SQUASH‑4 is a streamlined version of the Dutch‑developed SQUASH questionnaire, focusing on four key activity domains: commuting, leisure-time/sport, household and work‑related activities. It captures frequency (days/week), duration (minutes/day), and intensity to estimate weekly physical activity scores in MET‑minutes. Validation studies among healthy adults and clinical populations (e.g., total hip arthroplasty patients) report test–retest reliability with Spearman/ICC values of approximately 0.57–0.67, and moderate criterion validity (correlation r ≈ 0.45 with accelerometer data). This makes SQUASH‑4 a practical tool for healthcare screening and monitoring in community and clinical settings.</p>
			<br>
            <h6 class="alert-heading mb-2 font-weight-bold">MET (Metabolic Equivalent)</h6>
            <p class="mb-2"> The ratio of the work metabolic rate to the resting metabolic rate. One MET is defined as 1 kcal/kg/hour and is roughly equivalent to the energy cost of sitting quietly. A MET also is defined as oxygen uptake in ml/kg/min with one MET equal to the oxygen cost of sitting quietly, equivalent to 3.5 ml/kg/mi </p>
            <br>
            <h6 class="alert-heading mb-2 font-weight-bold">Scoring Guide</h6>
            <p class="mb-2">Calculate MET minutes per week for moderate activities (≥4 METs):</p>
            <p class="mb-2">MET min/week = MET value × minutes per day × days per week</p>
            <p class="mb-2">Total MET min/week = Sum of all activity MET minutes</p>
            <br>
            <small class="text-muted">
                For activities not listed, refer to the <a href="https://pacompendium.com/wp-content/uploads/2024/03/4_2024_adult-compendium-tracking-guide-1-2024.pdf" target="_blank">2024 Compendium of Physical Activities</a> <br> 
				Link: https://pmc.ncbi.nlm.nih.gov/articles/PMC5214219/ <br> 
				https://www.physio-pedia.com/images/c/c7/Quidelines_for_interpreting_the_IPAQ.pdf?utm_source=chatgpt.com <br> 
				https://wiki-lifelines.web.rug.nl/doku.php?id=physical_activity_squash&utm_source=chatgpt.com <br> 
				https://research.rug.nl/en/publications/physical-activity-and-cardiometabolic-health-focus-on-domain-spec <br> 
				https://pure.rug.nl/ws/portalfiles/portal/112903517/Chapter_7.pdf <br> 
            </small>
        </div>
        
    <!-- Physical Activity Results Table -->
    <div class="table-responsive">
        <table class="table table-striped" id="PhysicalActivityTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be loaded via JavaScript -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="PhysicalActivityModal" tabindex="-1" aria-labelledby="PhysicalActivityModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form id="PhysicalActivityFormAdd">
       	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
        <div class="modal-header">
          <h5 class="modal-title" id="PhysicalActivityModalLabel">Add Physical Activity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          	<table class="table table-bordered align-middle">
			    <thead>
			        <tr>
			            <th style="width: 8%;">MET</th>
			            <th style="width: 15%;">Days</th>
			            <th style="width: 15%;">Hours</th>
			            <th style="width: 15%;">Minutes</th>
			            <th style="width: 47%;">Activity Description</th>
			        </tr>
			    </thead>
			    <tbody>
			    	<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Commuting Activities</td>
					</tr>
			        <tr>
			            {{-- Hidden MET --}}
			            <input type="hidden" name="met[]" value="3.5">
			            <input type="hidden" name="activity_description_id[]" value="1">

			            <td>
			                <span class="fw-bold text-primary">3.5</span>
			            </td>
			            <td>
			                <input type="number" name="days[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="hours[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="minutes[]" class="form-control" min="0">
			            </td>
			            <td>
			            	<label>Walking, to work or class</label>
			            </td>
			        </tr>
			        <tr>
			            {{-- Hidden MET --}}
			            <input type="hidden" name="met[]" value="3.5">
			            <input type="hidden" name="activity_description_id[]" value="2">
			            <td>
			                <span class="fw-bold text-primary">3.5</span>
			            </td>
			            <td>
			                <input type="number" name="days[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="hours[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="minutes[]" class="form-control" min="0">
			            </td>
			            
			            <td>
			            	<label>Walking from house to car or bus, from car or bus to go places, from car or bus to and from the worksite</label>
			            </td>
			        </tr>
			        <tr>
					    <input type="hidden" name="met[]" value="9.3">
					    <input type="hidden" name="activity_description_id[]" value="3">
						<td class="bg-warning">
					        <span class="fw-bold text-primary">9.3</span>
						</td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>
					    <td>
					        <label>Bicycling for transportation, light/high effort</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.8">
					    <input type="hidden" name="activity_description_id[]" value="4">
					    <td>
					        <span class="fw-bold text-primary">3.8</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>
					    <td>
					        <label>Horseback riding, walking</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.8">
					    <input type="hidden" name="activity_description_id[]" value="5">
					    <td>
					        <span class="fw-bold text-primary">2.8</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>
					    
					    <td>
					        <label>Motor scooter, motorcycle</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.3">
					    <input type="hidden" name="activity_description_id[]" value="6">
					    <td>
					        <span class="fw-bold text-primary">1.3</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>
					    
					    <td>
					        <label>Riding in a car or bus or jeep</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.0">
					    <input type="hidden" name="activity_description_id[]" value="7">
					    <td>
					        <span class="fw-bold text-primary">2.0</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>

					    <td>
					        <label>Automobile or light truck (not a semi) driving</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="8">
					    <td>
					        <span class="fw-bold text-primary">2.5</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>
					    
					    <td>
					        <label>Truck, semi, tractor, ≥1 ton, or bus, driving</label>
					    </td>
					</tr>
					<tr class="cloneable-section" data-label="Other mode of transportation:" data-activity="9">
					    <td><input name="met[]" value="0"></td>
					    <input type="hidden" name="activity_description_id[]" value="9">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    
					    <td>
					        <label>Other mode of transportation:</label>
					        <button type="button" class="btn btn-sm btn-outline-primary addMore"><i class="fa-solid fa-plus"></i> Add another one</button>
					    </td>
					</tr>
					<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Leisure Time Activities</td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.5">
					    <input type="hidden" name="activity_description_id[]" value="10">
					    <td>
					        <span class="fw-bold text-primary">3.5</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>

					    <td>
					        <label>Walking for pleasure</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.0">
					    <input type="hidden" name="activity_description_id[]" value="11">
					    <td>
					        <span class="fw-bold text-primary">1.0</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>

					    <td>
					        <label>Sit, watch television</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.5">
					    <input type="hidden" name="activity_description_id[]" value="12">
					    <td>
					        <span class="fw-bold text-primary">1.5</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>

					    <td>
					        <label>Video game, handheld controller (light effort)</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.0">
					    <input type="hidden" name="activity_description_id[]" value="13">
					    <td>
					        <span class="fw-bold text-primary">1.0</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>

					    <td>
					        <label>Sitting: reading, book, newspaper, magazine</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.0">
					    <input type="hidden" name="activity_description_id[]" value="14">
					    <td>
					        <span class="fw-bold text-primary">1.0</span>
					    </td>
					    <td>
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>

					    <td>
					        <label>Lying quietly and watching television/cellphone</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="7.0">
					    <input type="hidden" name="activity_description_id[]" value="15">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">7.0</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Bicycling, general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.0">
					    <input type="hidden" name="activity_description_id[]" value="16">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.0</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Watering lawn or garden, standing or walking</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="17">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Weeding, cultivating garden, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="18">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Chopping wood, splitting logs, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.3">
					    <input type="hidden" name="activity_description_id[]" value="19">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.3</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Planting crops or garden, stooping, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="20">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Harvesting Produce, Picking fruit off trees, gleaning fruits, picking fruits/vegetables, climbing ladder to pick fruit, vigorous effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.0">
					    <input type="hidden" name="activity_description_id[]" value="21">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.0</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Yardwork, general, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="6.0">
					    <input type="hidden" name="activity_description_id[]" value="22">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">6.0</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Yardwork, general, vigorous effort</label></td>
					</tr>
					<tr class="cloneable-section" data-label="Odd Jobs:" data-activity="23">
					    <td><input name="met[]" value="0"></td>
					    <input type="hidden" name="activity_description_id[]" value="23">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    
					    <td>
					        <label>Odd Jobs:</label>
					        <button type="button" class="btn btn-sm btn-outline-primary addMore"><i class="fa-solid fa-plus"></i> Add another one</button>
					    </td>
					</tr>
					<tr class="cloneable-section" data-label="Sports:" data-activity="24">
					    <td><input name="met[]" value="0"></td>
					    <input type="hidden" name="activity_description_id[]" value="24">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    
					    <td>
					        <label>Sports:</label>
					        <button type="button" class="btn btn-sm btn-outline-primary addMore"><i class="fa-solid fa-plus"></i> Add another one</button>
					    </td>
					</tr>
					<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Household Activities</td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.8">
					    <input type="hidden" name="activity_description_id[]" value="25">
					    <td>
					        <span class="fw-bold text-primary">2.8</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Multiple household tasks all at once, light effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.3">
					    <input type="hidden" name="activity_description_id[]" value="26">
					    <td>
					        <span class="fw-bold text-primary">3.3</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Multiple household tasks all at once, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.3">
					    <input type="hidden" name="activity_description_id[]" value="27">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.3</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Multiple household tasks all at once, vigorous effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.0">
					    <input type="hidden" name="activity_description_id[]" value="28">
					    <td>
					        <span class="fw-bold text-primary">2.0</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Sitting, child care, only active periods</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="29">
						<td>
					        <span class="fw-bold text-primary">2.5</span>
						</td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Child care, infant, general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.5">
					    <input type="hidden" name="activity_description_id[]" value="30">
						<td>
					        <span class="fw-bold text-primary">3.5</span>
						</td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Walk/run play with children, moderate, only active periods</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="5.8">
					    <input type="hidden" name="activity_description_id[]" value="31">
						<td class="bg-dark-blue">
					        <span class="fw-bold text-primary">5.8</span>
						</td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Walk/run play with children, vigorous, only active periods</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.3">
					    <input type="hidden" name="activity_description_id[]" value="32">
						<td>
					        <span class="fw-bold text-primary">3.3</span>
						</td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Food shopping with or without a grocery cart; carrying a 10 lb bag; standing or walking</label></td>
					</tr>
					<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Activities at School/Work</td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.8">
					    <input type="hidden" name="activity_description_id[]" value="33">
					    <td>
					        <span class="fw-bold text-primary">1.8</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Sitting - in class, general, including note-taking or class discussion</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="34">
					    <td>
					        <span class="fw-bold text-primary">2.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Standing: miscellaneous</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.5">
					    <input type="hidden" name="activity_description_id[]" value="35">
					    <td>
					        <span class="fw-bold text-primary">1.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Sitting, light office work, in general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.3">
					    <input type="hidden" name="activity_description_id[]" value="36">
					    <td>
					        <span class="fw-bold text-primary">1.3</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Sitting, computer work</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="37">
					    <td>
					        <span class="fw-bold text-primary">2.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Sitting tasks, moderate effort (e.g., pushing heavy levers, riding mower/forklift, crane operation)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.8">
					    <input type="hidden" name="activity_description_id[]" value="38">
					    <td>
					        <span class="fw-bold text-primary">1.8</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Standing tasks, light effort (e.g., bartending, store clerk, assembling, filing, duplicating, librarian)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.3">
					    <input type="hidden" name="activity_description_id[]" value="39">
					    <td>
					        <span class="fw-bold text-primary">3.3</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Standing, light/moderate work (e.g., assemble/repair heavy parts, welding, stocking parts, auto repair, packing boxes, set up chairs/furniture, nursing patient care, laundry)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="40">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Standing, moderate/heavy work (e.g., lifting more than 50 lbs, masonry, painting, paper hanging)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="41">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><label>Stair climbing, slow pace</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="9.3">
					    <input type="hidden" name="activity_description_id[]" value="42">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">9.3</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Stair climbing, fast pace, one step at a time</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.5">
					    <input type="hidden" name="activity_description_id[]" value="43">
					    <td>
					        <span class="fw-bold text-primary">3.5</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Descending stairs</label></td>
					</tr>
					<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Intentional Exercise</td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.8">
					    <input type="hidden" name="activity_description_id[]" value="44">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.8</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Walking, 3.5 to 3.9 mph, level, brisk, firm surface, walking for exercise</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.8">
					    <input type="hidden" name="activity_description_id[]" value="45">
					    <td>
					        <span class="fw-bold text-primary">3.8</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Home exercise, general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.8">
					    <input type="hidden" name="activity_description_id[]" value="46">
					    <td class="bg-dark-blue">
					        <span class="fw-bold text-primary">4.8</span>
					    </td>
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>

					    <td><label>Jogging, in place</label></td>
					</tr>
					<tr class="cloneable-section" data-label="Other Exercise:" data-activity="47">
					    <td><input name="met[]" value="0"></td>
					    <input type="hidden" name="activity_description_id[]" value="47">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    
					    <td>
					        <label>Other Exercise:</label>
					        <button type="button" class="btn btn-sm btn-outline-primary addMore">
					            <i class="fa-solid fa-plus"></i> Add another one
					        </button>
					    </td>
					</tr>
			    </tbody>
			</table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="submitBtn">Save</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Physical Activity Details Modal -->
<div class="modal fade" id="PhysicalActivityDetailsModal" tabindex="-1" aria-labelledby="PhysicalActivityDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="PhysicalActivityDetailsModalLabel">Physical Activity Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Activity</th>
                <th>MET</th>
                <th>Days/Week</th>
                <th>Hours</th>
                <th>Minutes</th>
                <th>MET·min/week</th>
              </tr>
            </thead>
            <tbody id="activityDetailsTableBody">
              <!-- Activity details will be populated here -->
            </tbody>
          </table>
        </div>
        <div class="mt-3">
          <h6>Summary:</h6>
          <p id="activitySummary" class="mb-0"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		// Add CSRF token to all AJAX requests
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    });

	    // Load physical activity data when page loads
	    loadPhysicalActivityData();

	    function loadPhysicalActivityData() {
	        $.ajax({
	            url: "{{ route('physical-activity.get_lists') }}",
	            method: "GET",
	            success: function(response) {
	                let tableBody = $('#PhysicalActivityTable tbody');
	                tableBody.empty();
	                
	                if (response.length > 0) {
	                    response.forEach(function(activity) {
	                        let row = `
	                            <tr>
	                                <td>${activity.id}</td>
	                                <td>${new Date(activity.created_at).toLocaleString()}</td>
	                                <td>
	                                    <button class="btn btn-info btn-sm view-activity" data-id="${activity.id}">
	                                        View Details
	                                    </button>
	                                </td>
	                            </tr>
	                        `;
	                        tableBody.append(row);
	                    });
	                } else {
	                    tableBody.append('<tr><td colspan="3" class="text-center">No physical activity records found.</td></tr>');
	                }
	            },
	            error: function(xhr) {
	                console.log('Error loading physical activity data:', xhr);
	                $('#PhysicalActivityTable tbody').html('<tr><td colspan="3" class="text-center text-danger">Error loading data.</td></tr>');
	            }
	        });
	    }

	    // View activity details
	    $(document).on('click', '.view-activity', function() {
	        let activityId = $(this).data('id');
	        
	        $.ajax({
	            url: `/physical-activity/${activityId}`,
	            method: "GET",
	            success: function(response) {
	                // Clear previous data
	                $('#activityDetailsTableBody').empty();
	                
	                let totalMetMinutes = 0;
	                let moderateActivities = 0;
	                
	                // Populate table with activity details
	                response.details.forEach(function(detail) {
	                    // Only process activities with MET ≥4
	                    if (detail.met >= 4) {
	                        // Calculate MET·min/week = MET × minutes per day × days per week
	                        let totalMinutesPerDay = (detail.hours * 60) + detail.minutes;
	                        let metMinutesPerWeek = detail.met * totalMinutesPerDay * detail.days;
	                        totalMetMinutes += metMinutesPerWeek;
	                        moderateActivities += metMinutesPerWeek;
	                        
	                        let row = `
	                            <tr>
	                                <td>${detail.description.name || 'N/A'}</td>
	                                <td><span class="fw-bold text-warning">${detail.met}</span></td>
	                                <td>${detail.days}</td>
	                                <td>${detail.hours}</td>
	                                <td>${detail.minutes}</td>
	                                <td><strong>${metMinutesPerWeek.toFixed(1)}</strong></td>
	                            </tr>
	                        `;
	                        $('#activityDetailsTableBody').append(row);
	                    }
	                });
	                
	                // Update summary
	                let summaryText = `
	                    <strong>Total MET·min/week (≥4 METs only):</strong> ${totalMetMinutes.toFixed(1)}<br>
	                    <strong>Moderate to Vigorous Activities (≥4 METs):</strong> ${moderateActivities.toFixed(1)} MET·min/week<br>
	                    <strong>Number of Activities (≥4 METs):</strong> ${$('#activityDetailsTableBody tr').length}
	                `;
	                $('#activitySummary').html(summaryText);
	                
	                // Show the modal
	                $('#PhysicalActivityDetailsModal').modal('show');
	            },
	            error: function(xhr) {
	                alert('Error loading activity details.');
	            }
	        });
	    });

	    // Add More
	    $(document).on('click', '.addMore', function (e) {
	        e.preventDefault();

	        const $currentRow = $(this).closest('.cloneable-section');
	        const label = $currentRow.data('label');
	        const activityId = $currentRow.data('activity');

	        const $newRow = $currentRow.clone();

	        // Reset values
	        $newRow.find('input').each(function () {
	            $(this).val('');
	        });

	        // Update hidden input if needed
	        $newRow.find('input[name="activity_description_id[]"]').val(activityId);

	        // Replace Add button with Remove button
	        $newRow.find('.addMore').remove();
	        $newRow.find('td:last').html(`
	            <label>${label}</label>
	            <button type="button" class="btn btn-sm btn-outline-danger removeRow mt-1">
	                <i class="fa-solid fa-minus"></i> Remove
	            </button>
	        `);

	        $newRow.insertAfter($currentRow);
	    });

	    // Remove Row
	    $(document).on('click', '.removeRow', function () {
	        $(this).closest('tr').remove();
	    });

	    $('#submitBtn').on('click', function (e) {
	        e.preventDefault();

	        const form = $('#PhysicalActivityFormAdd');
	        const url = "{{ route('physical-activity.store') }}"; // Adjust route if needed
	        // console.log(form.serializeArray());

	        $.ajax({
	            type: "POST",
	            url: url,
	            data: form.serialize(),
	            success: function (response) {
	                alert('Physical activity data saved successfully!');
	                $('#PhysicalActivityModal').modal('hide');
	                form[0].reset();
	                // Reload the table data after successful submission
	                loadPhysicalActivityData();
	            },
	            error: function (xhr) {
	                let errors = xhr.responseJSON?.errors;
	                if (errors) {
	                    let message = Object.values(errors).map(err => err.join(', ')).join('\n');
	                    alert('Validation error:\n' + message);
	                } else {
	                    alert('Something went wrong. Please try again.');
	                }
	            }
	        });
	    });


	});


</script>