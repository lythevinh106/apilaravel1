<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\ProductController as ApiProductController;
use App\Http\Controllers\Api\RegisterController;
use App\Models\Api\productController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("register", [RegisterController::class, "register"]); //  co thmm prefix("api")
Route::post("login", [LoginController::class, "login"]);
///danh sach san pham
Route::get("product", [ApiProductController::class, "index"]);
///refresh token
/// khi token het han thi se update lai
Route::post("refresh_token", [LoginController::class, "refresh_token"]);


///delete token
/// khi loggout se xoa token

Route::delete("delete_token", [LoginController::class, "delete_token"]);

// Route::delete("delete-token", [LoginController::class, "delete-token"]);
