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
    Route::group(['prefix' => 'favorite'], function () {
        Route::post("add",'AgencyController@addFav');//add favorite
        Route::post("remove",'AgencyController@removeFav');//remove favorite
        Route::post("get_agency_list",'AgencyController@agencyFav');//get agency list favorite
        Route::post("get_center_list",'AgencyController@centerFav');//get cetner maintenance list favorite
        Route::post("get_car_list",'AgencyController@');//get car list favorite(Not Finished)
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post("update_interested_country",'UserController@update_interested_country');
    });
    Route::post("ask_expoert",'AskExpertController@create');
    Route::group(['prefix' => 'car'], function () {
        Route::post("details",'CarsController@show');
    });
    Route::group(['prefix' => 'centers/review'], function () {
        Route::post("agency",'AgencyController@review');
    });
    Route::post("payment",'CarsController@deposit');
    Route::post("car/promote/car_promote",'CarsController@promote');

    Route::post("insurance/create_request",'InsuranceRequestController@insurance');
    Route::post("finance/create_request",'InsuranceRequestController@insurance');
});
Route::post("news/home",'api\NewsController@filter');

Route::post("news",'api\NewsController@show');
Route::group(['prefix' => 'insurance','namespace'=>'api'], function () {

    Route::post("insuranceCompanyList",'InsuranceCompanyController@show');
    Route::post("offer_company",'InsuranceCompanyController@offer');
    Route::post("ask_help",'InsuranceCompanyController@askHelp');
});
Route::group(['prefix' => 'centers','namespace'=>'api'], function () {
    Route::group(['prefix' => 'home'], function () {
        Route::post("agency",'AgencyController@agency');
        Route::post("maintenance",'AgencyController@maintenance');
        Route::post("spare",'AgencyController@spare');
    });
    Route::group(['prefix' => 'details'], function () {
        Route::post("agency",'AgencyController@detailsAgency');
        Route::post("maintenance",'AgencyController@detailsMaintenance');
        Route::post("spare",'AgencyController@detailsSpare');
    });
    Route::group(['prefix' => 'list'], function () {
        Route::post("agency/search",'AgencyController@agencySearch');
        Route::post("agency/filter",'AgencyController@Filter');
        Route::post("maintenance/search",'AgencyController@maintenanceSearch');
        Route::post("spare/search",'AgencyController@spareSearch');
    });
});
Route::group(['prefix' => 'auth','namespace'=>'api'], function () {
    Route::post("login",'UserController@login');
    Route::post("check_phone",'UserController@check_phone');
    Route::post("signup",'UserController@signup');
});
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
Route::group(['prefix' => 'sell_car','namespace'=>"api"], function () {

    Route::post("copy",'CarsController@copy');
    Route::post("delete",'CarsController@delete');
    Route::post("create",'CarsController@create');

});
