<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];


    public function materials(){
        return $this->hasMany(Material::class, 'activity_id');
    }
}
