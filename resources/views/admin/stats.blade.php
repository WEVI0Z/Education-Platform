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

        .stats__title {
            margin-bottom: 0;
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
    </style>
    <section class="stats">
        <h2 class="stats__title">
            Cтатистика:
        </h2>

        <ul class="stats__list">
            @foreach($stats as $stat)
                <li class="stats__item">
                    <a href="{{route("profile", ["id" => $stat->user_id])}}" class="stats__profile">{{$stat->user->full_name}}</a> просмотрел/a <a href="{{asset(\App\Models\Document::query()->find($stat->document_id)->path)}}" class="stats__doc"> {{\App\Models\Document::query()->find($stat->document_id)->name}}</a>  {{$stat->created_at->diffForHumans()}}
                </li>
            @endforeach
        </ul>
    </section>
@endsection
