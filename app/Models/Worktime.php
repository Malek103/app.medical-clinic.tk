<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Worktime extends Model
{
    protected $table = "worktime";
    protected $fillable = [
        'id',
        'time',
        'date',
    ];
}
