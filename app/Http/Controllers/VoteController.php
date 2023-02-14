<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Thread;
use App\Models\Comment;
use Illuminate\Http\Request;

class VoteController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function show(Vote $vote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function edit(Vote $vote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vote $vote)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vote  $vote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vote $vote)
    {
        //
    }

    /**
     * upvoteComment
     *
     * @param  mixed $request
     * @param  mixed $model
     * @return void
     */
    public function upvoteComment(Comment $comment)
    {
        $vote = new Vote();
        $vote->type = 'up';
        $vote->user_id = auth()->user()->id;
        $vote->comment_id = $comment->id;
        $vote->save();
    }

    /**
     * downvoteComment
     *
     * @param  mixed $request
     * @param  mixed $model
     * @return void
     */
    public function downvoteComment(Comment $comment)
    {
        $vote = new Vote();
        $vote->type = 'down';
        $vote->user_id = auth()->user()->id;
        $vote->comment_id = $comment->id;
        $vote->save();
    }

    /**
     * upvoteThread
     *
     * @param  mixed $request
     * @return void
     */
    public function upvoteThread(Thread $thread)
    {
        $vote = new Vote();
        $vote->type = 'up';
        $vote->user_id = auth()->user()->id;
        $vote->thread_id = $thread->id;
        $vote->save();
    }

    /**
     * downvoteThread
     *
     * @param  mixed $request
     * @return void
     */
    public function downvoteThread(Thread $thread)
    {
        $vote = new Vote();
        $vote->type = 'down';
        $vote->user_id = auth()->user()->id;
        $vote->thread_id = $thread->id;
        $vote->save();
    }
}
