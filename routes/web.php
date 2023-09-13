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

Auth::routes();

Route::get('/home', 'HomeController@home')->name('home');
//create
Route::post('/create', 'HomeController@create')->name('create');

//create view page
Route::get('/create', 'HomeController@createView')->name('createView');

//edit
Route::get('/edit/{student_type}/{id}', 'HomeController@edit')->name('edit');

//update info
Route::put('/update/{id}/{student_type}', 'HomeController@update')->name('update');

//delete
Route::delete('/home','HomeController@delete')->name('delete');