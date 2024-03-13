<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->hasMany(Question::class , 'quiz_id', 'id')->with('inputs');
    }

    public function course()
    {
        return $this->hasOne(Course::class , 'id', 'course_id');
    }
}
