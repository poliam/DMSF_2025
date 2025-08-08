<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;
use App\Models\Patient;
use Carbon\Carbon;


class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Order by creation time (most recent first), with secondary sort by id for consistency
        $patients = Patient::orderBy('created_at', 'desc')
                          ->orderBy('id', 'desc')
                          ->get();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check for duplicate submission token first
        if ($request->has('submission_token')) {
            $cacheKey = 'submission_token_' . $request->submission_token;
            
            // Check if this token was already used (stored in cache for 5 minutes)
            if (cache()->has($cacheKey)) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This form has already been submitted. Please do not submit multiple times.'
                    ], 422);
                }
                return back()->with('error', 'This form has already been submitted. Please do not submit multiple times.');
            }
            
            // Mark this token as used for 5 minutes
            cache()->put($cacheKey, true, now()->addMinutes(5));
        }

        try {
            $validatedData = $request->validate([
                'last_name' => ['required', 'string', 'max:255'],
                'first_name' => ['required', 'string', 'max:255'],
                'middle_name' => ['nullable', 'string', 'max:255'],
                'birth_date' => ['required', 'date'],
                'gender' => ['required', 'in:male,female'],
                'street' => ['required', 'string', 'max:255'],
                'brgy_address' => ['required', 'string', 'max:255'],
                'address_landmark' => ['nullable', 'string', 'max:255'],
                'occupation' => ['nullable', 'string', 'max:255'],
                'status' => ['nullable', 'in:active,inactive,pending'],
                'highest_educational_attainment' => ['required', 'string', 'max:255'],
                'marital_status' => ['required', 'string', 'max:50'],
                'monthly_household_income' => ['required', 'string', 'max:50'],
                'religion' => ['required', 'string', 'max:50'],
                'submission_token' => ['nullable', 'string'], // Add validation for submission token
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e; // Re-throw for normal form submissions
        }

        // Generate reference number with database-level concurrency handling
        $fullReferenceNumber = $this->generateReferenceNumber();

        // Create the patient record with the generated reference number
        $patient = Patient::create([
            'last_name' => $validatedData['last_name'],
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'birth_date' => $validatedData['birth_date'],
            'gender' => $validatedData['gender'],
            'street' => $validatedData['street'],
            'brgy_address' => $validatedData['brgy_address'],
            'address_landmark' => $validatedData['address_landmark'],
            'occupation' => $validatedData['occupation'],
            'status' => $validatedData['status'] ?? 'active',
            'highest_educational_attainment' => $validatedData['highest_educational_attainment'],
            'marital_status' => $validatedData['marital_status'],
            'monthly_household_income' => $validatedData['monthly_household_income'],
            'religion' => $validatedData['religion'],
            'reference_number' => $fullReferenceNumber,
        ]);

        // Clear dashboard cache since we added a new patient
        $this->clearDashboardCache();

        // Handle AJAX requests differently
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Patient added successfully!',
                'redirect' => route('patients.show', $patient->id)
            ]);
        }

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient added successfully!');
    }

    /**
     * Generate a unique reference number with proper concurrency handling
     *
     * @return string
     */
    private function generateReferenceNumber()
    {
        return DB::transaction(function () {
            // Get the latest reference number with row locking to prevent race conditions
            $latestPatient = Patient::lockForUpdate()
                ->orderBy('id', 'desc')
                ->first();

            // Extract numeric part from reference number or start from 0
            if ($latestPatient && $latestPatient->reference_number) {
                // Remove any non-numeric characters to get the numeric part
                $numericPart = (int) preg_replace('/[^0-9]/', '', $latestPatient->reference_number);
            } else {
                $numericPart = 0;
            }

            // Increment and format the reference number
            $nextNumber = $numericPart + 1;
            $formattedNumber = str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
            
            // Add default suffix
            $suffix = 'ABC';
            
            return $formattedNumber . $suffix;
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        // Use eager loading to reduce database queries
        $patient->load([
            'reviewOfSystems' => function ($query) {
                $query->latest();
            },
            'physicalExamination'
        ]);

        // Get or create consultations for this patient
        $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id);
        
        // If consultations array is returned, convert to collection
        if (is_array($consultations)) {
            $consultations = collect($consultations);
        } else {
            // Fallback to getting consultations from database
            $consultations = $patient->consultations()
                ->orderBy('consultation_number')
                ->take(3)
                ->get();
        }

        // Load patient measurements for each consultation
        $consultation1 = $consultations[0] ?? null;
        $consultation2 = $consultations[1] ?? null;
        $consultation3 = $consultations[2] ?? null;

        // Get measurements for each consultation
        $consultation1Measurement = $consultation1?->patientMeasurement ?? null;
        $consultation2Measurement = $consultation2?->patientMeasurement ?? null;
        $consultation3Measurement = $consultation3?->patientMeasurement ?? null;

        // Set consultation dates
        $consultation1Date = $consultation1?->consultation_date ?? now();
        $consultation2Date = $consultation2?->consultation_date ?? now();
        $consultation3Date = $consultation3?->consultation_date ?? now();

        // Use patient data as fallback if no measurements exist
        $consultation1Measurement = $consultation1Measurement ?? $patient;
        $consultation2Measurement = $consultation2Measurement ?? $patient;
        $consultation3Measurement = $consultation3Measurement ?? $patient;

        $age = Carbon::parse($patient->birth_date)->age;
        $reviewOfSystems = $patient->reviewOfSystems->first();
        $physicalExam = $patient->physicalExamination;
        
        return view('patients.show', [
            'patient' => $patient,
            'age' => $age,
            'reviewOfSystems' => $reviewOfSystems,
            
            // Consultation data
            'consultation1' => $consultation1,
            'consultation2' => $consultation2,
            'consultation3' => $consultation3,
            
            // Measurement data (keep variable names for compatibility)
            'tab1Measurements' => $consultation1Measurement,
            'tab2Measurements' => $consultation2Measurement,
            'tab3Measurements' => $consultation3Measurement,
            
            // Date data (keep variable names for compatibility)
            'tab1Date' => $consultation1Date,
            'tab2Date' => $consultation2Date,
            'tab3Date' => $consultation3Date,
            
            'measurementDate' => now()->toDateString(),
            'physicalExam' => $physicalExam,
            'generalSurveyData' => $physicalExam?->general_survey ?? [],
            'skinHairData' => $physicalExam?->skin_hair ?? [],
            'fingerNailsData' => $physicalExam?->finger_nails ?? [],
            'headData' => $physicalExam?->head ?? [],
            'eyesData' => $physicalExam?->eyes ?? [],
            'earData' => $physicalExam?->ear ?? [],
            'neckData' => $physicalExam?->neck ?? [],
            'backPostureData' => $physicalExam?->back_posture ?? [],
            'thoraxLungsData' => $physicalExam?->thorax_lungs ?? [],
            'cardiacExamData' => $physicalExam?->cardiac_exam ?? [],
            'abdomenData' => $physicalExam?->abdomen ?? [],
            'breastAxillaeData' => $physicalExam?->breast_axillae ?? [],
            'maleGenitaliaData' => $physicalExam?->male_genitalia ?? [],
            'femaleGenitaliaData' => $physicalExam?->female_genitalia ?? [],
            'extremitiesData' => $physicalExam?->extremities ?? [],
            'nervousSystemData' => $physicalExam?->nervous_system ?? [],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        // Split reference number into numeric and suffix parts
        $referenceNumber = $patient->reference_number;
        $referenceNumberParts = preg_split('/(?<=\d)(?=\D)/', $referenceNumber); // Split at the digit-letter boundary

        // $referenceNumberParts[0] is the numeric part
        // $referenceNumberParts[1] is the suffix part (letters)
        $numericPart = $referenceNumberParts[0] ?? ''; // Default to empty string if no match
        $suffixPart = $referenceNumberParts[1] ?? ''; // Default to empty string if no match
        echo $numericPart . "=" . $suffixPart;
        return view('patients.edit', compact('patient', 'numericPart', 'suffixPart'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'street' => 'required|string|max:255',
            'brgy_address' => 'required|string|max:255',
            'address_landmark' => 'nullable|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'highest_educational_attainment' => 'required|string|max:255',
            'marital_status' => 'required|string|max:50',
            'monthly_household_income' => 'required|string|max:50',
            'religion' => 'required|string|max:50',
        ]);

        // Manually update the record using Query Builder
        $updated = Patient::where('id', $patient->id)->update($validated);

        // Debugging: Check if update was successful
        if (!$updated) {
            return back()->with('error', 'Failed to update patient. Please try again.');
        }

        // Clear dashboard cache since patient data was updated
        $this->clearDashboardCache();

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient updated successfully');
    }


    public function getMacronutrients($patient_id)
    {
        $patient = Patient::with(['tdee', 'patientMeasurements'])->findOrFail($patient_id);
        $tdee = $patient->tdee ? $patient->tdee->tdee : null;
        $latestMeasurement = $patient->getLatestMeasurement();

        if (!$tdee) {
            return response()->json(['error' => 'TDEE data missing'], 400);
        }

        if (!$latestMeasurement || !$latestMeasurement->weight_kg) {
            return response()->json(['error' => 'Patient weight measurement missing'], 400);
        }

        // Computation
        $protein_grams = 0.8 * $latestMeasurement->weight_kg;
        $protein_calories = $protein_grams * 4;

        $fat_calories = 0.15 * $tdee;
        $fat_grams = $fat_calories / 9;

        $carbs_calories = $tdee - ($protein_calories + $fat_calories);
        $carbs_grams = $carbs_calories / 4;

        return response()->json([
            'tdee' => round($tdee, 0),
            'weight_kg' => round($latestMeasurement->weight_kg, 1),
            'protein_grams' => round($protein_grams, 1),
            'protein_calories' => round($protein_calories, 1),
            'fat_grams' => round($fat_grams, 1),
            'fat_calories' => round($fat_calories, 1),
            'carbs_grams' => round($carbs_grams, 1),
            'carbs_calories' => round($carbs_calories, 1),
        ]);
    }

    /**
     * Update the patient's diabetes status.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateDiabetesStatus(Request $request, Patient $patient)
    {
        $request->validate([
            'diabetes_status' => 'required|string|in:Not Diabetic,Prediabetes,DM Type I,DM Type II,Gestational DM,Other Hyperglycemic States,Pending'
        ]);

        $patient->update([
            'diabetes_status' => $request->diabetes_status
        ]);

        // Clear dashboard cache since diabetes status affects dashboard charts
        $this->clearDashboardCache();

        return response()->json([
            'success' => true,
            'message' => 'Diabetes Status updated successfully',
            'diabetes_status' => $patient->diabetes_status
        ]);
    }

    /**
     * Update the patient's height.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateHeight(Request $request, Patient $patient)
    {
        $request->validate([
            'height' => 'required|numeric|min:0.5|max:3.0' // Height in meters
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'height' => $request->height
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Height updated successfully',
            'height' => $latestMeasurement->height
        ]);
    }

    /**
     * Update the patient's weight.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateWeight(Request $request, Patient $patient)
    {
        $request->validate([
            'weight_kg' => 'required|numeric|min:20|max:300' // Weight in kg
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'weight_kg' => $request->weight_kg
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Weight updated successfully',
            'weight_kg' => $latestMeasurement->weight_kg
        ]);
    }

    public function updateWaist(Request $request, Patient $patient)
    {
        $request->validate([
            'waist_circumference' => 'required|numeric|min:0|max:300',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'waist_circumference' => $request->waist_circumference
        ]);

        return response()->json(['message' => 'Waist circumference updated successfully']);
    }

    public function updateHip(Request $request, Patient $patient)
    {
        $request->validate([
            'hip_circumference' => 'required|numeric|min:0|max:300',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'hip_circumference' => $request->hip_circumference
        ]);

        return response()->json(['message' => 'Hip circumference updated successfully']);
    }

    public function updateNeck(Request $request, Patient $patient)
    {
        $request->validate([
            'neck_circumference' => 'required|numeric|min:0|max:100',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'neck_circumference' => $request->neck_circumference
        ]);

        return response()->json(['message' => 'Neck circumference updated successfully']);
    }

    public function updateTemperature(Request $request, Patient $patient)
    {
        $request->validate([
            'temperature' => 'required|numeric|min:35|max:42',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'temperature' => $request->temperature
        ]);

        return response()->json(['message' => 'Temperature updated successfully']);
    }

    public function updateHeartRate(Request $request, Patient $patient)
    {
        $request->validate([
            'heart_rate' => 'required|integer|min:40|max:200',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'heart_rate' => $request->heart_rate
        ]);

        return response()->json(['message' => 'Heart rate updated successfully']);
    }

    public function updateO2Saturation(Request $request, Patient $patient)
    {
        $request->validate([
            'o2_saturation' => 'required|integer|min:70|max:100',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'o2_saturation' => $request->o2_saturation
        ]);

        return response()->json(['message' => 'O2 saturation updated successfully']);
    }

    public function updateRespiratoryRate(Request $request, Patient $patient)
    {
        $request->validate([
            'respiratory_rate' => 'required|integer|min:8|max:40',
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'respiratory_rate' => $request->respiratory_rate
        ]);

        return response()->json(['message' => 'Respiratory rate updated successfully']);
    }

    public function updateBloodPressure(Request $request, Patient $patient)
    {
        $request->validate([
            'blood_pressure' => ['required', 'string', 'regex:/^\d{2,3}\/\d{2,3}$/'],
        ]);

        // Get or create the latest measurement record
        $latestMeasurement = $patient->getLatestMeasurement();
        if (!$latestMeasurement) {
            $latestMeasurement = $patient->patientMeasurements()->create([
                'measurement_date' => now()->toDateString(),
                'tab_number' => 1, // Default to tab 1
            ]);
        }

        $latestMeasurement->update([
            'blood_pressure' => $request->blood_pressure
        ]);

        return response()->json(['message' => 'Blood pressure updated successfully']);
    }

    public function getReviewOfSystems(Patient $patient)
    {
        $review = $patient->reviewOfSystems()->latest()->first();
        return response()->json(['symptoms' => $review ? $review->symptoms : []]);
    }

    public function saveReviewOfSystems(Request $request, Patient $patient)
    {
        // Initialize empty symptoms array if none provided
        $symptoms = $request->symptoms ?? [];

        // Get the latest review of systems entry
        $review = $patient->reviewOfSystems()->latest()->first();

        if ($review) {
            // Update existing entry
            $review->update([
                'symptoms' => $symptoms
            ]);
        } else {
            // Create new entry if none exists
            $review = $patient->reviewOfSystems()->create([
                'symptoms' => $symptoms
            ]);
        }

        return response()->json(['message' => 'Review of Systems saved successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Tab-specific measurement update methods (updated for consultation system)
    public function updateMeasurement(Request $request, Patient $patient)
    {
        $request->validate([
            'tab_number' => 'required|integer|in:1,2,3',
            'field_name' => 'required|string',
            'field_value' => 'required|string'
        ]);

        // Get the consultation based on tab number (for backward compatibility)
        $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id);
        $consultationIndex = $request->tab_number - 1;
        $consultation = is_array($consultations) ? $consultations[$consultationIndex] : null;

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        // Find or create measurement for this consultation
        $measurement = $consultation->patientMeasurement;

        if (!$measurement) {
            $measurement = new \App\Models\PatientMeasurement([
                'patient_id' => $patient->id,
                'consultation_id' => $consultation->id,
                'measurement_date' => $consultation->consultation_date,
                'tab_number' => $request->tab_number, // Keep for compatibility
            ]);
        }

        $measurement->{$request->field_name} = $request->field_value;
        $measurement->save();

        return response()->json([
            'success' => true,
            'message' => ucfirst(str_replace('_', ' ', $request->field_name)) . ' updated successfully',
            'measurement' => $measurement
        ]);
    }

    public function getMeasurementsForTab(Patient $patient, $tabNumber, $date = null)
    {
        // Get consultation based on tab number
        $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id);
        $consultationIndex = $tabNumber - 1;
        $consultation = is_array($consultations) ? $consultations[$consultationIndex] : null;

        if (!$consultation) {
            return response()->json([
                'measurement' => null,
                'tab_number' => $tabNumber,
                'consultation_id' => null
            ]);
        }

        $measurement = $consultation->patientMeasurement;

        return response()->json([
            'measurement' => $measurement,
            'tab_number' => $tabNumber,
            'consultation_id' => $consultation->id,
            'consultation_date' => $consultation->consultation_date->format('Y-m-d')
        ]);
    }

    public function updateMeasurementDate(Request $request, Patient $patient)
    {
        $request->validate([
            'tab_number' => 'required|integer|in:1,2,3',
            'old_date' => 'required|date',
            'new_date' => 'required|date'
        ]);

        // Get consultation based on tab number
        $consultations = \App\Models\Consultation::ensureThreeConsultations($patient->id);
        $consultationIndex = $request->tab_number - 1;
        $consultation = is_array($consultations) ? $consultations[$consultationIndex] : null;

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        // Update the consultation date (which will also be used for measurement date)
        $consultation->update([
            'consultation_date' => $request->new_date
        ]);

        // Update measurement date if measurement exists
        $measurement = $consultation->patientMeasurement;
        if ($measurement) {
            $measurement->update([
                'measurement_date' => $request->new_date
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Consultation and measurement date updated successfully',
            'consultation' => $consultation->fresh(),
            'measurement' => $measurement?->fresh()
        ]);
    }

    public function storeDiagnostic(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnostic_date' => 'required|date',
            'tribe' => 'nullable|string|max:255',
            'requesting_physician' => 'nullable|string|max:255',
            'hematology' => 'nullable|array',
            'hematology.*' => 'string|in:hemoglobin,hematocrit,complete_blood_count,blood_typing,differential_count,bsmp',
            'clinical_microscopy' => 'nullable|array',
            'clinical_microscopy.*' => 'string|in:urinalysis,fecalysis,pregnancy_test,semenalysis',
            'blood_chemistry' => 'nullable|array',
            'blood_chemistry.*' => 'string|in:fbs_rbs,lipid_profile,serum_uric_acid,creatinine,sgpt_alt,sgot_ast,bun,hba1c,serum_electrolytes,ogtt',
            'microbiology' => 'nullable|array',
            'microbiology.*' => 'string|in:gram_stain,sputum_genexpert,koh,slit_skin_smear',
            'immunology_serology' => 'nullable|array',
            'immunology_serology.*' => 'string|in:hbsag_qualitative,syphilis_rpr_qualitative,dengue_rdt,hiv_qualitative,fecal_occult_blood_test,malaria_rdt',
            'others' => 'nullable|string|max:1000'
        ]);

        // For now, we'll just return a success response
        // You can later create a Diagnostic model and save the data to the database

        return response()->json([
            'success' => true,
            'message' => 'Diagnostic information saved successfully!',
            'data' => $request->all()
        ]);
    }

    /**
     * Save patient notes
     */
    public function saveNotes(Request $request, Patient $patient)
    {
        $request->validate([
            'field' => 'required|string|in:physician_notes,allied_health_notes,admin_notes',
            'content' => 'nullable|string'
        ]);

        $field = $request->input('field');
        $content = $request->input('content');

        // Update the specific note field
        $patient->update([
            $field => $content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Notes saved successfully!',
            'field' => $field,
            'content' => $content
        ]);
    }

    /**
     * Clear dashboard cache when patient data changes
     */
    private function clearDashboardCache()
    {
        // Clear all dashboard-related cache keys
        Cache::forget('dashboard_data');
        Cache::forget('dashboard_basic_counts');
        Cache::forget('dashboard_diabetes_data');
        Cache::forget('dashboard_demographic_data');
        
        // Clear monthly data cache for current year
        $currentYear = now()->year;
        $currentMonth = now()->month;
        Cache::forget("dashboard_monthly_data_{$currentYear}_{$currentMonth}");
        Cache::forget("dashboard_monthly_patients_{$currentYear}");
        Cache::forget("dashboard_consultation_trends_{$currentYear}");
    }
}
