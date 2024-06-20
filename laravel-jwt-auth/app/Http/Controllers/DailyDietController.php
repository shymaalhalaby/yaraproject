<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\DailyDiet;
use Illuminate\Http\Request;
use App\Models\LunchDailyDiet;
use App\Models\DinnerDailyDiet;
use App\Models\BreakFastDailyDiet;

class DailyDietController extends Controller
{
    public function store(member $member)
    {

        $DailyDiet = DailyDiet::create([
            'member_id' => $member->id,
        ]);

        return response()->json($DailyDiet, 201);
    }
    public function getByMember($memberId)
{
    $member = Member::with('DailyDiet')->find($memberId);

    if (!$member) {
        return response()->json(['message' => 'Member not found'], 404);
    }

    if ($member->DailyDiet->isEmpty()) {
        return response()->json(['message' => 'DailyDiet not found'], 404);
    }
    $result=[];
 
    $dailyDietIds = $member->DailyDiet->pluck('id'); // Assuming 'id' is the correct fieldd
    foreach ($dailyDietIds as $key=>$value) {
        $result[$key]['daystatus']=$member->DailyDiet[$key]->status;
        $breakfastDetails = BreakFastDailyDiet::where('daily_diet_id','=', $value)->with('breakfastdetails')->get();
        $result[$key]['breakfast']=$breakfastDetails;
    
        $lunchDetails = LunchDailyDiet::where('daily_diet_id', $value)->with('lunchdetails')->get();
        $result[$key]['lunch']=$lunchDetails;
        $DinnerDetails = DinnerDailyDiet::where('daily_diet_id', $value)->with('dinnerdetails')->get();
        $result[$key]['dinner']=$DinnerDetails;
    }
    $response = [
        'status' => 'success',
        'message' => 'Plans Getted successful',
        'total'=> count($result),
        
        'data' => $result,
    ];

    return response()->json($response);
    
}


}
