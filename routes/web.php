<?php

use Illuminate\Support\Facades\Route;

Route::get("/", [\App\Http\Controllers\Controller::class, "main"])->name("main");

Route::group(["middleware" => "authorized"], function () {
    Route::get("users/logout", [\App\Http\Controllers\UsersController::class, "logout"])->name("logout");

    Route::group(["middleware" => "admin", "prefix" => "admin"], function () {

    });
});

Route::group(["middleware" => "unauthorized"], function () {
    Route::match(
        ["get", "post"],
        "/users/login",
        [\App\Http\Controllers\UsersController::class, "login"]
    )->name("login");

    Route::match(["get", "post"],
        "/users/register",
        [\App\Http\Controllers\UsersController::class, "register"]
    )->name("register");
});
