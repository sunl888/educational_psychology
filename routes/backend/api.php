<?php
// Route::get('auth/captcha_src', 'Auth\LoginController@captchaSrc');
Route::get('auth/need_verification_code', 'Auth\LoginController@needVerificationCodeRequest');
Route::post('auth/login', 'Auth\LoginController@login');
Route::post('auth/logout', 'Auth\LoginController@logout');

Route::post('ajax_upload_image', 'ImageController@upload');
Route::post('wang_editor_upload_image', 'ImageController@wangEditorUpload');

Route::apiResource('users', 'UsersController');

Route::get('me', 'MeController@show');

// 获取所有角色(不分页 用于添加用户时显示)
Route::get('roles/all', 'RolesController@allRoles')->name('roles.allRoles');
Route::apiResource('roles', 'RolesController');

Route::get('roles/{role}/permissions', 'RolesController@permissions')->name('roles.permissions');

Route::apiResource('posts', 'PostsController');
// 真删除指定的文章
Route::delete('posts/{post}/real', 'PostsController@realDestroy')->name('posts.real');
// 恢复指定的被软删除的文章
Route::post('posts/{post}/restore', 'PostsController@restore')->name('posts.restore');
// 获取模板
Route::get('templates', 'TemplatesController@templates');

Route::get('categories/visual_output', 'CategoriesController@visualOutput')->name('categories.visualOutput');
Route::apiResource('categories', 'CategoriesController');

// 获取单页
Route::get('categories/{category}/page', 'CategoriesController@page')->name('categories.page');
// 创建或更新单页
Route::post('categories/{category}/page', 'CategoriesController@savePage')->name('categories.page');
Route::apiResource('banners', 'BannersController');

Route::apiResource('links', 'LinksController');

Route::post('settings/index_order', 'SettingsController@setOrder');
Route::apiResource('settings', 'SettingsController');


Route::apiResource('types', 'TypesController');

// 获取统计数据
Route::get('statistics', 'HomeController@index');


Route::apiResource('attachments', 'AttachmentsController');

Route::apiResource('tags', 'TagsController');
