<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BucketController;
use App\Http\Controllers\BallController;
use App\Http\Controllers\GameController;

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
Route::resource('buckets', BucketController::class);
Route::resource('balls', BallController::class);
Route::resource('game', GameController::class);
// Route::resource('game.distribute', GameController::class);

Route::post('/game/distribute', [GameController::class, 'distribute'])->name('game.distribute');

Route::get('/', function () {
    return view('welcome');
});
