<?php

namespace App\Http\Controllers;

use App\Models\ComprehensiveHistory;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComprehensiveHistoryController extends Controller
{
    public function show(Patient $patient)
    {
        $comprehensiveHistory = $patient->comprehensiveHistory()->first();
        return view('patients.comprehensive_history.comprehensive_history', compact('patient', 'comprehensiveHistory'));
    }

    public function get(Patient $patient)
    {
        $comprehensiveHistory = $patient->comprehensiveHistory;
        return response()->json($comprehensiveHistory);
    }

    public function store(Request $request, Patient $patient)
    {
        $validator = Validator::make($request->all(), [
            'informant' => 'nullable|array',
            'informant_other' => 'nullable|string',
            'percent_reliability' => 'nullable|integer|min:0|max:100',
            'chief_concern' => 'nullable|string',
            'history_present_illness' => 'nullable|string',
            'childhood_illness' => 'nullable|array',
            'completed_vaccinations' => 'nullable|boolean',
            'adult_illness' => 'nullable|array',
            'other_conditions' => 'nullable|array',
            'family_illness' => 'nullable|array',
            'family_other_conditions' => 'nullable|array',
            'food_allergies' => 'nullable|string',
            'drug_allergies' => 'nullable|string',
            'medications' => 'nullable|string',
            'hospitalization' => 'nullable|array',
            'surgical_history' => 'nullable|array',
            'covid_vaccination' => 'nullable|array',
            'other_vaccinations' => 'nullable|array',
            'lmp' => 'nullable|date',
            'pmp' => 'nullable|date',
            'ob_g' => 'nullable|string',
            'ob_p' => 'nullable|string',
            'ob_t' => 'nullable|string',
            'ob_p2' => 'nullable|string',
            'ob_a' => 'nullable|string',
            'ob_l' => 'nullable|string',
            'menarche' => 'nullable|string',
            'menstrual_interval' => 'nullable|string',
            'menstrual_duration' => 'nullable|string',
            'menstrual_pads' => 'nullable|integer|min:0',
            'menstrual_amount' => 'nullable|string',
            'menstrual_symptoms' => 'nullable|array',
            'coitarche' => 'nullable|string',
            'pap_smear' => 'nullable|string',
            'contraceptive_methods' => 'nullable|array',
            'contraceptive_other' => 'nullable|string',
            'contraceptive_pills_details' => 'nullable|string',
            'contraceptive_depo_details' => 'nullable|string',
            'contraceptive_implant_details' => 'nullable|string',
            'psychiatric_illness' => 'nullable|array',
            'psychiatric_others_details' => 'nullable|string',
            'cigarette_user' => 'nullable|boolean',
            'cigarette_year_started' => 'nullable|string',
            'cigarette_year_discontinued' => 'nullable|string',
            'current_smoker' => 'nullable|boolean',
            'sticks_per_day' => 'nullable|integer|min:0',
            'years_smoking' => 'nullable|integer|min:0',
            'pack_years' => 'nullable|numeric|min:0',
            'alcohol_drinker' => 'nullable|boolean',
            'alcohol_year_started' => 'nullable|string',
            'alcohol_year_discontinued' => 'nullable|string',
            'current_drinker' => 'nullable|boolean',
            'alcohol_type' => 'nullable|string',
            'alcohol_sd' => 'nullable|integer|min:0',
            'alcohol_frequency' => 'nullable|string',
            'drug_user' => 'nullable|boolean',
            'drug_type' => 'nullable|string',
            'drug_year_started' => 'nullable|string',
            'drug_year_discontinued' => 'nullable|string',
            'current_drug_user' => 'nullable|boolean',
            'coffee_user' => 'nullable|boolean',
            'coffee_type' => 'nullable|string',
            'coffee_amount' => 'nullable|string',
            'coffee_cups' => 'nullable|string',
            'alternative_therapies' => 'nullable|array',
            'therapy_other' => 'nullable|string',
            'schooling' => 'nullable|string',
            'job_history' => 'nullable|string',
            'financial_situation' => 'nullable|string',
            'marriage_children' => 'nullable|string',
            'home_situation' => 'nullable|string',
            'daily_activities' => 'nullable|string',
            'environment' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Process hospitalization data
            $hospitalizationData = [];
            if ($request->has('hospitalization_year')) {
                foreach ($request->hospitalization_year as $key => $year) {
                    if (!empty($year)) {
                        $hospitalizationData[] = [
                            'year' => $year,
                            'diagnosis' => $request->hospitalization_diagnosis[$key] ?? null,
                            'notes' => $request->hospitalization_notes[$key] ?? null,
                        ];
                    }
                }
            }

            // Process surgical history data
            $surgicalHistoryData = [];
            if ($request->has('surgical_year')) {
                foreach ($request->surgical_year as $key => $year) {
                    if (!empty($year)) {
                        $surgicalHistoryData[] = [
                            'year' => $year,
                            'diagnosis' => $request->surgical_diagnosis[$key] ?? null,
                            'procedure' => $request->surgical_procedure[$key] ?? null,
                            'biopsy' => $request->surgical_biopsy[$key] ?? null,
                            'notes' => $request->surgical_notes[$key] ?? null,
                        ];
                    }
                }
            }

            // Process childhood illness data
            $childhoodIllnessData = [];
            if ($request->has('childhood_illness')) {
                foreach ($request->childhood_illness as $illness) {
                    $childhoodIllnessData[$illness] = [
                        'year' => $request->input("{$illness}_year"),
                        'complications' => $request->input("{$illness}_complications") ?? $request->input("{$illness}_other_information"),
                    ];
                }
            }

            // Process adult illness details
            $adultIllnessDetails = [];
            foreach (['hypertension', 'diabetes', 'bronchial_asthma'] as $illness) {
                if ($request->has('adult_illness') && in_array($illness, $request->adult_illness)) {
                    $prefix = ($illness === 'bronchial_asthma') ? 'asthma' : $illness;
                    $adultIllnessDetails["{$prefix}_type"] = $request->input("{$prefix}_type");
                    $adultIllnessDetails["{$prefix}_stage"] = $request->input("{$prefix}_stage");
                    $adultIllnessDetails["{$prefix}_control"] = $request->input("{$prefix}_control");
                    $adultIllnessDetails["{$prefix}_year"] = $request->input("{$prefix}_year");
                    $adultIllnessDetails["{$prefix}_med_status"] = $request->input("{$prefix}_med_status");
                    $adultIllnessDetails["{$prefix}_medications"] = $request->input("{$prefix}_medications");
                    $adultIllnessDetails["{$prefix}_compliance"] = $request->input("{$prefix}_compliance");
                    $adultIllnessDetails["{$prefix}_insulin"] = $request->input("{$prefix}_insulin");
                }
            }

            // Process family illness details
            $familyIllnessDetails = [];
            foreach (['hypertension', 'diabetes', 'asthma', 'cancer'] as $illness) {
                if ($request->has('family_illness') && in_array($illness, $request->family_illness)) {
                    $familyIllnessDetails["{$illness}_relation"] = $request->input("{$illness}_relation");
                    $familyIllnessDetails["{$illness}_side"] = $request->input("{$illness}_side");
                    $familyIllnessDetails["{$illness}_family_year"] = $request->input("{$illness}_family_year");
                    $familyIllnessDetails["{$illness}_family_medications"] = $request->input("{$illness}_family_medications");
                    $familyIllnessDetails["{$illness}_family_status"] = $request->input("{$illness}_family_status");
                }
            }

            // Process other condition details
            $otherConditionDetails = [];
            foreach (['cancer', 'dyslipidemia', 'neurologic', 'liver', 'kidney', 'other_condition'] as $condition) {
                $otherConditionDetails["{$condition}_details"] = $request->input("{$condition}_details");
            }

            // Process family other condition details
            $familyOtherConditionDetails = [];
            foreach (['dyslipidemia', 'neurologic', 'liver', 'kidney', 'other'] as $condition) {
                $familyOtherConditionDetails["family_{$condition}_details"] = $request->input("family_{$condition}_details");
            }

            // Process vaccination data
            $covidVaccination = [
                'year' => $request->covid_year,
                'brand' => $request->covid_brand,
                'boosters' => $request->covid_boosters,
            ];

            $otherVaccinations = [
                'pcv' => $request->pcv_vaccine,
                'flu' => $request->flu_vaccine,
                'hepb' => $request->hepb_vaccine,
                'hpv' => $request->hpv_vaccine,
                'others' => $request->other_vaccines,
            ];

            // Create or update comprehensive history
            $comprehensiveHistory = $patient->comprehensiveHistory()->updateOrCreate(
                ['patient_id' => $patient->id],
                array_merge(
                    $request->except([
                        'hospitalization_year',
                        'hospitalization_diagnosis',
                        'hospitalization_notes',
                        'surgical_year',
                        'surgical_diagnosis',
                        'surgical_procedure',
                        'surgical_biopsy',
                        'surgical_notes',
                        'covid_year',
                        'covid_brand',
                        'covid_boosters',
                        'pcv_vaccine',
                        'flu_vaccine',
                        'hepb_vaccine',
                        'hpv_vaccine',
                        'other_vaccines',
                        // Exclude individual adult illness fields that are processed separately
                        'hypertension_type', 'hypertension_stage', 'hypertension_control', 'hypertension_year',
                        'hypertension_med_status', 'hypertension_medications', 'hypertension_compliance',
                        'diabetes_type', 'diabetes_insulin', 'diabetes_control', 'diabetes_year',
                        'diabetes_med_status', 'diabetes_medications', 'diabetes_compliance',
                        'asthma_control', 'asthma_year', 'asthma_med_status', 'asthma_medications', 'asthma_compliance',
                        // Exclude family illness detail fields
                        'hypertension_relation', 'hypertension_side', 'hypertension_family_year', 'hypertension_family_medications', 'hypertension_family_status',
                        'diabetes_relation', 'diabetes_side', 'diabetes_family_year', 'diabetes_family_medications', 'diabetes_family_status',
                        'asthma_relation', 'asthma_side', 'asthma_family_year',
                        'cancer_relation', 'cancer_side', 'cancer_family_year', 'cancer_family_medications', 'cancer_family_status',
                        // Exclude condition detail fields
                        'cancer_details', 'dyslipidemia_details', 'neurologic_details', 'liver_details', 'kidney_details', 'other_condition_details',
                        'family_dyslipidemia_details', 'family_neurologic_details', 'family_liver_details', 'family_kidney_details', 'family_other_details',
                    ]),
                    [
                        'hospitalization' => $hospitalizationData,
                        'surgical_history' => $surgicalHistoryData,
                        'childhood_illness' => $childhoodIllnessData,
                        'covid_vaccination' => $covidVaccination,
                        'other_vaccinations' => $otherVaccinations,
                    ],
                    $adultIllnessDetails,
                    $familyIllnessDetails,
                    $otherConditionDetails,
                    $familyOtherConditionDetails
                )
            );

            return response()->json([
                'success' => true,
                'message' => 'Comprehensive history saved successfully',
                'data' => $comprehensiveHistory
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving comprehensive history: ' . $e->getMessage()
            ], 500);
        }
    }
}
