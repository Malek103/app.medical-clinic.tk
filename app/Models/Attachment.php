<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = ['image'];
    use HasFactory;

    public function getCreatedFormatAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

}
