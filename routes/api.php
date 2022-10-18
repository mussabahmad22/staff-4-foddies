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
| is assigned the "api" a ismiddleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/restaurant','App\Http\Controllers\api\RestaurantController@index');
Route::post('/contact-us','App\Http\Controllers\api\RestaurantController@contactus');

Route::get('/cuisines',function(){
    return response()->json( ["All","Asian" ,"Breakfast","Chicken","Chinese","Curry","Desserts","Fast Food","Fish & Chips","Grill","Halal","Indian","Mexican","Noodles","Oriental","Peri Peri","Subways","Thai","Vegan","Waffle","Burger","Pizza"],200);
});

Route::get('/date',function(){
    return response()->json(["message"=>date('d-m-y H:i:s')],200);
});
