<div class="row">
  	<div class="col-4">
    	<div class="list-group" id="list-tab" role="tablist">
		<a class="list-group-item list-group-item-action active" id="list-nutrition-list" data-bs-toggle="list" href="#list-nutrition" role="tab" aria-controls="list-nutrition">Nutrition Results</a>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
        $('#telemedicine-perception-form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('telemedicine_perception.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    alert("Survey submitted successfully!");
                    $('#telemedicine-perception-form')[0].reset();
                    $('#TelemedicinePerceptionModal').modal('hide');
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

            $.ajax({
                url: "{{ route('nutrition.store') }}", // Define route in web.php
                type: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    alert('Form submitted successfully!');
                    $('#nutrition-form')[0].reset();
                    $('#NutritionModal').modal('hide');
                    location.reload(); // Refresh the page to show new data
                },
                error: function (xhr) {
                    alert('Error submitting form!');
                }
            });
        });

        $(".view-nutrition-details").click(function () {
            // Get data attributes from the clicked button
            let date = $(this).data("date");
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

            // Populate modal fields
            $("#nutrition-date").text(date);
            $("#nutrition-fruit").text(fruit);
            $("#nutrition-fruit-juice").text(fruitJuice);
            $("#nutrition-vegetables").text(vegetables);
            $("#nutrition-green-vegetables").text(greenVegetables);
            $("#nutrition-starchy-vegetables").text(starchyVegetables);
            $("#nutrition-grains").text(grains);
            $("#nutrition-grains-frequency").text(grainsFrequency);
            $("#nutrition-whole-grains").text(wholeGrains);
            $("#nutrition-whole-grains-frequency").text(wholeGrainsFrequency);
            $("#nutrition-milk").text(milk);
            $("#nutrition-milk-frequency").text(milkFrequency);
            $("#nutrition-low-fat-milk").text(lowFatMilk);
            $("#nutrition-low-fat-milk-frequency").text(lowFatMilkFrequency);
            $("#nutrition-beans").text(beans);
            $("#nutrition-nuts-seeds").text(nutsSeeds);
            $("#nutrition-seafood").text(seafood);
            $("#nutrition-seafood-frequency").text(seafoodFrequency);
            $("#nutrition-ssb").text(ssb);
            $("#nutrition-ssb-frequency").text(ssbFrequency);
            $("#nutrition-added-sugars").text(addedSugars);
            $("#nutrition-saturated-fat").text(saturatedFat);
            $("#nutrition-water").text(water);

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
	                location.reload(); // Refresh the page
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

	        $.ajax({
	            url: "{{ route('qualityoflife.store') }}", // Update with your actual route
	            type: "POST",
	            data: $(this).serialize(),
	            success: function(response) {
	                alert("Quality of Life entry added successfully!");
	                $('#qualityOfLifeForm')[0].reset();
	                $('#qualityOfLifeModal').modal('hide'); // Hide correct modal
	                location.reload(); // Refresh the page
	            },
	            error: function(xhr) {
	                alert("An error occurred. Please try again.");
	                console.error(xhr.responseText); // Log error for debugging
	            }
	        });
	    });

	    let patientId = "{{ $patient->id }}"; // Get patient ID from Blade
    	let isQOLLoaded = false; // Prevent multiple AJAX calls

	    function loadQualityOfLifeRecords() {
	        $.ajax({
	            url: "/qualityoflife/" + patientId, // Laravel route to fetch records
	            type: "GET",
	            dataType: "json",
	            success: function (response) {
	                let tableBody = $("#qualityOfLifeTableBody");
	                tableBody.empty(); // Clear previous data

	                if (response.length === 0) {
	                    tableBody.append('<tr><td colspan="3" class="text-center">No records found</td></tr>');
	                } else {
	                    response.forEach(function (record) {
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
	                }
	            },
	            error: function (xhr) {
	                console.error("Error fetching data:", xhr.responseText);
	            },
	        });
	    }

	    // Load data when the "Quality of Life" tab is clicked
	    $("#list-QOL-list").on("click", function () {
	        if (!isQOLLoaded) {
	            loadQualityOfLifeRecords();
	            isQOLLoaded = true; // Ensure it loads only once per visit
	        }
	    });
    });
</script>

