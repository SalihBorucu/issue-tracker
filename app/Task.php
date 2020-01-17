<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'user_id', 'board_id', 'description', 'is_completed'];

    public function comments()
    {

        return $this->hasMany('App\Comment');
    }
}
