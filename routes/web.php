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
    return view('citl');
});

Route::get('fret', function () {
    return view('fret');
});

Route::get('mantrans', function () {
    return view('mantrans');
});

Route::get('transport', function () {
    return view('transport');
});

Route::get('logistique', function () {
    return view('logistique');
});

Route::get('about', function () {
    return view('about');
});
