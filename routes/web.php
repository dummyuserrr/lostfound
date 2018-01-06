<?php

Route::get('/', 'PagesController@index');
Route::get('/lost', 'PagesController@lost');

// users
Route::post('/login', 'UsersController@login');
Route::post('/logout', 'UsersController@logout');