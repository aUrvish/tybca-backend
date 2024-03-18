<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrie extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class , 'id', 'user_id');
    }

    public function responce()
    {
        return $this->hasMany(Responce::class , 'entries_id', 'id');
    }
}
