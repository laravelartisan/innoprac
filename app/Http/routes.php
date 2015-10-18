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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/registered', function () {
    return view('registered');
});
Route::get('/logged', function () {
    return view('logged');
});
/*
Route::get('admin', function () {
    return view('dashboard');
});*/

Route::get('/', array('as' => 'index', 'uses' =>
    'AlbumsController@getList'));
Route::get('/createalbum', array('as' => 'create_album_form',
    'uses' => 'AlbumsController@getForm'));
Route::post('/createalbum', array('as' => 'create_album',
    'uses' => 'AlbumsController@postCreate'));
Route::get('/deletealbum/{id}', array('as' => 'delete_album',
    'uses' => 'AlbumsController@getDelete'));
Route::get('/album/{id}', array('as' => 'show_album', 'uses' =>
    'AlbumsController@getAlbum'));
Route::get('/addimage/{id}', array('as' => 'add_image', 'uses' =>
    'ImageController@getForm'));
Route::post('/addimage', array('as' => 'add_image_to_album',
    'uses' => 'ImageController@postAdd'));
Route::get('/deleteimage/{id}', array('as' => 'delete_image',
    'uses' => 'ImageController@getDelete'));
Route::post('/moveimage', array('as' => 'move_image',
    'uses' => 'ImageController@postMove'));

//---------------------
Route::get('admin', 'AdminController@index');
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('db', function () {

    return 'ehlloo';
    return \DB::connection()->getPdo();
});










