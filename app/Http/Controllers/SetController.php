<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Set;

class SetController extends Controller
{
    public function getSets(Request $req){
        return Set::where('workoutId', $req->workoutId)->get();
    }
}
