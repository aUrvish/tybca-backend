<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function inputs()
    {
        return $this->hasMany(QuizInput::class , 'question_id', 'id');
    }
}
