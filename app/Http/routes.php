<?php




Route::post('api/register', 'UserController@register');
Route::post('api/authenticate', 'UserController@authenticate');
Route::get('api/authenticate/user', 'UserController@getAuthenticatedUser');
Route::resource('api/posts', 'PostController');
Route::resource('api/relations', 'RelationController');