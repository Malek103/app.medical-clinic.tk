<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class XRay extends Model
{

    protected $table = 'xrays';

    protected $fillable = [
        'name',
        'note'
    ];


}
