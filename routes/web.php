<?php

use Illuminate\Support\Facades\Route;

Route::get("/", [\App\Http\Controllers\Controller::class, "main"])->name("main");


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

Route::group(["middleware" => "authorized"], function () {
    Route::get("users/logout", [\App\Http\Controllers\UsersController::class, "logout"])->name("logout");
    Route::get("users/delete", [\App\Http\Controllers\UsersController::class, "delete"])->name("delete-account");
    Route::match(["get", "post"],
        "/users/edit",
        [\App\Http\Controllers\UsersController::class, "edit"]
    )->name("edit-account");
    Route::get("users/{id}", [\App\Http\Controllers\UsersController::class, "showProfile"])->name("profile");

    Route::get("/docs/{category}", [\App\Http\Controllers\DocumentsController::class, "show"])->name("docs");

    Route::get("app/{id}", [\App\Http\Controllers\StatisticsController::class, "open"])->name("open");
    Route::get("stats", [\App\Http\Controllers\StatisticsController::class, "show"])->name("show-stats");



    Route::group(["middleware" => "admin", "prefix" => "admin"], function () {
        Route::get("/docs", [\App\Http\Controllers\DocumentsController::class, "showDocs"])->name("admin-docs");
        Route::get("/", [\App\Http\Controllers\DocumentsController::class, "showPanel"])->name("admin");
        Route::get("/delete/{id}", [\App\Http\Controllers\DocumentsController::class, "delete"])->name("admin-delete");
        Route::match(["get", "post"], "/edit/{id}", [\App\Http\Controllers\DocumentsController::class, "edit"])->name("admin-edit");
        Route::match(["get", "post"], "/doc", [\App\Http\Controllers\DocumentsController::class, "createDoc"])->name("admin-create");
    });
});
