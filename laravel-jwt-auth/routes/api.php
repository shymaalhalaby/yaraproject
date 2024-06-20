<?php
use App\Models\User;
use App\Models\member;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\memberResource;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\coachController;
use App\Http\Controllers\lunchController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\DinnerController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\dietplanController;
use App\Http\Controllers\BreakfastController;
use App\Http\Controllers\DailyDietController;
use App\Http\Controllers\ExcerciseController;

use App\Http\Controllers\CoachMemberController;
use App\Http\Controllers\MonthlyPlanController;
use App\Http\Controllers\coach_memberController;
use App\Http\Controllers\nutritionistController;
use App\Http\Controllers\DailyExerciseController;
use App\Http\Controllers\MultipleUploadController;
use App\Http\Controllers\BreakFastMemberController;
use App\Http\Controllers\MemberExcerciseController;
use App\Http\Controllers\PlanedExcerciseController;
use App\Http\Controllers\PlannedExcerciseController;
use App\Http\Controllers\NutritionistMemberController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api'
], function () {
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        // Apply the CheckUserStatus middleware specifically to this route
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/cnlogin', [AuthController::class, 'cnlogin']);
    });

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::apiResource('members', MemberController::class);
        Route::patch('/profile', [MemberController::class, 'profile']);
        Route::apiResource('coaches', CoachController::class);
        Route::patch('/Cprofile', [CoachController::class, 'Cprofile']);
        Route::apiResource('Nutritionist', NutritionistController::class);
        Route::patch('/Nprofile', [NutritionistController::class, 'Nprofile']);


        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/user-profile', [AuthController::class, 'userProfile']);


        Route::post('/coachesR/{coach}', [CoachMemberController::class, 'sendRequest']);
        Route::get('/coach/{coachId}', [CoachMemberController::class, 'showRequests']);
        Route::get('/coach/{coachId}/sub', [CoachMemberController::class, 'showsubscribers']);
        Route::post('/coachesAccept/{id}', [CoachMemberController::class, 'AcceptRequest']);
        Route::post('/coachesReject/{id}', [CoachMemberController::class, 'RejectRequest']);


        Route::post('/NutritionistsR/{Nutritionist}', [NutritionistMemberController::class, 'sendRequest']);
        Route::get('/Nutritionistshowrequest/{NutritionistId}', [NutritionistMemberController::class, 'showRequests']);
        Route::get('/Nutritionist/{NutritionistId}/sub', [NutritionistMemberController::class, 'showsubscribers']);
        Route::post('/NutritionistsAccept/{id}', [NutritionistMemberController::class, 'AcceptRequest']);//id of request
        Route::post('/NutritionistsReject/{id}', [NutritionistMemberController::class, 'RejectRequest']);//id of request





        Route::post('/excercises', [ExcerciseController::class, 'store']);
        Route::post('/AddExcercise', [ExcerciseController::class, 'store']);
        Route::get('/excercise', [ExcerciseController::class, 'index']);
        Route::get('/excercisess/{Excercise}', [ExcerciseController::class, 'show']);
        Route::post('/PlannedExercise/{Excercise}/{DailyExercise}', [PlaneController::class, 'store']);
        Route::get('/PlanedExcerciseWithExercise/{id}', [PlaneController::class, 'index']);
        Route::put('/PlanedExcercise/{id}', [PlaneController::class, 'update']);


        Route::post('/DailyExercise/{member}', [DailyExerciseController::class, 'store']);
        Route::post('/DailyExercise/{member}/{day}/done', [DailyExerciseController::class, 'finish']);
        Route::get('/getPlans/{dailyExerciseId}', [PlaneController::class, 'getPlans']);


        Route::get('/DailyExercise/{member}', [DailyExerciseController::class, 'getByMember']);

        Route::post('upload', [MultipleUploadController::class, 'upload']);
        Route::get('/getImageById/{image_id}', [MultipleUploadController::class, 'getImageById']);



        Route::post('/DailyDiet/{member}', [DailyDietController::class, 'store']);
        Route::get('/DailyDiet/{member}', [DailyDietController::class, 'getByMember']);



        Route::post('/dietplan', [dietplanController::class, 'saveUserBreakfastSelection']);
        Route::get('/getbreakfast/{dailyDietId}', [dietplanController::class, 'getBreakfastDetailsByDailyDietId']);



        Route::post('/lunchForMember', [dietplanController::class, 'saveUserlunchSelection']);
        Route::get('/getlunch/{dailyDietId}', [dietplanController::class, 'getlunchDetailsByDailyDietId']);




        Route::post('/DinnerForMember', [dietplanController::class, 'saveUserDinnerSelection']);
        Route::get('/getDinner/{dailyDietId}', [dietplanController::class, 'getDinnerDetailsByDailyDietId']);



        Route::get('/getBreakFast', [BreakFastController::class, 'index']);
        Route::get('/getlunch', [lunchController::class, 'index']);
        Route::get('/getDinner', [DinnerController::class, 'index']);

    });

});







