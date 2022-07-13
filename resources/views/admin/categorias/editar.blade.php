@extends('admin.master')
@section('title', 'Categorias')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categorias/{modulo}') }}"><i class="fa-solid fa-folder-open"></i> Categorias</a>
    </li>
@endsection



@section('content')
    <div class="container-fluid ">
        <div class="row ">
            <div class="col-md-3 ">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fa-solid fa-pen-to-square"></i> Editar Categoria</h2>
                    </div>

                    <div class="inside">
                        {!! Form::open(['url'=> '/admin/categoria/'.$cat->id.'/editar']) !!}
                        <label for="nombre">Nombre:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-keyboard"></i></span>

                            {!! Form::text('nombre', $cat->nombre, ['class'=>'form-control']) !!}
                        </div>

                        <label for="modulo" class="mtop16">Módulo:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-box-open"></i></span>
                            {!! Form::select('modulo', getModulesArray(), $cat->modulo,['class'=> 'form-select']) !!}
                        </div>

                        <label for="icono" class="mtop16">Ícono:</label>
                        <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-hurricane"></i></span>
                            {!! Form::text('icono', $cat->icono, ['class'=>'form-control']) !!}
                        </div>
                        {!! Form::submit('Actualizar',['class' => 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
