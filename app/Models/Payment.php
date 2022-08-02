<?php

namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;

class Payment extends Model
{

    protected $table = 'payments';

    protected $fillable = [
        'value',
        'customer_id',
        'reservation_id',
        'user_id',
        'note',
    ];

    public function customer() {
        return $this->HasOne(Customer::class,"id","customer_id");
    }

    public function user() {
        return $this->HasOne(User::class,"id","user_id");
    }
}
