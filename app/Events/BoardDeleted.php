<?php

namespace App\Events;

use App\Board;
use Illuminate\Queue\SerializesModels;

class BoardDeleted
{
    use SerializesModels;

    public $board;

    public function __construct(Board $board)
    {
        $this->board = $board;

    }

}
