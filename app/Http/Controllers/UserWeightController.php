<?php

namespace App\Http\Controllers;

use App\Models\UserWeight;
use Illuminate\Http\Request;

class UserWeightController extends Controller{
    
    public function get(Request $req){
        return UserWeight::where('user', $req->user)->orderBy('date', 'DESC')->get();
    }

    public function save(Request $req){
        $weight = new UserWeight(['user' => $req->user, 'weight' => $req->weight, 'date' => $req->date]);
        $weight->save();
    }
}
