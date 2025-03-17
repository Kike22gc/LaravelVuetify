<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

// API Login
Route::post('/api/user/signUp', [UserController::class, 'signUp']);
Route::post('/api/user/login', [UserController::class, 'login']);
Route::post('/api/user/logout', [UserController::class, 'logout']);
Route::get('/api/user/data', [UserController::class, 'user']);