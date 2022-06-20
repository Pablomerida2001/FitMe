<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeight extends Model
{
    use HasFactory;
    protected $table = "weight_progress";
    public $timestamps = false;

    protected $fillable = ['user', 'weight', 'date'];
}
