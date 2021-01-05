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
    Route::delete('/country/destroy/all','CountryController@multi_delete"');
    Route::delete('/governorate/destroy/all','GovernorateController@multi_delete"');
    Route::delete('/city/destroy/all','CityController@multi_delete"');
    Route::delete('/category/destroy/all','CategoryController@multi_delete"');
    Route::delete('/news/destroy/all','NewsController@multi_delete"');
    Route::delete('/terms/destroy/all','TermsController@multi_delete"');
    Route::delete('/settings/destroy/all','SettingsController@multi_delete"');
    Route::delete('/insurance/destroy/all','InsuranceController@multi_delete"');
    Route::delete('/insurance-offer/destroy/all','InsuranceOfferController@multi_delete"');
    Route::delete('/offer-plan/destroy/all','OfferPlanController@multi_delete"');
    /* Datatable Activity request */
    Route::post('/country/{country}/activity',"CountryController@Activity")->name('Country.Activity');
    Route::post('/governorate/{governorate}/activity',"GovernorateController@Activity")->name('Governorate.Activity');
    Route::post('/city/{city}/activity',"CityController@Activity")->name('City.Activity');
    Route::post('/category/{category}/activity',"CategoryController@Activity")->name('Category.Activity');

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
});
