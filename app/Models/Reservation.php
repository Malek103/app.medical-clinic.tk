<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Reservation extends Model
{

    protected $table = 'reservations';

    protected $fillable = [
        'date',
        'day',
        'start_time',
        'end_time',
        'customer_id',
        'user_id',
        'price',
        'status',
        'note',
        'work_time'
    ];
    public function getRemainingAttribute()
    {

        return $this->price - $this->total_payments;
    }

    public function customer() {
        return $this->HasOne(Customer::class,"id","customer_id");
    }
}
