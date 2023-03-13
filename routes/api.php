<?php

use App\Http\Controllers\API\ArtistsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::group(['prefix' => 'artists'], function() {
    Route::get('/', [ArtistsController::class,'index']);
    Route::post('add', [ArtistsController::class,'add']);
    Route::post('update/{id}', [ArtistsController::class,'update']);
    Route::get('edit/{id}', [ArtistsController::class,'edit']);
    Route::delete('delete/{id}', [ArtistsController::class,'delete']);
});