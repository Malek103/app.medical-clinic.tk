<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;
class Customer extends Model
{

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'phone1',
        'phone2',
        'email',
        'gender',
        'image',
        'birthdate',
        'blood_type',
        'id_number',
        'user_id',
        'user_updated_id',
        'height',
        'marital_status',
        'job',
        'final_report',
        'is_sensitive',
        'is_sick',
        'note',
    ];

    public function getAgeAttribute()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }

    public function reservations(){
        return $this->hasOne(Reservation::class);
    }

    public function payments(){
        return $this->hasOne(Payment::class);
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {

            return "/uploads/patients.png";
        }
        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }
        return "/uploads/{$this->image}";
    }
}
