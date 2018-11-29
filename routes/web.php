<?php

Route::get('customers', 'CustomerController@index');
Route::get('customers/view/{id}', 'CustomerController@view');
Route::get('customers/add', 'CustomerController@add');
Route::post('customers/add', 'CustomerController@create');
Route::get('customers/edit/{id}', 'CustomerController@edit');
Route::post('customers/edit/{id}', 'CustomerController@update');
Route::get('customers/delete/{id}', 'CustomerController@delete');

Route::get('products', 'ProductController@index');
Route::get('products/view/{id}', 'ProductController@view');
Route::get('products/add', 'ProductController@add');
Route::post('products/add', 'ProductController@create');
Route::get('products/edit/{id}', 'ProductController@edit');
Route::post('products/edit/{id}', 'ProductController@update');
Route::get('products/delete/{id}', 'ProductController@delete');

Route::get('complains', 'ComplainController@index');
Route::get('complains/view/{id}', 'ComplainController@view');
Route::get('complains/add', 'ComplainController@add');
Route::post('complains/add', 'ComplainController@create');
Route::get('complains/edit/{id}', 'ComplainController@edit');
Route::post('complains/edit/{id}', 'ComplainController@update');
Route::get('complains/delete/{id}', 'ComplainController@delete');

Route::get('complains/filter/{status}', 'ComplainController@filter');
Route::get('complains/status/{id}/{status}', 'ComplainController@status');
Route::get('complains/assign/{id}/{user}', 'ComplainController@assign');

Route::post('comments/add', 'ComplainController@addComment');
Route::get('comments/delete/{id}', 'ComplainController@deleteComment');

Route::get('/', 'ComplainController@index');
Route::get('/home', 'ComplainController@index')->name('home');

Auth::routes();
