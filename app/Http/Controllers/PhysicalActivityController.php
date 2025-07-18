<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhysicalActivity;
use App\Models\PhysicalActivityDetail;
use App\Models\PhysicalActivityDescription;
use Illuminate\Support\Facades\Validator;

class PhysicalActivityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'activity_description_id' => 'required|array',
            'met' => 'required|array',
            'days' => 'required|array',
            'hours' => 'required|array',
            'minutes' => 'required|array',
        ]);

        // Create the main PhysicalActivity record
        $activity = PhysicalActivity::create([
            'patient_id' => $request->patient_id,
        ]);

        foreach ($request->activity_description_id as $index => $orderId) {
            $days = (int) ($request->days[$index] ?? 0);
            $hours = (int) ($request->hours[$index] ?? 0);
            $minutes = (int) ($request->minutes[$index] ?? 0);
            $other = isset($request->other_value[$index]) ? trim($request->other_value[$index]) : null;
            $met = isset($request->met[$index]) ? floatval($request->met[$index]) : 0;
            // STRONG CHECK: Skip if there's no meaningful input
            if ($days === 0 && $hours === 0 && $minutes === 0 && ($other === null || $other === '')) {
                continue;
            }

            $description = PhysicalActivityDescription::where('order', $orderId)->first();

            if (!$description) {
                continue; // invalid order
            }

            PhysicalActivityDetail::create([
                'physical_activity_id' => $activity->id,
                'activity_description_id' => $description->id,
                'met' => $met,
                'days' => $days,
                'hours' => $hours,
                'minutes' => $minutes,
                'other_value' => $other ?: null, // save as NULL if empty
            ]);
        }


        return response()->json(['message' => 'Physical activity saved successfully.']);
    }

    public function show($id)
    {
        $activity = PhysicalActivity::with(['details.description'])->findOrFail($id);

        return response()->json([
            'id' => $activity->id,
            'created_at' => $activity->created_at,
            'details' => $activity->details->map(function ($detail) {
                return [
                    'days' => $detail->days,
                    'hours' => $detail->hours,
                    'minutes' => $detail->minutes,
                    'other_value' => $detail->other_value,
                    'met' => $detail->met,
                    'activity_description_id' => $detail->activity_description_id,
                    'description' => [
                        'name' => optional($detail->description)->name,
                    ]
                ];
            }),
        ]);
    }

    public function get_lists()
    {
        $activities = PhysicalActivity::withCount('details')->orderBy('created_at', 'desc')->get();

        return response()->json($activities);
    }
}

