<div class="card shadow-lg p-4 border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h5>Physical Activity Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PhysicalActivityModal">
            Add Physical Activity
        </button>
    </div>
    <br/>
    <table class="table table-bordered" id="PhysicalActivityTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Date/Time Submitted</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically inserted here -->
        </tbody>
    </table>
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
			            <th style="width: 12%;">Days</th>
			            <th style="width: 12%;">Hours</th>
			            <th style="width: 12%;">Minutes</th>
			            <th style="width: 23%;">Other Value</th>
			            <th style="width: 40%;">Activity Description</th>
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
			                <input type="number" name="days[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="hours[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="minutes[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
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
			                <input type="number" name="days[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="hours[]" class="form-control" min="0">
			            </td>
			            <td>
			                <input type="number" name="minutes[]" class="form-control" min="0">
			            </td>
			            <td>
			               <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
			            </td>
			            <td>
			            	<label>Walking from house to car or bus, from car or bus to go places, from car or bus to and from the worksite</label>
			            </td>
			        </tr>
			        <tr>
					    <input type="hidden" name="met[]" value="9.3">
					    <input type="hidden" name="activity_description_id[]" value="3">
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
					        <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Bicycling for transportation, light/high effort</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.8">
					    <input type="hidden" name="activity_description_id[]" value="4">
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
					        <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Horseback riding, walking</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.8">
					    <input type="hidden" name="activity_description_id[]" value="5">
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
					        <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Motor scooter, motorcycle</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.3">
					    <input type="hidden" name="activity_description_id[]" value="6">
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
					        <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Riding in a car or bus or jeep</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.0">
					    <input type="hidden" name="activity_description_id[]" value="7">
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
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Automobile or light truck (not a semi) driving</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="8">
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
					        <input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Truck, semi, tractor, ≥1 ton, or bus, driving</label>
					    </td>
					</tr>
					<tr class="cloneable-section" data-label="Other mode of transportation:" data-activity="9">
					    <input type="hidden" name="met[]" value="0">
					    <input type="hidden" name="activity_description_id[]" value="9">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="text" name="other_value[]" class="form-control" maxlength="250"></td>
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
					        <input type="number" name="days[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="hours[]" class="form-control" min="0">
					    </td>
					    <td>
					        <input type="number" name="minutes[]" class="form-control" min="0">
					    </td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Walking for pleasure</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.0">
					    <input type="hidden" name="activity_description_id[]" value="11">
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
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Sit, watch television</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.5">
					    <input type="hidden" name="activity_description_id[]" value="12">
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
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Video game, handheld controller (light effort)</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.0">
					    <input type="hidden" name="activity_description_id[]" value="13">
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
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Sitting: reading, book, newspaper, magazine</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.0">
					    <input type="hidden" name="activity_description_id[]" value="14">
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
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td>
					        <label>Lying quietly and watching television/cellphone</label>
					    </td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="7.0">
					    <input type="hidden" name="activity_description_id[]" value="15">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Bicycling, general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.0">
					    <input type="hidden" name="activity_description_id[]" value="16">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Watering lawn or garden, standing or walking</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="17">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Weeding, cultivating garden, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="18">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Chopping wood, splitting logs, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.3">
					    <input type="hidden" name="activity_description_id[]" value="19">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Planting crops or garden, stooping, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="20">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Harvesting Produce, Picking fruit off trees, gleaning fruits, picking fruits/vegetables, climbing ladder to pick fruit, vigorous effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.0">
					    <input type="hidden" name="activity_description_id[]" value="21">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Yardwork, general, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="6.0">
					    <input type="hidden" name="activity_description_id[]" value="22">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Yardwork, general, vigorous effort</label></td>
					</tr>
					<tr class="cloneable-section" data-label="Odd Jobs:" data-activity="23">
					    <input type="hidden" name="met[]" value="0">
					    <input type="hidden" name="activity_description_id[]" value="23">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="text" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td>
					        <label>Odd Jobs:</label>
					        <button type="button" class="btn btn-sm btn-outline-primary addMore"><i class="fa-solid fa-plus"></i> Add another one</button>
					    </td>
					</tr>
					<tr class="cloneable-section" data-label="Sports:" data-activity="24">
					    <input type="hidden" name="met[]" value="0">
					    <input type="hidden" name="activity_description_id[]" value="24">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="text" name="other_value[]" class="form-control" maxlength="250"></td>
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
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Multiple household tasks all at once, light effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.3">
					    <input type="hidden" name="activity_description_id[]" value="26">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td>
					    	<input type="hidden" name="other_value[]" class="form-control" maxlength="250">
					    </td>
					    <td><label>Multiple household tasks all at once, moderate effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.3">
					    <input type="hidden" name="activity_description_id[]" value="27">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Multiple household tasks all at once, vigorous effort</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.0">
					    <input type="hidden" name="activity_description_id[]" value="28">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Sitting, child care, only active periods</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="29">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Child care, infant, general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.5">
					    <input type="hidden" name="activity_description_id[]" value="30">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Walk/run play with children, moderate, only active periods</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="5.8">
					    <input type="hidden" name="activity_description_id[]" value="31">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Walk/run play with children, vigorous, only active periods</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.3">
					    <input type="hidden" name="activity_description_id[]" value="32">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Food shopping with or without a grocery cart; carrying a 10 lb bag; standing or walking</label></td>
					</tr>
					<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Activities at School/Work</td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.8">
					    <input type="hidden" name="activity_description_id[]" value="33">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Sitting - in class, general, including note-taking or class discussion</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="34">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Standing: miscellaneous</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.5">
					    <input type="hidden" name="activity_description_id[]" value="35">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Sitting, light office work, in general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.3">
					    <input type="hidden" name="activity_description_id[]" value="36">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Sitting, computer work</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="2.5">
					    <input type="hidden" name="activity_description_id[]" value="37">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Sitting tasks, moderate effort (e.g., pushing heavy levers, riding mower/forklift, crane operation)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="1.8">
					    <input type="hidden" name="activity_description_id[]" value="38">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Standing tasks, light effort (e.g., bartending, store clerk, assembling, filing, duplicating, librarian)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.3">
					    <input type="hidden" name="activity_description_id[]" value="39">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Standing, light/moderate work (e.g., assemble/repair heavy parts, welding, stocking parts, auto repair, packing boxes, set up chairs/furniture, nursing patient care, laundry)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="40">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Standing, moderate/heavy work (e.g., lifting more than 50 lbs, masonry, painting, paper hanging)</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.5">
					    <input type="hidden" name="activity_description_id[]" value="41">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td></td>
					    <td><label>Stair climbing, slow pace</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="9.3">
					    <input type="hidden" name="activity_description_id[]" value="42">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Stair climbing, fast pace, one step at a time</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.5">
					    <input type="hidden" name="activity_description_id[]" value="43">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Descending stairs</label></td>
					</tr>
					<tr style="text-align: center; background-color: #cfcfcf;">
						<td colspan="5">Intentional Exercise</td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.8">
					    <input type="hidden" name="activity_description_id[]" value="44">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Walking, 3.5 to 3.9 mph, level, brisk, firm surface, walking for exercise</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="3.8">
					    <input type="hidden" name="activity_description_id[]" value="45">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Home exercise, general</label></td>
					</tr>
					<tr>
					    <input type="hidden" name="met[]" value="4.8">
					    <input type="hidden" name="activity_description_id[]" value="46">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="hidden" name="other_value[]" class="form-control" maxlength="250"></td>
					    <td><label>Jogging, in place</label></td>
					</tr>
					<tr class="cloneable-section" data-label="Other Exercise:" data-activity="47">
					    <input type="hidden" name="met[]" value="0">
					    <input type="hidden" name="activity_description_id[]" value="47">
					    <td><input type="number" name="days[]" class="form-control" min="0"></td>
					    <td><input type="number" name="hours[]" class="form-control" min="0"></td>
					    <td><input type="number" name="minutes[]" class="form-control" min="0"></td>
					    <td><input type="text" name="other_value[]" class="form-control" maxlength="250"></td>
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
<script type="text/javascript">
	$(document).ready(function () {
		// Add CSRF token to all AJAX requests
	    $.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
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