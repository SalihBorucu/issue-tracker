<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['title', 'color'];

    public function tasks()
    {

        return $this->hasMany('App\Task');
    }
}
