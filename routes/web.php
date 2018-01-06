<?php

Route::get('/', 'PagesController@index');
Route::get('/lost-something', 'PagesController@lost');

// users
Route::post('/login', 'UsersController@login');
Route::post('/logout', 'UsersController@logout');

// lost items
Route::post('/lost-something/add', 'LostItemsController@store')->middleware('checkUserSession');
