<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'city',
        'gender',
        'people_card',
        'phone',
        'referral_id'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'user_programs');
    }

    public function hasPrograms()
    {
        return $this->belongsToMany(Program::class, 'user_programs');
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class)->withPivot('read_at');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function memberPoints()
    {
        return $this->hasMany(MemberPoint::class, 'user_id');
    }
    // User.php
    public function getExpiredPoints()
    {
        return $this->memberPoints()
            ->join('points', 'member_points.point_id', '=', 'points.id')
            ->where('points.expired_at', '>', now())
            ->select('points.expired_at')
            ->get();
    }

}
