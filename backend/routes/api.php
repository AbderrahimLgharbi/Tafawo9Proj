<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AdministrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthUserController::class,'login']);
Route::post('/register',[AuthUserController::class,'register']);
Route::post('/logout',[AuthUserController::class,'logout'])->middleware("auth:sanctum");


Route::prefix('administration')->group(function(){
    Route::post("create",[AdministrationController::class,'create']);
    Route::put("update",[AdministrationController::class,'update']);
    Route::post("delete",[AdministrationController::class,'delete']);
    Route::get("getAll",[AdministrationController::class,'getAll']);

});

Route::prefix('grade')->group(function(){
    Route::post("create",[GradeController::class,'create']);
    Route::put("update",[GradeController::class,'update']);
    Route::post("delete",[GradeController::class,'delete']);
    Route::get("getAll",[GradeController::class,'getAll']);

});

Route::prefix('domaine')->group(function(){
    Route::post("create",[DomaineController::class,'create']);
    Route::put("update",[DomaineController::class,'update']);
    Route::post("delete",[DomaineController::class,'delete']);
    Route::get("getAll",[DomaineController::class,'getAll']);
});
