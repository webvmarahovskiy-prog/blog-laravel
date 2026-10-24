<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/contact', 'contact')->name('contact');
Route::view('/reviews', 'reviews')->name('reviews');
