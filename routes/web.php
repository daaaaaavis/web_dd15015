<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('users', function(){
	return 'users';
});

Route::get('users/create', ['uses' => 'UsersController@create']);
Route::post('users', ['uses' => 'UsersController@store']); 
Auth::routes();

Route::get('/home', 'HomeController@index');


//This is for the get event of the index page
Route::get('/images',array('as'=>'index_page','uses'=>'ImageController@getIndex'));
Route::post('/images',array('as'=>'index_page_post','before' =>'csrf', 'uses'=>'ImageController@postIndex'));

//This is to show the image's permalink on our website
Route::get('snatch/{id}',array('as'=>'get_image_information','uses'=>'ImageController@getSnatch'))->where('id', '[0-9]+');

  //This route is to show all images.
Route::get('all',array('as'=>'all_images','uses'=>'ImageController@getAll'));
Route::get('delete/{id}', array('as'=>'delete_image','uses'=>'ImageController@getDelete'))->where('id', '[0-9]+');