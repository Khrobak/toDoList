<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/groups', [\App\Http\Controllers\GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/create', [\App\Http\Controllers\GroupController::class, 'create'])->name('groups.create');
Route::post('/groups', [\App\Http\Controllers\GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/{group}/edit/', [\App\Http\Controllers\GroupController::class, 'edit'])->name('groups.edit');
Route::put('/groups', [\App\Http\Controllers\GroupController::class, 'update'])->name('groups.update');
Route::delete('/groups/{group}', [\App\Http\Controllers\GroupController::class, 'destroy'])->name('groups.destroy');

Route::get('/tasks/create/{group}', [\App\Http\Controllers\TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [\App\Http\Controllers\TaskController::class, 'store'])->name('tasks.store');
Route::get('/tasks/{task}/edit/', [\App\Http\Controllers\TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [\App\Http\Controllers\TaskController::class, 'destroy'])->name('tasks.destroy');
