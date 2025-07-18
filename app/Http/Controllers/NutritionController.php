<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Nutrition;

class NutritionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $NutritionResults = Nutrition::where('patient_id', $patient_id)
            ->orderBy('date', 'desc') // Sort by latest results
            ->get();

        return view('patients.Nutrition.index', compact('patient', 'NutritionResults'));
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
        $validatedData = $request->validate([
            'fruit' => 'required|string',
            'fruit_juice' => 'required|string',
            'vegetables' => 'required|string',
            'green_vegetables' => 'required|string',
            'starchy_vegetables' => 'required|string',
            'grains' => 'required|string',
            'whole_grains' => 'required|string',
            'milk' => 'required|string',
            'low_fat_milk' => 'required|string',
            'beans' => 'required|string',
            'nuts_seeds' => 'required|string',
            'seafood' => 'required|string',
            'ssb' => 'required|string',
            'added_sugars' => 'required|string',
            'saturated_fat' => 'required|string',
            'water' => 'required|string',
        ]);


        // Find the patient
        $patient = Patient::findOrFail($request->patient_id);

        // Convert string values to integers
        $total_fruits = (int) $request->fruit + (int) $request->fruit_juice;
        $whole_fruits = (int) $request->fruit;
        $tot_veg = (int) $request->vegetables;
        $greens_beans = (int) $request->green_vegetables + (int) $request->beans;
        $whole_grains = (int) $request->whole_grains;
        $dairy = (int) $request->milk + (int) $request->low_fat_milk;
        $tot_proteins = (int) $request->beans + (int) $request->nuts_seeds + (int) $request->seafood;
        $seafood_plant = (int) $request->seafood + (int) $request->beans;
        $fatty_acid = (int) $request->nuts_seeds;
        $refined_grains = (int) $request->grains;
        $sodium = (int) $request->ssb;
        $added_sugars = (int) $request->added_sugars;
        $sat_fat = (int) $request->saturated_fat;

        // Compute total score
        $tot_score = $total_fruits + $whole_fruits + $tot_veg + $greens_beans + $whole_grains + $dairy + $tot_proteins + $seafood_plant + $fatty_acid + $refined_grains + $sodium + $added_sugars + $sat_fat;

        $nutrition = Nutrition::create([
            'patient_id' => $patient->id,
            'fruit' => $request->fruit,
            'fruit_juice' => $request->fruit_juice,
            'vegetables' => $request->vegetables,
            'green_vegetables' => $request->green_vegetables,
            'starchy_vegetables' => $request->starchy_vegetables,
            'grains' => $request->grains,
            'grains_frequency' => $request->grains_frequency ?? 'N/A',
            'whole_grains' => $request->whole_grains,
            'whole_grains_frequency' => $request->whole_grains_frequency ?? 'N/A',
            'milk' => $request->milk,
            'milk_frequency' => $request->milk_frequency ?? 'N/A',
            'low_fat_milk' => $request->low_fat_milk,
            'low_fat_milk_frequency' => $request->low_fat_milk_frequency ?? 'N/A',
            'beans' => $request->beans,
            'nuts_seeds' => $request->nuts_seeds,
            'seafood' => $request->seafood,
            'seafood_frequency' => $request->seafood_frequency ?? 'N/A',
            'ssb' => $request->ssb,
            'ssb_frequency' => $request->ssb_frequency ?? 'N/A',
            'added_sugars' => $request->added_sugars,
            'saturated_fat' => $request->saturated_fat,
            'water' => $request->water,
            'dq_score' => $tot_score,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Nutrition added successfully!',
            'data' => $nutrition
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
        $response = Nutrition::findOrFail($id);
        $response->delete();

        return response()->json(['message' => 'Response deleted successfully!']);
    }
}
