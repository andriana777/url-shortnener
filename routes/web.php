<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\URLController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', '\App\Http\Controllers\URLController@index')->name('url.list');

Route::post('/generate', '\App\Http\Controllers\URLController@generate_short')->name('url.short');
Route::post('/redirect_to_original', '\App\Http\Controllers\URLController@redirect_to_original')->name('url.redirect');
