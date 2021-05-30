<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request) {
        $status = $request->status;

        if (!$status || $status === 'all') {
            return ['todos' => Todo::all()];
        }

        $status = $status === 'completed' ? 1 : 0;
        return ['todos' => Todo::where(['status' => $status])->get()];
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
