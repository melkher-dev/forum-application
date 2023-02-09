<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function indexForNotLoggedUser()
    {
        $threads = Thread::all();
        return inertia('Dashboard', [
            'threads' => $threads
        ]);
    }
    public function index()
    {
        $threads = Thread::all();
        return inertia('Threads/Threads', [
            'threads' => $threads
        ]);
    }

    public function create(Request $request)
    {
        $thread = new Thread;
        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->user_id = Auth::id();
        $thread->save();

        return redirect()->route('threads.index')->with('success', 'Thread created successfully');
    }

    public function edit($id)
    {
        $thread = Thread::find($id);
        return inertia('threads.edit', [
            'thread' => $thread
        ]);
    }

    public function update(Request $request, $id)
    {
        $thread = Thread::find($id);
        $thread->title = $request->input('title');
        $thread->body = $request->input('body');
        $thread->save();

        return redirect()->route('threads.index')->with('success', 'Thread updated successfully');
    }

    public function delete($id)
    {
        $thread = Thread::find($id);
        $thread->delete();

        return redirect()->route('threads.index')->with('success', 'Thread deleted successfully');
    }
}
