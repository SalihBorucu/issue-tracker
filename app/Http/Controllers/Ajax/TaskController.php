<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "title" => 'required',
        ]);
        // dd($request->board_id);
        $id = Auth::user()->id;

        $task = Task::create([
            "title" => $request->title,
            "board_id" => $request->board_id,
            "user_id" => $id,
            "is_completed" => 0,
        ]);
        $task = Task::with(['comments', 'comments.user'])->find($task->id);

        return response()->json([
            "task" => $task,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update($taskId, Request $request)
    {
        $task = Task::findOrFail($taskId);

        $validated = $request->validate([
            "title" => 'required',

        ]);
        // dd($request->description);

        $task->update([$validated, 'description' => $request->description]);
        $task = Task::with(['comments', 'comments.user'])->find($task->id);

        return response()->json([
            "task" => $task,
        ]);

    }

    public function updateBoard($taskId, Request $request)
    {
        $task = Task::findOrFail($taskId);

        $validated = $request->validate([
            "board_id" => 'required|exists:boards,id',
        ]);

        $task->update($validated);
        $task = Task::with('comments')->find($task->id);

        return response()->json([
            "task" => $task,
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json();

    }
}
