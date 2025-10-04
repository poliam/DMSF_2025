<?php

namespace App\Http\Controllers;

use App\Models\MedicalCertificate;
use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MedicalCertificateController extends Controller
{
    /**
     * Get all medical certificates for a patient
     *
     * @param int $patientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByPatient($patientId)
    {
        $certificates = MedicalCertificate::where('patient_id', $patientId)
            ->orderByDesc('date_issued')
            ->get();

        return response()->json(['certificates' => $certificates]);
    }

    /**
     * Store a newly created medical certificate
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'certificate_type' => 'required|string|in:fitness_work,medical_leave,travel_clearance,school_sports,custom',
            'purpose' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'valid_until' => 'nullable|date|after:date_issued',
            'issuing_doctor' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'medical_findings' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'digital_signature' => 'boolean'
        ]);

        $certificate = MedicalCertificate::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Medical certificate issued successfully',
            'certificate' => $certificate
        ]);
    }

    /**
     * Display the specified medical certificate
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $certificate = MedicalCertificate::with('patient')->findOrFail($id);

        return response()->json(['certificate' => $certificate]);
    }

    /**
     * Generate and download PDF of the medical certificate
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf($id)
    {
        $certificate = MedicalCertificate::with('patient')->findOrFail($id);
        $patient = $certificate->patient;

        $pdf = Pdf::loadView('patients.management.components.medical_certificate_download_pdf', compact('certificate', 'patient'))
            ->setPaper([0, 0, 612, 396], 'landscape'); // 8.5in x 5.5in in points (72 points per inch)

        return $pdf->download("medical_certificate_{$certificate->id}.pdf");
    }

    /**
     * View PDF of the medical certificate in browser
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function viewPdf($id)
    {
        $certificate = MedicalCertificate::with('patient')->findOrFail($id);
        $patient = $certificate->patient;

        $pdf = Pdf::loadView('patients.management.components.medical_certificate_download_pdf', compact('certificate', 'patient'))
            ->setPaper([0, 0, 612, 396], 'landscape'); // 8.5in x 5.5in in points (72 points per inch)

        return $pdf->stream("medical_certificate_{$certificate->id}.pdf");
    }

    /**
     * Revoke a medical certificate
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function revoke(Request $request, $id)
    {
        $validated = $request->validate([
            'revocation_reason' => 'required|string|max:500'
        ]);

        $certificate = MedicalCertificate::findOrFail($id);

        $certificate->update([
            'status' => 'revoked',
            'revocation_reason' => $validated['revocation_reason'],
            'revoked_at' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Medical certificate revoked successfully'
        ]);
    }

    /**
     * Update the specified medical certificate
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $certificate = MedicalCertificate::findOrFail($id);

        $validated = $request->validate([
            'certificate_type' => 'required|string|in:fitness_work,medical_leave,travel_clearance,school_sports,custom',
            'purpose' => 'required|string|max:255',
            'valid_until' => 'nullable|date|after:date_issued',
            'issuing_doctor' => 'required|string|max:255',
            'license_number' => 'nullable|string|max:255',
            'medical_findings' => 'nullable|string',
            'recommendations' => 'nullable|string',
        ]);

        $certificate->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Medical certificate updated successfully',
            'certificate' => $certificate
        ]);
    }
}
