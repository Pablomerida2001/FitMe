<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;

class SetController extends Controller
{
    public function getSets(Request $req){
        return Set::where('workoutId', $req->workoutId)->get();
    }

    public function updateSet(Request $req){
        Set::find($req->set)->update(["reps" => $req->reps, "weight"  => $req->weight]);
    }

    public function deleteSet(Request $req){
        Set::find($req->set)->delete();
    }

    public function addSet(Request $req){
        $set = new Set(['reps' => 0, 'weight' => 0, 'workoutId' => $req->workout]);
        $set->workoutId = $req->workout;
        $set->save();
    }
}
