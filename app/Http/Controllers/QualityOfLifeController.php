<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\QualityOfLife;

class QualityOfLifeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $qualityOfLifeRecords = QualityOfLife::where('patient_id', $patient_id)->latest()->get();
        return response()->json($qualityOfLifeRecords);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'consultation_id' => 'nullable|exists:consultations,id',
            'mobility' => 'required|integer',
            'self_care' => 'required|integer',
            'usual_activities' => 'required|integer',
            'pain_discomfort' => 'required|integer',
            'anxiety_depression' => 'required|integer',
            'health_today' => 'required|integer',
            'icd_10' => 'nullable|string',
        ]);

        // Find the patient
        $patient = Patient::findOrFail($request->patient_id);

        // Save the quality of life record
        $qualityOfLife = QualityOfLife::create([
            'patient_id' => $request->patient_id,
            'consultation_id' => $request->consultation_id,
            'mobility' => $request->mobility,
            'self_care' => $request->self_care,
            'usual_activities' => $request->usual_activities,
            'pain' => $request->pain_discomfort,
            'anxiety' => $request->anxiety_depression,
            'health_today' => $request->health_today,
            'icd_10' => $request->icd_10,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quality of life record saved successfully',
            'data' => $qualityOfLife
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    /**
     * Get quality of life records by consultation ID
     */
    public function getByConsultation($consultationId)
    {
        $qualityOfLifeRecords = QualityOfLife::where('consultation_id', $consultationId)
            ->with('consultation')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($qualityOfLifeRecords);
    }
}
