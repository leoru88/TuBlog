<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
        <a class="navbar-brand" href="{{route('admin.posts.index')}}">
            <img src="{{  asset('vendor/adminlte/dist/img/AdminLTELogo3.png')}}" alt="Blog Logo" width="60" height="60">
            <span class="ml-2">Panel de control</span>
        </a>
    </nav>

    <nav class="navbar navbar-light bg-main">
        <div class="container d-flex justify-content-end align-items-center">
            <a class="navbar-brand mx-auto" href="{{route('home')}}">
                <img src="{{  asset('images/13.png')}}" width="250" alt="" loading="lazy">
                <div class="ml-2 text-right">
                    <span style="font-size: 1.6rem; font-family: 'Arial', sans-serif;">Bienvenido a tu</span>
                    <br>
                    <span style="font-size: 5rem; font-family: 'Arial Black', sans-serif;">BLOG</span>
                </div>
            </a>
        </div>
    </nav>


    <section class="container-fluid content">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <nav class="text-center my-5">
                    <a href="/" class="mx-3 pb-3 link-category d-block d-md-inline {{ request()->routeIs('home') ? 'selected-category' : '' }} text-dark">Todas</a>
                    @foreach ($categories as $category)
                    @php
                    $selectedClass = '';
                    if(request()->routeIs('posts.category') && request()->segment(2) == $category->name) {
                    $selectedClass = 'selected-category';
                    }
                    @endphp
                    <a href="{{route('posts.category', $category->name)}}" class="mx-3 pb-3 link-category d-block d-md-inline {{ $selectedClass }} text-dark">{{$category->name}}</a>
                    @endforeach
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    @foreach ($posts as $post)
                    <div class="col-md-4 mb-5 d-flex">
                        <div class="card flex-fill" style="height: 900px;">
                            <a href="{{ route('post', $post->id) }}">
                                <img class="card-img-top" src="{{ asset($post->featured) }}" alt="{{ $post->name }}">
                            </a>
                            <div class="card-body d-flex flex-column" style="height: 50%; scrollbar-width: none; -ms-overflow-style: none;">

                                <small class="card-txt-category">Categoría: {{$post->category->name}}</small>
                                <h5 class="card-title">{{$post->title}}</h5>
                                <p class="card-text" style="flex: 1; text-align: justify; overflow: auto;">{{$post->content}}</p>
                                <a href="{{route('post', $post->id)}}" class="post-link mt-auto">Leer más</a>
                                <hr>
                                <div class="row mt-auto">
                                    <div class="col-6 text-right">
                                        <span class="card-txt-author">{{$post->author}}</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="card-txt-date">{{$post->created_at->diffForHumans()}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </section>

    <footer class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="social-links mb-4">
                    <a href="https://www.linkedin.com/in/leonardo-rodriguez-developer/" target="_blank" class="social-link">
                        <i class="fab fa-linkedin fa-lg"></i>
                    </a>
                    <a href="https://www.instagram.com/leoru88/" target="_blank" class="social-link">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="https://www.facebook.com/leonardo.rodriguez.uzcategui/" target="_blank" class="social-link">
                        <i class="fab fa-facebook-f fa-lg"></i>
                    </a>
                </div>
                <p class="mb-0">© 2022 Ing. Leonardo Rodríguez
                    . Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>

</body>

<style>
    .text-dark {
        color: #000;
    }

    .text-dark:hover {
        color: #333 !important;
        transition: color 0.3s;
    }

    .content {
        overflow-y: auto;
        scrollbar-width: none;
        -ms-overflow-style: none;
    }

    .content::-webkit-scrollbar {
        display: none;
    }

    .content {
        scrollbar-color: transparent transparent;
    }

    nav.navbar {
        background-color: #ff9800;
        border-bottom: none;
    }

    .navbar-brand img {
        border-radius: 50%;
    }

    .navbar-brand span {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5),
            -1px -1px 1px rgba(0, 0, 0, 0.5);
        font-size: 20px;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .navbar-brand:hover span {
        transform: scale(1.1);
        color: #ff9800;
    }

    .navbar-brand img {
        max-width: 120%;
    }

    .navbar-nav .nav-link {
        color: #333;
    }

    .navbar-nav .nav-link:hover {
        color: #fff;
        background-color: #333;
    }

    .navbar-nav {
        margin: auto;
    }

    .navbar {
        margin-bottom: 20px;
    }

    .link-category {
        text-decoration: none;
        color: #333;
        transition: color 0.3s, transform 0.3s;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .link-category:hover {
        color: #ff9800;
        transform: scale(1.1);
        text-shadow: 1px 1px 1px #ff9800, -1px -1px 1px rgba(255 183 0 / 0.5);
    }

    .selected-category {
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.5),
            -1px -1px 1px rgba(0, 0, 0, 0.5);
        font-size: 1.5rem;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }

    .card {
        border: 2px solid #ff9800;
        border-radius: 20px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
        transition: transform 0.3s ease;
        background-color: #333;
        color: #fff;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.4);
    }

    .card-img-top {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        height: 300px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.5rem;
        margin-top: 1rem;
    }

    .card-txt-category {
        color: #ff9800;
    }

    .card-txt-date {
        color: #ff9800;
    }

    footer {
        background-color: #262626;
        color: #fff;
        padding: 2rem 0;
        text-align: center;
    }

    .social-link {
        margin: 0 0.5rem;
        color: #ff9800;
    }

    .social-link:hover {
        color: #ffc107;
    }
</style>

</html>