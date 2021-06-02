<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TodoController extends Controller
{
    public function index(Request $request) {
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
}
