@extends('admin.master')
@section('title','Usuarios')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/usuarios/todos') }}"><i class="fa-solid fa-users"></i> Usuarios</a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-users"></i> Usuarios</h2>
        </div>
        <div class="inside">
            <div class="row-col-md-2 offset-md-10">
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 100%;">
                    <i class="fas fa-filter"></i> Filtrar
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ '/admin/usuarios/todos' }}"><i class="fa-solid fa-list"></i> Todos</a>
                        <a class="dropdown-item" href="{{ '/admin/usuarios/0' }}"><i class="fa-solid fa-ban"></i> No verificado</a>
                        <a class="dropdown-item" href="{{ '/admin/usuarios/1' }}"><i class="fa-solid fa-user-check"></i> Verificados</a>
                        <a class="dropdown-item" href="{{ '/admin/usuarios/100' }}"><i class="fa-solid fa-user-slash"></i> Suspendido</a>
                    </div>
                </div>
            </div>

            <table class="table table-hover mtop16">
                <thead class="table-secondary ">
                    <tr>
                        <td><strong>#</strong></td>
                        <td><strong>Nombre</strong></td>
                        <td><strong>Apellido</strong></td>
                        <td><strong>Correo</strong></td>
                        <td><strong>Role</strong></td>
                        <td><strong>Estado</strong></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ getRoleUserArray(null, $user->role) }}</td>
                        <td>{{ getUserStatusArray(null, $user->estado) }}</td>
                        <td>
                            <div class="opts">
                                @if(kvfj(Auth::user()->permisos,'user_edit'))
                                <a href="{{ url('/admin/usuario/'.$user->id.'/editar') }}"
                                    data-togger="tooltip" data-placement="top" title="Editar">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                @endif

                                @if(kvfj(Auth::user()->permisos,'user_permisos'))
                                <a href="{{ url('/admin/usuario/'.$user->id.'/permisos') }}"
                                    data-togger="tooltip" data-placement="top" title="Permisos de usuario">
                                    <i class="fa-solid fa-gears"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">{!! $users -> render() !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
