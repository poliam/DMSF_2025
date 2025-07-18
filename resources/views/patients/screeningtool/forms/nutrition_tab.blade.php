<div class="card shadow-lg p-4 border-0 mx-auto mb-4" style="width: 90%; border-radius: 2rem;">

	<h5 class="border-bottom pb-2 mb-3">Nutrition Summary</h5>
	<div class="row">
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">BMR (kcal/day)</p>
			<p class="fw-bold">{{ $patient->calculateBMR() }}</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				TDEE
				<button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#tdeeModal">
					<i class="fa-solid fa-plus"></i>
				</button>
			</p>
			<p class="fw-bold" id="tdeeValue">
				{{ $patient->tdee ? $patient->tdee->tdee . ' kcal/day' : 'Not calculated yet' }}
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">Weight Loss / Gain</p>
			<p class="fw-bold">
				{{ $patient->tdee ? ($patient->tdee->tdee - 500) . " kcal / " . ($patient->tdee->tdee + 200) . " kcal" : 'Need TDEE data' }}
			</p>
		</div>
		<div class="col-4 mb-3">
			<p class="text-muted mb-1">
				Macronutrient Split 
				<button class="btn btn-light btn-sm open-macro-modal" data-patient-id="{{ $patient->id }}">
					<i class="fa-solid fa-eye"></i>
				</button>
			</p>
		</div>
		<div class="col-4 mb-3">
            <p class="text-muted mb-1">
				Meal Plan
				<button class="btn btn-light btn-sm open-meal-plan-modal" data-patient-id="{{ $patient->id }}">
					<i class="fa-solid fa-eye"></i>
				</button>
			</p>
		</div>
		<div class="col-4 mb-3">
            <p class="text-muted mb-1">
				24hrs Food Recall
				@if($patient->nutritions()->exists())
					@php $latestNutrition = $patient->nutritions()->latest()->first(); @endphp
					<button class="btn btn-warning btn-sm open-foodrecall-modal" 
						data-nutrition-id="{{ $latestNutrition->id }}" 
						data-bs-toggle="modal" 
						data-bs-target="#foodRecallModal">
						<i class="fa-solid fa-plus"></i>
					</button>
					<button class="btn btn-light btn-sm open-viewfoodrecall-modal"
						data-bs-toggle="modal" 
						data-bs-target="#ViewfoodRecallModal" 
						data-nutrition-id="{{ $latestNutrition->id }}">
						<i class="fa-solid fa-eye"></i>
					</button>
				@else
					<span class="text-muted small">No nutrition records</span>
				@endif
			</p>
		</div>
	</div>
</div>

<div class="card shadow-lg p-4 border-0">
    <div class="d-flex justify-content-between align-items-center">
        <h5>Nutrition Results</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#NutritionModal">
            Add Nutrition
        </button>
    </div>
    <div class="alert alert-info">
            <h6 class="alert-heading mb-2 font-weight-bold">Short Healthy Eating Index (SHEI-22)</h6>
            <p class="mb-2">The SHEI‑22 is a concise, 22-item dietary quality assessment tool designed to estimate individuals’ adherence to healthy eating patterns in a user-friendly and efficient manner. Developed through expert panels and decision-tree algorithms, it correlates strongly (r = 0.79) with the full Healthy Eating Index derived from 24-hour dietary recalls. SHEI‑22 also shows moderate to strong validity (r = 0.44–0.64) for key food group intake estimates. It boasts high content validity, internal consistency (Cronbach’s α ≈ 0.80–0.81), and structural validity across diverse populations including college students and international samples.</p>

            <h6 class="alert-heading mb-2 font-weight-bold">Scoring Guide</h6>
            <p class="mb-2">Total Dietary Quality Score (0-100) is calculated as:</p>
            <p class="mb-2">tot_score = total_fruits + whole_fruits + tot_veg + greens_beans + whole_grains + dairy + tot_proteins + seafood_plant + fatty_acid + refined_grains + sodium + added_sugars + sat_fat</p>
            
            <h6 class="alert-heading mb-2 font-weight-bold">ICD-10 Diagnosis</h6>
            <p class="mb-2">Z72.4 - Inappropriate Diet and Eating Habits</p>
            
            <small class="text-muted">
                For detailed scoring criteria of each food group, refer to: <br> 
                https://pmc.ncbi.nlm.nih.gov/articles/PMC7551037/table/array1/ 
            </small>
    </div>
    @if($patient->nutritions()->exists())
            <table class="table table-striped mt-3">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Score</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patient->nutritions as $nutrition)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($nutrition->created_at)->format('M d, Y') }}</td>
                        <td>{{ $nutrition->dq_score }}</td>
                        <td>
                            <button class="btn btn-info btn-sm view-nutrition-details" 
                                    data-date="{{ \Carbon\Carbon::parse($nutrition->created_at)->format('M d, Y') }}"
                                    data-fruit="{{ $nutrition->fruit }}"
                                    data-fruit_juice="{{ $nutrition->fruit_juice }}"
                                    data-vegetables="{{ $nutrition->vegetables }}"
                                    data-green_vegetables="{{ $nutrition->green_vegetables }}"
                                    data-starchy_vegetables="{{ $nutrition->starchy_vegetables }}"
                                    data-grains="{{ $nutrition->grains }}"
                                    data-grains_frequency="{{ $nutrition->grains_frequency }}"
                                    data-whole_grains="{{ $nutrition->whole_grains }}"
                                    data-whole_grains_frequency="{{ $nutrition->whole_grains_frequency }}"
                                    data-milk="{{ $nutrition->milk }}"
                                    data-milk_frequency="{{ $nutrition->milk_frequency }}"
                                    data-low_fat_milk="{{ $nutrition->low_fat_milk }}"
                                    data-low_fat_milk_frequency="{{ $nutrition->low_fat_milk_frequency }}"
                                    data-beans="{{ $nutrition->beans }}"
                                    data-nuts_seeds="{{ $nutrition->nuts_seeds }}"
                                    data-seafood="{{ $nutrition->seafood }}"
                                    data-seafood_frequency="{{ $nutrition->seafood_frequency }}"
                                    data-ssb="{{ $nutrition->ssb }}"
                                    data-ssb_frequency="{{ $nutrition->ssb_frequency }}"
                                    data-added_sugars="{{ $nutrition->added_sugars }}"
                                    data-saturated_fat="{{ $nutrition->saturated_fat }}"
                                    data-water="{{ $nutrition->water }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#viewNutritionModal">
                                View Details
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-muted text-center mt-3">No nutrition records available.</p>
        @endif
</div>

<!-- Nutritional Modal -->
<div class="modal fade" id="NutritionModal" tabindex="-1" aria-labelledby="NutritionModalabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NutritionModalLabel">Nutrition Test</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
				<!-- Nutritional Form -->
			    @include('patients.screeningtool.forms.nutrition_form')
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewNutritionModal" tabindex="-1" aria-labelledby="viewNutritionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewNutritionLabel">Nutrition Details (<strong><span id="nutrition-date"></span></strong>)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Fruit Consumption: <strong><span id="nutrition-fruit"></span></strong></p>
                <hr>
                <p>Fruit Juice Consumption: <strong><span id="nutrition-fruit-juice"></span></strong></p>
                <hr>
                <p>Vegetable Consumption: <strong><span id="nutrition-vegetables"></span></strong></p>
                <hr>
                <p>Green Vegetables: <strong><span id="nutrition-green-vegetables"></span></strong></p>
                <hr>
                <p>Starchy Vegetables: <strong><span id="nutrition-starchy-vegetables"></span></strong></p>
                <hr>
                <p>Grain Consumption: <strong><span id="nutrition-grains"></span></strong></p>
                <hr>
                <p>Grain Frequency: <strong><span id="nutrition-grains-frequency"></span></strong></p>
                <hr>
                <p>Whole Grain Consumption: <strong><span id="nutrition-whole-grains"></span></strong></p>
                <hr>
                <p>Whole Grain Frequency: <strong><span id="nutrition-whole-grains-frequency"></span></strong></p>
                <hr>
                <p>Milk Consumption: <strong><span id="nutrition-milk"></span></strong></p>
                <hr>
                <p>Milk Frequency: <strong><span id="nutrition-milk-frequency"></span></strong></p>
                <hr>
                <p>Low-Fat Milk Consumption: <strong><span id="nutrition-low-fat-milk"></span></strong></p>
                <hr>
                <p>Low-Fat Milk Frequency: <strong><span id="nutrition-low-fat-milk-frequency"></span></strong></p>
                <hr>
                <p>Beans Consumption: <strong><span id="nutrition-beans"></span></strong></p>
                <hr>
                <p>Nuts & Seeds Consumption: <strong><span id="nutrition-nuts-seeds"></span></strong></p>
                <hr>
                <p>Seafood Consumption: <strong><span id="nutrition-seafood"></span></strong></p>
                <hr>
                <p>Seafood Frequency: <strong><span id="nutrition-seafood-frequency"></span></strong></p>
                <hr>
                <p>Sugar-Sweetened Beverages: <strong><span id="nutrition-ssb"></span></strong></p>
                <hr>
                <p>SSB Frequency: <strong><span id="nutrition-ssb-frequency"></span></strong></p>
                <hr>
                <p>Added Sugars: <strong><span id="nutrition-added-sugars"></span></strong></p>
                <hr>
                <p>Saturated Fat: <strong><span id="nutrition-saturated-fat"></span></strong></p>
                <hr>
                <p>Water Consumption: <strong><span id="nutrition-water"></span></strong></p>
            </div>
        </div>
    </div>
</div>

<!-- Food Recall Modal -->
<div class="modal fade" id="foodRecallModal" tabindex="-1" aria-labelledby="foodRecallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="foodRecallModalLabel">Create Food Recall Entry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="foodRecallForm">
                    @csrf
                    <input type="hidden" id="nutrition_id" name="nutrition_id">
                    
                    <div class="mb-3">
                        <label class="form-label">Breakfast</label>
                        <textarea class="form-control" name="breakfast"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">AM Snack</label>
                        <textarea class="form-control" name="am_snack"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Lunch</label>
                        <textarea class="form-control" name="lunch"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">PM Snack</label>
                        <textarea class="form-control" name="pm_snack"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dinner</label>
                        <textarea class="form-control" name="dinner"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Midnight Snack</label>
                        <textarea class="form-control" name="midnight_snack"></textarea>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Food view Recall Modal -->
<div class="modal fade" id="ViewfoodRecallModal" tabindex="-1" aria-labelledby="ViewfoodRecallLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ViewfoodRecallLabel">Food Recall Records</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Breakfast</th>
                            <th>AM Snack</th>
                            <th>Lunch</th>
                            <th>PM Snack</th>
                            <th>Dinner</th>
                            <th>Midnight Snack</th>
                        </tr>
                    </thead>
                    <tbody id="foodRecallTableBody">
                        <tr>
                            <td colspan="7" class="text-center">No records available.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>