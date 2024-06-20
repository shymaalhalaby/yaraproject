<?php

namespace App\Http\Controllers;

use App\Models\Nutritionist;
use Illuminate\Http\Request;
use App\Models\member_nutritionist;
use Illuminate\Support\Facades\Auth;

class NutritionistMemberController extends Controller
{
    public function sendRequest(Nutritionist $Nutritionist)
    {

        $member = Auth::user()->member;

        if (!$member->nutritionists->contains($Nutritionist->id)) {

            $member->nutritionists()->attach($Nutritionist, ['status' => 'pending']);

            return response()->json(['message' => 'Request sent successfully!'], 200);
        } else {
            return response()->json(['error' => 'You already have a pending request with this nutritionist.'], 400);
        }
    }
    public function showRequests(Request $request, $NutritionistId)
    {
        $Nutritionist = Nutritionist::findOrFail($NutritionistId);
        $memberNames = $Nutritionist->members()
            ->wherePivot('status', 'pending')
            ->get(['user_id', 'name'])

            ->map(function ($member) {
                return [
                    'user_id' => $member->user_id,
                    'name' => $member->name,
                ];
            });

        return response()->json($memberNames);
    }
    public function AcceptRequest($id)
    {
        $data = member_nutritionist::find($id);
        $data->status = 'Accepted';
        $data->save();
        return response()->json(['message' => 'Request Accepted successfully!'], 200);

    }
    public function RejectRequest($id)
    {
        $data = member_nutritionist::find($id);
        $data->status = 'Rejected';
        $data->save();
        return response()->json(['message' => 'Request Rejected successfully!'], 200);
    }
    public function showsubscribers(Request $request, $NutritionistId)
    {
        $Nutritionist = Nutritionist::findOrFail($NutritionistId);
        $memberNames = $Nutritionist->members()
            ->wherePivot('status', 'Accepted')
            ->get(['user_id', 'name']);

        $memberData = $memberNames->map(function ($member) {
            return [
                'user_id' => $member->user_id,
                'name' => $member->name,
            ];
        });

        return response()->json($memberData);
    }
}
