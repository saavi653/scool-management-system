<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable=[
        'name'
    ];

    public function roleId()
    {
        return $this->belongsToMany(RoleId::class,'permissions','role_id','feature_id');
    }
}
