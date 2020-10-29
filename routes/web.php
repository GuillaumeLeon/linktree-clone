<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  if (Auth::check()) {
    return redirect('/dashboard/links');
  } else {
    return view('home');
  }
});

//Route::get('/home', 'HomeController@index')->name('home');

//Route::redirect('/home', '/dashboard/links');
//Route::redirect('/', '/dashboard/links');


Auth::routes();
// http://127.0.0.1:8000/dashboard
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/links', 'Linkcontroller@index');
    Route::get('/links/new', 'LinkController@create');
    Route::post('/links/new', 'LinkController@store');
    Route::get('/links/{link}', 'LinkController@edit');
    Route::post('/links/{link}', 'LinkController@update');
    Route::delete('/links/{link}', 'LinkController@destroy');

    Route::get('/settings', 'UserController@edit');
    Route::post('/settings', 'UserController@update');


});

Route::post('/visit/{link}', 'VisitController@store');

// http://127.0.0.1:8000/username
Route::get('/{user}', 'UserController@show');
