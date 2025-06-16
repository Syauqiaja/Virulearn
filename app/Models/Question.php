<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        "exam_id",
        "question_text",
        "order",
        "answer_a",
        "answer_b",
        "answer_c",
        "answer_d",
        "correct_answer",
    ];

    public function exam(){
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
