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

        .docs__label {
            font-size: 20px;
            position: relative;
        }

        .docs__input:focus {
            outline: none;
        }

        .docs__input {
            padding-left: 20px;
            margin: 10px 0;

            font-size: 18px;

            border: none;
            font-family: 'Montserrat', sans-serif;
            border-bottom: 1px solid black;
        }

        .docs__label::before {
            content: "";
            width: 20px;
            height: 20px;
            position: absolute;
            top: 12px;
            left: 0;

            background-size: contain;
            background-image: url({{asset("img/search.svg")}});
        }

        .docs__main {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>

    <section class="docs">
        <div class="docs__main">
            <h2 class="docs__title">
                {{$documents[0]->category ?? "Документы"}}:
            </h2>
            <span class="docs__category" style="display: none">
                {{$documents[0]->category ?? "Документы"}}
            </span>
            <label for="search" class="docs__label">
                <input type="search" name="search" id="search" class="docs__input" placeholder="Поиск...">
            </label>
        </div>

        @if(count($documents))
            <ul class="docs__list">
                @foreach($documents as $document)
                    <li class="docs__item doc">
                        <h3 class="doc__title">{{$document->name}}</h3>
                        <p class="doc__date">{{$document->created_at}}</p>
                        <p class="doc__type">{{$document->category}}</p>
                        <div class="doc__buttons">
                            <a href="{{route("open", ["id" => $document->id])}}" class="doc__button button">Открыть</a>
                        </div>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="docs__span">
                Документов выбранного типа пока не было добавлено
            </p>
        @endif
    </section>

    <script>
        const category = document.querySelector(".docs__category");
        const input = document.querySelector(".docs__input");
        const container = document.querySelector(".docs__list");

        input.addEventListener("change", async (event) => {
            event.preventDefault();
            container.innerHTML = "";

            const response = await fetch("{{asset("api/documents/search")}}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json;charset=utf-8"
                },
                body: JSON.stringify({text: input.value, category: category.textContent}),
            })

            const documents = await response.json();

            documents.forEach(doc => {
                const date = new Date(doc.created_at);

                const humanDate = `${date.getFullYear()}-${date.getMonth() + 1 >= 10 ? date.getMonth() + 1 : "0" + (date.getMonth() + 1)}-${date.getDate() >= 10 ? date.getDate() : "0" + date.getDate()} ${date.getHours() >= 10 ? date.getHours() : "0" + date.getHours()}:${date.getMinutes() >= 10 ? date.getMinutes() : "0" + date.getMinutes()}:${date.getSeconds() >= 10 ? date.getSeconds() : "0" + date.getSeconds()}`

                container.innerHTML += `
                    <li class="docs__item doc">
                        <h3 class="doc__title">${doc.name}</h3>
                        <p class="doc__date">${humanDate}</p>
                        <p class="doc__type">${doc.category}</p>
                        <div class="doc__buttons">
                            <a href="{{asset("open/")}}${doc.id}" class="doc__button button">Открыть</a>
                        </div>
                    </li>
                `;
            });
        });

    </script>
@endsection
