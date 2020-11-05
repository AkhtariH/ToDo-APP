<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todoList = Todo::latest()->paginate(5);

        return view('list', compact('todoList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required'
        ]);

        Todo::create($request->all());

        return redirect()->route('list.index')->with('success', 'Item was added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Todo::findOrFail($id);
        return view('edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'value' => 'required',
        ]);

        $item = Todo::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('list.index')->with('success', 'Item was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Todo::findOrFail($id);
        $item->delete();

        return redirect()->route('list.index')->with('success', 'Item was deleted!');
    }

    // Use update method for that
    public function check(Request $request) {
        $item = Todo::findOrFail($request->input('id'));
        $item->checked = $request->input('checked');
        
        $item->save();
    }
}
