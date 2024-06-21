<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Validator;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return response()->json([
            'status' => 'success',
            'todos'  => $todos,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'title'       => 'required|string',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $todo = Todo::create([
            'title'       => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'status'  => 'success',
            'message' => 'Todo created successfully',
            'todo'    => $todo,
        ]);
    }

    public function show($id)
    {
        $todo = Todo::find($id);
        return response()->json([
            'status' => 'success',
            'todo'   => $todo,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(request()->all(), [
            'title'       => 'required|string',
            'description' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $todo              = Todo::find($id);
        $todo->title       = $request->title;
        $todo->description = $request->description;
        $todo->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Todo updated successfully',
            'todo'    => $todo,
        ]);
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Todo deleted successfully',
            'todo'    => $todo,
        ]);
    }
}
