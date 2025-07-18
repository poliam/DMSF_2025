<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
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
        $patients = Patient::all(); // Adjust to your pagination needs

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get the latest reference number from the patients table
        $latestReference = Patient::latest('reference_number')->first();

        // Extract the numeric part of the reference number
        $referenceNumber = $latestReference ? (int) $latestReference->reference_number : 0;

        // Increment the reference number
        $numericPart = str_pad($referenceNumber + 1, 5, '0', STR_PAD_LEFT);
        $suffixPart = 'ABC'; // Default suffix

        return view('patients.create', compact('numericPart', 'suffixPart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
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
            'reference_number_number' => ['required', 'string', 'max:5'],
            'reference_number_suffix' => ['required', 'string', 'max:3'],
        ]);

        // Concatenate the numeric part and suffix to form the full reference number
        $fullReferenceNumber = $request->reference_number_number . $request->reference_number_suffix;

        // Create the patient record with the concatenated reference number
        $patient = Patient::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'birth_date' => $request->birth_date,
            'gender' => $request->gender,
            'street' => $request->street,
            'brgy_address' => $request->brgy_address,
            'address_landmark' => $request->address_landmark,
            'occupation' => $request->occupation,
            'status' => $request->status ?? 'active',
            'highest_educational_attainment' => $request->highest_educational_attainment,
            'marital_status' => $request->marital_status,
            'monthly_household_income' => $request->monthly_household_income,
            'religion' => $request->religion,
            'reference_number' => $fullReferenceNumber,
        ]);

        return redirect()->route('patients.show', $patient->id)->with('success', 'Patient added successfully!');
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
            'patientMeasurements' => function ($query) {
                $query->whereIn('tab_number', [1, 2, 3])
                    ->latest('measurement_date');
            },
            'physicalExamination'
        ]);

        $age = Carbon::parse($patient->birth_date)->age;
        $reviewOfSystems = $patient->reviewOfSystems->first();
        $today = now()->toDateString();

        // Group measurements by tab_number for efficient access
        $measurementsByTab = $patient->patientMeasurements->groupBy('tab_number');

        // Get the latest measurement for each tab
        $tab1Measurements = $measurementsByTab->get(1)?->first();
        $tab2Measurements = $measurementsByTab->get(2)?->first();
        $tab3Measurements = $measurementsByTab->get(3)?->first();

        // Set the dates for each tab (use today if no measurement exists)
        $tab1Date = $tab1Measurements?->measurement_date ?? $today;
        $tab2Date = $tab2Measurements?->measurement_date ?? $today;
        $tab3Date = $tab3Measurements?->measurement_date ?? $today;

        // Use patient data as fallback if no measurements exist
        $tab1Measurements = $tab1Measurements ?? $patient;
        $tab2Measurements = $tab2Measurements ?? $patient;
        $tab3Measurements = $tab3Measurements ?? $patient;

        $physicalExam = $patient->physicalExamination;
        return view('patients.show', [
            'patient' => $patient,
            'age' => $age,
            'reviewOfSystems' => $reviewOfSystems,
            'tab1Measurements' => $tab1Measurements,
            'tab2Measurements' => $tab2Measurements,
            'tab3Measurements' => $tab3Measurements,
            'tab1Date' => $tab1Date,
            'tab2Date' => $tab2Date,
            'tab3Date' => $tab3Date,
            'measurementDate' => $today,
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
     * Update the patient's diagnosis.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function updateDiagnosis(Request $request, Patient $patient)
    {
        $request->validate([
            'diagnosis' => 'required|string|max:1000'
        ]);

        $patient->update([
            'diagnosis' => $request->diagnosis
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Diagnosis updated successfully',
            'diagnosis' => $patient->diagnosis
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

    public function getLatestReferenceNumber()
    {
        // Get the latest reference number from the patients table
        $latestReference = Patient::latest('reference_number')->first();

        // Extract the numeric part of the reference number
        $referenceNumber = $latestReference ? (int) $latestReference->reference_number : 0;

        // Increment the reference number
        $nextReferenceNumber = str_pad($referenceNumber + 1, 5, '0', STR_PAD_LEFT);

        return response()->json(['next_reference_number' => $nextReferenceNumber]);
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

    // Tab-specific measurement update methods
    public function updateMeasurement(Request $request, Patient $patient)
    {
        $request->validate([
            'tab_number' => 'required|integer|in:1,2,3',
            'field_name' => 'required|string',
            'field_value' => 'required|string'
        ]);

        // Always find or create by patient_id and tab_number only
        $measurement = $patient->patientMeasurements()
            ->where('tab_number', $request->tab_number)
            ->first();

        if (!$measurement) {
            $measurement = new \App\Models\PatientMeasurement([
                'patient_id' => $patient->id,
                'tab_number' => $request->tab_number,
                // Optionally, set measurement_date to today or null
                'measurement_date' => now()->toDateString(),
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
        $date = $date ?: now()->toDateString();

        $measurement = $patient->getMeasurementForTab($tabNumber, $date);

        return response()->json([
            'measurement' => $measurement,
            'tab_number' => $tabNumber,
            'date' => $date
        ]);
    }

    public function updateMeasurementDate(Request $request, Patient $patient)
    {
        $request->validate([
            'tab_number' => 'required|integer|in:1,2,3',
            'old_date' => 'required|date',
            'new_date' => 'required|date'
        ]);

        // First, check if a measurement already exists for the new date and tab
        $existingMeasurement = $patient->patientMeasurements()
            ->where('tab_number', $request->tab_number)
            ->where('measurement_date', $request->new_date)
            ->first();

        if ($existingMeasurement) {
            return response()->json([
                'success' => false,
                'message' => 'A measurement already exists for this tab and date.'
            ], 422);
        }

        // Look for existing measurement with the old date
        $measurement = $patient->patientMeasurements()
            ->where('tab_number', $request->tab_number)
            ->where('measurement_date', $request->old_date)
            ->first();

        if ($measurement) {
            // Update existing measurement date
            $measurement->measurement_date = $request->new_date;
            $measurement->save();

            return response()->json([
                'success' => true,
                'message' => 'Measurement date updated successfully',
                'measurement' => $measurement
            ]);
        } else {
            // No measurement exists for this tab and old date, create a new empty record with the new date
            $measurement = new \App\Models\PatientMeasurement([
                'patient_id' => $patient->id,
                'tab_number' => $request->tab_number,
                'measurement_date' => $request->new_date
            ]);
            $measurement->save();

            return response()->json([
                'success' => true,
                'message' => 'New measurement record created for the selected date',
                'measurement' => $measurement
            ]);
        }
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
}
