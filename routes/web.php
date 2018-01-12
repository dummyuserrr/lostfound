<?php

Route::get('/', 'PagesController@index');
Route::get('/lost-something', 'PagesController@lost');

// users
Route::post('login', 'UsersController@login');
Route::post('logout', 'UsersController@logout');
Route::get('user/{user}', 'PagesController@userView');
Route::get('my-account', 'PagesController@myAccount')->middleware('checkUserSession');
Route::patch('my-account', 'UsersController@patch')->middleware('checkUserSession');
Route::post('register', 'UsersController@register');

// lost items
Route::post('lost-something/add', 'LostItemsController@store')->middleware('checkUserSession');
Route::delete('lost-something/{item}/delete', 'LostItemsController@destroy')->middleware('checkUserSession');
Route::get('lost-something/search', 'LostItemsController@search');

// lost items comments
Route::post('lost-something/{item}/comment/add', 'LostItemCommentsController@store')->middleware('checkUserSession');
Route::delete('lost-something/{lostitem}/comment/{item}/delete', 'LostItemCommentsController@destroy')->middleware('checkUserSession');

// messages
Route::get('messages/', 'PagesController@messages_empty');
Route::get('messages/{user}', 'PagesController@messages');
Route::post('messages/{conversation}/{user}', 'ConversationsController@store');