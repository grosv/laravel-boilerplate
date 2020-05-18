<?php


use App\Http\Controllers\Temporary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/** @todo - Delete this entire group of routes before launch */
Route::group(['prefix' => 'tmp'], function() {
    Route::get('/panic', [Temporary::class, 'panic'])->name('panic-if-launched');
});

