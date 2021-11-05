<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
})->middleware('auth');
Route::get('/', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index')->middleware('auth');
Route::get('/index', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index')->middleware('auth');
Route::get('/home', [\App\Http\Controllers\TaskController::class, 'index'])->name('tasks.index')->middleware('auth');
Route::resource('tasks', \App\Http\Controllers\TaskController::class);
Route::get('/get_tasks', [\App\Http\Controllers\TaskController::class, 'get_tasks'])->name('tasks.get');

