<?php

Route::get('/', 'IndexController@index');

Route::get('/categories/{$cateSlug}', 'CategoriesController@show');