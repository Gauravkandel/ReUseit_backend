<?php

use App\Http\Controllers\logController;
use App\Http\Controllers\profileController;
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
//hello my name is gaurav
Route::controller(logController::class)->group(function () {
    Route::post("/login", "login")->name("login");
    Route::get("/logout", "logout")->name("user.logout")->middleware('auth:sanctum');
    Route::post("/register", [logController::class, "register"])->name("user.register");
});
Route::get("/get-profile", [profileController::class, "getUserdetails"])->middleware('auth:sanctum');
