<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;
    protected $table = "exercises";
    public $timestamps = false;

    public function workout(){
        return $this->belongsToMany('App\Models\User', 'workout', 'exerciseId', 'userId')->withPivot(["id", "sets", "reps", "weight", "date"]);
    }
}
