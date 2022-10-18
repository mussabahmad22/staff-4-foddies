<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});

Route::get('/dashboard', 'App\Http\Controllers\RestaurantController@dashboard')->middleware(['auth'])->name('dashboard');

Route::get('/restaurants', 'App\Http\Controllers\RestaurantController@index')->middleware(['auth'])->name('restaurants');
Route::post('/delete/restaurant', 'App\Http\Controllers\RestaurantController@destroy')->middleware(['auth'])->name('delete.restaurants');
Route::post('/create-restaurant', 'App\Http\Controllers\RestaurantController@create')->middleware(['auth'])->name('delete.restaurants');
Route::get('/restaurant/{id}', 'App\Http\Controllers\RestaurantController@show')->middleware(['auth'])->name('show.restaurants');
Route::put('/restaurant', 'App\Http\Controllers\RestaurantController@update')->middleware(['auth'])->name('update.restaurants');

//---------------------Manage Users Routes-----------------------------------------------
Route::middleware('auth')->group(function () {
  
    Route::get('/users', [UserController::class, 'users'])->name('users');
    Route::get('/add_users' , [UserController::class, 'index'])->name('userform');
    Route::post('/add_users' , [UserController::class, 'add_users'])->name('add_users');
    Route::get('/edit_user/{id}' , [UserController::class, 'edit_user'])->name('edit_user');
    Route::post('/update_user/{id}' , [UserController::class, 'update_user'])->name('update_user');
    Route::get('/delete_user/{id}' , [UserController::class, 'delete_user'])->name('delete_user');

});

require __DIR__.'/auth.php';
