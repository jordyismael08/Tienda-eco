@extends('admin.master')
@section('title', 'Editar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/productos/todos') }}"><i class="fa-solid fa-box-open"></i> Productos</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar Producto</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url' => '/admin/producto/' . $p->id . '/editar', 'files' => true]) !!}

                        <div class="row">
                            <div class="col-md-6">
                                <label for="nombre">Nombre del producto:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i>
                                    </span>
                                    {!! Form::text('nombre', $p->nombre, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="categoria">Categoría:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-box-open"></i>
                                    </span>
                                    {!! Form::select('categoria', $cats, $p->categoria_id, ['class' => 'form-select']) !!}
                                </div>
                            </div>
                            <div class="col-md-3 ">
                                <label for="imagen">Imagen Destacada:</label>
                                <div class="input-group">
                                    {!! Form::file('imagen', ['class' => 'input-group-text', 'id' => 'inputGroupFile01', 'accept' => 'image/*']) !!}
                                </div>

                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-3">
                                <label for="precio">Precio:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-money-bill-1"></i>
                                    </span>
                                    {!! Form::number('precio', $p->precio, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="endescuento">En Descuento:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i>
                                    </span>
                                    {!! Form::select('endescuento', ['0' => 'No', '1' => 'Si'], $p->endescuento, ['class' => 'form-select']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="descuento">Descuento:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-percent"></i></span>
                                    {!! Form::number('descuento', $p->descuento, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="estado">Estado:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i>
                                    </span>
                                    {!! Form::select('estado', ['0' => 'Borrador', '1' => 'Publico'], $p->estado, ['class' => 'form-select']) !!}
                                </div>
                            </div>
                        </div>
                        <div class="row mtop16">
                            <div class="col-md-3">
                                <label for="inventario">Inventario:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="fa-solid fa-cart-flatbed"></i>
                                    </span>

                                    {!! Form::number('inventario', $p->inventario, ['class' => 'form-control', 'mini' => '0.00']) !!}
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="codigo">Codígo de sistema:</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-barcode"></i>
                                    </span>
                                    {!! Form::text('codigo', $p->codigo, ['class' => 'form-control']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                <label for="contenido">Descripción</label>
                                {!! Form::textarea('contenido', $p->contenido, ['class' => 'form-control', 'id' => 'editor']) !!}
                            </div>
                        </div>

                        <div class="row mtop16">
                            <div class="col-md-12">
                                {!! Form::submit('Actualizar', ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-image"></i> Imagen Destacada</h2>
                        <div class="inside">
                            <img src="{{ url('/uploads/' . $p->archivo_ruta . '/' . $p->imagen) }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="panel shadow mtop16">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Galeria</h2>
                    </div>
                    <div class="inside producto_galeria">

                        @if (kvfj(Auth::user()->permisos, 'producto_galeria_add'))
                            {!! Form::open([
                                'url' => '/admin/producto/' . $p->id . '/galeria/add',
                                'files' => true,
                                'id' => 'form_producto_galeria',
                            ]) !!}
                            {!! form::file('file_imagen', [
                                'id' => 'producto_file_imagen',
                                'accept' => 'image/*',
                                'style' => 'display: none;',
                                'required',
                            ]) !!}
                            {{-- {!! form::file('file_imagen', ['id'=> 'producto_file_imagen','accept' => 'imagen/*']) !!} --}}
                            {!! Form::close() !!}

                            <div class="btn-submit">
                                <a href="#" id="btn_producto_file_imagen"><i class="fa-solid fa-plus"></i></a>
                            </div>
                        @endif

                        <div class="tumbs">
                            @foreach ($p->getGallery as $imagen)
                                <div class="tumb">
                                    @if (kvfj(Auth::user()->permisos, 'producto_galeria_eliminar'))
                                        <a href="{{ url('/admin/producto/' . $p->id . '/galeria/' . $imagen->id . '/eliminar') }}"
                                            data-togger="tooltip" data-placement="top" title="Eliminar">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                    @endif
                                    <img
                                        src="{{ url('/uploads/' . $imagen->archivo_ruta . '/t_' . $imagen->nombre_archivo) }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
