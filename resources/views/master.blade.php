<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Tienda</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ url('/static/css/style.css?v=' . time()) }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;500&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0f2675824f.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script> -->

    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
    <!--<script src="{{ url('/static/libreria/ckeditor/ckeditor.js') }}"></script>-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('/static/js/site.js?v=' . time()) }}"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/imagen/logo_tienda.png') }}"></a>
            <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>-->

            <div class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/tienda') }}" class="nav-link"> Tienda</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link">Sobre Nosotros</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"> Contactos</a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('/carrito') }}" class="nav-link"><i class="fa-solid fa-cart-shopping"></i>
                        <span class="carnumber">0</span></a>
                    </li>
                    @if (Auth::guest())
                    <li class="nav-item link-acc">
                        <a href="{{ url('/login') }}" class="nav-link btn"> Ingresar</a>
                        <a href="{{ url('/registro') }}" class="nav-link btn"> Crear Cuenta</a>
                    </li>

                    @else
                    <li class="nav-item dropdown link-acc link-user  ">
                        <a href="{{ url('/login') }}" class="nav-link btn dropdown-toggle
                        id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false""> @if(is_null(Auth::user()->avatar))
                            <img src="{{ url('/static/imagen/default-avatar.png') }}"> @endif Bienvenido: {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/account/editar') }}"><i class="fa-solid fa-user-pen">
                                </i> Editar mi perfil</a></li>
                            <li><a class="dropdown-item" href="{{ url('/logout') }}">Cerrar Sesión
                                <i class="fa-solid fa-right-from-bracket"></i></a></li>

                        </ul>
                    </li>

                    @endif
                </ul>

            </div>

        </div>
    </nav>


    @if (Session::has('message'))
        <div class="container-fluid">
            <div class="alert alert-{{ Session::get('typealert') }} mtop16"
                style="display:block; margin-bottom: 16px;">
                {{ Session::get('message') }}
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <script>
                    $('.alert').slideDown();
                    setTimeout(function() {
                        $('.alert').slideUp();
                    }, 10000);
                </script>
            </div>
        </div>
    @endif
    @section('content')
    @show


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
</body>

</html>
