<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResMedicine extends Model
{

    protected $table = 'reservations_medicines';

    protected $fillable = [
        'medicine_id',
        'reservation_id',
        'customer_id',
        'note',
        'instructions',
    ];

    public function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
