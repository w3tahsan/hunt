<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerRegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['auth:sanctum'])->group(function() {
    Route::post('category/store', [CategoryController::class, 'category_store']);
});


// Route::post('category/store', [CategoryController::class, 'category_store'])->middleware('auth:sanctum');


Route::post('customer/register', [CustomerRegisterController::class, 'customer_register']);
Route::post('customer/login', [CustomerRegisterController::class, 'customer_login']);
Route::post('customer/logout', [CustomerRegisterController::class, 'customer_logout']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
