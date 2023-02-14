<?php

namespace App\Http\Controllers;

use App\Models\Vote;
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
    public function store($voteableModel, $voteableType, $voteableId)
    {
        $userVote = auth()->user()->votes()->where('voteable_id', $voteableId)->first();

        if ($userVote && $userVote->type == $voteableType) {
            $userVote->delete();
            return back();
        }

        if ($userVote && $userVote->type !== $voteableType) {
            $userVote->delete();
            return back();
        }

        Vote::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
                'voteable_id' => $voteableId,
                'voteable_type' => $voteableModel,
            ],
            [
                'type' => $voteableType
            ]
        );

        return back();
    }

    public function votes($voteableId)
    {
        $voteUp = Vote::where('voteable_id', $voteableId)->where('type', 'upvote')->count();
        $voteDown = Vote::where('voteable_id', $voteableId)->where('type', 'downvote')->count();
        $voteResult = $voteUp - $voteDown;

        return $voteResult;
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
}
