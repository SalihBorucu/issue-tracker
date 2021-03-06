<?php

namespace App;

// use App\Events\BoardDeleted;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable = ['title', 'color'];

    // protected $dispatchesEvents = [
    //     // When board is deleted...
    //     'deleted' => BoardDeleted::class,
    // ];

    public function tasks()
    {

        return $this->hasMany('App\Task');
    }
}
