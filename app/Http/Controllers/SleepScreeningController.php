<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SleepScreening;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SleepScreeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sleepScreenings = SleepScreening::with('patient')->latest()->paginate(10);
        return view('sleep_screenings.index', compact('sleepScreenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        return view('sleep_screenings.create', compact('patients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'sleep_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
            'sleep_duration' => 'required|numeric|min:0|max:24',
            'sleep_quality' => 'required|integer|min:1|max:10',
            'sleep_activities' => 'nullable|array',
            'sleep_activities.*' => 'string|in:alcohol,large_meal,coffee,gadgets',
            'daytime_sleepiness' => 'required|in:yes,no',
            'blood_pressure' => 'required|string',
            'bmi' => 'required|numeric|min:15|max:60',
            'age' => 'required|integer|min:18|max:120',
            'neck_circumference' => 'required|numeric|min:20|max:60',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Process recommended assessments based on screening data
        $recommendedAssessments = $this->evaluateSleepScreening($request);

        $sleepScreening = SleepScreening::create([
            'patient_id' => $request->patient_id,
            'sleep_time' => $request->sleep_time,
            'wake_time' => $request->wake_time,
            'sleep_duration' => $request->sleep_duration,
            'sleep_quality' => $request->sleep_quality,
            'sleep_activities' => $request->sleep_activities,
            'daytime_sleepiness' => $request->daytime_sleepiness,
            'blood_pressure' => $request->blood_pressure,
            'bmi' => $request->bmi,
            'age' => $request->age,
            'neck_circumference' => $request->neck_circumference,
            'gender' => $request->gender,
            'recommended_assessments' => $recommendedAssessments,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sleep screening saved successfully',
            'data' => $sleepScreening,
            'recommended_assessments' => $recommendedAssessments
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sleepScreening = SleepScreening::with('patient')->findOrFail($id);
        return view('sleep_screenings.show', compact('sleepScreening'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sleepScreening = SleepScreening::findOrFail($id);
        $patients = Patient::all();
        return view('sleep_screenings.edit', compact('sleepScreening', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sleepScreening = SleepScreening::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'patient_id' => 'required|exists:patients,id',
            'sleep_time' => 'required|date_format:H:i',
            'wake_time' => 'required|date_format:H:i',
            'sleep_duration' => 'required|numeric|min:0|max:24',
            'sleep_quality' => 'required|integer|min:1|max:10',
            'sleep_activities' => 'nullable|array',
            'sleep_activities.*' => 'string|in:alcohol,large_meal,coffee,gadgets',
            'daytime_sleepiness' => 'required|in:yes,no',
            'blood_pressure' => 'required|string',
            'bmi' => 'required|numeric|min:15|max:60',
            'age' => 'required|integer|min:18|max:120',
            'neck_circumference' => 'required|numeric|min:20|max:60',
            'gender' => 'required|in:male,female',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Process recommended assessments based on screening data
        $recommendedAssessments = $this->evaluateSleepScreening($request);

        $sleepScreening->update([
            'patient_id' => $request->patient_id,
            'sleep_time' => $request->sleep_time,
            'wake_time' => $request->wake_time,
            'sleep_duration' => $request->sleep_duration,
            'sleep_quality' => $request->sleep_quality,
            'sleep_activities' => $request->sleep_activities,
            'daytime_sleepiness' => $request->daytime_sleepiness,
            'blood_pressure' => $request->blood_pressure,
            'bmi' => $request->bmi,
            'age' => $request->age,
            'neck_circumference' => $request->neck_circumference,
            'gender' => $request->gender,
            'recommended_assessments' => $recommendedAssessments,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Sleep screening updated successfully',
            'data' => $sleepScreening,
            'recommended_assessments' => $recommendedAssessments
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sleepScreening = SleepScreening::findOrFail($id);
        $sleepScreening->delete();

        return response()->json([
            'success' => true,
            'message' => 'Sleep screening deleted successfully'
        ]);
    }

    /**
     * Evaluate sleep screening and determine recommended assessments
     */
    private function evaluateSleepScreening(Request $request)
    {
        $recommendedAssessments = [];

        // 1. If <7 hours sleep or rating <6 ➔ Show ISI-7
        if (($request->sleep_duration && $request->sleep_duration < 7) || 
            ($request->sleep_quality && $request->sleep_quality < 6)) {
            $recommendedAssessments[] = 'Insomnia Severity Index (ISI-7)';
        }

        // 2. If "Yes" to daytime sleepiness ➔ Show ESS-8
        if ($request->daytime_sleepiness === 'yes') {
            $recommendedAssessments[] = 'Epworth Sleepiness Scale (ESS-8)';
        }

        // 3. If poor sleep hygiene activity is marked ➔ Show SHI-13
        if ($request->sleep_activities && count($request->sleep_activities) > 0) {
            $recommendedAssessments[] = 'Sleep Hygiene Index (SHI-13)';
        }

        // 4. If P-BANG features (HTN >130/90, BMI >35, Age >50, Neck >40cm, Male) ➔ Show STOP-BANG
        $pBangScore = 0;
        
        // Check blood pressure (format: "140/90" or any string)
        if ($request->blood_pressure && $request->blood_pressure !== 'Provide Data') {
            $bpParts = explode('/', $request->blood_pressure);
            if (count($bpParts) === 2) {
                $systolic = intval($bpParts[0]);
                $diastolic = intval($bpParts[1]);
                if ($systolic > 130 || $diastolic > 90) $pBangScore++;
            }
        }
        
        if ($request->bmi && $request->bmi > 35) $pBangScore++;
        if ($request->age && $request->age > 50) $pBangScore++;
        if ($request->neck_circumference && $request->neck_circumference > 40) $pBangScore++;
        if ($request->gender === 'male') $pBangScore++;

        if ($pBangScore >= 2) {
            $recommendedAssessments[] = 'STOP-BANG Score for Obstructive Sleep Apnea';
        }

        return $recommendedAssessments;
    }

    /**
     * Get sleep screening by patient ID
     */
    public function getByPatient($patientId)
    {
        $sleepScreening = SleepScreening::where('patient_id', $patientId)->latest()->first();
        
        if (!$sleepScreening) {
            return response()->json([
                'success' => false,
                'message' => 'No sleep screening found for this patient'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $sleepScreening
        ]);
    }
}
