<?php

use App\Http\Controllers\Api\TodoApiController;
use Illuminate\Support\Facades\Route;

Route::get('/todos/summary', [TodoApiController::class, 'summary']);
Route::get('/todos', [TodoApiController::class, 'index']);