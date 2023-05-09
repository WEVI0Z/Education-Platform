@extends("layouts.layout")

@section("content")
    <style>
        .stats {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: flex-start;
            flex-direction: column;
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

        .stats__profile {
            display: inline;
            color: blue;
        }

        .stats__doc {
            display: inline;
            color: blue;
        }

        .stats__button {
            font-size: 18px;
        }

        .docs {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: flex-start;
            flex-direction: column;
        }

        .docs__item {
            position: relative;
            margin-bottom: 20px;
        }

        .doc {
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;

            border: 1px solid black;
            border-radius: 10px;
        }

        .doc__title {
            margin: 0;
        }

        .doc__date {
            margin: 0;
        }

        .doc__buttons {
            display: flex;
            flex-wrap: wrap;
        }

        .doc__button {
            margin-left: 20px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .button {
            align-self: flex-start;
        }
    </style>

    <section class="docs">
        <h2 class="docs__title">
            Последние документы:
        </h2>

        <ul class="docs__list">
            @foreach($documents as $document)
                <li class="docs__item doc">
                    <h3 class="doc__title">{{$document->name}}</h3>
                    <p class="doc__date">{{$document->created_at}}</p>
                    <p class="doc__type">{{$document->category}}</p>
                    <div class="doc__buttons">
                        <a href="{{asset($document->path)}}" class="doc__button button">Открыть</a>
                        <a href="{{route("admin-edit", ["id" => $document->id])}}" class="doc__button button">Изменить</a>
                        <a href="{{route("admin-delete", ["id" => $document->id])}}" class="doc__button button">Удалить</a>
                    </div>
                </li>
            @endforeach
        </ul>

        <a href="{{route("admin-docs")}}" class="button">
            Показать все документы
        </a>
    </section>

    <section class="stats">
        <h2 class="stats__title">
            Последняя статистика:
        </h2>

        <ul class="stats__list">
            <li class="stats__item"><a href="" class="stats__profile">Гаркавый Алексей Петрович</a> просмотрел/a <a href="" class="stats__doc"> документ с таким то названием</a></li>
            <li class="stats__item"><a href="" class="stats__profile">Гаркавый Алексей Петрович</a> просмотрел/a <a href="" class="stats__doc"> документ с таким то названием</a></li>
            <li class="stats__item"><a href="" class="stats__profile">Гаркавый Алексей Петрович</a> просмотрел/a <a href="" class="stats__doc"> документ с таким то названием</a></li>
            <li class="stats__item"><a href="" class="stats__profile">Гаркавый Алексей Петрович</a> просмотрел/a <a href="" class="stats__doc"> документ с таким то названием</a></li>
            <li class="stats__item"><a href="" class="stats__profile">Гаркавый Алексей Петрович</a> просмотрел/a <a href="" class="stats__doc"> документ с таким то названием</a></li>
        </ul>

        <a href="#" class="button">
            Показать всю статистику
        </a>
    </section>
@endsection
