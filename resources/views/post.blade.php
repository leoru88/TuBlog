@extends('layouts.layout')

@section('title', 'POST')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand mx-auto" href="{{route('home')}}">
                    <h1 style="font-family: 'Arial', sans-serif; font-weight: bold; font-size: 28px; color: #ffffff; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Página principal</h1>
                </a>
        </div>
    </nav>

    <section class="container-fluid content">
        <div class=" row justify-content-center">
            <div class="col-12 col-md-7 text-center">
                <h1>{{$post->title}}</h1>
                <hr>
                <img src="{{asset($post->featured)}}" alt="{{$post->title}}" class="card-img-top">

                <p class="text-left mt-3 post-txt">
                    <span>Autor: {{$post->author}}</span>
                    <span class="float-right">Publicado: {{$post->created_at->diffForHumans()}}</span>
                </p>

                <p class="post-txt">
                    <span>{{$post->content}}</span>
                </p>

                <p class="text-left post-txt"><i>Categoría: {{$post->category->name}}</i></p>
            </div>

            <div class="col-md-3 offset-md-1">
                <p>Últimas entradas</p>

                @foreach($latestPosts as $post)

                <div class="row mb-4">
                    <div>
                        <a href="{{route('post', $post->id)}}">
                            <img src="{{ asset($post->featured) }}" width="100" alt="{{ $post->title }}">
                        </a>
                    </div>

                    <div class="col-7 pl-0">
                        <a href="{{route('post', $post->id)}}" class="link-post" style="color: #333">{{$post->title}}</a>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </section>

</body>

</html>

@endsection
