<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMaterialProgress extends Model
{
    protected $fillable = [
        'user_id',
        'material_id',
        'is_completed',
        'last_viewed_at',
    ];

    public function material(){
        return $this->belongsTo(Material::class, 'material_id');
    }
}
