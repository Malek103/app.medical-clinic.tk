<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class ResExam extends Model
{

    protected $table = 'reservations_examinations';

    protected $fillable = [
        'examination_id',
        'reservation_id',
        'customer_id',
        'note',
        'result'
    ];


}
