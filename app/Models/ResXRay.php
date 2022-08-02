<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResXRay extends Model
{

    protected $table = 'reservations_xrays';

    protected $fillable = [
        'xray_id',
        'reservation_id',
        'customer_id',
        'result',
        'note'
    ];

    public function xray(){
        return $this->belongsTo(XRay::class);
    }

}
