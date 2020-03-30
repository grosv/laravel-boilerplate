<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', [WelcomeController::class, 'render'])->name('welcome');
Route::get('/home', [HomeController::class, 'render'])->name('home');

