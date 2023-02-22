<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    AuthController,
    CategoryController,
    SubCategoryController,
    BrandController,
    TagController,
    ProductController
};

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post("register",[AuthController::class,"register"]);
Route::post("login",[AuthController::class,"login"]);
// Category [Index show] Controller for the API
Route::get('categories',[CategoryController::class,'index']);
Route::get('categories/show/{slug}',[CategoryController::class,'show']);
// SubCategory [Index show] Controller for the API
Route::group(['prefix'=>'subcategories'],function(){
    Route::get('/',[SubCategoryController::class,'index']);
    Route::get('/{id}',[SubCategoryController::class,'show']);
});
// Brand [Index show] Controller for the API
Route::group(['prefix'=>'brands'],function(){
    Route::get('/',[BrandController::class,'index']);
    Route::get('/{id}',[BrandController::class,'show']);
});

// Tag [Index show] Controller for the API
Route::group(['prefix'=>'tags'],function(){
    Route::get('/',[TagController::class,'index']);
    Route::get('/{id}',[TagController::class,'show']);
});

// Product [Index show] Controller for the API
Route::group(['prefix'=>'products'],function(){
    Route::get('/',[ProductController::class,'index']);
    Route::get('/{slug}',[ProductController::class,'show']);
});


Route::middleware("auth:api")->group(function(){
    Route::get("me",[AuthController::class,"me"]);
    Route::get("users",[AuthController::class,"users"]);
    Route::post("logout",[AuthController::class,"logout"]);

    // Category Controller for the API
    Route::group(['prefix'=>'category'],function(){
        Route::post('store',[CategoryController::class,'store']);
        Route::put('update/{id}',[CategoryController::class,'update']);
        Route::delete('destroy/{id}',[CategoryController::class,'destroy']);
    });
    // SubCategory Controller for the API
    Route::group(['prefix'=>'subcategory'],function(){
        Route::post('store',[SubCategoryController::class,'store']);
        Route::put('update/{id}',[SubCategoryController::class,'update']);
        Route::delete('destroy/{id}',[SubCategoryController::class,'destroy']);
    });

    // Brand Controller for the API
    Route::group(['prefix'=>'brand'],function(){
        Route::post('store',[BrandController::class,'store']);
        Route::put('update/{id}',[BrandController::class,'update']);
        Route::delete('destroy/{id}',[BrandController::class,'destroy']);
    });
    // Tags Controller for the API
    Route::group(['prefix'=>'tag'],function(){
        Route::post('store',[TagController::class,'store']);
        Route::put('update/{id}',[TagController::class,'update']);
        Route::delete('destroy/{id}',[TagController::class,'destroy']);
    });
    // Tags Controller for the API
    Route::group(['prefix'=>'product'],function(){
        Route::post('store',[ProductController::class,'store']);
        Route::put('update/{id}',[ProductController::class,'update']);
        Route::delete('destroy/{id}',[ProductController::class,'destroy']);
    });

});