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

Route::group(['middleware' => 'auth:sanctum','namespace'=>'api'], function () {

    Route::post("ask_expoert",'AskExpertController@create');
    Route::group(['prefix' => 'car'], function () {
        Route::post("details",'CarsController@show');
    });

    Route::post("news",'NewsController@filter');
    Route::post("payment",'CarsController@deposit');
    Route::post("car/promote/car_promote",'CarsController@promote');

});
Route::group(['prefix' => 'insurance','namespace'=>'api'], function () {
    Route::post("insuranceCompanyList",'InsuranceCompanyController@show');
    Route::post("offer_company",'InsuranceCompanyController@offer');
    Route::post("ask_help",'InsuranceCompanyController@askHelp');
});
Route::group(['prefix' => 'centers','namespace'=>'api'], function () {
    Route::group(['prefix' => 'review'], function () {
        Route::post("agency",'AgencyController@review');
    });
});
Route::group(['prefix' => 'auth'], function () {
    Route::post("login",'api\UserController@login');
});
Route::post("news",'api\NewsController@show');
/* Route::post("news/home",'api\NewsController@filter'); */
Route::post("finance/ask_help",'api\FinanceContactController@create');

Route::group(['prefix' => 'car','namespace'=>"api"], function () {
    Route::post("details  ",'CarsController@details');
    Route::post("list",'CarsController@search');
    Route::post("alert",'CarsController@alert');
    Route::post("compare",'CarsController@compare');
    Route::post("action_counter",'CarsController@action_counter');
    Route::post("promote/get_promote_package",'CarsController@promote_package');
});
