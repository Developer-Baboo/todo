<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Log;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd("test");
        // echo "Hello0";
        // $todos = Todo::get();
        // return response()->json(['todos' => $todos], 200);
        $todos = Todo::orderBy('created_at', 'desc')->get();
        return response()->json($todos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Create new todo
        $todo = Todo::create(['name' => $request->input('name')]);

        // Get updated list of todos
        $todos = Todo::all();

        return response()->json($todos);
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        echo "Hello";

        try {
            // Find the todo item by id
            $todo = Todo::find($request->id);

            // Update the todo item with new data
            $todo->name = $request->name;
            $todo->save();

            // Return the updated todo item
            return response()->json($todo);
        } catch (\Exception $e) {
            // Log the exception message for debugging
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
            return response()->json('Todo deleted successfully');
        } else {
            return response()->json('Todo not found', 404);
        }
    }
}
