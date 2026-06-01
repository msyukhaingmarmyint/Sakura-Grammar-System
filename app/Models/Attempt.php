<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attempt extends Model
{
    protected $fillable = [
        'user_id', 'exam_id', 'attempt_count', 'correct_answers','time_taken',
        'total_questions', 'mark', 'user_choices', 'status'
    ];

protected $casts = [
        'user_choices' => 'array',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function certificate(){
        return $this->hasOne(Certificate::class);
    }

    public function answers()
    {
        return $this->hasMany(Option::class); 
    }
}


