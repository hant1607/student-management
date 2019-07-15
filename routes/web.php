<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'], function (){
   Route::group(['prefix'=>'faculty'], function(){
       Route::get('list', 'FacultyController@getList');

       Route::get('add', 'FacultyController@getAdd');
       Route::post('add', 'FacultyController@postAdd');

       Route::get('update/{id}', 'FacultyController@getUpdate');
       Route::post('update/{id}', 'FacultyController@postUpdate');

       Route::get('delete/{id}', 'FacultyController@getDelete');
   }) ;

    Route::group(['prefix'=>'class'], function(){
        Route::get('list', 'ClassController@getList');

        Route::get('add', 'ClassController@getAdd');
        Route::post('add', 'ClassController@postAdd');

        Route::get('update/{id}', 'ClassController@getUpdate');
        Route::post('update/{id}', 'ClassController@postUpdate');

        Route::get('delete/{id}', 'ClassController@getDelete');
    }) ;
    //Route::resource('classes', 'ClassController');

    Route::group(['prefix'=>'student'], function(){
        Route::get('list', 'StudentController@getList');
        Route::get('add', 'StudentController@getAdd');
        Route::get('update', 'StudentController@getUpdate');
    }) ;

    Route::group(['prefix'=>'subject'], function(){
        Route::get('list', 'SubjectController@getList');
        Route::get('add', 'SubjectController@getAdd');
        Route::get('update', 'SubjectController@getUpdate');
    }) ;

    Route::group(['prefix'=>'result'], function(){
        Route::get('list', 'ResultController@getList');
        Route::get('add', 'ResultController@getAdd');
        Route::get('update', 'ResultController@getUpdate');
    }) ;

    Route::group(['prefix'=>'user'], function(){
        Route::get('list', 'UserController@getList');
        Route::get('add', 'UserController@getAdd');
        Route::get('update', 'UserController@getUpdate');
    }) ;
});
