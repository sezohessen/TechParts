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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/test",function(){
    return 22;
});
Route::group(['middleware' => 'auth:sanctum','namespace'=>'api'], function () {

    Route::post("ask_expoert",'api\AskExpertController@create');
    Route::group(['prefix' => 'car'], function () {
        Route::post("details",'CarsController@show');
    });

});

Route::group(['prefix' => 'auth'], function () {
    Route::post("login",'api\UserController@login');
});

Route::post("news",'api\NewsController@show');

