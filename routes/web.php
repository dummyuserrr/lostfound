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
Route::patch('admin-panel/registration-requests/{user}/approve', 'UsersController@approve')->middleware('checkUserSession');
Route::delete('admin-panel/registration-requests/{user}/decline', 'UsersController@decline')->middleware('checkUserSession');
Route::get('admin-panel/users/{user}/edit', 'AdminPagesController@users_view')->middleware('checkUserSession');

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

// retrieved items
Route::get('retrieved-items', 'PagesController@retrievedItems');
Route::get('retrieved-items/search', 'PagesController@retrievedItemsSearch');

// adminpanel
Route::redirect('admin-panel', '/admin-panel/users', 301)->middleware('checkUserSession');
Route::get('admin-panel/users', 'AdminPagesController@users')->middleware('checkUserSession');
Route::delete('admin-panel/users/{item}/delete', 'UsersController@destroy')->middleware('checkUserSession');
Route::get('admin-panel/users/new', 'AdminPagesController@users_new')->middleware('checkUserSession');
Route::post('admin-panel/users/new', 'UsersController@store_admin')->middleware('checkUserSession');
Route::get('admin-panel/users/{user}/change-role/{role}', 'UsersController@changeRole')->middleware('checkUserSession');
Route::get('users/{user}/edit', 'PagesController@user_edit')->middleware('checkUserSession');
Route::patch('user/{user}/edit', 'UsersController@patch_other')->middleware('checkUserSession');
Route::get('admin-panel/registration-requests', 'AdminPagesController@registrationRequests')->middleware('checkUserSession');
Route::get('admin-panel/system-logs', 'AdminPagesController@systemLogs')->middleware('checkUserSession');

// ratings
Route::post('rate', 'RatingsController@store')->middleware('checkUserSession');

// message us
Route::post('submit-message', 'MessageQueryController@store');
Route::get('admin-panel/message-queries', 'AdminPagesController@messageQueries')->middleware('checkUserSession');
Route::delete('admin-panel/message-queries/{item}/delete', 'MessageQueryController@destroy')->middleware('checkUserSession');

Route::post('forgot-password', 'UsersController@forgotPassword');