@php
    // Get or create consultations for this patient
    $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id);
    if (!$consultations) {
        $consultations = $patient->consultations()->orderBy('consultation_date')->take(3)->get();
    } else {
        $consultations = collect($consultations)->values();
    }
@endphp

<style>
    .active-row {
        background-color: #e3f2fd !important;
        font-weight: bold;
    }
    
    .consultation-date-input.is-loading {
        background-color: #f8f9fa;
        opacity: 0.7;
        cursor: wait;
    }
    
    .consultation-date-input.is-valid {
        border-color: #28a745;
        background-color: #d4edda;
    }
    
    .consultation-date-input.is-invalid {
        border-color: #dc3545;
        background-color: #f8d7da;
    }
</style>

<div class="row justify-content-md-center mb-4">
    <div class="col-10">
        <div class="card shadow-lg p-4 border-0">
            <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Consultation Entries</h5>
                <div class="alert alert-info mb-0 py-2 px-3" style="font-size: 0.85em;">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Dates are manually editable:</strong> Click on any date to modify consultation schedules. Changes are automatically saved.
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="consultations-table">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="50%">Date</th>
                            <th width="20%">Status</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultations as $i => $consultation)
                        <tr data-index="{{ $i }}" data-consultation-id="{{ $consultation->id }}">
                            <td>{{ $consultation->consultation_number ?? ($i + 1) }}</td>
                            <td>
                                <input type="date" class="form-control consultation-date-input" 
                                       value="{{ $consultation->consultation_date->format('Y-m-d') }}" 
                                       data-consultation-id="{{ $consultation->id }}"
                                       data-index="{{ $i }}">
                            </td>
                            <td>
                                @if($consultation->hasScreeningToolData())
                                    <span class="badge bg-success">Has Data</span>
                                @else
                                    <span class="badge bg-secondary">No Data</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm add-record-btn" 
                                        data-consultation-id="{{ $consultation->id }}"
                                        data-consultation-number="{{ $consultation->consultation_number }}"
                                        data-index="{{ $i }}">Add Record</button>
                                <span class="active-badge" style="display:none;">
                                    <span class="badge bg-info">Active</span>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="screeningtool-form-section" style="display:none;">
    <input type="hidden" id="consultation_id" name="consultation_id" value="">
    <input type="hidden" id="consultation_date" name="consultation_date" value="">
    <div class="row">
  	<div class="col-4">
    	<div class="list-group" id="list-tab" role="tablist">
		<a class="list-group-item list-group-item-action active" id="list-nutrition-list" data-bs-toggle="list" href="#list-nutrition" role="tab" aria-controls="list-nutrition">Nutrition</a>
		<a class="list-group-item list-group-item-action" id="list-PA-list" data-bs-toggle="list" href="#list-PA" role="tab" aria-controls="list-PA">Physical Activity</a>
	      	<a class="list-group-item list-group-item-action" id="list-QOL-list" data-bs-toggle="list" href="#list-QOL" role="tab" aria-controls="list-QOL">Quality of Life</a>
	      	<a class="list-group-item list-group-item-action" id="list-TP-list" data-bs-toggle="list" href="#list-TP" role="tab" aria-controls="list-TP">Telemedicine Perception Results</a>
    	</div>
  	</div>
  	<div class="col-8">
    	<div class="tab-content" id="nav-tabContent">
      		<div class="tab-pane fade" id="list-TP" role="tabpanel" aria-labelledby="list-TP-list">
      			@include('patients.screeningtool.forms.telemedicine_perception_result')
    		</div>
    		<div class="tab-pane fade show active" id="list-nutrition" role="tabpanel" aria-labelledby="list-nutrition-list">
    			@include('patients.screeningtool.forms.nutrition_tab')
    		</div>
    		<div class="tab-pane fade" id="list-QOL" role="tabpanel" aria-labelledby="list-QOL-list">
    			@include('patients.screeningtool.forms.quality_life_tab')
    		</div>
    		<div class="tab-pane fade" id="list-PA" role="tabpanel" aria-labelledby="list-PA-list">
    			@include('patients.screeningtool.forms.physical_activity_form')
    		</div>
 		</div>
	</div>
</div>
</div>

<style>
    .list-group-item {
        background-color: white; /* Change to your desired color */
        color: #1A5D77;        /* Change text color for better contrast */
        border: none;             /* Remove border for a cleaner look */
    }
    .list-group-item.active {
        background-color: rgb(26 93 119); /* Change to your desired active color */
        color: white;                   /* Change text color for better contrast */
        border-color: none;             /* Remove border for a cleaner look */
    }
    .list-group-item:hover {
        background-color: rgb(124 173 62); /* Change to your desired hover color */
        color: white;
        cursor: pointer;
        transition: background-color 0.3s ease;            /* Change text color for better contrast */
    }
</style>

<script>
  $(document).ready(function() {
        // Initialize consultation mode
        window.consultationMode = false;
        
        $('#telemedicine-perception-form').submit(function(event) {
            event.preventDefault();

            // Add consultation_id to form data
            var formData = $(this).serialize();
            var consultationId = $('#consultation_id').val();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }

            $.ajax({
                url: "{{ route('telemedicine_perception.store') }}",
                method: "POST",
                data: formData,
                success: function(response) {
                    alert("Survey submitted successfully!");
                    $('#telemedicine-perception-form')[0].reset();
                    $('#TelemedicinePerceptionModal').modal('hide');
                    // Update consultation status
                    updateConsultationStatus();
                    loadConsultationData(consultationId);
                },
                error: function(xhr) {
                    alert("An error occurred. Please try again.");
                }
            });
        });

        $('.view-details').click(function () {
            $('#test-date').text($(this).data('date'));
            $('#test-first').text($(this).data('first'));
            $('#test-q1').text($(this).data('q1'));
            $('#test-q2').text($(this).data('q2'));
            $('#test-q3').text($(this).data('q3'));
            $('#test-q4').text($(this).data('q4'));
            $('#test-q5').text($(this).data('q5'));
            $('#test-satisfaction').text($(this).data('satisfaction'));
        });

        $('#nutrition-form').submit(function (e) {
            e.preventDefault();

            // Add consultation_id to form data
            var formData = $(this).serialize();
            var consultationId = $('#consultation_id').val();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }

            $.ajax({
                url: "{{ route('nutrition.store') }}", // Define route in web.php
                type: "POST",
                data: formData,
                success: function (response) {
                    alert('Form submitted successfully!');
                    $('#nutrition-form')[0].reset();
                    $('#NutritionModal').modal('hide');
                    updateConsultationStatus();
                    loadConsultationData(consultationId);
                },
                error: function (xhr) {
                    alert('Error submitting form!');
                }
            });
        });

        // Helper function to format nutrition values for display
        function formatNutritionValue(value, type = 'serving') {
            if (!value || value === 'na') {
                return '<span class="text-muted">Not answered</span>';
            }
            
            if (value === 'none' || value === 'some' || value === 'a_lot') {
                return value.charAt(0).toUpperCase() + value.slice(1).replace('_', ' ');
            }
            
            // Convert numeric values to meaningful labels
            const servingLabels = {
                '1': '<1 serving/day',
                '2': '1 serving/day', 
                '3': '2 servings/day',
                '4': '3 servings/day',
                '5': '4 servings/day',
                '6': '5 servings/day',
                '7': '>6 servings/day'
            };
            
            const frequencyLabels = {
                '1': 'Never',
                '2': 'Rarely',
                '3': 'Sometimes',
                '4': 'Often',
                '5': 'Usually',
                '6': 'Almost always',
                '7': 'Always',
                'N/A': 'N/A'
            };
            
            if (type === 'frequency') {
                return frequencyLabels[value] || value;
            } else {
                return servingLabels[value] || value + ' servings/day';
            }
        }

        // Use event delegation for dynamically created elements
        $(document).on('click', '.view-nutrition-details', function () {
            // Get data attributes from the clicked button
            let date = $(this).data("date");
            let score = $(this).data("score");
            let fruit = $(this).data("fruit");
            let fruitJuice = $(this).data("fruit_juice");
            let vegetables = $(this).data("vegetables");
            let greenVegetables = $(this).data("green_vegetables");
            let starchyVegetables = $(this).data("starchy_vegetables");
            let grains = $(this).data("grains");
            let grainsFrequency = $(this).data("grains_frequency");
            let wholeGrains = $(this).data("whole_grains");
            let wholeGrainsFrequency = $(this).data("whole_grains_frequency");
            let milk = $(this).data("milk");
            let milkFrequency = $(this).data("milk_frequency");
            let lowFatMilk = $(this).data("low_fat_milk");
            let lowFatMilkFrequency = $(this).data("low_fat_milk_frequency");
            let beans = $(this).data("beans");
            let nutsSeeds = $(this).data("nuts_seeds");
            let seafood = $(this).data("seafood");
            let seafoodFrequency = $(this).data("seafood_frequency");
            let ssb = $(this).data("ssb");
            let ssbFrequency = $(this).data("ssb_frequency");
            let addedSugars = $(this).data("added_sugars");
            let saturatedFat = $(this).data("saturated_fat");
            let water = $(this).data("water");

            // Populate modal fields with formatted values
            $("#nutrition-date").text(date);
            $("#nutrition-score").text(score);
            $("#nutrition-fruit").html(formatNutritionValue(fruit));
            $("#nutrition-fruit-juice").html(formatNutritionValue(fruitJuice));
            $("#nutrition-vegetables").html(formatNutritionValue(vegetables));
            $("#nutrition-green-vegetables").html(formatNutritionValue(greenVegetables));
            $("#nutrition-starchy-vegetables").html(formatNutritionValue(starchyVegetables));
            $("#nutrition-grains").html(formatNutritionValue(grains));
            $("#nutrition-grains-frequency").html(formatNutritionValue(grainsFrequency, 'frequency'));
            $("#nutrition-whole-grains").html(formatNutritionValue(wholeGrains));
            $("#nutrition-whole-grains-frequency").html(formatNutritionValue(wholeGrainsFrequency, 'frequency'));
            $("#nutrition-milk").html(formatNutritionValue(milk));
            $("#nutrition-milk-frequency").html(formatNutritionValue(milkFrequency, 'frequency'));
            $("#nutrition-low-fat-milk").html(formatNutritionValue(lowFatMilk));
            $("#nutrition-low-fat-milk-frequency").html(formatNutritionValue(lowFatMilkFrequency, 'frequency'));
            $("#nutrition-beans").html(formatNutritionValue(beans));
            $("#nutrition-nuts-seeds").html(formatNutritionValue(nutsSeeds));
            $("#nutrition-seafood").html(formatNutritionValue(seafood));
            $("#nutrition-seafood-frequency").html(formatNutritionValue(seafoodFrequency, 'frequency'));
            $("#nutrition-ssb").html(formatNutritionValue(ssb));
            $("#nutrition-ssb-frequency").html(formatNutritionValue(ssbFrequency, 'frequency'));
            $("#nutrition-added-sugars").html(formatNutritionValue(addedSugars));
            $("#nutrition-saturated-fat").html(formatNutritionValue(saturatedFat));
            $("#nutrition-water").html(formatNutritionValue(water));

            // Show the modal
            $("#viewNutritionModal").modal("show");
        });

        // Open modal and set nutrition ID
	    $('.open-foodrecall-modal').on('click', function() {
	        let nutritionId = $(this).data('nutrition-id');
	        $('#nutrition_id').val(nutritionId);
	    });

	    // Handle form submission via AJAX
	    $('#foodRecallForm').on('submit', function(e) {
	        e.preventDefault();

	        $.ajax({
	            url: "{{ route('food-recall.store') }}",
	            type: "POST",
	            data: $(this).serialize(),
	            success: function(response) {
	                alert("Food Recall entry added successfully!");
	                $('#foodRecallForm')[0].reset();
	                $('#foodRecallModal').modal('hide');
	            },
	            error: function(xhr) {
	                alert("An error occurred. Please try again.");
	                console.error(xhr.responseText);
	            }
	        });
	    });

	    $(".open-viewfoodrecall-modal").click(function () {
	        let nutritionId = $(this).data("nutrition-id");

	        // Clear the table while loading
	        $("#foodRecallTableBody").html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');

	        $.ajax({
	            url: "/food-recall/" + nutritionId,
	            type: "GET",
	            success: function (response) {
	                let rows = "";

	                if (response.foodRecalls.length > 0) {
	                    response.foodRecalls.forEach(function (recall) {
	                    	let formattedDate = new Date(recall.created_at).toLocaleDateString("en-US", {
	                            month: "long", // Full month name (e.g., "March")
	                            day: "2-digit", // Two-digit day (e.g., "29")
	                            year: "numeric" // Full year (e.g., "2025")
	                        });
	                        rows += `
	                            <tr>
	                                <td>${formattedDate}</td>
	                                <td>${recall.breakfast}</td>
	                                <td>${recall.am_snack}</td>
	                                <td>${recall.lunch}</td>
	                                <td>${recall.pm_snack}</td>
	                                <td>${recall.dinner}</td>
	                                <td>${recall.midnight_snack}</td>
	                            </tr>`;
	                    });
	                } else {
	                    rows = '<tr><td colspan="7" class="text-center">No records available.</td></tr>';
	                }

	                $("#foodRecallTableBody").html(rows);
	            },
	            error: function () {
	                $("#foodRecallTableBody").html('<tr><td colspan="7" class="text-center text-danger">Error fetching data.</td></tr>');
	            }
	        });
	    });

	    // Handle form submission via AJAX
	    $('#qualityOfLifeForm').on('submit', function(e) {
	        e.preventDefault(); // Prevent default form submission

            // Add consultation_id to form data
            var formData = $(this).serialize();
            var consultationId = $('#consultation_id').val();
            if (consultationId) {
                formData += '&consultation_id=' + consultationId;
            }

	        $.ajax({
	            url: "{{ route('qualityoflife.store') }}", // Update with your actual route
	            type: "POST",
	            data: formData,
	            success: function(response) {
	                alert("Quality of Life entry added successfully!");
	                $('#qualityOfLifeForm')[0].reset();
	                $('#QualityOfLifeModal').modal('hide');
                    updateConsultationStatus();
                    loadConsultationData(consultationId);
	            },
	            error: function(xhr) {
	                alert("An error occurred. Please try again.");
	                console.error(xhr.responseText); // Log error for debugging
	            }
	        });
	    });

	    let patientId = "{{ $patient->id }}"; // Get patient ID from Blade

    // Show the screening tool form when Add Record is clicked
    $(document).on('click', '.add-record-btn', function() {
        var row = $(this).closest('tr');
        var consultationId = $(this).data('consultation-id');
        var index = $(this).data('index');
        var date = row.find('.consultation-date-input').val();
        
        // Set hidden fields in main form section
        $('#consultation_id').val(consultationId);
        $('#consultation_date').val(date);
        
        // Set consultation_id in all screening tool forms
        $('#nutrition_consultation_id').val(consultationId);
        $('#qol_consultation_id').val(consultationId);
        $('#tp_consultation_id').val(consultationId);
        $('#pa_consultation_id').val(consultationId);
        
        // Show the form
        $('#screeningtool-form-section').show();
        
        // Highlight the active row
        $('#consultations-table tbody tr').removeClass('active-row');
        $('#consultations-table .active-badge').hide();
        row.addClass('active-row');
        row.find('.active-badge').show();
        
        // Load existing data for this consultation
        loadConsultationData(consultationId);
        
        // Optionally scroll to the form
        $('html, body').animate({
            scrollTop: $('#screeningtool-form-section').offset().top
        }, 500);
    });

    // Function to load existing data for a consultation
    function loadConsultationData(consultationId) {
        // Set consultation mode flag
        window.consultationMode = true;
        // Load nutrition data
        $.get('/consultations/' + consultationId + '/nutrition', function(data) {
            updateNutritionDisplay(data);
        });
        
        // Load quality of life data
        $.get('/consultations/' + consultationId + '/quality-of-life', function(data) {
            updateQualityOfLifeDisplay(data);
        });
        
        // Load telemedicine perception data
        $.get('/consultations/' + consultationId + '/telemedicine-perception', function(data) {
            updateTelemedicineDisplay(data);
        });
        
        // Load physical activity data
        $.get('/consultations/' + consultationId + '/physical-activity', function(data) {
            updatePhysicalActivityDisplay(data);
        });
    }

    // Functions to update displays with consultation-specific data
    function updateNutritionDisplay(data) {
        var tbody = $('#nutrition-results-tbody');
        tbody.empty();
        
        if (data.length > 0) {
            $('#nutrition-data-container').show();
            $('#no-consultation-selected').hide();
            
            // Show food recall buttons and set nutrition ID for the latest record in this consultation
            let latestNutrition = data[0]; // First item is latest due to orderBy in controller
            $('#food-recall-buttons').show();
            $('#no-nutrition-for-recall').hide();
            $('#add-food-recall-btn').attr('data-nutrition-id', latestNutrition.id);
            $('#view-food-recall-btn').attr('data-nutrition-id', latestNutrition.id);
            
            // Update latest score display and interpretation
            let latestScore = latestNutrition.dq_score || 0;
            $('#latest-score-value').text(latestScore);
            
            let interpretation = '';
            let scoreClass = '';
            if (latestScore >= 80) {
                interpretation = '<span class="badge bg-success me-2">Excellent</span>Your dietary pattern aligns well with healthy eating guidelines.';
                scoreClass = 'text-success';
            } else if (latestScore >= 60) {
                interpretation = '<span class="badge bg-warning me-2">Good</span>Your diet has many healthy components with room for improvement.';
                scoreClass = 'text-warning';
            } else if (latestScore >= 40) {
                interpretation = '<span class="badge bg-warning me-2">Needs Improvement</span>Consider increasing fruits, vegetables, and whole grains while reducing processed foods.';
                scoreClass = 'text-warning';
            } else {
                interpretation = '<span class="badge bg-danger me-2">Poor</span>Significant dietary changes are recommended. Consider consulting with a nutritionist.';
                scoreClass = 'text-danger';
            }
            
            $('#latest-score-value').removeClass('text-success text-warning text-danger').addClass(scoreClass);
            $('#score-interpretation').html(interpretation);
            
            data.forEach(function(nutrition) {
                let formattedDate = new Date(nutrition.created_at).toLocaleDateString("en-US", {
                    month: "long",
                    day: "2-digit", 
                    year: "numeric"
                });
                
                let row = `
                    <tr>
                        <td>${formattedDate}</td>
                        <td>${nutrition.dq_score || 'N/A'}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-nutrition-details" 
                                    data-date="${formattedDate}"
                                    data-score="${nutrition.dq_score || 'N/A'}"
                                    data-fruit="${nutrition.fruit}"
                                    data-fruit_juice="${nutrition.fruit_juice}"
                                    data-vegetables="${nutrition.vegetables}"
                                    data-green_vegetables="${nutrition.green_vegetables}"
                                    data-starchy_vegetables="${nutrition.starchy_vegetables}"
                                    data-grains="${nutrition.grains}"
                                    data-grains_frequency="${nutrition.grains_frequency}"
                                    data-whole_grains="${nutrition.whole_grains}"
                                    data-whole_grains_frequency="${nutrition.whole_grains_frequency}"
                                    data-milk="${nutrition.milk}"
                                    data-milk_frequency="${nutrition.milk_frequency}"
                                    data-low_fat_milk="${nutrition.low_fat_milk}"
                                    data-low_fat_milk_frequency="${nutrition.low_fat_milk_frequency}"
                                    data-beans="${nutrition.beans}"
                                    data-nuts_seeds="${nutrition.nuts_seeds}"
                                    data-seafood="${nutrition.seafood}"
                                    data-seafood_frequency="${nutrition.seafood_frequency}"
                                    data-ssb="${nutrition.ssb}"
                                    data-ssb_frequency="${nutrition.ssb_frequency}"
                                    data-added_sugars="${nutrition.added_sugars}"
                                    data-saturated_fat="${nutrition.saturated_fat}"
                                    data-water="${nutrition.water}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewNutritionModal">
                                View Details
                            </button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        } else {
            $('#nutrition-data-container').hide();
            $('#no-consultation-selected').show();
            
            // Hide food recall buttons when no nutrition data
            $('#food-recall-buttons').hide();
            $('#no-nutrition-for-recall').show();
        }
    }

    function updateQualityOfLifeDisplay(data) {
        var tableBody = $("#qualityOfLifeTableBody");
        tableBody.empty();
        
        if (data.length > 0) {
            $('#qol-data-container').show();
            $('#no-qol-consultation-selected').hide();
            
            data.forEach(function(record) {
                let score = `${record.mobility}${record.self_care}${record.usual_activities}${record.pain}${record.anxiety}`;
                let row = `
                    <tr>
                        <td>${score}</td>
                        <td>${record.health_today}</td>
                        <td>${record.icd_10 ? record.icd_10 : "N/A"}</td>
                    </tr>
                `;
                tableBody.append(row);
            });
        } else {
            $('#qol-data-container').hide();
            $('#no-qol-consultation-selected').show();
        }
    }

    function updateTelemedicineDisplay(data) {
        var tbody = $('#telemedicine-results-tbody');
        tbody.empty();
        
        if (data.length > 0) {
            $('#tp-data-container').show();
            $('#no-tp-consultation-selected').hide();
            
            data.forEach(function(test) {
                let formattedDate = new Date(test.created_at).toLocaleDateString("en-US", {
                    month: "long",
                    day: "2-digit", 
                    year: "numeric"
                });
                
                let row = `
                    <tr>
                        <td>${formattedDate}</td>
                        <td>${test.satisfaction}</td>
                        <td>${test.first_time}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-details" 
                                    data-date="${formattedDate}"
                                    data-first="${test.first_time}"
                                    data-q1="${test.question_1}"
                                    data-q2="${test.question_2}"
                                    data-q3="${test.question_3}"
                                    data-q4="${test.question_4}"
                                    data-q5="${test.question_5}"
                                    data-satisfaction="${test.satisfaction}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewTestModal">
                                View Details
                            </button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        } else {
            $('#tp-data-container').hide();
            $('#no-tp-consultation-selected').show();
        }
    }

    function updatePhysicalActivityDisplay(data) {
        var tbody = $('#PhysicalActivityTable tbody');
        tbody.empty();
        
        if (data.length > 0) {
            $('#pa-data-container').show();
            $('#no-pa-consultation-selected').hide();
            
            // Calculate activity level for the latest record (first in array)
            let latestActivity = data[0];
            calculateAndDisplayActivitySummary(latestActivity.id);
            
            data.forEach(function(activity) {
                let formattedDate = new Date(activity.created_at).toLocaleDateString("en-US", {
                    month: "long",
                    day: "2-digit", 
                    year: "numeric"
                });
                
                let row = `
                    <tr>
                        <td>${activity.id}</td>
                        <td>${formattedDate}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-activity" data-id="${activity.id}">
                                View Details
                            </button>
                        </td>
                    </tr>
                `;
                tbody.append(row);
            });
        } else {
            $('#pa-data-container').hide();
            $('#no-pa-consultation-selected').show();
        }
    }

    // Function to calculate and display activity summary for latest record
    function calculateAndDisplayActivitySummary(activityId) {
        $.ajax({
            url: `/physical-activity/${activityId}`,
            method: "GET", 
            success: function(response) {
                let totalMetMinutes = 0;
                
                // Calculate total MET minutes for activities ≥4 METs
                response.details.forEach(function(detail) {
                    if (detail.met >= 4) {
                        let totalMinutesPerDay = (detail.hours * 60) + detail.minutes;
                        let metMinutesPerWeek = detail.met * totalMinutesPerDay * detail.days;
                        totalMetMinutes += metMinutesPerWeek;
                    }
                });
                
                // Determine activity level
                let activityLevel = '';
                let levelClass = '';
                let interpretation = '';
                
                if (totalMetMinutes < 600) {
                    activityLevel = 'Inactive';
                    levelClass = 'text-danger';
                    interpretation = '<span class="badge bg-danger me-2">Inactive</span>Below WHO recommendation; may benefit from moderate activity programs.';
                } else if (totalMetMinutes >= 600 && totalMetMinutes < 1500) {
                    activityLevel = 'Moderately Active';
                    levelClass = 'text-warning';
                    interpretation = '<span class="badge bg-warning me-2">Moderately Active</span>Meets basic activity guidelines; encourage maintenance/improvement.';
                } else {
                    activityLevel = 'Highly Active';
                    levelClass = 'text-success';
                    interpretation = '<span class="badge bg-success me-2">Highly Active</span>Engages in sufficient activity; maintain for health benefits.';
                }
                
                // Update display
                $('#latest-activity-level').text(activityLevel).removeClass('text-danger text-warning text-success').addClass(levelClass);
                $('#activity-interpretation').html(interpretation + `<br><small class="text-muted">Total MET·min/week: ${totalMetMinutes.toFixed(1)}</small>`);
            },
            error: function(xhr) {
                $('#latest-activity-level').text('Error');
                $('#activity-interpretation').html('<span class="text-danger">Unable to calculate activity level</span>');
            }
        });
    }

    // Function to reset all displays when no consultation is selected
    function resetAllDisplays() {
        // Reset consultation mode
        window.consultationMode = false;
        
        // Hide all data containers
        $('#nutrition-data-container').hide();
        $('#qol-data-container').hide();
        $('#tp-data-container').hide();
        $('#pa-data-container').hide();
        
        // Show all "no consultation selected" messages
        $('#no-consultation-selected').show();
        $('#no-qol-consultation-selected').show();
        $('#no-tp-consultation-selected').show();
        $('#no-pa-consultation-selected').show();
        
        // Reset food recall buttons
        $('#food-recall-buttons').hide();
        $('#no-nutrition-for-recall').show();
        
        // Reload standalone physical activity data if the function exists
        if (typeof loadPhysicalActivityData === 'function') {
            loadPhysicalActivityData();
        }
    }

    // Function to hide screening tool form and reset displays
    function hideScreeningToolForm() {
        $('#screeningtool-form-section').hide();
        $('#consultations-table tbody tr').removeClass('active-row');
        $('#consultations-table .active-badge').hide();
        resetAllDisplays();
    }

    // Initialize with no consultation selected
    $(document).ready(function() {
        resetAllDisplays();
        
        // ... rest of existing jQuery ready code ...
    });

    // Update consultation date when input is changed
    $(document).on('change', '.consultation-date-input', function() {
        var consultationId = $(this).data('consultation-id');
        var newDate = $(this).val();
        var row = $(this).closest('tr');
        var inputField = $(this);
        
        // Show loading state
        inputField.addClass('is-loading');
        inputField.prop('disabled', true);
        
        // Update the date via AJAX
        $.ajax({
            url: '/consultations/' + consultationId + '/update-date',
            method: 'POST',
            data: {
                consultation_date: newDate,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Update the hidden field if this row is active
        if (row.hasClass('active-row')) {
                    $('#consultation_date').val(newDate);
                }
                
                // Show success feedback
                inputField.removeClass('is-loading');
                inputField.addClass('is-valid');
                setTimeout(function() {
                    inputField.removeClass('is-valid');
                }, 2000);
                
                console.log('Consultation date updated successfully');
            },
            error: function(xhr) {
                console.error('Error updating consultation date:', xhr.responseText);
                inputField.removeClass('is-loading');
                inputField.addClass('is-invalid');
                setTimeout(function() {
                    inputField.removeClass('is-invalid');
                }, 3000);
            },
            complete: function() {
                inputField.prop('disabled', false);
            }
        });
    });

    // Function to update consultation status badges
    function updateConsultationStatus() {
        $('.add-record-btn').each(function() {
            var consultationId = $(this).data('consultation-id');
            var row = $(this).closest('tr');
            
            // Check if consultation has data via AJAX
            $.ajax({
                url: '/consultations/' + consultationId + '/has-screening-data',
                method: 'GET',
                success: function(response) {
                    var statusBadge = row.find('td:nth-child(3) .badge');
                    if (response.hasData) {
                        statusBadge.removeClass('bg-secondary').addClass('bg-success').text('Has Data');
                    } else {
                        statusBadge.removeClass('bg-success').addClass('bg-secondary').text('No Data');
                    }
                }
            });
        });
    }
});
</script>

