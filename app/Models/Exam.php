<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable  = [
        'activity_id',
        'type',
    ];

    public function questions(){
        return $this->hasMany(Question::class, 'exam_id')->orderBy('order');
    }
}
