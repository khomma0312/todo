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

    public function update(Request $request) {
        // ステータスのアップデート処理
        $item = Todo::find($request->id);

        if (!isset($item)) {
            return ['id' => null];
        }

        $status = $request->status;
        $updatedStatus = (int)$status === Todo::$defaultStatus ? Todo::$doneStatus : Todo::$defaultStatus;

        $item->status = $updatedStatus;
        $item->save();

        return ['id' => $item->id, 'status' => $item->status];
    }

    public function remove(Request $request) {
        $item = Todo::find($request->id);
        $id = null;

        if (isset($item)) {
            $item->delete();
            $id = $item->id;
        }

        // 削除した対象のidを返す
        return ['id' => $id];
    }
}
