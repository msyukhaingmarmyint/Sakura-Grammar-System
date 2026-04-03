<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','pass_mark','level_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function attempts(){
        return $this->hasMany(Attempt::class);
    }
}
