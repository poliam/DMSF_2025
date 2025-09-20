<?php

namespace App\Http\Controllers;

use App\Models\ResearchEligibilityCriteria;
use App\Models\Patient;
use Illuminate\Http\Request;

class ResearchEligibilityController extends Controller
{
    public function showForm($patientId)
    {
        // You can return a partial or a modal view
        $patient = Patient::findOrFail($patientId);
        return view('research-eligibility.form', compact('patient'));
    }

    public function check($patientId)
    {
        // Check if the patient has already submitted the form
        $eligibility = ResearchEligibilityCriteria::where('patient_id', $patientId)->first();

        if ($eligibility) {
            // Return the existing data if it exists
            return response()->json(['form_exists' => true, 'data' => $eligibility]);
        }

        // Return false if the form has not been submitted yet
        return response()->json(['form_exists' => false]);
    }


    public function storeFirstEncounter(Request $request)
    {
        // Store informed consent data
        $consentData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'consent_date' => 'required|date',
            'consent_session' => 'required|in:AM,PM',
            'participant_signed' => 'required|boolean',
            'witness_signed' => 'required|boolean',
            'witness_name' => 'required|string',
            'copy_given' => 'required|boolean',
            'copy_reason' => 'required_if:copy_given,0|nullable|string',
        ]);

        // Store research eligibility data
        $eligibilityData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'read_and_write_consent' => 'required|boolean',
            'consent_for_info' => 'required|boolean',
            'consent_for_teleconsultation' => 'required|boolean',
            'laboratory_finding' => 'required|boolean',
            'fbs_result' => 'nullable|numeric',
            'rbs_result' => 'nullable|integer',
            'polyuria' => 'required|boolean',
            'polydipsia' => 'required|boolean',
            'polyphagia' => 'required|boolean',
        ]);

        // Create records in both tables
        \App\Models\InformedConsent::create($consentData);
        ResearchEligibilityCriteria::create($eligibilityData);

        return response()->json(['message' => 'First encounter screening data saved successfully!']);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'read_and_write_consent' => 'required|boolean',
            'consent_for_info' => 'required|boolean',
            'consent_for_teleconsultation' => 'required|boolean',
            'laboratory_finding' => 'required|boolean',
            'fbs_result' => 'nullable|numeric',
            'rbs_result' => 'nullable|integer',
            'polyuria' => 'required|boolean',
            'polydipsia' => 'required|boolean',
            'polyphagia' => 'required|boolean',
        ]);

        // Check if a record already exists for this patient
        $existingRecord = ResearchEligibilityCriteria::where('patient_id', $request->patient_id)->first();
        if ($existingRecord) {
            return response()->json(['message' => 'Research eligibility criteria already exists for this patient.'], 409);
        }

        // Create the research eligibility criteria record
        $eligibility = ResearchEligibilityCriteria::create($validated);

        return response()->json([
            'message' => 'Research eligibility criteria saved successfully!',
            'data' => $eligibility
        ]);
    }
}
