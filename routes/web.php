<?php

use App\Http\Controllers\Welcome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', Welcome::class)->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
