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

// found items
Route::get('found-something', 'PagesController@found');
Route::post('found-something/add', 'FoundItemsController@store')->middleware('checkUserSession');
Route::delete('found-something/{item}/delete', 'FoundItemsController@destroy')->middleware('checkUserSession');
Route::get('found-something/search', 'FoundItemsController@search');
// found items comments
Route::post('found-something/{item}/comment/add', 'FoundItemCommentsController@store')->middleware('checkUserSession');
Route::delete('found-something/{founditem}/comment/{item}/delete', 'FoundItemCommentsController@destroy')->middleware('checkUserSession');

// messages
Route::get('messages/', 'PagesController@messages_empty');
Route::get('messages/{user}', 'PagesController@messages');
Route::post('messages/{conversation}/{user}', 'ConversationsController@store');

// items
Route::patch('lost-item/{item}/mark-as-found', 'LostItemsController@markAsFound')->middleware('checkUserSession');
Route::patch('found-item/{item}/mark-as-found', 'FoundItemsController@markAsFound')->middleware('checkUserSession');

// retrived items
Route::get('retrieved-items', 'PagesController@retrievedItems');
Route::get('retrieved-items/search', 'PagesController@retrievedItemsSearch');

// adminpanel
Route::redirect('admin-panel', '/admin-panel/users', 301)->middleware('checkUserSession');
Route::get('admin-panel/users', 'AdminPagesController@users')->middleware('checkUserSession');
Route::delete('admin-panel/users/{item}/delete', 'UsersController@destroy')->middleware('checkUserSession');
Route::get('admin-panel/users/new', 'AdminPagesController@users_new')->middleware('checkUserSession');
Route::post('admin-panel/users/new', 'UsersController@store_admin')->middleware('checkUserSession');