<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index() {
        return view('todo.index');
    }

    public function todos(Request $request) {
        $status = $request->status;
        $user_id = Auth::id();

        if (!$status || $status === 'all') {
            $todos = User::find($user_id)->todos;
            return ['todos' => $todos];
        }

        $status = $status === 'completed' ? 1 : 0;
        $todos = User::find($user_id)->todos()->where('status', '=', $status)->get();
        return ['todos' => $todos];
    }

    public function create(Request $request) {
        $this->validate($request, Todo::$rules);
        $user_id = Auth::id();
        Todo::create([ 'todo' => $request->todo, 'status' => Todo::$defaultStatus, 'user_id' => $user_id ]);
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
