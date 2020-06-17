<?php

namespace App\Http\Controllers;

use App\Thought;
use Illuminate\Http\Request;

class ThoughtController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        return Thought::all()->where('user_id', $req->body["user_id"])->where('date', $req->body['date']);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        
       Thought::updateOrCreate(
            ['date' => $req->body['date'], 'user_id' => $req->body["user_id"]],
            ['text'=>$req->body["text"]]
        );

        return $id;
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
     * @param  \App\Thought  $thought
     * @return \Illuminate\Http\Response
     */
    public function show(Thought $thought)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thought  $thought
     * @return \Illuminate\Http\Response
     */
    public function edit(Thought $thought)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thought  $thought
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thought $thought)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thought  $thought
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thought $thought)
    {
        //
    }
}
