<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

// Get Users
Route::get('/users',[UsersController::class,'index']);
// Get One user
Route::get('/show-user/{User}',[UsersController::class,'show']);
// Search for a user
Route::get('/search-user/{name}',[UsersController::class,'search']);
// Add New User
Route::post('/add-user',[UsersController::class,'AddUser']);
// Update User
Route::put('/update-user/{User}',[UsersController::class,'UpdateUser']);
// Delete User
Route::delete('delete-user/{User}',[UsersController::class,'DeleteUser']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


