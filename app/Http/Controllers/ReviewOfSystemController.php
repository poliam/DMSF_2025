<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\ReviewOfSystem;
use Carbon\Carbon;

class ReviewOfSystemController extends Controller
{
    /**
     * Get the three consultations for a patient, creating them if they don't exist
     */
    public function getConsultations(Patient $patient)
    {
        $consultations = Consultation::ensureThreeConsultations($patient->id);
        
        $response = [];
        foreach (['ROS_1st', 'ROS_2nd', 'ROS_3rd'] as $type) {
            $consultation = $consultations[$type] ?? null;
            $ros = null;
            
            if ($consultation) {
                $ros = $consultation->reviewOfSystems()->first();
            }
            
            $response[$type] = [
                'consultation' => $consultation,
                'consultation_date' => $consultation ? $consultation->consultation_date->format('Y-m-d') : null,
                'symptoms' => $ros ? $ros->symptoms : []
            ];
        }
        
        return response()->json($response);
    }

    /**
     * Save Review of Systems for a specific consultation
     */
    public function saveReviewOfSystems(Request $request, Patient $patient)
    {
        $request->validate([
            'consultation_type' => 'required|in:ROS_1st,ROS_2nd,ROS_3rd',
            'symptoms' => 'nullable|array'
        ]);

        $consultationType = $request->consultation_type;
        $symptoms = $request->symptoms ?? [];

        // Get or create the consultations
        $consultations = Consultation::ensureThreeConsultations($patient->id);
        $consultation = $consultations[$consultationType];

        if (!$consultation) {
            return response()->json(['error' => 'Consultation not found'], 404);
        }

        // Get existing ROS or create new one
        $ros = $consultation->reviewOfSystems()->first();
        
        if ($ros) {
            // Update existing entry
            $ros->update([
                'symptoms' => $symptoms
            ]);
        } else {
            // Create new entry
            $ros = ReviewOfSystem::create([
                'patient_id' => $patient->id,
                'consultation_id' => $consultation->id,
                'symptoms' => $symptoms
            ]);
        }

        return response()->json([
            'message' => 'Review of Systems saved successfully for ' . $consultationType,
            'consultation_date' => $consultation->consultation_date->format('M d, Y')
        ]);
    }

    /**
     * Get Review of Systems for a specific consultation
     */
    public function getReviewOfSystems(Patient $patient, $consultationType)
    {
        if (!in_array($consultationType, ['ROS_1st', 'ROS_2nd', 'ROS_3rd'])) {
            return response()->json(['error' => 'Invalid consultation type'], 400);
        }

        $consultations = Consultation::ensureThreeConsultations($patient->id);
        $consultation = $consultations[$consultationType];

        if (!$consultation) {
            return response()->json(['symptoms' => []]);
        }

        $ros = $consultation->reviewOfSystems()->first();
        
        return response()->json([
            'symptoms' => $ros ? $ros->symptoms : [],
            'consultation_date' => $consultation->consultation_date->format('Y-m-d')
        ]);
    }

    /**
     * Update consultation date
     */
    public function updateConsultationDate(Request $request, Patient $patient)
    {
        $request->validate([
            'consultation_type' => 'required|in:ROS_1st,ROS_2nd,ROS_3rd',
            'consultation_date' => 'required|date'
        ]);

        $consultationType = $request->consultation_type;
        $newDate = Carbon::parse($request->consultation_date);

        $consultations = Consultation::ensureThreeConsultations($patient->id);
        $consultation = $consultations[$consultationType];

        if (!$consultation) {
            return response()->json(['error' => 'Consultation not found'], 404);
        }

        $consultation->update([
            'consultation_date' => $newDate
        ]);

        return response()->json([
            'message' => 'Consultation date updated successfully',
            'consultation_date' => $consultation->consultation_date->format('M d, Y')
        ]);
    }
} 