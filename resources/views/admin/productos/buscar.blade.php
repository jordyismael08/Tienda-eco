@extends('admin.master')
@section('title', 'Productos')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/productos') }}"><i class="fa-solid fa-box-open"></i> Productos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-box-open"></i> Productos</h2>
                <ul>
                    @if (kvfj(Auth::user()->permisos, 'producto_add'))
                        <li>
                            <a href="{{ url('/admin/producto/add') }}">
                                <i class="fa-solid fa-plus"></i> Agregar Producto
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#">Filtrar <i class="fa-solid fa-angles-down"></i></a>
                        <ul class="shadow">
                            <li><a href="{{ url('/admin/productos/1') }}"><i class="fa-solid fa-earth-americas"></i>
                                    Públicos</a></li>
                            <li><a href="{{ url('/admin/productos/0') }}"><i class="fas fa-eraser"></i> Borradores</a>
                            </li>
                            <li><a href="{{ url('/admin/productos/trash') }}"><i class="fa-solid fa-trash"></i>
                                    Papelera</a></li>
                            <li><a href="{{ url('/admin/productos/todos') }}"><i class="fa-solid fa-list-ul"></i>
                                    Todos</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" id="btn_buscar">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </a>
                    </li>
                </ul>
            </div>
            <div class="inside">
                <div class="form_search" id="form_search">
                    {!! Form::open(['url' => '/admin/producto/buscar']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::text('buscar', null, ['class' => 'form-control', 'placeholder' => 'Ingrese busqueda']) !!}
                        </div>

                        <div class="col-md-4">
                            {!! Form::select('filter', ['0' => 'Nombre del producto', '1' => 'Código'], 0, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2">
                            {!! Form::select('estado', ['0' => 'Borrador', '1' => 'Públicos'], 0, ['class' => 'form-control']) !!}
                        </div>

                        <div class="col-md-2">
                            {!! Form::submit('Buscar', ['class' => 'btn btn-success']) !!}
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>

                <table class="table table-striped table-hover">
                    <thead class="table-secondary ">
                        <tr>
                            <td><strong>#</strong></td>
                            <td><strong>Imagen</strong></td>
                            <td><strong>Nombre</strong></td>
                            <td><strong>Categoria</strong></td>
                            <td><strong>Precio</strong></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $p)
                            <tr>
                                <td width="50">{{ $p->id }}</td>
                                <td width="64">
                                    <a href="{{ url('/uploads/' . $p->archivo_ruta . '/' . $p->imagen) }}"
                                        data-fancybox="gallery">
                                        <img src="{{ url('/uploads/' . $p->archivo_ruta . '/t_' . $p->imagen) }}"
                                            width="64">
                                    </a>
                                </td>
                                <td>{{ $p->nombre }}@if ($p->estado == '0')
                                        <i class="fas fa-eraser" data-togger="tooltip" data-placement="top"
                                            title="Estado: Borrador"></i>
                                    @endif
                                </td>
                                <td>{{ $p->cat->nombre }}</td>
                                <td>{{ $p->precio }}</td>
                                <td>
                                    <div class="opts">

                                        @if (kvfj(Auth::user()->permisos, 'producto_editar'))
                                            <a href="{{ url('/admin/producto/' . $p->id . '/editar') }}"
                                                data-togger="tooltip" data-placement="top" title="Editar">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        @endif

                                        @if (kvfj(Auth::user()->permisos, 'producto_eliminar'))
                                            <a href="{{ url('/admin/producto/' . $p->id . '/eliminar') }}"
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
@endsection
