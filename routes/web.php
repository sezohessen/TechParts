<?php

use Illuminate\Support\Facades\Auth;

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
    Route::resource('/part','PartController');
    Route::resource('/seller','SellerController');
    Route::resource('/governorate','GovernorateController');
    Route::resource('/city','CityController');
    Route::resource('/terms','TermsController');
    Route::resource('/PPolicy','PrivacyPolicyController');
    Route::resource('/settings','SettingsController');
    Route::resource('/contact','ContactController');



    Route::prefix('car')->group(function () {
        Route::resources([
            'maker'     => "CarMakerController",
            'model'     => "CarModelController",
            'year'      => "CarYearController",
            'capacity'  => "CarCapacityController",
            'class'     => "CarClassController"
        ]);
        Route::get("available_model/{id}",'CarController@available_model');
        Route::get("available_city/{id}",'CarController@available_city');
        Route::get("available_year/{id}",'CarController@available_year');

    });
    Route::resource('car', 'CarController');

    // Users
  //  Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
  //  Route::resource('users', 'UsersController');
    Route::resource('users', 'UserController');
    /* Datatable deleteAll request */
    Route::delete('/part/destroy/all','PartController@multi_delete');
    Route::delete('/seller/destroy/all','SellerController@multi_delete');
    Route::delete('/governorate/destroy/all','GovernorateController@multi_delete');
    Route::delete('/city/destroy/all','CityController@multi_delete');

    Route::delete('/maker/destroy/all','CarMakerController@multi_delete');
    Route::delete('/model/destroy/all','CarModelController@multi_delete');
    Route::delete('/year/destroy/all','CarYearController@multi_delete');
    Route::delete('/car/destroy/all','CarController@multi_delete');
    Route::delete('/capacity/destroy/all','CarCapacityController@multi_delete');
    Route::delete('/class/destroy/all','CarClassController@multi_delete');
    Route::delete('/contact/destroy/all','ContactController@multi_delete');

    Route::delete('/users/destroy/all','UserController@multi_delete');
    /* Datatable Activity request */
    Route::post('/part/{part}/activity',"PartController@Activity")->name('part.Activity');
});
Route::get('/terms', 'Dashboard\TermsController@show')->name('OurTerms');
Route::get('/PPolicy', 'Dashboard\PrivacyPolicyController@show')->name('OurPolicy');


// Start website /////////////////////////////////////////////////////////////////////////////////
Route::group(['namespace'=>"Website",'as' => 'Website.'],function () {
    // Show Data / Index
    Route::get('/', 'HomeController@index')->name('Index');
    Route::get('/contact-us', 'ContactController@index')->name('ContactUs');
    Route::get('available_model/{id}','HomeController@available_model');
    Route::get('available_year/{id}','HomeController@available_year');
    Route::get('available_cities/{id}','HomeController@available_cities');
    // Send Data / Store
    Route::post('/contact-us', 'ContactController@store')->name('SendContact');

    // Show Parts Details
    Route::get('/part/{id}', 'HomeController@show')->name('ShowPart');
    // User
    // Route::get('/user', 'UserController@index')->name('ShowUser');

    Route::get('/seller/{id}/{first}-{second}', 'SellerController@show')->name('SellerProfile');
    Route::post('/RateSeller/{id}', 'SellerController@store')->name('RateSeller');

    // Adjusments
    Route::get('/all-sellers', 'SellersController@index')->name('Sellers');
    Route::get('/parts', 'AllPartController@show')->name('parts');


});
Route::group(['as' => 'Website.','namespace'=>"Website", 'middleware' => 'auth'], function () {

    Route::post('/part/{id}', 'ReviewController@store')->name('SendReview');

    Route::get('/edit-user', 'UserController@edit')->name('EditUser');
    Route::post('/edit-user', 'UserController@update')->name('SendEditUser');

    Route::get('/favorite', 'UserFavController@index')->name('favorite');
    Route::delete('/favorite/{id}', 'UserFavController@destroy')->name('destroyFavorite');
    Route::post('/favorite/{id}', 'UserFavController@store')->name('addToFavorite');
    Route::post('/add-favorite/{id}', 'UserFavController@storeFav')->name('storeFav');

});
Route::get('/Messenger/{id}','vendor\Chatify\MessagesController@index')
->middleware('auth')->name('MessengerID');

Auth::routes();
Route::group(['prefix' => 'seller','as' => 'seller.','namespace'=>"Seller", 'middleware' => ['role:seller']], function () {
    Route::get('/','SellerController@index')->name('index');
    Route::resource('/part','PartController');

    Route::delete('/part/destroy/all','PartController@multi_delete');
    Route::get('/car/create','CarController@create')->name('car.create');
    Route::post('/car/store','CarController@store')->name('car.store');
    Route::prefix('car')->group(function () {
        Route::get('/capacity/create','CarCapacityController@create')->name('capacity.create');
        Route::post('/capacity/store','CarCapacityController@store')->name('capacity.store');
        Route::get('/model/create','CarModelController@create')->name('model.create');
        Route::post('/model/store','CarModelController@store')->name('model.store');
        Route::get('/year/create','CarYearController@create')->name('year.create');
        Route::post('/year/store','CarYearController@store')->name('year.store');

        Route::get("available_model/{id}",'CarController@available_model');
        Route::get("available_year/{id}",'CarController@available_year');

    });
    Route::get('/my-account','AccountController@edit')->name('my_account.edit');
    Route::patch('/my-account/{id}','AccountController@update')->name('my_account.update');
    Route::get('/my-account/governorates/{id}','AccountController@show');
    Route::post('/part/{part}/activity',"PartController@Activity")->name('part.Activity');
});




Route::get('/download/{id}','FileDownloadController@DownloadFile');
