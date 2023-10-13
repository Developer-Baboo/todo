<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::resource('todos', 'TodoController');
// Route::get('/todos', [TodoController::class, 'index']);
Route::get('/todos', [App\Http\Controllers\TodoController::class, 'index']);
// Route::get('/todos', function(){
//     dd("test");
// });
