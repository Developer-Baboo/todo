<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/todos', [App\Http\Controllers\TodoController::class, 'index']);
Route::post('/todosStore', [App\Http\Controllers\TodoController::class, 'store']);
Route::post('/todosUpdate', [App\Http\Controllers\TodoController::class, 'update']);
// Route::post('/todosUpdate', [TodoController::class, 'update']);
Route::delete('/todos/{id}', [App\Http\Controllers\TodoController::class, 'destroy']);
