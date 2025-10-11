<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnostic;
use App\Models\Patient;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DiagnosticController extends Controller
{
    /**
     * Generate a unique control number for diagnostic requests
     * Format: DXC-YYYYMMDD-#### (Cogon) or DXM-YYYYMMDD-#### (Marilog)
     * DXC/DXM = D(diagnostic) + location code (XC=Cogon, XM=Marilog)
     * YYYYMMDD = date
     * #### = sequence for the day
     */
    private function generateControlNumber($patientId)
    {
        // Get patient to determine location
        $patient = Patient::findOrFail($patientId);
        
        // Determine location code based on barangay
        $locationCode = 'DXC'; // Default to Cogon
        if ($patient->brgy_address && stripos($patient->brgy_address, 'marilog') !== false) {
            $locationCode = 'DXM';
        } else if ($patient->brgy_address && stripos($patient->brgy_address, 'cogon') !== false) {
            $locationCode = 'DXC';
        }
        
        // Get today's date in YYYYMMDD format
        $dateStr = Carbon::now()->format('Ymd');
        
        // Get the count of diagnostics created today with the same location code
        $todayPrefix = $locationCode . '-' . $dateStr;
        
        // Use database transaction to ensure uniqueness
        return DB::transaction(function () use ($todayPrefix) {
            // Lock the diagnostics table for reading to prevent race conditions
            $maxSequence = Diagnostic::where('control_number', 'like', $todayPrefix . '%')
                ->lockForUpdate()
                ->count();
            
            $sequence = str_pad($maxSequence + 1, 4, '0', STR_PAD_LEFT);
            
            return $todayPrefix . '-' . $sequence;
        });
    }

    // List diagnostics for a patient
    public function index($patient_id)
    {
        $diagnostics = Diagnostic::where('patient_id', $patient_id)
            ->orderByDesc('created_at')
            ->get();
        return response()->json(['diagnostics' => $diagnostics]);
    }

    // Store a new diagnostic record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnostic_date' => 'required|date',
            'requesting_physician' => 'nullable|string|max:255',
            'hematology' => 'nullable|array',
            'clinical_microscopy' => 'nullable|array',
            'blood_chemistry' => 'nullable|array',
            'microbiology' => 'nullable|array',
            'immunology_serology' => 'nullable|array',
            'stool_tests' => 'nullable|array',
            'blood_typing_bsmp' => 'nullable|array',
            'others' => 'nullable|string|max:1000',
        ]);
        
        // Get the authenticated user's display name for requesting physician
        $requestingPhysician = $validated['requesting_physician'] ?? auth()->user()->display_name ?? null;
        
        // Generate control number
        $controlNumber = $this->generateControlNumber($validated['patient_id']);
        
        $diagnostic = Diagnostic::create([
            'patient_id' => $validated['patient_id'],
            'diagnostic_date' => $validated['diagnostic_date'],
            'requesting_physician' => $requestingPhysician,
            'control_number' => $controlNumber,
            'hematology' => $validated['hematology'] ?? [],
            'clinical_microscopy' => $validated['clinical_microscopy'] ?? [],
            'blood_chemistry' => $validated['blood_chemistry'] ?? [],
            'microbiology' => $validated['microbiology'] ?? [],
            'immunology_serology' => $validated['immunology_serology'] ?? [],
            'stool_tests' => $validated['stool_tests'] ?? [],
            'blood_typing_bsmp' => $validated['blood_typing_bsmp'] ?? [],
            'others' => $validated['others'] ?? null,
        ]);
        return response()->json(['success' => true, 'diagnostic' => $diagnostic]);
    }

    // Show a single diagnostic record
    public function show($id)
    {
        $diagnostic = Diagnostic::findOrFail($id);
        return response()->json(['diagnostic' => $diagnostic]);
    }

    // Print a diagnostic record as PDF
    public function print($diagnosticId)
    {
        $diagnostic = Diagnostic::with('patient')->findOrFail($diagnosticId);

        $pdf = Pdf::loadView('patients.management.components.diagnostic_request.print', compact('diagnostic'));

        return $pdf->stream('diagnostic.pdf'); // Will display the PDF in browser
    }
}
