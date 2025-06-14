<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $guarded = [];
    public function contents(){
        return $this->hasMany(MaterialContent::class, 'material_id');
    }
}
