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

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

App::setLocale('ru');

Route::get('/event/{event}', 'EventController@showEvent');
Route::get('/slot/{slot}', 'SlotController@showSlot');
Route::post('/slot/{slot}', 'SlotController@submitSlot');
Route::get('/activate/{participant}/{secret}', 'ParticipantController@activate');

Route::get('/admin/{event}', 'AdminController@listEventParticipants'); // todo some basic password
Route::get('/admin/{event}/export', 'AdminController@export'); // todo some basic password
Route::get('/admin/delete/{participant}', 'AdminController@deleteParticipant'); // todo some basic password
