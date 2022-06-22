<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercise;
use App\Models\Set;

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
        Exercise::find($req->exercise)->workout()->attach($req->user, ["date" => $req->date]);

        $id = User::find($req->user)->workout()->wherePivot('date', '=', $req->date)->where('exerciseId', '=', $req->exercise)->latest('id')->get()->first()->pivot->id;

        for($i = 0; $i < $req->sets; $i++){
            $set = new Set(['reps' => 0, 'weight' => 0, 'workoutId' => $id]);
            $set->workoutId = $id;
            $set->save();
        }
    }

    public function removeFromWorkout(Request $req){
        Exercise::find($req->exercise)->workout()->wherePivot('id', '=', $req->workoutId)->detach($req->user);
    }

    public function edit(Request $req){
        Exercise::find($req->exercise)->workout()->updateExistingPivot($req->user, ["sets" => $req->sets, "reps" => $req->reps, "weight"  => $req->weight, "date" => $req->date]);
    }
    
    public function create(Request $req){
        $exercise = new Exercise(['id' => null, 'name' => $req->name, 'description' => $req->description]);
        $exercise->save();
    }

    public function delete(Request $req){
        Exercise::find($req->exercise)->delete();
    }

    public function modify(Request $req){
        Exercise::find($req->exercise)->update(['name' => $req->name, 'description' => $req->description]);
    }
}
