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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/newtodo', 'TodoController@index');

Route::get('/todo', 'TodoController@index');

Route::post('/create', 'TodoController@create');
Route::post('/deleteItem', 'TodoController@delete');
Route::post('/updateStatus', 'TodoController@update');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/challenges', 'ChallengeController@index');
Route::get('/showChallenge/{id}', 'ChallengeController@show');

Route::post('/addThought', 'ThoughtController@create');
Route::post('/getThought', 'ThoughtController@index');