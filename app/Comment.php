<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['message', 'user_id', 'task_id'];

    // To add to the model (so dont have to pass it through from blade)
    protected $appends = ['human_readable_date'];

    public function getHumanReadableDateAttribute()
    {
        // Make Date Human Readable
        return $this->updated_at->diffForHumans();
    }

    public function user()
    {

        return $this->belongsTo('App\User');
    }
}
