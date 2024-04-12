<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable=[
        'subject',
        'description',
        'teacher_id'
    ];
    public function teacher()
    {
      return $this->belongsTo(User::class);
    }

    public function stdSub()
    {
        return $this->belongsToMany(User::class,'student_subjects','subject_id','user_id')->withPivot('status','reason');
    }

    public function assignedUser()
    {
        return $this->belongsToMany(User::class,'student_subjects','subject_id','user_id');
    }
}
