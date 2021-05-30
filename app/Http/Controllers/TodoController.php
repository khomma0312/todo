<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() {
        $items = Todo::all();
        return view('todo.index', ['items' => $items]);
    }

    public function create(Request $request) {
        $this->validate($request, Todo::$rules);

        Todo::create([ 'todo' => $request->todo, 'status' => Todo::$defaultStatus ]);
        return redirect('/');
    }
}
