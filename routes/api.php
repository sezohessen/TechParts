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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'auth:sanctum','namespace'=>'api'], function () {
    Route::group(['prefix' => 'favorite'], function () {
        Route::post("add",'AgencyController@addFav');//add favorite
        Route::post("remove",'AgencyController@removeFav');//remove favorite
        Route::post("get_agency_list",'AgencyController@agencyFav');//get agency list favorite
        Route::post("get_center_list",'AgencyController@centerFav');//get cetner maintenance list favorite
        Route::post("get_car_list",'AgencyController@carFav');
        Route::post("get_fav_list",'AgencyController@FavList');
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post("update_interested_country",'UserController@update_interested_country');
        Route::post("change_status_verify_phone",'UserController@change_status_verify_phone');
        Route::post("rest_password",'UserController@rest_password');
        Route::post("get_profile",'UserController@get_profile');
        Route::post("edit_profile",'UserController@edit_profile');
    });
    Route::group(['prefix' => 'general'], function () {
        Route::post("upload_file",'generalController@upload_file');
    });

    Route::group(['prefix' => 'my_maintenance'], function () {
        Route::post("create_new_maintenance",'HomeDataController@createNewMaintenance');
        Route::post("get_list",'HomeDataController@get_list');
    });
    Route::post("ask_expoert",'AskExpertController@create');

    Route::group(['prefix' => 'centers/review'], function () {
        Route::post("CenterAgency",'AgencyController@review');
        Route::post("CenterMaintenace",'AgencyController@review');
        Route::post("CenterSpare",'AgencyController@review');
    });
    Route::post("payment",'CarsController@deposit');
    Route::post("car/promote/car_promote",'CarsController@promote');
    Route::post("car/alert",'CarsController@alert');
    Route::post("insurance/create_request",'InsuranceRequestController@insurance');
    Route::post("finance/create_request",'InsuranceRequestController@insurance');

    Route::group(['prefix' => 'sell_car'], function () {
        Route::post("create",'CarsController@create');
        Route::post("edit",'CarsController@edit');
        Route::post("my_list",'CarsController@list');
    });
    Route::post("sell_car/delete",'CarsController@delete');

});
Route::group(['prefix' => 'data','namespace'=>'api'], function () {
    Route::group(['prefix' => 'static'], function () {
        Route::get("news_category",'NewsController@category');
        Route::get("car_body_style",'CarsController@carBody');
        Route::get("car_extra_feature",'CarsController@carFeature');
        Route::get("car_badge",'CarsController@carBadge');
        Route::post("color_pallet",'CarsController@carColors');
    });
});
Route::group(['prefix' => 'finance','namespace'=>'api'], function () {
    Route::post("filter",'BankController@filter');
    Route::post("home",'BankController@home');
});

Route::group(['prefix' => 'data','namespace'=>'api'], function () {
    Route::group(['prefix' => 'dynamic'], function () {
        Route::post("faq_all",'dynamicController@faq');
        Route::post("distributor_all",'dynamicController@distributor');
        Route::post("country_all",'dynamicController@country');
        Route::post("gevernment_all",'dynamicController@governorate');
        Route::post("city_all",'dynamicController@city');
        Route::post("car_maker_all",'dynamicController@maker');
        Route::post("car_maker_search",'dynamicController@maker_search');
        Route::post("car_model_all",'dynamicController@model');
        Route::post("car_model_search",'dynamicController@model_search');
        Route::post("car_manufactures_all",'dynamicController@manufactures');
        Route::post("car_manufactures_search",'dynamicController@manufactures_search');
        Route::post("car_motor_cc",'dynamicController@motor');
        Route::post("car_year_by_model",'dynamicController@year');



    });
});
Route::post("news/home",'api\NewsController@filter');
Route::post("home/complete_data",'api\HomeDataController@completeData');

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
        Route::post("agency/filter",'AgencyController@agencyFilter');
        Route::post("maintenance/search",'AgencyController@maintenanceSearch');
        Route::post("maintenance/filter",'AgencyController@maintenanceFilter');
        Route::post("spare/search",'AgencyController@spareSearch');
        Route::post("spare/filter",'AgencyController@spareFilter');
    });
});
Route::group(['prefix' => 'auth','namespace'=>'api'], function () {
    Route::post("login",'UserController@login');
    Route::post("check_phone",'UserController@check_phone');
    Route::post("signup",'UserController@signup');
    Route::post("forget-password",'UserController@forgetPassword');
    Route::post("get_profile_by_id",'UserController@get_profile_by_id');
});
/* Route::post("news/home",'api\NewsController@filter'); */
Route::post("finance/ask_help",'api\FinanceContactController@create');

Route::group(['prefix' => 'car','namespace'=>"api"], function () {

    Route::post("details  ",'CarsController@details');
    Route::post("list/car_paginate",'CarsController@search');
    Route::post("list/car_list",'CarsController@filter');
    Route::post("compare",'CarsController@compare');
    Route::post("action_counter",'CarsController@action_counter');
    Route::post("promote/get_promote_package",'CarsController@promote_package');
});
Route::group(['prefix' => 'sell_car','namespace'=>"api"], function () {
    Route::post("copy",'CarsController@copy');
});


