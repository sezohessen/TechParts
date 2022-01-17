<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\UsersController;
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


Route::prefix('v1')->group(function() {
    // Public Api Routes
    // Get Users
    Route::get('/users',[UsersController::class,'index']);
    // Get One user
    Route::get('/show-user/{User}',[UsersController::class,'show']);
    // Search for a user
    Route::get('/search-user/{name}',[UsersController::class,'search']);
    // Register to have a token
    Route::post('/register',[AuthController::class,'register']);
    // Register to have a token
    Route::post('/login',[AuthController::class,'login']);

    // Protected Api Routes
    Route::group(['middleware' => ['auth:sanctum']] , function () {
        // Add New User
        Route::post('/add-user',[UsersController::class,'AddUser']);
        // Update User
        Route::put('/update-user/{User}',[UsersController::class,'UpdateUser']);
        // Delete User
        Route::delete('delete-user/{User}',[UsersController::class,'DeleteUser']);
        // Logout and destroy Token
        Route::post('/logout',[AuthController::class,'logout']);

        // Seller Panel
        Route::post('/addCarModel',[SellerController::class,'addCarModel']);

    });

});




