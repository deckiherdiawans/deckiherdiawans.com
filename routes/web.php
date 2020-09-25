<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/certificates', 'PagesController@certificates');
Route::get('/portfolios', 'PagesController@portfolios');
Route::get('/blogs', 'PagesController@blogs');
Route::get('/welcome', 'PagesController@welcome')->name('welcome');


// Route::get('/myportfolio/students', 'StudentsController@index');
// Route::post('/myportfolio/students', 'StudentsController@store');
// Route::get('/myportfolio/students/create', 'StudentsController@create');
// Route::get('/myportfolio/students/{student}', 'StudentsController@show');
// Route::patch('myportfolio/students/{student}', 'StudentsController@update');
// Route::delete('/myportfolio/students/{student}', 'StudentsController@destroy');
// Route::get('/myportfolio/students/{student}/edit', 'StudentsController@edit');
Route::resource('/myportfolio/students', 'StudentsController');

Auth::routes();

Route::get('/myportfolio/helpdeck', 'HelpdeckController@index');

Route::get('/myportfolio/instadeck', 'InstadeckController@index')->name('instadeck');
Route::get('/myportfolio/instadeck/profile/{user}', 'InstadeckProfilesController@index')->name('profile.show');
Route::get('/myportfolio/instadeck/post/create', 'InstadeckPostsController@create');
Route::post('/myportfolio/instadeck/post', 'InstadeckPostsController@store');