<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class ReadyList extends Model
{

    protected $table = 'ready_list';

    protected $fillable = [
        'id',
        'reservation_id',
        'status',
        'created_at'
    ];
}
