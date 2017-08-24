<?php

Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/logout', 'Auth\LoginController@logout');

Route::resource('users', 'UsersController', [
    'except'=> ['create', 'edit']
]);