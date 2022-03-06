<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarModlesController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\FavController;
use App\Http\Controllers\Api\RateController;
use App\Http\Controllers\Api\SellerAccountController;
use App\Http\Controllers\Api\SellerController;
use App\Http\Controllers\Api\SellersController;
use App\Http\Controllers\Api\ToPartUsersController AS SearchForUser;



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
        // Get Reviews [Part - Seller]
        Route::get('/PartReviews',[RateController::class,'getAllPartRates']);
        Route::get('/SellerReviews',[RateController::class,'getAllSellerReviews']);

            ////////////////////////////
            // Protected Api Routes////
            //////////////////////////
        Route::group(['middleware' => ['auth:sanctum']] , function () {
            // Logout and destroy Token
            Route::post('/logout',[AuthController::class,'logout']);
            // Seller Panel
            Route::get('/allSellers',[SellerAccountController::class,'index']);
            Route::post('/updateSeller',[SellerAccountController::class,'saveSellerInfo']);
            // Route::get('/getAuth', function () {
            //     return auth()->user();
            // });
            // Seller Dashboard
            Route::post('/addCarType',[SellerController::class,'addCarType']);
            Route::post('/addYear',[SellerController::class,'addYear']);
            Route::post('/addCapacity',[SellerController::class,'addCapacity']);
            Route::post('/storePart',[SellerController::class,'addPart']);
            Route::post('/updatePart',[SellerController::class,'editPart']);
            Route::get('/sellerParts',[SellerController::class,'showSellerPart']);
            Route::post('/deletePart',[SellerController::class,'deleteSellerPart']);
            // Rate [Part-Seller]
            Route::post('/ratePart',[RateController::class,'ratePart']);
            Route::post('/rateSeller',[RateController::class,'rateSeller']);
            // User fav
            Route::get('/userFav',[FavController::class,'showUserFav']);
            Route::post('/addToFav',[FavController::class,'AddToFav']);
            Route::post('/deleteFav',[FavController::class,'deleteFav']);
            // Chat
            // Route::post('/sendMessage',[ChatController::class,'sendMessage']);
            // Route::post('/getMessages',[ChatController::class,'fetchMessages']);
        });
    });
// });



