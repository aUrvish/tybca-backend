<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class , 'id', 'user_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class , 'id', 'cource_id');
    }

    public function quiz()
    {
        return $this->hasOne(quiz::class , 'id', 'quiz_id')->with('user');
    }
}
