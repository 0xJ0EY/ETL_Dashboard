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

/*
 * Logboek routes
 */

// Default binds
Route::get('/', 'LogboekController@analytic');
Route::get('/logboek/', 'LogboekController@analytic');

Route::get('/logboek/data/', 'LogboekController@data');
Route::get('/logboek/data/{id}', 'LogboekController@dataDetails');

Route::get('/logboek/analytic/', 'LogboekController@analytic');
Route::get('/logboek/analytic/{id}', 'LogboekController@analyticDetails');

Route::get('/logboek/report/', 'LogboekController@report');
Route::get('/logboek/report/{id}', 'LogboekController@reportDetails');

/*
 * Movies routes
 * */
// Default bind
Route::get('/movies/', 'MovieController@analytic');

Route::get('/movies/analytic/', 'MovieController@analytic');
Route::get('/movies/analytic/{id}', 'MovieController@analyticDetails');

Route::get('/movies/genre/{genre}', 'MovieController@genre');
Route::get('/movies/keyword/{genre}', 'MovieController@keyword');

Route::get('/movies/report/', 'MovieController@report');
Route::get('/movies/report/{id}', 'MovieController@reportDetails');