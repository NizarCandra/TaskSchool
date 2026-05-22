<?php

use App\Http\Controllers\Api\TaskApiController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskApiController::class, 'index']);
Route::post('/tasks', [TaskApiController::class, 'store']);
Route::get('/tasks/{task}', [TaskApiController::class, 'show']);
Route::put('/tasks/{task}', [TaskApiController::class, 'update']);
Route::delete('/tasks/{task}', [TaskApiController::class, 'destroy']);
