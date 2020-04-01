<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TemporaryController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/* TEMPORARY ROUTES - DELETE BEFORE GOING LIVE */
Route::get('/tmp', [TemporaryController::class, 'render'])->name('tmp');
/* END TEMPORARY ROUTES */
Auth::routes();
Route::get('/', [WelcomeController::class, 'render'])->name('welcome');
Route::get('/home', [HomeController::class, 'render'])->name('home');

