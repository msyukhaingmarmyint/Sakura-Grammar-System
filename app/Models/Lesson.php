<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title','structure','explanation','example','status','level_id',
    ];

    public function level(){
        return $this->belongsTo(Level::class);
    }
}
