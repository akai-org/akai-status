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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider')->name('redirect');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

//Events

Route::prefix('events')->middleware(['auth'])->group(function () {
    //List all events
    Route::get('/', 'EventsController@getList')->name('events.list');
    //Show single event
    Route::get('/event/{event}', 'EventsController@getSingle');
    //List user events
    Route::get('/attended', 'EventsController@getUserList')->name('events.attended');
    //Show single event

    //Create event
    Route::get('add', 'EventsController@getAdd')->name('events.get.add');
    Route::post('add', 'EventsController@postAdd')->name('events.post.add');
    //Modify event

    //Delete event

    //Join event
    Route::get('join', 'EventsController@getJoin')->name('events.get.join');
    Route::post('join', 'EventsController@postJoin')->name('events.post.join');
});