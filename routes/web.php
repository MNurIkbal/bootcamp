<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/',[LoginController::class,'index']);
Route::post('/masuk',[LoginController::class,'masuk']);
Route::get('/dashboard',[LoginController::class,'dashboard']);
