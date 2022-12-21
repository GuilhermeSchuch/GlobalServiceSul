<?php

use Illuminate\Support\Facades\Route;

// INDEX
Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

// AUTH
Route::get('/auth', 'App\Http\Controllers\UserController@index')->name('auth');
Route::post('/auth/login', 'App\Http\Controllers\UserController@login')->name('login');
Route::post('/auth/register', 'App\Http\Controllers\UserController@register')->name('register');
Route::get('/logout', 'App\Http\Controllers\UserController@logout')->name('logout');

// CLIENT
Route::get('/client', 'App\Http\Controllers\ClientController@index')->name('client');
Route::delete('/client/{id}', 'App\Http\Controllers\ClientController@destroy')->name('client.destroy');
Route::put('/client/{id}', 'App\Http\Controllers\ClientController@update')->name('client.update');
Route::post('/client', 'App\Http\Controllers\ClientController@store')->name('client.post');

// SERVICE
Route::get('/service', 'App\Http\Controllers\ServiceController@index')->name('service');
Route::delete('/service/{id}', 'App\Http\Controllers\ServiceController@destroy')->name('service.destroy');
Route::put('/service/{id}', 'App\Http\Controllers\ServiceController@update')->name('service.update');
Route::post('/service', 'App\Http\Controllers\ServiceController@store')->name('service.post');
