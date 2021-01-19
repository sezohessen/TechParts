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

Route::group(['middleware' => 'auth:sanctum','namespace'=>'api'], function () {
    Route::group(['prefix' => 'car'], function () {
        Route::post("details",'CarsController@show');
    });

});
Route::post("news",'NewsController@filter');
Route::group(['prefix' => 'auth'], function () {
    Route::post("login",'api\UserController@login');
});
