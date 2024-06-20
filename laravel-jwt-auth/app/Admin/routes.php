<?php

use Illuminate\Routing\Router;
use App\Admin\Controllers\UserController;
use App\Admin\Controllers\CoachController;
use App\Admin\Controllers\LunchController;
use App\Admin\Controllers\DinnerController;
use App\Admin\Controllers\memberController;
use App\Admin\Controllers\Dinner1Controller;
use App\Admin\Controllers\ExerciseController;
use App\Admin\Controllers\BreakFastController;
use App\Admin\Controllers\NutritionistController;
use App\Admin\Controllers\MultipleUploadController;
use App\Admin\Controllers\NutritionistMemberController;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('users', UserController::class);
    $router->resource('coaches', CoachController::class);
    $router->resource('nutritionists', NutritionistController::class);
    $router->resource('members', memberController::class);
    $router->resource('images', MultipleUploadController::class);
    $router->resource('break-fasts', BreakFastController::class);
    $router->resource('lunches', LunchController::class);
    $router->resource('dinners', DinnerController::class);
    $router->resource('excercises', ExerciseController::class);
});
