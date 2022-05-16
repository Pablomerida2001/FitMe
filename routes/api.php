<?php

use App\Http\Controllers\FoodController;
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

Route::middleware('web')->get('foods/getAllFoods', [FoodController::class, 'getAll']);

Route::middleware('web')->get('foods/searchFoods', [FoodController::class, 'search']);

Route::middleware('web')->get('foods/consumedFoods', [FoodController::class, 'get']);

Route::middleware('web')->post('foods/addConsumedFood', [FoodController::class, 'add']);

Route::middleware('web')->delete('foods/deleteConsumedFood', [FoodController::class, 'remove']);

Route::middleware('web')->post('foods/editConsumedFood', [FoodController::class, 'edit']);