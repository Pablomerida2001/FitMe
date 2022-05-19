<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercise;

class ExerciseController extends Controller{

    public function getAll(){
        return Exercise::all();
    }

    public function search(Request $request) {
            $query = $request->query('query');
            
            $exercises = Exercise::where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')->get();
    
            return $exercises;
    }

    public function getWorkout(Request $req){
        return User::find($req->user)->workout()->wherePivot('date', '=', $req->date)->get();
    }

    public function addToWorkout(Request $req){
        Exercise::find($req->exercise)->workout()->attach($req->user, ["sets" => $req->sets, "reps" => $req->reps, "weight"  => $req->weight, "date" => $req->date]);
    }

    public function removeFromWorkout(Request $req){
        Exercise::find($req->exercise)->workout()->wherePivot('date','=',$req->date)->detach($req->user);
    }

    public function edit(Request $req){
        Exercise::find($req->exercise)->workout()->updateExistingPivot($req->user, ["sets" => $req->sets, "reps" => $req->reps, "weight"  => $req->weight, "date" => $req->date]);
    }
    
}
