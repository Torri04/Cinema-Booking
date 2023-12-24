<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\GetFilm;
use App\Http\Controllers\api\GetSeat;
use App\Http\Controllers\api\GetUser;
use App\Http\Controllers\api\GetStatistics;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getfilm', [GetFilm::class, 'index']);

Route::get('/getseat/{ShowID}', [GetSeat::class, 'index']);

Route::get('/getuser/{UserID}', [GetUser::class, 'index']);

Route::get('/getmovie', [GetStatistics::class, 'getMovie']);
Route::get('/getshow', [GetStatistics::class, 'getShow']);
Route::get('/getuser', [GetStatistics::class, 'getUser']);
Route::get('/getreser', [GetStatistics::class, 'getReser']);
