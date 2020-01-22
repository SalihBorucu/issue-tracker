<?php

namespace App\Http\Controllers;

use App\Board;

class AppController extends Controller
{
    public function index()
    {
        $boards = Board::with(['tasks', 'tasks.comments', 'tasks.comments.user'])->get();

        return view('app')->with(['boards' => $boards]);
    }
}
