<?php

namespace App\Listeners;

use App\Events\BoardDeleted;

class DeleteRelatedBoardTasks
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BoardDeleted  $event
     * @return void
     */
    public function handle(BoardDeleted $event)
    {
        $board = $event->board;

        $board->tasks()->delete();

    }
}
