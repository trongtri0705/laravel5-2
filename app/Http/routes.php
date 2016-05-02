<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/**
 * Front-end Area.
 */
// require __DIR__.'\Routes\user.php';

/*
 * Admin Area
 */
if (Request::is('admin/*') || Request::is('admin')) {
    require __DIR__.'/Routes/admin.php';
}

Route::group([
    'prefix' => '/auth',
    'namespace' => 'Auth',
], function () {

    // Authentication Routes...
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@getLogout');
    Route::get('register', 'AuthController@getRegister');
    Route::post('register', 'AuthController@postRegister');

});
Route::group([
    'prefix' => '/password',
    'namespace' => 'Auth',
    'as' => 'password::',
], function () {

    // Password Routes...
    Route::get('email', 'PasswordController@getEmail')->name('email');
    Route::post('email', 'PasswordController@postEmail');

    Route::get('reset/{token}', 'PasswordController@getReset');
    Route::post('reset', 'PasswordController@postReset')->name('reset');
});
Route::get('/', function () {
    // $files = glob('public/files/*');
    // Zipper::make('public/test.zip')->add($files);
    Zipper::make('test.zip')->folder('public')->add('composer.json');
    return view('app');
});
Route::get('/home', function () {
    return view('app');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
});