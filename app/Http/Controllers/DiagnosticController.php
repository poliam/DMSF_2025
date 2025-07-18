<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnostic;
use Barryvdh\DomPDF\Facade\Pdf;

class DiagnosticController extends Controller
{
    // List diagnostics for a patient
    public function index($patient_id)
    {
        $diagnostics = Diagnostic::where('patient_id', $patient_id)->orderByDesc('diagnostic_date')->get();
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
        $diagnostic = Diagnostic::create([
            'patient_id' => $validated['patient_id'],
            'diagnostic_date' => $validated['diagnostic_date'],
            'requesting_physician' => $validated['requesting_physician'] ?? null,
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

        $pdf = Pdf::loadView('patients.diagnostic.print', compact('diagnostic'));

        return $pdf->stream('diagnostic.pdf'); // Will display the PDF in browser
    }
}
