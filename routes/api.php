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

// SPA Requests
Route::get('user/carriers', '\App\Http\Controllers\Api\User\CarriersController@index');
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    /*Route::get('students/{id}', 'ApiController@getStudent');
    Route::post('students, 'ApiController@createStudent');
    Route::put('students/{id}', 'ApiController@updateStudent');
    Route::delete('students/{id}','ApiController@deleteStudent');
    */
});

// oAuth API Requests
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', '\App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
