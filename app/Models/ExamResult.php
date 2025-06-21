<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'user_id',
        'exam_id',
        'point'
    ];

    public function answers(){
        return $this->hasMany(UserAnswer::class, 'exam_result_id');
    }
}
