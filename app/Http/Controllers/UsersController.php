<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

        return view("users.login", compact("title"));
    }

    function register(Request $request) {
        if ($_POST) {
            $rules = [
                "full_name" => "required",
                "login" => "required|unique:users",
                "email" => "required|unique:users|email",
                "password" => "required|confirmed"
            ];

            $messages = [
                "full_name.required" => "Поле ФИО является обязательным",
                "login.required" => "Поле Логин является обязательным",
                "email.required" => "Поле Почта является обязательным",
                "password.required" => "Поле Пароль является обязательным",
                "login.unique" => "Пользователь с данным логином уже существует",
                "email.unique" => "Пользователь с данной почтой уже существует",
                "email.email" => "Данной почты не существует",
                "password.confirmed" => "Поля паролей не совпадают",
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            $validator->validate();

            $user = User::query()->create([
                "full_name" => $request->full_name,
                "email" => $request->email,
                "login" => $request->login,
                "password" => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()->route("main")->with("message", "Регистрация прошла успешно");
        }

        $title = "Регистрация";

        return view("users.register", compact("title"));
    }

    function logout() {
        Auth::logout();

        return redirect()->route("main")->with("message", "Успешный выход из аккаунта");
    }
}
