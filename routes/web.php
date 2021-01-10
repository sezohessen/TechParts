<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'dashboard','as' => 'dashboard.','namespace'=>"Dashboard", 'middleware' => ['role:superadministrator|admin']], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/faqs','FaqController');
    Route::resource('/country','CountryController');
    Route::resource('/governorate','GovernorateController');
    Route::resource('/city','CityController');
    Route::resource('/category','CategoryController');
    Route::resource('/news','NewsController');
    Route::resource('/terms','TermsController');
    Route::resource('/PPolicy','PrivacyPolicyController');
    Route::resource('/settings','SettingsController');
    Route::resource('/insurance','InsuranceController');
    Route::resource('/insurance-offer','InsuranceOfferController');
    Route::resource('/offer-plan','OfferPlanController');
    Route::resource('/feature','FeaturesController');
    Route::resource('/badge','BadgesController');
    Route::resource('/contact','ContactController');
    Route::resource('/AskExpert','AskExpertController');
    Route::resource('/finance-request','FinanceRequestController');
    Route::resource('/car','CarController');
    Route::group(['prefix' => 'car'],function(){
        Route::resource('/maker','CarMakerController');
        Route::resource('/model','CarModelController');
        Route::resource('/body','CarBodyController');
        Route::resource('/year','CarYearController');
        Route::resource('/capacity','CarCapacityController');
        Route::resource('/color','CarColorController');
        Route::get("available_model/{id}",'CarController@available_model');
        Route::get("available_governorate/{id}",'CarController@available_governorate');
        Route::get("available_city/{id}",'CarController@available_city');
    });

    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');
    /* Datatable deleteAll request */
    Route::delete("faqs/destroy/all","FaqController@multi_delete");
    Route::delete('/country/destroy/all','CountryController@multi_delete');
    Route::delete('/governorate/destroy/all','GovernorateController@multi_delete');
    Route::delete('/city/destroy/all','CityController@multi_delete');
    Route::delete('/category/destroy/all','CategoryController@multi_delete');
    Route::delete('/news/destroy/all','NewsController@multi_delete');
    Route::delete('/terms/destroy/all','TermsController@multi_delete');
    Route::delete('/settings/destroy/all','SettingsController@multi_delete');
    Route::delete('/insurance/destroy/all','InsuranceController@multi_delete');
    Route::delete('/finance-request/destroy/all','InsuranceController@multi_delete');
    Route::delete('/feature/destroy/all','FeaturesController@multi_delete');
    Route::delete('/badge/destroy/all','BadgesController@multi_delete');
    Route::delete('/insurance-offer/destroy/all','InsuranceOfferController@multi_delete');
    Route::delete('/offer-plan/destroy/all','OfferPlanController@multi_delete');
    Route::delete('/maker/destroy/all','CarMakerController@multi_delete');
    Route::delete('/model/destroy/all','CarModelController@multi_delete');
    Route::delete('/body/destroy/all','CarBodyController@multi_delete');
    Route::delete('/year/destroy/all','CarYearController@multi_delete');
    Route::delete('/capacity/destroy/all','CarCapacityController@multi_delete');
    Route::delete('/color/destroy/all','CarColorController@multi_delete');
    Route::delete('/car/destroy/all','CarController@multi_delete');
    /* Datatable Activity request */
    Route::post('/country/{country}/activity',"CountryController@Activity")->name('Country.Activity');
    Route::post('/governorate/{governorate}/activity',"GovernorateController@Activity")->name('Governorate.Activity');
    Route::post('/city/{city}/activity',"CityController@Activity")->name('City.Activity');
    Route::post('/category/{category}/activity',"CategoryController@Activity")->name('Category.Activity');
    Route::post('/feature/{feature}/activity',"FeaturesController@Activity")->name('Features.Activity');
    Route::post('/badge/{badge}/activity',"BadgesController@Activity")->name('Badge.Activity');
    Route::post('/maker/{maker}/activity',"CarMakerController@Activity")->name('CarMaker.Activity');
    Route::post('/model/{model}/activity',"CarModelController@Activity")->name('CarModel.Activity');
    Route::post('/body/{body}/activity',"CarBodyController@Activity")->name('CarBody.Activity');
});
Route::get('/terms', 'Dashboard\TermsController@show');
Route::get('/PPolicy', 'Dashboard\PrivacyPolicyController@show');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function ()
{
    $page_title = __('login');
    $page_description = __('login page');
    return view('auth.login',  compact('page_title', 'page_description'));
});
Route::group(['prefix' => 'insurance','as' => 'insurance.','namespace'=>"Insurance", 'middleware' => ['role:insurance']], function () {
    Route::get('/','InsuranceController@index');
    Route::resource('/company','InsuranceCompanyController');
    Route::resource('/insurance-offer','InsuranceOfferController');
    Route::resource('/offer-plan','OfferPlanController');
});
