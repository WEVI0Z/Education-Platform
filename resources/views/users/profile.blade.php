@extends("layouts.layout")

@section("content")
    <style>
        .profile {
            width: 350px;
            margin: auto;
        }

        .profile__item {
            display: flex;
            justify-content: space-between;
        }

        .profile__name {
            text-decoration: underline;
        }

        .profile__data {
        }

        .stats__list {
            padding-left: 20px;
        }

        .stats__item {
            margin-bottom: 10px;
            position: relative;
        }

        .stats__item::before {
            content: "";
            position: absolute;
            top: 9px;
            left: -18px;
            width: 15px;
            height: 0;
            border-bottom: 1px solid;
        }

        .stats__doc {
            display: inline;
            color: blue;
        }
    </style>

    <section class="profile">
        <h2 class="profile__title">
            {{$title}}
        </h2>
        <ul class="profile__list">
            <li class="profile__item">
                <p class="profile__name">ФИО:</p>
                <p class="profile__data">{{$user->full_name}}</p>
            </li>
            <li class="profile__item">
                <p class="profile__name">Логин:</p>
                <p class="profile__data">{{$user->login}}</p>
            </li>
            <li class="profile__item">
                <p class="profile__name">Почта:</p>
                <p class="profile__data">{{$user->email}}</p>
            </li>
        </ul>

        <p class="stats__title">
            Последняя статистика:
        </p>

        <ul class="stats__list">
            @foreach($stats as $stat)
                <li class="stats__item">Просмотрел/a <a href="{{asset($stat->document->path)}}" class="stats__doc"> {{$stat->document->name}}</a> {{$stat->created_at->diffForHumans()}}</li>
            @endforeach
        </ul>
    </section>
@endsection
