<?php

namespace App\Http\Controllers;

use App\Board;

class AppController extends Controller
{
    public function index()
    {
        $boards = Board::with('tasks')->get();
        // dd($boards);

        return view('app')->with(['boards' => $boards]);
    }
}
