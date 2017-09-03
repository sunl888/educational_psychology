<?php

Route::get('/backend/{path?}', 'HomeController@index')->where('path', '[\/\w\.-]*')->name('dashboard');