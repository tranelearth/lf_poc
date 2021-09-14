<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

//Route::group(['middleware' => 'auth'], function() {
    //Route::group(['middleware' => 'role:student', 'prefix' => 'student', 'as' => 'student.'], function() {
        Route::resource('/Broker/myCarriers', \App\Http\Controllers\Broker\MyCarriersController::class);
    //});
//});

/*
Route::get('/Broker/myCarriers/{broker}', [\App\Http\Controllers\Broker\MyCarriersController::class, 'index'])->name('myCarriers.index');
//Route::get('/Broker/myCarriers/{broker}/create', [\App\Http\Controllers\Broker\MyCarriersController::class, 'create'])->name('myCarriers.create');
//Route::get('/Broker/myCarriers/{player}/{broker}/edit', [\App\Http\Controllers\Broker\MyCarriersController::class, 'edit'])->name('myCarriers.edit');
//Route::post('/Broker/myCarriers', [\App\Http\Controllers\Broker\MyCarriersController::class, 'store'])->name('myCarriers.store');
//Route::put('/Broker/myCarriers/{broker}', [\App\Http\Controllers\Broker\MyCarriersController::class, 'update'])->name('myCarriers.update');
Route::delete('/Broker/myCarriers/{player}/{broker}', [\App\Http\Controllers\Broker\MyCarriersController::class, 'remove'])->name('myCarriers.remove');
*/