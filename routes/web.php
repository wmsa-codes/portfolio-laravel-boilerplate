<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

use App\Http\Controllers\QnaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// For authentication
// -- register / login
Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/about', 'AboutController@index');

Route::get('/projects', 'ProjectController@index');

Route::get('/blog', 'BlogController@index');

Route::get('/contact', function () {
    return view('contact');
});

Route::view('/show_react','show_react');

Route::resource('ama', 'QnaController');

// Route::get('/add-question',[QnaController::class,'addQuestion']);

// Route::get('/add-answer/{id}',[QnaController::class,'addAnswer']);

/////////////////
// ADMIN
//
Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function () {

  Route::get('/',function(){
    return redirect('/admin/dashboard');
  });

  Route::get('/dashboard', 'AdminController@index');

  Route::resource('home', 'AdminHomeController', ['as'=>'admin']);

  Route::resource('about', 'AdminAboutController', ['as'=>'admin']);

  Route::resource('project', 'AdminProjectController', ['as'=>'admin']);

  Route::resource('blog', 'AdminBlogController', ['as'=>'admin']);

  Route::resource('social', 'AdminSocialController', ['as'=>'admin']);

  Route::resource('ama', 'AdminQnaController', ['as'=>'admin']);

  Route::post('ama', 'AdminQnaController', ['as'=>'admin']);

  Route::get('/masterdetail', 'AdminController@masterdetail');

  Route::view('/react', 'admin.react');

  Route::resource('tasks','AdminTasksController',['as'=>'admin']);

});
