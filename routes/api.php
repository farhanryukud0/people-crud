<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/daftar', 'PeopleController@index');
Route::post('/buat', 'PeopleController@buat');
Route::get('/edit/{id}', 'PeopleController@getPeople');
Route::get('/lihat/{id}', 'PeopleController@getPeople');
Route::put('/ubah/{id}', 'PeopleController@ubah');
Route::delete('/hapus/{id}', 'PeopleController@hapus');
