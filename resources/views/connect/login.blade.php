@extends('connect.master')

@section('title', 'Login')

@section('content')
    <div class="box box_login shadow">
        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/imagen/logo.png') }}">
            </a>
        </div>

        <div class="inside">
            {!! Form::open(['url' => '/login']) !!}
            <label for="email" class="mtop16">Correo electrónico:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                </div>
                {!! Form::email('email', null, ['class' => 'form-control']) !!}
            </div>

            <label for="password" class="mtop16">Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                </div>
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>
            {!! Form::submit('Ingresar', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}

            @if(Session::has('message'))
            <div class="container-fluid">
                <div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:
                block; margin-bottom: 16px;">
                    {{ Session::get('message') }}
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors -> all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <script>
                        $('.alert').slideDown();
                        setTimeout(function() {$('.alert').slideUp();}, 10000);
                    </script>
                </div>
            </div>
        @endif

            <div class="footer mtop16">
                <a href="{{ url('/registro') }}">¿No tienes cuenta?, Registrate</a>
                <a href="{{ url('/recuperar') }}">Recuperar contraseña</a>
            </div>
        </div>
    </div>

@stop
