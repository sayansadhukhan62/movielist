<?php

use App\Http\Controllers\MovieController;
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
    return redirect('/login');
});

Auth::routes();
Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');

Route::middleware(['auth'])->group(function () {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/home', function () {
    	return redirect('/movie');
	});
	Route::get('movie','MovieController@index')->name('movie.index');
	Route::get('imdb','MovieController@imdb');
	Route::resource('movie','MovieController')->except('index')->middleware('rolesauth');
});
