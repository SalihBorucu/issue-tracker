<?php

namespace App\Http\Controllers\Ajax;

use App\Board;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => 'required',
            "color" => 'required',
        ]);

        $board = Board::create($validated);
        $board = Board::with('tasks')->find($board->id);

        return response()->json([
            "board" => $board,
        ]);
    }

    public function update($boardId, Request $request)
    {
        $board = Board::findOrFail($boardId);

        $validated = $request->validate([
            "title" => 'required',
            "color" => 'required',
        ]);

        $board->update($validated);

        return response()->json([
            "board" => $board,
        ]);
    }
}
