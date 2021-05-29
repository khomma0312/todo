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
}
