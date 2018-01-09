<?php

Route::get('/', 'PagesController@index');
Route::get('/lost-something', 'PagesController@lost');

// users
Route::post('/login', 'UsersController@login');
Route::post('/logout', 'UsersController@logout');

// lost items
Route::post('/lost-something/add', 'LostItemsController@store')->middleware('checkUserSession');
Route::delete('/lost-something/{item}/delete', 'LostItemsController@destroy')->middleware('checkUserSession');

// lost items comments
Route::post('/lost-something/{item}/comment/add', 'LostItemCommentsController@store')->middleware('checkUserSession');
Route::delete('lost-something/{lostitem}/comment/{item}/delete', 'LostItemCommentsController@destroy')->middleware('checkUserSession');