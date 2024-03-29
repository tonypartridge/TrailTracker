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

Route::get('/record/add/{loc_id}', \App\Http\Livewire\Record\Create::class);
Route::get('/qr-record/{loc_id}', \App\Http\Livewire\Record\Create::class);
