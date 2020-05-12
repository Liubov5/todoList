<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deals = Todo::all()->where('user_id', Auth::user()->id);
        return view('newtodo',['deals'=>$deals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $time = date('Y-m-d', strtotime($request->body["date"]));

        $id = Todo::create([
            'text'=> $request->body["deal"],
            'date'=> $time,
            'status'=> false,
            'user_id'=>$request->body["user_id"],
        ]);
        
       $deals = Todo::all()->where('user_id', Auth::user()->id);
        return $deals;

        //return $request;
    }

    public function delete(Request $request){
        
    
        $todo = Todo::find($request->body);
        $todo->delete();

       $deals = Todo::all()->where('user_id', Auth::user()->id);
        return $deals;
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
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        //сделать uncheck
        $todo = Todo::find($request->body);
        $todo->status = 1;
        $todo->save();
        $deals = Todo::all()->where('user_id', Auth::user()->id);
        return $deals;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
