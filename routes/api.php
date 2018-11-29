<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('customers', 'CustomerApiController@index');
Route::get('customers/{id}', 'CustomerApiController@view');
Route::post('customers', 'CustomerApiController@create');
Route::put('customers/{id}', 'CustomerApiController@update');
Route::delete('customers/{id}', 'CustomerApiController@delete');

Route::post('customers/login', 'CustomerApiController@login');
