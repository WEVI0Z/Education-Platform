@extends("layouts.layout")

@section("content")
    <style>
        .docs {
            max-width: 1200px;
            margin: auto;
            display: flex;
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
            Документы:
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

        <a href="{{route("admin-create")}}" class="docs__button button">Создать новый</a>
    </section>
@endsection
