<div class="row">
  	<div class="col-4">
    	<div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-InformConcent-list" data-bs-toggle="list" href="#list-InformConcent" role="tab" aria-controls="list-InformConcent">Inform Consent</a>
			<a class="list-group-item list-group-item-action" id="list-InclusionCriteria-list" data-bs-toggle="list" href="#list-InclusionCriteria" role="tab" aria-controls="list-InclusionCriteria">Inclusion Criteria</a>
    	    <a class="list-group-item list-group-item-action" id="list-ExclusionCriteria-list" data-bs-toggle="list" href="#list-ExclusionCriteria" role="tab" aria-controls="list-ExclusionCriteria">Exclusion Criteria</a>
    	</div>
  	</div>
  	<div class="col-8">
    	<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="list-InformConcent" role="tabpanel" aria-labelledby="list-InformConcent-list">
				@include('patients.first_encounter.InformedConsent')
			</div>
			<div class="tab-pane fade" id="list-InclusionCriteria" role="tabpanel" aria-labelledby="list-InclusionCriteria-list">
				@include('patients.first_encounter.inclusionCriteria')
			</div>
			<div class="tab-pane fade" id="list-ExclusionCriteria" role="tabpanel" aria-labelledby="list-ExclusionCriteria-list">
				@include('patients.first_encounter.exclusionCriteria')
			</div>
    	</div>
 	</div>
</div>
<!-- Blood Sugar Modal -->
    <div class="modal fade" id="bloodSugarModal" tabindex="-1" aria-labelledby="bloodSugarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bloodSugarModalLabel">Add Blood Sugar Test</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('blood-sugar.store', $patient->id) }}" method="POST">
                        @csrf
                        <!-- Blood Sugar Result (mg/dL) -->
                        <div class="mb-3">
                            <label for="blood_sugar_mgdl" class="form-label">Blood Sugar (mg/dL)</label>
                            <input type="number" class="form-control @error('blood_sugar_mgdl') is-invalid @enderror"
                                   name="blood_sugar_mgdl" id="blood_sugar_mgdl" value="{{ old('blood_sugar_mgdl') }}"
                                   step="0.1" required>
                            @error('blood_sugar_mgdl')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Blood Sugar Result (mmol/L) -->
                        <div class="mb-3">
                            <label for="blood_sugar_mmol" class="form-label">Blood Sugar (mmol/L)</label>
                            <input type="number" class="form-control @error('blood_sugar_mmol') is-invalid @enderror"
                                   name="blood_sugar_mmol" id="blood_sugar_mmol" value="{{ old('blood_sugar_mmol') }}"
                                   step="0.01" required>
                            @error('blood_sugar_mmol')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Test Date -->
                        <div class="mb-3">
                            <label for="test_date" class="form-label">Test Date</label>
                            <input type="date" class="form-control @error('test_date') is-invalid @enderror"
                                   name="test_date" id="test_date" value="{{ old('test_date') }}" required>
                            @error('test_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Save Test Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap JavaScript (Required for Modal) -->

<!-- HbA1c Result Modal -->
	<div class="modal fade" id="addHbA1cModal" tabindex="-1" aria-labelledby="addHbA1cModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title">Add HbA1c Result</h5>
	                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
	            </div>
	            <div class="modal-body">
	                <form id="hba1cForm">
	                    @csrf
	                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

	                    <div class="mb-3">
	                        <label class="form-label">Test Date</label>
	                        <input type="date" name="date" id="date" class="form-control" required>
	                    </div>

	                    <div class="mb-3">
	                        <label class="form-label">HbA1c Level (%)</label>
	                        <input type="number" step="0.1" name="result" id="result" class="form-control" required>
	                    </div>

	                    <input type="hidden" name="test_type" value="HbA1c">

	                    <div class="modal-footer">
	                        <button type="submit" class="btn btn-primary">Save Result</button>
	                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
	                    </div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="uploadLabModal" tabindex="-1" aria-labelledby="uploadLabLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <h5 class="modal-title" id="uploadLabLabel">Upload Laboratory Result</h5>
	                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
	            </div>
	            <div class="modal-body">
	                <form id="labUploadForm" enctype="multipart/form-data">
	                    @csrf
	                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">

	                    <label class="block text-gray-700">Lab Test Type:</label>
	                    <input type="text" name="lab_type" id="lab_type" required class="mt-2 p-2 border rounded w-full" placeholder="e.g., CBC, HbA1c">
	                    <!-- Date of Procedure -->
			            <label class="block mt-3 mb-2 text-sm font-semibold">Date of Procedure:</label>
			            <input type="date" name="date_of_procedure" class="w-full border px-3 py-2 rounded focus:outline-blue-500" required>

	                    <label class="block text-gray-700 mt-3">Upload Image:</label>
	                    <input type="file" name="lab_image" id="lab_image" accept="image/*" required class="mt-2 p-2 border rounded w-full">
	                    
	                    <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded w-full">
	                        Upload
	                    </button>
	                </form>
	            </div>
	        </div>
	    </div>
</div>


	<!-- jQuery for AJAX -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
	    $(document).ready(function() {
		    $('#hba1cForm').submit(function(event) {
		        event.preventDefault(); // Prevent page reload

		        let patientId = "{{ $patient->id }}"; // Get patient ID dynamically

		        $.ajax({
		            url: `/patients/${patientId}/laboratory`, // Dynamic route
		            method: "POST",
		            data: $(this).serialize(),
		            success: function(response) {
		                if (response.success) {
		                    // Append new result row dynamically
		                    let newRow = `
		                        <tr>
		                            <td class="border border-gray-300 px-4 py-2">${response.date}</td>
		                            <td class="border border-gray-300 px-4 py-2">${response.result}%</td>
		                            <td class="border border-gray-300 px-4 py-2">${response.blood_sugar} mg/dL</td>
		                            <td class="border border-gray-300 px-4 py-2">${response.remarks}</td>
		                        </tr>
		                    `;
		                    $('#hba1cTable tbody').prepend(newRow);

		                    // Close modal and reset form
		                    $('#addHbA1cModal').modal('hide');
		                    $('#hba1cForm')[0].reset();
		                }
		            },
		            error: function(xhr) {
		                alert("Error: " + xhr.responseJSON.message);
		            }
		        });
		    });

		     $('#labUploadForm').submit(function (event) {
		        event.preventDefault(); // Prevent reload

		        let formData = new FormData(this);
		        let patientId = "{{ $patient->id }}"; 

		        $.ajax({
		            url: `/patients/${patientId}/laboratory/upload`,
		            method: "POST",
		            data: formData,
		            processData: false,
		            contentType: false,
		            success: function (response) {
		                if (response.success) {
		                    let newRow = `
		                        <tr>
		                            <td class="border px-4 py-2">${response.test_type}</td>
		                    		<td class="border px-4 py-2">${response.date}</td>
		                            <td class="border px-4 py-2">
		                                <img src="${response.image_url}" class="w-32 h-32 rounded shadow">
		                            </td>
		                        </tr>`;
		                    $('#uploadedResults').prepend(newRow);

		                    $('#uploadLabModal').modal('hide');
		                    $('#labUploadForm')[0].reset();
		                }
		            },
		            error: function (xhr) {
		                alert("Error: " + xhr.responseJSON.message);
		            }
		        });
		    });
		});
	</script>

