<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\image;
use App\Models\member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\memberResource;
use App\Http\Resources\memberCollection;
use App\Http\Requests\StorememberRequest;
use App\Http\Requests\updatememberRequest;
use Tymon\JWTAuth\Contracts\Providers\Auth;


class memberController extends Controller
{


    public function index(Request $request)
    {
        $single = member::with('Uesr')->where("id", $request->id)->find($request);
        echo $single->User->name . "name" .
            $single->User->email . "email";

        return new memberCollection(member::all());
    }
    public function show(Request $request, member $member)
    {
        return new memberResource($member);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function profile(Request $request, User $user, Auth $auth)
    {

        $validated = $request->validate([
            'gender' => 'required|in:male,female',
            'phone_number' => 'required|string',
            'GOAL' => 'required|string',
            'AT' => 'required|string',
            'Age' => 'required|integer|min:0',
            'illness' => 'nullable|string',
            'Physical_case' => 'nullable|string',
            'Hieght' => 'required|numeric|min:0',
            'Wieght' => 'required|numeric|min:0',
            'target_Wieght' => 'required|numeric|min:0',
            // 'ProfileImage' => 'nullable|mimes:png,jpg,gif,jpeg',
        ]);
        $userId = auth()->id();
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 400);
        }

        if ($user->role !== 'member') {
            return response()->json(['error' => 'User is not a member'], 400);
        };

        $validated = [

            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'gender' => $validated['gender'],
            // 'ProfileImage' =>  $validated['ProfileImage'],
            'phone_number' => $validated['phone_number'],
            'Age' => $validated['Age'],
            'illness' => $validated['illness'],
            'Physical_case' => $validated['Physical_case'],
            'Hieght' => $validated['Hieght'],
            'Wieght' => $validated['Wieght'],
            'target_Wieght' => $validated['target_Wieght'],
            'GOAL' => $validated['GOAL'],
            'AT' => $validated['AT'],

        ];

        $member = $user->member()->create($validated);
        return new memberResource($member);

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(updatememberRequest $request, member $member)
    {
        $userId = auth()->id();
        $user = User::find($userId);
        $validated = $request->validated();

        $member->update($validated);
        return new memberResource($member);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( member $member)
    {
        $member->delete();

        return response(null, 204);
    }}


