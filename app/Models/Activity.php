<?php

namespace App\Models;

use App\Livewire\Activities\TestType;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];
     public function tests(TestType $testType){
        return $this->hasMany(Exam::class, 'activity_id')->where('type', $testType->value);
    }
    

    public function preTests(){
        return $this->hasMany(Exam::class, 'activity_id')->where('type', TestType::PRETEST->value);
    }
    
    public function latsol(){
        return $this->hasMany(Exam::class, 'activity_id')->where('type', TestType::LATSOL->value);
    }

    public function postTests(){
        return $this->hasMany(Exam::class, 'activity_id')->where('type', TestType::POSTTEST->value);
    }
    
    public function materials(){
        return $this->hasMany(Material::class, 'activity_id');
    }
}
