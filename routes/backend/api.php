<?php

Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/logout', 'Auth\LoginController@logout');

Route::post('ajax_upload_image', 'ImageController@upload');

Route::resource('users', 'UsersController', [
    'except'=> ['create', 'edit']
]);

Route::get('me', 'UsersController@me');

Route::resource('roles', 'RolesController', [
    'except'=> ['create', 'edit']
]);

Route::resource('posts', 'PostsController', [
    'except'=> ['create', 'edit']
]);
