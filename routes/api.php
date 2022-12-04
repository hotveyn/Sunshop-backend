<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post("register", [\App\Http\Controllers\User\UserController::class, "store"]);
Route::post("login", [\App\Http\Controllers\User\UserController::class, "login"]);



Route::prefix("/category")->group(function (){
    Route::get("/", [\App\Http\Controllers\CategoryController::class,"info"]);
    Route::post("/", [\App\Http\Controllers\CategoryController::class,"infoPaged"]);
});

Route::middleware('auth:api')->group(function (){
    Route::get("session", [\App\Http\Controllers\User\UserController::class, "session"]);
    Route::get("logout", [\App\Http\Controllers\User\UserController::class, "logout"]);

    Route::middleware("staff")->group(function (){
        Route::prefix("/user")->group(function (){
            Route::put("/{id}", [\App\Http\Controllers\User\StaffType\UserController::class, "update"]);
            Route::get("/{id}", [\App\Http\Controllers\User\StaffType\UserController::class, "infoOne"]);
            Route::delete("/{id}", [\App\Http\Controllers\User\StaffType\UserController::class, "delete"]);
            Route::post("/", [\App\Http\Controllers\User\StaffType\UserController::class, "infoPaged"]);
            Route::get("/", [\App\Http\Controllers\User\StaffType\UserController::class, "info"]);
        });

        Route::prefix("/category")->group(function (){
            Route::get("/", [\App\Http\Controllers\CategoryController::class,"info"]);
            Route::post("/", [\App\Http\Controllers\CategoryController::class,"infoPaged"]);
            Route::post("create", [\App\Http\Controllers\CategoryController::class,"create"]);
            Route::delete("/{id}", [\App\Http\Controllers\CategoryController::class,"delete"]);
            Route::put("/{id}", [\App\Http\Controllers\CategoryController::class,"update"]);
        });
        Route::prefix("/product")->group(function (){
//           Route::post("/create", [\App\Http\Controllers\ProductController::class, "create"]);
        });
    });
//    Route::middleware("client")->group(function (){
//
//    });
});
