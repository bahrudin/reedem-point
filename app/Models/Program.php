<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function memberPoints()
    {
        return $this->hasMany(MemberPoint::class);
    }

    public function isUserRegistered($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }

    //
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_programs')->withTimestamps();
    }

}
