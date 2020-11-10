<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
    public function store(TodoRequest $request)
    {
        $request->validated();

        $data = collect(['value' => $request->value]);

        if ($request->has('image_path')) {
            $imageName = time() . '.' . $request->image_path->extension();  
            $request->image_path->move(public_path('img/uploads/'), $imageName);
            $data->put('image_path', $imageName);
        }
    
        Todo::create($data->toArray());

        return redirect()->route('list.index')->with('success', 'Item was added!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $id
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
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $request->validated();

        $data = collect(['value' => $request->value]);
        $item = Todo::findOrFail($id);

        if ($request->has('image_path')) {
            $imageName = time() . '.' . $request->image_path->extension();  
            $request->image_path->move(public_path('img/uploads/'), $imageName);
            $data->put('image_path', $imageName);

            if(File::exists(public_path('img/uploads/' . $item->image_path))){
                File::delete(public_path('img/uploads/' . $item->image_path));
            }
        }

        if ($request->has('remove')){
            if(File::exists(public_path('img/uploads/' . $item->image_path))){
                File::delete(public_path('img/uploads/' . $item->image_path));
            }
            
            $data->put('image_path', null);
        }

        $item->update($data->toArray());

        return redirect()->route('list.index')->with('success', 'Item was updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Todo::findOrFail($id);
        $item->delete();

        return redirect()->route('list.index')->with('success', 'Item was deleted!');
    }

    /**
     * Updates checked column in storage
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function check(Request $request) {
        $item = Todo::findOrFail($request->input('id'));
        $item->checked = $request->input('checked');
        
        $item->save();
    }
}
