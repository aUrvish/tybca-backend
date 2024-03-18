<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responce extends Model
{
    use HasFactory;

    public function question()
    {
        return $this->hasOne(Question::class , 'id', 'que_id');
    }

    public function input()
    {
        return $this->hasOne(QuizInput::class , 'id', 'option_id');
    }
}
