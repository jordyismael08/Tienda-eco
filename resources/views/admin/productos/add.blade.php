@extends('admin.master')
@section('title', 'Agregar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/productos/todos') }}"><i class="fa-solid fa-box-open"></i> Productos</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/producto/add') }}"><i class="fa-solid fa-plus"></i> Agregar Producto</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fa-solid fa-plus"></i> Agregar Producto</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/producto/add', 'files' => true]) !!}
                <div class="row">

                    <div class="col-md-6">
                        <label for="nombre">Nombre del producto:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>
                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="categoria">Categoría:</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-box-open"></i></span>
                            {!! Form::select('categoria', $cats, 0, ['class' => 'form-select']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
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
                            <span class="input-group-text" id="basic-addon1">
                                <i class="fa-solid fa-money-bill-1"></i></span>
                            {!! Form::number('precio', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="endescuento">En Descuento:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-tag"></i></span>
                            {!! Form::select('endescuento', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'form-select']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="descuento">Descuento:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-percent"></i></span>
                            {!! Form::number('descuento', 0.0, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                        </div>
                    </div>

                </div>

                <div class="row mtop16">
                    <div class="col-md-3">
                        <label for="inventario">Inventarío:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="fa-solid fa-cart-flatbed"></i></span>
                            {!! Form::number('inventario', 0, ['class' => 'form-control', 'mini' => '0.00']) !!}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="codigo">Codígo de sistema:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-barcode"></i></span>
                            {!! Form::text('codigo', 0, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        <label for="contenido">Descripción</label>
                        {!! Form::textarea('contenido', null, ['class' => 'form-control', 'id' => 'editor']) !!}
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                    </div>

                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
