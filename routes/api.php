<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\BloguserController;
use App\Http\Controllers\Api\CategoriController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\HomeController;

use App\Models\User;
use Database\Seeders\adminseeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/admin/login',[UserController::class,'login']);

Route::middleware('auth:api')->group(function(){ 
    
     Route::group(['prefix' => 'admin'], function () {

        //home
        Route::group(['prefix' => 'home'], function () {
            Route::get('/index',[HomeController::class,'index']);
            Route::get('/index/{id}',[HomeController::class,'bloguser']);
        });
        
        
        Route::get('/dashboard/index',[DashboardController::class,'index']); //dashboard
        Route::get('/profile/index',[ProfileController::class,'index']);  //profile
        
        
        //categories
        Route::group(['prefix' => 'categories'], function () {
            Route::post('/',[CategoriController::class,'store']);
            Route::get('/index',[CategoriController::class,'index']);
            Route::get('/edit/{id}',[CategoriController::class,'edit']);
            Route::post('/update/{id}',[CategoriController::class,'update']);
            Route::delete('/delete/{id}',[CategoriController::class,'delete']);
        });

        //tags
        Route::group(['prefix' => 'tags'], function () {
            Route::post('/',[TagController::class,'store']);
            Route::get('/index',[TagController::class,'index']);
            Route::get('/edit/{id}',[TagController::class,'edit']);
            Route::post('/update/{id}',[TagController::class,'update']);
            Route::delete('/delete/{id}',[TagController::class,'delete']);
        });    
        
        //users
        Route::group(['prefix' => 'users'], function () {
            Route::post('/',[UserController::class,'store']);
            Route::get('/index',[UserController::class,'index']);
            Route::get('/edit/{id}',[UserController::class,'edit']);
            Route::post('/update/{id}',[UserController::class,'update']);
            Route::delete('/delete/{id}',[UserController::class,'delete']);
            Route::post('/password',[UserController::class,'password']);
        });

        //blogs
        Route::group(['prefix' => 'blogs'], function () {
            Route::post('/',[BlogController::class,'store']);
            Route::get('/index',[BlogController::class,'index']);
            Route::get('/edit/{id}',[BlogController::class,'edit']);
            Route::post('/update/{id}',[BlogController::class,'update']);
            Route::post('/status/{id}',[BlogController::class,'status']);
            Route::delete('/delete/{id}',[BlogController::class,'delete']);
        });
        

        //contacts
        Route::group(['prefix' => 'contacts'], function () {
            Route::post('/',[ContactController::class,'store']);
            Route::get('/index',[ContactController::class,'index']);
        });

        

        
        
     });

});

    
    