<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','status',
    ];

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function exam()
    {
        return $this->hasOne(Exam::class);
    }
}
