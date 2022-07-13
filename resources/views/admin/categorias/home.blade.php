@extends('admin.master')
@section('title', 'Categorias')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categorias/{modulo}') }}"><i class="fa-solid fa-folder-open"></i> Categorias</a>
    </li>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar Categoria</h2>
                    </div>

                    <div class="inside">
                        @if (kvfj(Auth::user()->permisos, 'categoria_add'))
                            {!! Form::open(['url' => '/admin/categoria/add']) !!}
                            <label for="nombre">Nombre:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                                {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                            </div>

                            <label for="modulo" class="mtop16">Módulo:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-box-open"></i></span>
                                {!! Form::select('modulo', getModulesArray(), 0, ['class' => 'form-select']) !!}
                            </div>

                            <label for="icono" class="mtop16">Ícono:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-hurricane"></i></span>
                                {!! Form::text('icono', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mtop16']) !!}
                            {!! Form::close() !!}
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-folder-open"></i> Categorias</h2>
                    </div>

                    <div class="inside">
                        <nav class="nav nav-pills nav-fill">
                            @foreach (getModulesArray() as $m => $k)
                                <a class="nav-link" href="{{ url('/admin/categorias/' . $m) }}"><i
                                        class="fa-solid fa-list-check"></i> {{ $k }}</a>
                            @endforeach
                        </nav>

                        <table class="table mtop16">
                            <thead>
                                <tr>
                                    <td width="32px"></td>
                                    <td><strong>Nombre</strong></td>
                                    <td width="140px"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cats as $cat)
                                    <tr>
                                        <td>{!! htmlspecialchars_decode($cat->icono) !!}</td>
                                        <td>{{ $cat->nombre }}</td>
                                        <td>
                                            <div class="opts">
                                                @if (kvfj(Auth::user()->permisos, 'categoria_editar'))
                                                    <a href="{{ url('/admin/categoria/' . $cat->id . '/editar') }}"
                                                        data-togger="tooltip" data-placement="top" title="Editar">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                @endif

                                                @if (kvfj(Auth::user()->permisos, 'categoria_eliminar'))
                                                    <a href="{{ url('/admin/categoria/' . $cat->id . '/eliminar') }}"
                                                        data-togger="tooltip" data-placement="top" title="Eliminar">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
