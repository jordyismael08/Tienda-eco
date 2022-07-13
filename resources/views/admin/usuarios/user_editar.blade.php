@extends('admin.master')
@section('title', 'Editar Usuario')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/usuarios/todos') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-user-large"></i> Información de Usuario</h2>
                        </div>
                        <div class="inside">
                            <div class="mini_profile">
                                @if (is_null($u->avatar))
                                    <img src="{{ url('/static/imagen/default-avatar.png') }}" class="avatar">
                                    @else
                                    <img src="{{ url('/uploads/usuario/'.$u->id.'/'.$usuario->avatar) }}" class="avatar">
                                @endif
                                <div class="info">
                                    <span class="title"><i class="fa-solid fa-address-card"></i> Nombre:</span>
                                    <span class="text">{{ $u->name }} {{ $u->lastname }}</span>
                                    <span class="title"><i class="fa-solid fa-user-clock"></i> Estado del Usuario:</span>
                                    <span class="text">{{ getUserStatusArray(null, $u->estado) }}</span>
                                    <span class="title"><i class="fa-solid fa-envelope-open-text"></i> Correo Electrónico:</span>
                                    <span class="text">{{ $u->email }}</span>
                                    <span class="title"><i class="fa-solid fa-calendar-check"></i> Fecha de registro:</span>
                                    <span class="text">{{ $u->created_at }}</span>
                                    <span class="title"><i class="fa-solid fa-user-shield"></i> Rol del Usuario:</span>
                                    <span class="text">{{ getRoleUserArray(null, $u->role) }}</span>

                                </div>
                                @if(kvfj(Auth::user()->permisos,'user_banned'))
                                    @if($u->estado == "100" )
                                    <a href="{{ url('/admin/usuario/'.$u->id.'/banned') }}" class="btn btn-success">Habilitar Usuario</a>
                                    @else
                                    <a href="{{ url('/admin/usuario/'.$u->id.'/banned') }}" class="btn btn-danger">Desabilitar Usuario</a>
                                    @endif
                                @endif
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fa-solid fa-user-pen"></i> Editar Información</h2>
                        </div>

                        <div class="inside">
                            @if(kvfj(Auth::user()->permisos,'user_edit'))
                            {!! Form::open(['url'=>'/admin/usuario/'.$u->id.'/editar']) !!}
                            <div class="row">

                                <div class="col-md-6">
                                    <label for="modulo">Tipo de usuario:</label>
                                    <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-box-open"></i></span>
                                        {!! Form::select('user_type', getRoleUserArray('list',null), $u->role,['class'=> 'form-select']) !!}
                                    </div>
                                </div>

                            </div>

                            <div class="row mtop16">
                                <div class="col-md-12">
                                    {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}

                                </div>
                            </div>
                            {!! Form::close() !!}
                            @endif

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
