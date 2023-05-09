@extends("layouts.layout")

@section("content")
    <style>
        .form {
            display: flex;
            flex-direction: column;
            width: 350px;
            margin: 30px auto;
            align-items: center;
        }

        .form__label {
            display: flex;
            font-size: 20px;
            flex-direction: column;
        }

        .form__input {
            margin: 10px 0;
            font-size: 18px;
            border: none;
            font-family: 'Montserrat', sans-serif;
            border-bottom: 1px solid black;
        }

        .form__input:focus {
            outline: none;
        }
        .form__submit {
            margin-top: 20px;
            padding: 10px 30px;
            font-size: 20px;
            font-family: 'Montserrat', sans-serif;
        }
    </style>

    <form action="{{route("edit-account")}}" method="post" class="form">
        @csrf
        <label for="full_name" class="form__label">
            Новое ФИО:
            <input type="text" name="full_name" id="full_name" class="form__input" placeholder="" value="{{\Illuminate\Support\Facades\Auth::user()->full_name}}">
        </label>
        <label for="password" class="form__label">
            Новый пароль:
            <input type="password" name="password" id="password" class="form__input" placeholder="" value="">
        </label>
        <label for="password_confirmation" class="form__label">
            Повторите пароль:
            <input type="password" name="password_confirmation" id="password-confirmation" class="form__input" placeholder="" value="">
        </label>
        <button type="submit" class="form__submit button">
            Внести изменения
        </button>
        <a href="{{route("delete-account")}}" type="button" class="form__submit button">
            Удалить аккаунт
        </a>
    </form>
@endsection
