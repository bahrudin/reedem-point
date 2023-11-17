<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;
    protected $fillable = ['program_id','point_type','amount','start_at','expired_at','converted','min_points','reward'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function memberPoints()
    {
        return $this->hasMany(MemberPoint::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
