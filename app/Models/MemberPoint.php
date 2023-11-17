<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPoint extends Model
{
    use HasFactory;
    protected $fillable = ['program_id','point_id', 'user_id', 'amount_point'];

    public function point()
    {
        return $this->belongsTo(Point::class,'point_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function getTotalAmountPoint($userId, $programId = null)
    {
        $query = self::where('user_id', $userId);
        if ($programId !== null) {
            $query->where('program_id', $programId);
        }
        return $query->sum('amount_point');
    }

    public static function convertPointsToRupiah($amount)
    {
        $rupiahAmount = $amount * 100;
        return $rupiahAmount;
    }
}
