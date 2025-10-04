<?php

namespace App\Http\Controllers;

use App\Models\ReferralForm;
use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class ReferralFormController extends Controller
{
    /**
     * Get all referral forms for a patient
     *
     * @param int $patientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByPatient($patientId)
    {
        $referrals = ReferralForm::where('patient_id', $patientId)
            ->orderByDesc('referral_date')
            ->get();

        return response()->json(['referrals' => $referrals]);
    }

    /**
     * Store a newly created referral form
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referral_date' => 'required|date',
            'priority' => 'required|string|in:routine,urgent,emergency',
            'specialty' => 'required|string|max:255',
            'referred_doctor' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'reason_for_referral' => 'required|string',
            'relevant_history' => 'nullable|string',
            'urgency_reason' => 'nullable|string',
            'include_reports' => 'boolean',
            'referring_doctor' => 'nullable|string|max:255'
        ]);

        $referral = ReferralForm::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Referral form created successfully',
            'referral' => $referral
        ]);
    }

    /**
     * Display the specified referral form
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $referral = ReferralForm::with('patient')->findOrFail($id);

        return response()->json(['referral' => $referral]);
    }

    /**
     * Generate and print PDF of the referral form
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function printPdf($id)
    {
        $referral = ReferralForm::with('patient')->findOrFail($id);

        $pdf = Pdf::loadView('patients.management.components.referral_form.print', compact('referral'))
            ->setPaper('a4', 'portrait');

        return $pdf->stream("referral_form_{$referral->id}.pdf");
    }

    /**
     * Download PDF of the referral form
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf($id)
    {
        $referral = ReferralForm::with('patient')->findOrFail($id);

        $pdf = Pdf::loadView('patients.management.components.referral_form.print', compact('referral'))
            ->setPaper('a4', 'portrait');

        return $pdf->download("referral_form_{$referral->id}.pdf");
    }

    /**
     * Update tracking information for referral
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTracking(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,in_progress,completed,cancelled',
            'tracking_notes' => 'nullable|string',
            'appointment_date' => 'nullable|date',
            'outcome' => 'nullable|string'
        ]);

        $referral = ReferralForm::findOrFail($id);
        $referral->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Tracking information updated successfully',
            'referral' => $referral
        ]);
    }

    /**
     * Update the specified referral form
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $referral = ReferralForm::findOrFail($id);

        $validated = $request->validate([
            'priority' => 'required|string|in:routine,urgent,emergency',
            'specialty' => 'required|string|max:255',
            'referred_doctor' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'reason_for_referral' => 'required|string',
            'relevant_history' => 'nullable|string',
            'urgency_reason' => 'nullable|string',
            'referring_doctor' => 'nullable|string|max:255'
        ]);

        $referral->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Referral form updated successfully',
            'referral' => $referral
        ]);
    }

    /**
     * Preview referral form without saving
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function preview(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'referral_date' => 'required|date',
            'priority' => 'required|string|in:routine,urgent,emergency',
            'specialty' => 'required|string|max:255',
            'referred_doctor' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'reason_for_referral' => 'required|string',
            'relevant_history' => 'nullable|string',
            'urgency_reason' => 'nullable|string',
            'include_reports' => 'boolean',
            'referring_doctor' => 'nullable|string|max:255'
        ]);

        // Create a temporary referral object for preview (don't save to database)
        $referral = new ReferralForm($validated);
        $referral->id = 'PREVIEW';
        $referral->status = 'pending';

        // Load the patient relationship
        $patient = Patient::findOrFail($validated['patient_id']);
        $referral->setRelation('patient', $patient);

        // Set proper date formatting
        $referral->referral_date = Carbon::parse($validated['referral_date']);

        // Generate PDF for preview
        $pdf = Pdf::loadView('patients.management.components.referral_form.print', compact('referral'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('referral_preview.pdf');
    }

    /**
     * Get referral statistics for a patient
     *
     * @param int $patientId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatistics($patientId)
    {
        $stats = [
            'pending' => ReferralForm::where('patient_id', $patientId)->where('status', 'pending')->count(),
            'in_progress' => ReferralForm::where('patient_id', $patientId)->where('status', 'in_progress')->count(),
            'completed' => ReferralForm::where('patient_id', $patientId)->where('status', 'completed')->count(),
            'cancelled' => ReferralForm::where('patient_id', $patientId)->where('status', 'cancelled')->count(),
            'total' => ReferralForm::where('patient_id', $patientId)->count()
        ];

        $specialties = ReferralForm::where('patient_id', $patientId)
            ->selectRaw('specialty, count(*) as count')
            ->groupBy('specialty')
            ->orderByDesc('count')
            ->get();

        return response()->json([
            'statistics' => $stats,
            'specialties' => $specialties
        ]);
    }
}
