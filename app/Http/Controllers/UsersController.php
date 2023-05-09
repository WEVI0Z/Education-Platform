<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    function login(Request $request) {
        if ($_POST) {
            if(Auth::attempt(["password" => $request->password, "login" => $request->login])) {
                return redirect()->route("main")->with("message", "Авторизация прошла успешно");
            } else {
                return redirect()->back()->with("error", "Неверный логин или пароль");
            }
        }

        $title = "Авторизация";

        return route("users.login", compact("title"));
    }

    function register() {
        if ($_POST) {

        }

        $title = "Регистрация";

        return route("users.register", compact("title"));
    }

    function logout() {
        Auth::logout();

        return redirect()->route("main")->with("message", "Успешный выход из аккаунта");
    }
}
