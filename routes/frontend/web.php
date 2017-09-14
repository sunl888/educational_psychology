<?php

Route::middleware('record_visitor')->group(function (){

    Route::get('/', 'IndexController@index')->name('index');

    Route::get('/categories/{slug}', 'CategoriesController@show')->name('showCategory');

    Route::get('/posts/{slug}', 'PostsController@show')->name('showPost');
});
