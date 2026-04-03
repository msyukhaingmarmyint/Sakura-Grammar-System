<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'attempt_id',
    ];

    public function attempt(){
        return $this->belongsTo(Attempt::class);
    }
}
