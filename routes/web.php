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


Route::group(['prefix' => 'dashboard','namespace'=>"Dashboard"], function () {
    Route::get('/', 'DashboardController@index');
    Route::resource('/faqs','FaqController');
    Route::resource('/country','CountryController');
    Route::resource('/governorate','GovernorateController');
    Route::resource('/city','CityController');
    Route::resource('/category','CategoryController');
    Route::resource('/news','NewsController');
    Route::resource('/terms','TermsController');
    Route::resource('/settings','SettingsController');
    Route::resource('/insurance','InsuranceController');
    Route::resource('/insurance-offer','InsuranceOfferController');
    Route::resource('/offer-plan','OfferPlanController');
});
Route::get('/terms', 'Dashboard\TermsController@show');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', function ()
{
    $page_title = __('login');
    $page_description = __('login page');
    return view('auth.login',  compact('page_title', 'page_description'));
});
Route::group(['middleware' => ['role:superadministrator']], function () {
    Route::resource('/users','UsersController');
    Route::resource('/permissions','PermissionsController');
    Route::resource('/roles','RoleController');
});

Route::get('/test', function ()
{
    $owner = Role::create([
        'name' => 'owner',
        'display_name' => 'Project Owner', // optional
        'description' => 'User is the owner of a given project', // optional
    ]);

    $admin = Role::create([
        'name' => 'admin',
        'display_name' => 'User Administrator', // optional
        'description' => 'User is allowed to manage and edit other users', // optional
    ]);

    $createPost = Permission::create([
        'name' => 'create-post',
        'display_name' => 'Create Posts', // optional
        'description' => 'create new blog posts', // optional
    ]);

    $editUser = Permission::create([
        'name' => 'edit-user',
        'display_name' => 'Edit Users', // optional
        'description' => 'edit existing users', // optional
    ]);
});

