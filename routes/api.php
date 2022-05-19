<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::name('food.')->middleware('web')->prefix('foods')->group(function() {

    Route::get('getAllFoods', [FoodController::class, 'getAll']);

    Route::get('searchFoods', [FoodController::class, 'search']);

    Route::get('consumedFoods', [FoodController::class, 'get']);

    Route::post('addConsumedFood', [FoodController::class, 'add']);

    Route::delete('deleteConsumedFood', [FoodController::class, 'remove']);

    Route::post('editConsumedFood', [FoodController::class, 'edit']);
});

Route::name('exercise.')->middleware('web')->prefix('exercise')->group(function() {

    Route::get('getAllExercises', [ExerciseController::class, 'getAll']);

    Route::get('searchExercise', [ExerciseController::class, 'search']);

    Route::get('workout', [ExerciseController::class, 'getWorkout']);

    Route::post('addExercise', [ExerciseController::class, 'addToWorkout']);

    Route::delete('removeExercise', [ExerciseController::class, 'removeFromWorkout']);

    Route::post('editWorkout', [ExerciseController::class, 'edit']);

    Route::get('getExerciseSets', [SetController::class, 'getSets']);
});