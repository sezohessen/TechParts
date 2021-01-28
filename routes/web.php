<?php

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
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en']) ) {
        session()->put('app_locale', $locale);
        return back();
    }
    return view('errors.404');
});
//Route::group(['middleware' => 'SetLocale'], function () {


Route::group(['prefix' => 'dashboard','as' => 'dashboard.','namespace'=>"Dashboard", 'middleware' => ['role:superadministrator|administrator']], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
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
    Route::resource('/agency','AgencyController');
    Route::resource('/AgencyCar','AgencyCarController');
    Route::resource('/bank','BankController');
    Route::resource('/bank-offer','BankOfferController');
    Route::resource('/log','LogsController');
    Route::resource('/subscribe_packages','SubscribeController');
    Route::resource('/promote','CarPromoteController');
    Route::resource('/trending','TrendingController');
    Route::prefix('car')->group(function () {
        Route::resources([
            'maker'=>"CarMakerController",
            'model'=>"CarModelController",
            'body'=>"CarBodyController",
            'year'=>"CarYearController",
            'capacity'=>"CarCapacityController",
            'color'=>"CarColorController",
        ]);
        Route::get("available_model/{id}",'CarController@available_model');
        Route::get("available_governorate/{id}",'CarController@available_governorate');
        Route::get("available_city/{id}",'CarController@available_city');
        Route::get("available_year/{id}",'CarController@available_year');

    });
    Route::resource('car', 'CarController');


    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');
    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');
    // Users
  //  Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
  //  Route::resource('users', 'UsersController');
    Route::resource('users', 'UserController');
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
    Route::delete('/car/destroy/all','CarController@multi_delete');
    Route::delete('/capacity/destroy/all','CarCapacityController@multi_delete');
    Route::delete('/color/destroy/all','CarColorController@multi_delete');
    Route::delete('/AskExpert/destroy/all','AskExpertController@multi_delete');
    Route::delete('/contact/destroy/all','ContactController@multi_delete');
    Route::delete('/bank/destroy/all','BankController@multi_delete');
    Route::delete('/bank-offer/destroy/all','BankOfferController@multi_delete');
    Route::delete('/log/destroy/all','LogsController@multi_delete');
    Route::delete('/users/destroy/all','UserController@multi_delete');
    Route::delete('/subscribe_packages/destroy/all','SubscribeController@multi_delete');
    Route::delete('/promote/destroy/all','CarPromoteController@multi_delete');
    Route::delete('/AgencyCar/destroy/all','AgencyCarController@multi_delete');
    Route::delete("trending/destroy/all","TrendingController@multi_delete");
    Route::delete('/news/destroy/all','NewsController@multi_delete');
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
    Route::post('/car/{car}/status',"CarController@Status")->name('Car.Status');
    Route::post('/agency/{agency}/status',"AgencyController@Status")->name('Agency.Status');
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
    Route::get('/','InsuranceController@index')->name('index');
    Route::resource('/company','InsuranceCompanyController');
    Route::resource('/insurance-offer','InsuranceOfferController');
    Route::resource('/offer-plan','OfferPlanController');
    Route::delete('/insurance-offer/destroy/all','InsuranceOfferController@multi_delete');
    Route::delete('/offer-plan/destroy/all','OfferPlanController@multi_delete');
});
Route::group(['prefix' => 'agency','as' => 'agency.','namespace'=>"Agency", 'middleware' => ['role:agency']], function () {
    Route::get('/','AgencyDashController@index')->name('index');
    Route::resource('/company','AgencyController');
    Route::resource('/car','AgencyCarController');

    Route::post('/car/{car}/status',"AgencyCarController@Status")->name('car.Status');
    Route::get("available_model/{id}",'AgencyCarController@available_model');
    Route::get("available_governorate/{id}",'AgencyCarController@available_governorate');
    Route::get("available_city/{id}",'AgencyCarController@available_city');
    Route::get("available_year/{id}",'AgencyCarController@available_year');
    Route::delete('destroy/all','AgencyCarController@multi_delete');
    Route::get('/governorate/{id}','AgencyController@governorate');//Ajax Request
    Route::get('/country/{id}','AgencyController@country');//Ajax Request
});
Route::group(['prefix' => 'bank','as' => 'bank.','namespace'=>"Bank", 'middleware' => ['role:bank']], function () {
    Route::get('/','BankDashController@index')->name('index');
    Route::resource('/company','BankController');
    Route::resource('/bank-offer','BankOfferController');
});
//});

