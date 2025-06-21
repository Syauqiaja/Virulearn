<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Material extends Model
{
    protected $guarded = [];

    public function activity(){
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function userProgress(){
        return $this->hasOne(UserMaterialProgress::class,'material_id')->where('user_id', Auth::user()->id);
    }
    public function next(){
        return $this->activity->materials()->where('order', $this->order + 1)->first();
    }
    public function previous(){
        return $this->activity->materials()->where('order', $this->order - 1)->first();
    }
}
