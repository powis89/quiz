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

use App\Services\OpenTrivia;

Route::get('/', function (OpenTrivia $openTrivia) {
    return $openTrivia->getQuestions();
    return view('welcome');
});

Route::get('/announcement', function () {
    broadcast(new \App\Events\PublicAnnouncement());
});