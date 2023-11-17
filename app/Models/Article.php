<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title','category_id','point_id','program_id', 'slug','contents','author_id','is_publish'];

    public function point()
    {
        return $this->belongsTo(Point::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('read_at');
    }
}
