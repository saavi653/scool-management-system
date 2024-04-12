<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoleId extends Model
{
    use HasFactory;
    protected $table='role_id';

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'permissions','role_id','feature_id');
    }

}

