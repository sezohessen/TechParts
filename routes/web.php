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


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/jquerymask', 'PagesController@jQueryMask');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

Route::group(['prefix' => 'dashboard','namespace'=>"Dashboard"], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/faqs','FaqController');
    Route::resource('/country','CountryController');
    Route::resource('/governorate','GovernorateController');
    Route::resource('/city','CityController');
    Route::resource('/category','CategoryController');
    Route::resource('/news','NewsController');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function ()
{
    $page_title = __('login');
    $page_description = __('login page');
    return view('auth.login',  compact('page_title', 'page_description'));
});

