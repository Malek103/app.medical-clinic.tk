<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{

    protected $table = 'pharmaceuticales';

    protected $fillable = [
        'name',
        'instructions'
    ];


}
