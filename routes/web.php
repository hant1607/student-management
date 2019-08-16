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

Route::group(['prefix'=>'admin', ['middleware' => ['auth' => ['except' => 'admin/students/create']]]], function (){
   Route::group(['prefix'=>'faculty'], function(){
       Route::get('list', 'FacultyController@getList')->name('faculty.index');

       Route::get('add', 'FacultyController@getAdd')->name('faculty.create');
       Route::post('add', 'FacultyController@postAdd')->name('faculty.store');

       Route::get('update/{faculty}', 'FacultyController@getUpdate')->name('faculty.edit');
       Route::post('update/{id}', 'FacultyController@postUpdate')->name('faculty.update');

       Route::get('delete/{id}', 'FacultyController@getDelete')->name('faculty.delete');
   }) ;

    Route::group(['prefix'=>'class'], function(){
        Route::get('list', 'ClassController@getList')->name('class.index');

        Route::get('add', 'ClassController@getAdd')->name('class.create');
        Route::post('add', 'ClassController@postAdd')->name('class.store');

        Route::get('update/{class}', 'ClassController@getUpdate')->name('class.edit');
        Route::post('update/{class}', 'ClassController@postUpdate')->name('class.update');

        Route::get('delete/{class}', 'ClassController@getDelete')->name('class.delete');
    }) ;

    Route::post('students/sendEmail', 'StudentController@sendEmail')->name('students.sendEmail');

    Route::post('students/ajaxUpdate', 'StudentController@ajaxUpdate')->name('students.ajaxUpdate');

    Route::resource('students', 'StudentController');
    Route::resource('results', 'ResultController');

    Route::resource('subjects', 'SubjectController');
    Route::resource('users', 'UserController');

    Route::get('results/students/{id}', 'ResultController@getAddStudentResult')->name('results.addResult');
    Route::post('results/students/{id}', 'ResultController@postStudentResult')->name('results.storeResults');
});

Auth::routes();
Route::get('auth/social/{social}', 'SocialAuthController@redirectToProvider')->name('social.login') ;
Route::get('auth/{social}/callback', 'SocialAuthController@handleProviderCallback');

