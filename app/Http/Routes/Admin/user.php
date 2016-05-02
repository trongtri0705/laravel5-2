<?php
Route::get('users', 'UserController@index')->name('users');

Route::group([
    'prefix' => '/user',
    'as' => 'user::',
], function () {
    Route::get('create', 'UserController@create')->name('create');
    Route::post('create', 'UserController@store');
    Route::get('edit/{user}', 'UserController@edit')->name('edit');
    Route::post('edit/{user}', 'UserController@update');
    Route::delete('delete/{user}', 'UserController@destroy')->name('delete');
    Route::get('show/{user}', 'UserController@show')->name('show');
    Route::get('static', 'UserController@getStatic')->name('static');
   
});
