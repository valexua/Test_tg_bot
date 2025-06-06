<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

# test DB
# Route::get('/dbcon',fn () => response()->json( DB::SELECT("SELECT * FROM users") ) ) ;


Route::post('/telegram/webhook',[App\Http\Controllers\TelegramController::class,'index']);

Route::get('/users',[App\Http\Controllers\UserController::class,'getUser']);

Route::any('/run/search/task',[App\Http\Controllers\RunCommandController::class,'run_task_command']);
Route::any('/get/task/service/{userID}',[App\Http\Controllers\UserController::class, 'chekTask']);
