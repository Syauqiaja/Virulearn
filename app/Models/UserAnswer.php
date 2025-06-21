<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    protected $fillable = [
        'answer',
        'exam_result_id',
        'question_id',
        'is_correct'
    ];
}
