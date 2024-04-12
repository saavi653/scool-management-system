<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'phone',
        'qualification',
        'role_id',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setNameAttribute($value)
    {
      $this->attributes['name']=ucfirst($value);
    }
    public function subject()
    {
      return $this->hasMany(Subject::class,'teacher_id');
    }

    public function studentSub()
    {
        return $this->belongsToMany(Subject::class,'student_subjects','subject_id','user_id');
    }
    
    public function attendance()
    {
        return $this->hasMany(Attendance::class,'user_id');
    }
    public function attendanceToday()
    {
        return $this->hasMany(Attendance::class)->where('date', Carbon::today());
    }

    public function try()
    {
        return $this->belongsToMany(Subject::class,'student_subjects','subject_id','user_id');
    }
}
