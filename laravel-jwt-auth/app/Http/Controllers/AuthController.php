<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\coach;
use App\Models\member;
use Illuminate\Http\Request;
use App\Models\Nutritionist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Attempt to authenticate the user with the provided credentials
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Retrieve the authenticated user
        $user = auth()->user();
    
        // Check if the user's registration is pending
        if ($user->status == 0) {
            return response()->json(['message' => 'Your registration is pending'], 403);
        }
        

        // If the user's registration is not pending, proceed to create a new token
        return $this->createNewToken($token);
    }
    public function cnlogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Attempt to authenticate the user with the provided credentials
        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $role=$request->role;
        // Retrieve the authenticated user
        $user = auth()->user();
    
        // Check if the user's registration is pending
        if ($user->status == 0) {
            return response()->json(['message' => 'Your registration is pending'], 403);
        }
        

        // If the user's registration is not pending, proceed to create a new token
        return $this->createNewTokenCN($token,$role);
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->merge(['role' => $request->input('role', 'member')]);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:Coach,Nutritionist,member',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        // Determine status based on role
        $status = $request->role === 'member' ? 1 : 0;

        $user = User::create(
            array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password)],
                ['status' => $status] // Set the status based on the role
            )
        );

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse

     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
       
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60*600,
            'member'=>member::where('user_id','=',auth()->user()->id)->get(),
            'memberID'=>member::where('user_id','=',auth()->user()->id)->get()->first()->id,
            'user' => auth()->user(),

        ]);
    }
    protected function createNewTokenCN($token,$role)
    {
        if($role=="c"){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60*600,
             'member'=>coach::where('user_id','=',auth()->user()->id)->get(),
            'memberID'=>coach::where('user_id','=',auth()->user()->id)->get()->first()->id,
            'user' => auth()->user(),

        ]);}else{
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60*600,
                 'member'=>Nutritionist::where('user_id','=',auth()->user()->id)->get(),
                'memberID'=>Nutritionist::where('user_id','=',auth()->user()->id)->get()->first()->id,
                'user' => auth()->user(),
    
            ]);   
        }
    }
}
