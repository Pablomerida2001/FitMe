<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\SetController;
use App\Http\Controllers\UserWeightController;
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

//add middleware to check role
Route::name('food.')->middleware('web')->prefix('admin/foods')->group(function() {

    Route::post('createFood', [FoodController::class, 'create']);

    Route::delete('deleteFood', [FoodController::class, 'delete']);

    Route::post('modifyFood', [FoodController::class, 'modify']);
});

Route::name('exercise.')->middleware('web')->prefix('exercise')->group(function() {

    Route::get('getAllExercises', [ExerciseController::class, 'getAll']);

    Route::get('searchExercise', [ExerciseController::class, 'search']);

    Route::get('workout', [ExerciseController::class, 'getWorkout']);

    Route::post('addExercise', [ExerciseController::class, 'addToWorkout']);

    Route::delete('removeExercise', [ExerciseController::class, 'removeFromWorkout']);

    Route::post('editWorkout', [ExerciseController::class, 'edit']);

    Route::get('getExerciseSets', [SetController::class, 'getSets']);

    Route::post('updateSet', [SetController::class, 'updateSet']);

    Route::delete('deleteSet', [SetController::class, 'deleteSet']);

    Route::post('addSet', [SetController::class, 'addSet']);
});

Route::name('exercise.')->middleware('web')->prefix('admin/exercise')->group(function() {

    Route::post('createExercise', [ExerciseController::class, 'create']);

    Route::delete('deleteExercise', [ExerciseController::class, 'delete']);

    Route::post('editExercise', [ExerciseController::class, 'modify']);
});

Route::name('profile.')->middleware('web')->prefix('profile')->group(function() {

    Route::get('getWeight', [UserWeightController::class, 'get']);

    Route::post('addWeight', [UserWeightController::class, 'save']);

});