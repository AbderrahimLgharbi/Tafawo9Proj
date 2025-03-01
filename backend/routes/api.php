<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AdministrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthUserController::class,'login']);
Route::post('/register',[AuthUserController::class,'register']);
Route::post('/logout',[AuthUserController::class,'logout'])->middleware("auth:sanctum");


Route::group([],function(){
    Route::post("create",[AdministrationController::class,'create']);
    Route::post("update",[AdministrationController::class,'update']);
    Route::post("delete",[AdministrationController::class,'delete']);
    Route::post("getAll",[AdministrationController::class,'getAll']);

});
