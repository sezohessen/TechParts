<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarModlesController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FavController;
use App\Http\Controllers\Api\SellerAccountController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\SellersController;
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


// Protected all routes with Api password (in env)
// Route::group(['middleware' => ['apiPass']] , function () {
    Route::prefix('v1')->group( function() {
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
        // Home page [Website] AKA - Search
        Route::get('/showCarModels',[CarModlesController::class,'carModels']);
        Route::get('/partSearch',[CarModlesController::class,'searchForPart']);
        Route::get('/sellersLocation',[SellersController::class,'LocationData']);
        Route::get('/sellerSearch',[SellersController::class,'searchForSellers']);


            ////////////////////////////
            // Protected Api Routes////
            //////////////////////////
        Route::group(['middleware' => ['auth:sanctum']] , function () {
            // get auth
            Route::get('getAuth', function(){
                return Auth()->user();
            });
            // Logout and destroy Token
            Route::post('/logout',[AuthController::class,'logout']);
            // Seller Panel
            Route::get('/allSellers',[SellerAccountController::class,'index']);
            Route::post('/updateSeller',[SellerAccountController::class,'saveSellerInfo']);
            Route::delete('/deleteBrand',[SellerAccountController::class,'deleteBrand']);
            // User fav
            Route::get('/userFav',[FavController::class,'showUserFav']);
            Route::post('/addToFav',[FavController::class,'AddToFav']);
            Route::post('/deleteFav',[FavController::class,'deleteFav']);
            // Chat
            Route::post('/sendMessage',[ChatController::class,'sendMessage']);
            Route::post('/getMessages',[ChatController::class,'fetchMessages']);
        });
    });
// });



