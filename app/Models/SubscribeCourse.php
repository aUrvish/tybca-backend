<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscribeCourse extends Model
{
    use HasFactory;

    public function subscribe()
    {
        return $this->hasOne(Course::class , 'id', 'course_id');
    }

    public function user()
    {
        return $this->hasOne(User::class , 'id', 'user_id');
    }
}
