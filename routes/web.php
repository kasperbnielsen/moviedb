<?php

use App\Http\Controllers\movieController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('test');
});

Route::get('/movie', function () {
    return view('movie');
});

Route::get('/', [movieController::class, 'loadPopular']);

Route::Get('movie/{id}', [movieController::class, 'getDetails']);
