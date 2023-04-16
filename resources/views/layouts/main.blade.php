<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.css"
        rel="stylesheet" type="text/css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <title>Document</title>
</head>

<body>
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('project.index') }}">Projects</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-primary" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Меню</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link {{ in_array(Request::path(), ['projects', '/']) ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('project.index') }}">Посты</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === 'profile' ? 'active' : '' }}"
                                    href="{{ route('profile.index') }}">Профиль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::path() === 'projects/create' ? 'active' : '' }}"
                                    href="{{ route('project.create') }}">Создать</a>
                            </li>
                        </ul>
                        @auth
                            <form class="d-flex align-items-center" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a class="dropdown-item a-light" onclick="this.closest('form').submit();return false;"
                                    href="{{ route('logout') }}">Выход</a>
                            </form>
                        @endauth
                        @guest
                            <div class="d-flex align-items-center">
                                <a class="dropdown-item a-light" href="{{ route('login') }}">Вход</a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <div class="padding">
        @yield('content')
    </div>
</body>

</html>
