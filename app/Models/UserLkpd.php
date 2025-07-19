<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLkpd extends Model
{
    protected $guarded = [];

    public function lkpd(){
        return $this->belongsTo(Lkpd::class, 'lkpd_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
