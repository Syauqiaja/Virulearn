<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lkpd extends Model
{
    protected $guarded = [];

    public function activity(){
        return $this->belongsTo(Activity::class, 'activity_id');
    }

    public function isCompleted(){
        return UserLkpd::where('user_id', Auth::user()->id)->where('lkpd_id', $this->id)->exists();
    }

    public function userLkpd(){
        return $this->hasMany(UserLkpd::class, 'lkpd_id');
    }
}
