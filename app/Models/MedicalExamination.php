<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalExamination extends Model
{

    protected $table = 'medical_exminations';

    protected $fillable = [
        'name',
        'category_id',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
