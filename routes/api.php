<?php

Route::get('/social/{provider}', 'AuthController@redirectToProvider');
Route::get('/social/{provider}/callback', 'AuthController@handleProviderCallback');

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/upload', 'AuthController@upload');
Route::post('/logout', 'AuthController@logout');
Route::post('/jogging/register', 'JoggingController@register');
Route::get('/jogging/getall', 'JoggingController@getall');
Route::post('/jogging/update', 'JoggingController@update');
Route::post('/jogging/delete', 'JoggingController@delete');
