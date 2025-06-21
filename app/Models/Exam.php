<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    protected $fillable  = [
        'activity_id',
        'type',
        'duration',
        'kkm',
    ];

    public function questions(){
        return $this->hasMany(Question::class, 'exam_id')->orderBy('order');
    }
    public function activity(){
        return $this->belongsTo(Activity::class,'activity_id');
    }
    public function examResults(){
        return $this->hasMany(ExamResult::class,'exam_id');
    }
    public function isCompleted(){
        return $this->examResults()->where('user_id', Auth::user()->id)->where('point', '>=', ($this->kkm ?? 1) / 100)->count() > 0;
    }
}
