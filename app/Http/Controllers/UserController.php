<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function updateCalories(Request $req){
        User::find($req->user)->update(['calories' => $req->calories]);
    }

    public function getCalories(Request $req){
        return User::find($req->user)->calories;
    }
}
