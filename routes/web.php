<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
})->middleware(['guest', 'checkLocale'])->name('landing');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'checkLocale'])->name('dashboard');

Route::get('/myFoods', function(){
    return view('foods/MyFoods');
})->middleware(['auth', 'checkLocale'])->name('myFoods');

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    $user = App\Models\User::find(Auth::user()->id);
    $user->lang = $locale;
    $user->save();
    return redirect()->back();
})->middleware('checkLocale')->name('locale.setting');

Route::get('/Workouts', function(){
    return view('workouts');
})->middleware(['auth', 'checkLocale'])->name('Workouts');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
