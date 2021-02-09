<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/dishes', [ApiController::class, 'index']);
Route::post('/dishes', [ApiController::class, 'store']);
Route::get('/dishes/{id}', [ApiController::class, 'show']);
Route::put('/dishes/{id}', [ApiController::class, 'update']);
Route::delete('/dishes/{id}', [ApiController::class, 'destroy']);
