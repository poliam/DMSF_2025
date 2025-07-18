<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tdee;
use App\Models\Patient;

class TdeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'activity_level' => 'required|string'
        ]);

        $patient = Patient::with('patientMeasurements')->findOrFail($request->patient_id);
        $latestMeasurement = $patient->getLatestMeasurement();

        if (!$latestMeasurement || !$latestMeasurement->weight_kg || !$latestMeasurement->height || !$patient->age || !$patient->gender) {
            return response()->json(['message' => 'Incomplete patient measurement data. Please ensure weight, height, age, and gender are recorded.'], 400);
        }

        // Convert meters to cm for BMR calculation
        $heightInCm = $latestMeasurement->height * 100;

        // Calculate BMR using Mifflin-St Jeor Equation
        $bmr = strtolower($patient->gender) === 'male'
            ? (10 * $latestMeasurement->weight_kg) + (6.25 * $heightInCm) - (5 * $patient->age) + 5
            : (10 * $latestMeasurement->weight_kg) + (6.25 * $heightInCm) - (5 * $patient->age) - 161;

        // Activity level multipliers
        $multipliers = [
            'sedentary' => 1.2,
            'lightly active' => 1.375,
            'moderately active' => 1.55,
            'very active' => 1.725,
            'extra active' => 1.9,
        ];

        $activityLevel = strtolower($request->activity_level);
        $tdee = isset($multipliers[$activityLevel]) ? $bmr * $multipliers[$activityLevel] : $bmr;

        // Create or Update TDEE
        $tdeeRecord = Tdee::updateOrCreate(
            ['patient_id' => $patient->id],
            [
                'bmr' => round($bmr, 2),
                'tdee' => round($tdee, 2),
                'activity_level' => $request->activity_level
            ]
        );

        return response()->json([
            'message' => 'TDEE saved successfully!',
            'tdee' => round($tdee, 2)
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
}
