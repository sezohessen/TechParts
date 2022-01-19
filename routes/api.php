<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SellerAccountController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\ToPartUsersController AS SearchForUser;

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


// Route::prefix('v1')->group(function() {
//     // Public Api Routes
//     // Get Users
//     Route::get('/users',[UsersController::class,'index']);
//     // Get Sellers
//     Route::get('/sellers',[SellerController::class,'index']);
//     // Get One user
//     Route::get('/show-user/{User}',[UsersController::class,'show']);
//     // Search for a user
//     Route::get('/search-user/{name}',[UsersController::class,'search']);
//     // Register to have a token
//     Route::post('/register',[AuthController::class,'register']);
//     // Register to have a token
//     Route::post('/login',[AuthController::class,'login']);

// });

Route::prefix('v1')->group(function() {
    // Public Api Routes
    Route::namespace('Api')->group(function () {
        Route::apiResource('users', ToPartUsersController::class);
        // Search for a user
        Route::get('/search-user/{name}',[SearchForUser::class,'search']);
    });
        // Register and login
    Route::post('/register',[AuthController::class,'register']);
        // Register to have a token
    Route::post('/login',[AuthController::class,'login']);
        // Protected Api Routes
    Route::group(['middleware' => ['auth:sanctum']] , function () {
        // Logout and destroy Token
        Route::post('/logout',[AuthController::class,'logout']);

        // Seller Panel
        Route::post('/updateSeller',[SellerAccountController::class,'saveSellerInfo']);
        // Route::post('/addCarModel',[SellerController::class,'addCarModel']);
        Route::get('/getAuth', function () {
            return auth()->user();
        });
    });
});



