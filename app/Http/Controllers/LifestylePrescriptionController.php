<?php

namespace App\Http\Controllers;

use App\Models\LifestylePrescription;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LifestylePrescriptionController extends Controller
{
    /**
     * Generate a unique control number for lifestyle prescriptions
     * Format: LXC-YYYYMMDD-#### (Cogon) or LXM-YYYYMMDD-#### (Marilog)
     * LXC/LXM = L(lifestyle) + location code (XC=Cogon, XM=Marilog)
     * YYYYMMDD = date
     * #### = sequence for the day
     */
    private function generateControlNumber($patientId)
    {
        // Get patient to determine location
        $patient = Patient::findOrFail($patientId);
        
        // Determine location code based on barangay
        $locationCode = 'LXC'; // Default to Cogon
        if ($patient->brgy_address && stripos($patient->brgy_address, 'marilog') !== false) {
            $locationCode = 'LXM';
        } else if ($patient->brgy_address && stripos($patient->brgy_address, 'cogon') !== false) {
            $locationCode = 'LXC';
        }
        
        // Get today's date in YYYYMMDD format
        $dateStr = Carbon::now()->format('Ymd');
        
        // Get the count of lifestyle prescriptions created today with the same location code
        $todayPrefix = $locationCode . '-' . $dateStr;
        
        // Use database transaction to ensure uniqueness
        return DB::transaction(function () use ($todayPrefix) {
            // Lock the lifestyle_prescriptions table for reading to prevent race conditions
            $maxSequence = LifestylePrescription::where('control_number', 'like', $todayPrefix . '%')
                ->lockForUpdate()
                ->count();
            
            $sequence = str_pad($maxSequence + 1, 4, '0', STR_PAD_LEFT);
            
            return $todayPrefix . '-' . $sequence;
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $patientId = $request->query('patient_id');
        if ($patientId) {
            $prescriptions = LifestylePrescription::where('patient_id', $patientId)
                ->orderByDesc('created_at')
                ->get();
            return response()->json(['prescriptions' => $prescriptions]);
        }

        $prescriptions = LifestylePrescription::orderByDesc('created_at')->paginate(20);
        return response()->json($prescriptions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diet_type' => 'nullable|string|max:255',
            'diet_notes' => 'nullable|string',
            'exercise_type' => 'nullable|string|max:255',
            'exercise_notes' => 'nullable|string',
            'sleep_recommendations' => 'nullable|string',
            'stress_recommendations' => 'nullable|string',
            'social_connectedness_recommendations' => 'nullable|string',
            'substance_avoidance_recommendations' => 'nullable|string',
        ]);

        // Generate control number
        $controlNumber = $this->generateControlNumber($validated['patient_id']);
        
        // Add control number to validated data
        $validated['control_number'] = $controlNumber;

        $prescription = LifestylePrescription::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lifestyle prescription saved successfully.',
            'data' => $prescription,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(LifestylePrescription $lifestylePrescription)
    {
        return response()->json($lifestylePrescription);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LifestylePrescription $lifestylePrescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LifestylePrescription $lifestylePrescription)
    {
        $validated = $request->validate([
            'diet_type' => 'nullable|string|max:255',
            'diet_notes' => 'nullable|string',
            'exercise_type' => 'nullable|string|max:255',
            'exercise_notes' => 'nullable|string',
            'sleep_recommendations' => 'nullable|string',
            'stress_recommendations' => 'nullable|string',
            'social_connectedness_recommendations' => 'nullable|string',
            'substance_avoidance_recommendations' => 'nullable|string',
        ]);

        $lifestylePrescription->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lifestyle prescription updated successfully.',
            'data' => $lifestylePrescription,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LifestylePrescription $lifestylePrescription)
    {
        $lifestylePrescription->delete();
        return response()->json(['success' => true]);
    }

    /**
     * Download lifestyle prescription as PDF
     */
    public function downloadPdf($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $prescription = LifestylePrescription::where('patient_id', $patientId)
            ->orderByDesc('created_at')
            ->first();

        if (!$prescription) {
            return response()->json(['error' => 'No lifestyle prescription found for this patient'], 404);
        }

        $isPdf = true; // This is for PDF generation
        $pdf = \PDF::loadView('patients.management.components.lifestyle_prescription.print', compact('patient', 'prescription', 'isPdf'));
        
        $filename = 'lifestyle_prescription_' . $patient->first_name . '_' . $patient->last_name . '_' . date('Y-m-d') . '.pdf';
        
        return $pdf->download($filename);
    }

    /**
     * Print lifestyle prescription - displays PDF in browser for printing
     */
    public function print($patientId)
    {
        $patient = Patient::findOrFail($patientId);
        $prescription = LifestylePrescription::where('patient_id', $patientId)
            ->orderByDesc('created_at')
            ->first();

        if (!$prescription) {
            return response()->json(['error' => 'No lifestyle prescription found for this patient'], 404);
        }

        $isPdf = true; // Generate PDF for browser viewing
        $pdf = \PDF::loadView('patients.management.components.lifestyle_prescription.print', compact('patient', 'prescription', 'isPdf'));
        
        // Return PDF to be displayed in browser (not downloaded)
        return $pdf->stream('lifestyle_prescription_' . $patient->first_name . '_' . $patient->last_name . '.pdf');
    }
}
