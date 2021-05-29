<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    // ステータスはデフォルトで0（未完了）にしておく
    public static $defaultStatus = 0;
    public static $doneStatus = 1;
    protected $isDone = 1;

    public static $rules = [
        'todo' => 'required',
    ];

    public function isDone() {
        return (int) $this->status === $this->isDone;
    }
}
