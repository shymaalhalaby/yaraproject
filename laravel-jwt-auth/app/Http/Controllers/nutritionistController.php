<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nutritionist;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use App\Http\Resources\NutritionistResource;
use App\Http\Resources\NutritionistCollection;
use App\Http\Requests\updateNutritionistRequest;

class nutritionistController extends Controller
{
    public function index(Request $request)
    {
        return new NutritionistCollection(Nutritionist::all());
    }
    public function show(Request $request, Nutritionist $Nutritionist)
    {
        return new NutritionistResource($Nutritionist);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function Nprofile(Request $request, User $user)
    {
        $validated = $request->validate([
            'WorkHours' => 'required|string',
            'gender' => 'required|in:male,female',
            'phone_number' => 'required|string',
            'Age' => 'required|integer|min:0',
            'ProfileImage' => 'nullable|mimes:png,jpg,gif,jpeg',

        ]);
        $userId = auth()->id();
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 400);
        }

        if ($user->role !== 'Nutritionist') {
            return response()->json(['error' => 'User is not a Nutritionist'], 400);
        }
        $validated = [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'ProfileImage' =>  $validated['ProfileImage'],
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'Age' => $validated['Age'],
            'WorkHours' => $validated['WorkHours'],

        ];
        $Nutritionist = $user->Nutritionist()->create($validated);
        return new NutritionistResource($Nutritionist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateNutritionistRequest $request, Nutritionist $Nutritionist)
    {
        $validated = $request->validated();

        $Nutritionist->update($validated);

        return new NutritionistResource($Nutritionist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Nutritionist $Nutritionist)
    {
        $Nutritionist->delete();

        return response(null, 204);
    }


}

