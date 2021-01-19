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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum','namespace'=>'api'], function () {
    Route::post("news",'NewsController@filter');
    Route::post("payment",'CarsController@deposit');
});

Route::group(['prefix' => 'auth'], function () {
    Route::post("login",'api\UserController@login');
});
Route::group(['prefix' => 'car','namespace'=>"api"], function () {
    Route::post("details",'CarsController@details');
    Route::post("list",'CarsController@search');
    Route::post("alert",'CarsController@alert');
    Route::post("compare",'CarsController@compare');

});
