@extends('connect.master')

@section('title', 'Registro')

@section('content')
    <div class="box box_registro shadow">
        <div class="header">
            <a href="{{ url('/') }}">
                <img src="{{ url('/static/imagen/logo.png') }}">
            </a>
        </div>
        <div class="inside">
            {!! Form::open(['url' => '/registro']) !!}
            <label for="name">Nombre:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-user-large"></i></div>
                </div>
                {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
            </div>

            <label for="lastname" class="mtop16">Apellido:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-user-pen"></i></div>
                </div>
                {!! Form::text('lastname', null, ['class' => 'form-control','required']) !!}
            </div>

            <label for="email" class="mtop16">Correo electrónico:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-envelope-open"></i></div>
                </div>
                {!! Form::email('email', null, ['class' => 'form-control','required']) !!}
            </div>

            <label for="password" class="mtop16">Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                </div>
                {!! Form::password('password', ['class' => 'form-control','required']) !!}
            </div>

            <label for="cpassword" class="mtop16">Confirmar Contraseña:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa-solid fa-key"></i></div>
                </div>
                {!! Form::password('cpassword', ['class' => 'form-control','required']) !!}
            </div>
            {!! Form::submit('Registrarse', ['class' => 'btn btn-success mtop16']) !!}
            {!! Form::close() !!}

            @if (Session::has('message'))
                <div class="container-fluid">
                    <div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:
                    block; margin-bottom: 16px;">
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

            <div class="footer mtop16">
                <a href="{{ url('/login') }}">Ya tengo una cuenta, Ingresar</a>
            </div>
        </div>
    </div>

@stop
