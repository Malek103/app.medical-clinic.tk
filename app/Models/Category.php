<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    use HasFactory;
    public function mexamination()
    {
        return $this->hasMany(MedicalExamination::class,'category_id','id');
    }
}
