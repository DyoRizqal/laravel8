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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

//BLOG
use App\Http\Controllers\BlogController;
Route::resource('blog', BlogController::class);

//GALERI
use App\Http\Controllers\GaleriController;
Route::resource('galeri', GaleriController::class);
Route::get('/slideshow', ['as'=>'slideshow','uses'=>'App\Http\Controllers\GaleriController@slideshow']);
Route::post('/slideshow/add', ['as'=>'store_slideshow','uses'=>'App\Http\Controllers\GaleriController@store_slideshow']);
Route::get('/slideshow/create', ['as'=>'create_slideshow','uses'=>'App\Http\Controllers\GaleriController@create_slideshow']);
Route::post('/slideshow/update', ['as'=>'update_slideshow','uses'=>'App\Http\Controllers\GaleriController@update_slideshow']);
Route::delete('/slideshow/delete/{id}', ['as'=>'destroy_slideshow','uses'=>'App\Http\Controllers\GaleriController@destroy_slideshow']);
