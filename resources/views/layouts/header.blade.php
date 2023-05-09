<style>
    .header {
        width: 100%;

        border-bottom: 1px solid black;
    }

    .header__nav {
        padding: 0 20px;
        max-width: 1200px;
        margin: auto;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .header__links {
        display: flex;
        flex-wrap: wrap;
    }

    .header__link {
        margin-right: 20px;
    }

    .header__buttons {
        display: flex;
        flex-wrap: wrap;
    }

    .header__button {
        margin-right: 20px;
    }
</style>

<header class="header">
    <nav class="header__nav">
        <h1 class="header__title">
            <a href="{{route("main")}}">Учебная система</a>
        </h1>

        <ul class="header__links">
            <li><a href="{{route("main")}}" class="header__link">Главная</a></li>
            <li><a href="" class="header__link">Теория</a></li>
            <li><a href="" class="header__link">Практика</a></li>
            <li><a href="" class="header__link">Тесты</a></li>
        </ul>

        <ul class="header__buttons">
            @if(\Illuminate\Support\Facades\Auth::user())
                <li><a href="{{route("edit-account")}}" class="header__button button">Аккаунт</a></li>
                <li><a href="{{route("logout")}}" class="header__button button">Выйти</a></li>
                @if(\Illuminate\Support\Facades\Auth::user()->is_admin)
                    <li><a href="" class="header__button button">Панель администратора</a></li>
                @endif
            @else
                <li><a href="{{route("login")}}" class="header__button button">Вход</a></li>
                <li><a href="{{route("register")}}" class="header__button button">Регистрация</a></li>
            @endif
        </ul>
    </nav>
</header>
