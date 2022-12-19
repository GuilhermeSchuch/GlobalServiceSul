<?php

use Illuminate\Support\Facades\Route;

// INDEX
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// AUTH
Route::get('/auth', 'App\Http\Controllers\UserController@index')->name('auth');
Route::post('/auth/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('/auth/register', 'App\Http\Controllers\UserController@register')->name('register');
Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');