<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table='attendance';

    protected $fillable=[
        'user_id',
        'date',
        'timeout',
        'timein'
    ];

    public function attendance()
    {
        return $this->belongsTo(User::class);
    }
}
