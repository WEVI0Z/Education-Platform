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
            <li><a href="{{route("login")}}" class="header__button">Вход</a></li>
            <li><a href="{{route("register")}}" class="header__button">Регистрация</a></li>
            <li><a href="" class="header__button">Аккаунт</a></li>
            <li><a href="{{route("logout")}}" class="header__button">Выйти</a></li>
            <li><a href="" class="header__button">Панель администратора</a></li>
        </ul>
    </nav>
</header>
