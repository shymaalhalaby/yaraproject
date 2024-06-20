<?php

namespace App\Http\Controllers;

use App\Models\DailyDiet;
use Illuminate\Http\Request;
use App\Models\LunchDailyDiet;
use App\Models\DinnerDailyDiet;
use App\Models\BreakFastDailyDiet;

class dietplanController extends Controller
{
    public function saveUserBreakfastSelection(Request $request)
    {
        $validated = $request->validate([
            'daily_diet_id' => 'required|exists:daily_diets,id',
            'breakfasts' => 'required|array',
            'breakfasts.*.id' => 'required|exists:break_fasts,id',
            'breakfasts.*.amount' => 'required|numeric',
            'snack1' => 'required|string'
        ]);

        $dailyDietId = $validated['daily_diet_id'];

        foreach ($validated['breakfasts'] as $breakfast) {

            BreakFastDailyDiet::updateOrCreate(
                [
                    'daily_diet_id' => $dailyDietId,
                    'break_fast_id' => $breakfast['id']
                ],
                [
                    'amount' => $breakfast['amount'],
                    'snack1' => $validated['snack1']
                ]
            );
        }

        return response()->json(['message' => 'Member breakfast and snack1 updated successfully.']);
    }


    public function getBreakfastDetailsByDailyDietId($dailyDietId)
    {

        $dailyDietExists = DailyDiet::find($dailyDietId);
        if (!$dailyDietExists) {
            return response()->json(['message' => 'Daily Diet not found'], 404);
        }


        $breakfastDetails = BreakFastDailyDiet::where('daily_diet_id', $dailyDietId)
                                                           ->get();

        if ($breakfastDetails->isEmpty()) {
            return response()->json(['message' => 'No breakfasts found for this daily diet'], 404);
        }


        return response()->json(['breakfast_details' => $breakfastDetails]);
    }



    public function saveUserlunchSelection(Request $request)
    {
        $validated = $request->validate([
            'daily_diet_id' => 'required|exists:daily_diets,id',
            'lunches' => 'required|array',
            'lunches.*.id' => 'required|exists:lunches,id',
            'lunches.*.amount' => 'required|numeric',
            'snack2' => 'required|string'
        ]);

        $dailyDietId = $validated['daily_diet_id'];

        foreach ($validated['lunches'] as $lunche) {

            LunchDailyDiet::updateOrCreate(
                [
                    'daily_diet_id' => $dailyDietId,
                    'lunch_id' => $lunche['id']
                ],
                [
                    'amount' => $lunche['amount'],
                    'snack2' => $validated['snack2']
                ]
            );
        }

        return response()->json(['message' => 'Member lunche and snack2 updated successfully.']);
    }


    public function getlunchDetailsByDailyDietId($dailyDietId)
    {

        $dailyDietExists = DailyDiet::find($dailyDietId);
        if (!$dailyDietExists) {
            return response()->json(['message' => 'Daily Diet not found'], 404);
        }


        $luncheDetails = LunchDailyDiet::where('daily_diet_id', $dailyDietId)
                                                           ->get();

        if ($luncheDetails->isEmpty()) {
            return response()->json(['message' => 'No luncheDetails found for this daily diet'], 404);
        }


        return response()->json(['lunche_Details' => $luncheDetails]);
    }









    public function saveUserDinnerSelection(Request $request)
    {
        $validated = $request->validate([
            'daily_diet_id' => 'required|exists:daily_diets,id',
            'Dinners' => 'required|array',
            'Dinners.*.id' => 'required|exists:Dinners,id',
            'Dinners.*.amount' => 'required|numeric',
            'TotalCalories' => 'required|string'
        ]);

        $dailyDietId = $validated['daily_diet_id'];

        foreach ($validated['Dinners'] as $Dinner) {

            DinnerDailyDiet::updateOrCreate(
                [
                    'daily_diet_id' => $dailyDietId,
                    'dinner_id' => $Dinner['id']
                ],
                [
                    'amount' => $Dinner['amount'],
                    'TotalCalories' => $validated['TotalCalories']
                ]
            );
        }

        return response()->json(['message' => 'Member Dinner and total updated successfully.']);
    }





    public function getDinnerDetailsByDailyDietId($dailyDietId)
    {

        $dailyDietExists = DailyDiet::find($dailyDietId);
        if (!$dailyDietExists) {
            return response()->json(['message' => 'Daily Diet not found'], 404);
        }


        $DinnerDetails = DinnerDailyDiet::where('daily_diet_id', $dailyDietId)
                                                           ->get();

        if ($DinnerDetails->isEmpty()) {
            return response()->json(['message' => 'No DinnerDetails found for this daily diet'], 404);
        }


        return response()->json(['DinnerDetails' => $DinnerDetails]);
    }
}
