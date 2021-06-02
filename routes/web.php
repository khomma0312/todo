<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function() {
	Route::get('/', [TodoController::class, 'index']);
	Route::post('/add', [TodoController::class, 'create']);
	Route::get('/todos', [TodoController::class, 'todos']);
	Route::post('/update', [TodoController::class, 'update']);
	Route::post('/delete', [TodoController::class, 'remove']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
