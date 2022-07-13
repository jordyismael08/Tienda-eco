<div class="sidebar shadow">
    <div class="section-top">
        <div class="logo">
            <img src="{{ url('/static/imagen/logo.png') }}" class="img-fluid">
        </div>
        <div class="user">
            <span class="subtitle">Hola:{{ Auth::user()->name }} </span>
            <div class="name">
                {{ Auth::user()->email }}
                <a href="{{ url('logout') }}" data-togger="tooltip" data-placement="top" title="Salir">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>

            </div>
        </div>
    </div>

    <div class="main">
        <ul>
            @if(kvfj(Auth::user()->permisos,'dashboard'))
            <li>
                <a href="{{ url('/admin') }}" class="lk-dashboard"><i class="fa-solid fa-house"></i> Dashboard</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permisos,'user_list'))
            <li>
                <a href="{{ url('/admin/usuarios/todos') }}" class="lk-user_list lk-user_edit lk-user_permisos"> <i class="fa-solid fa-users"></i> Usuarios</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permisos,'categorias'))
            <li>
                <a href="{{ url('/admin/categorias/0') }}" class="lk-categorias lk-categoria_add
                lk-categoria_editar lk-categoria_eliminar"> <i class="fa-solid fa-folder-open"></i> Categorias</a>
            </li>
            @endif

            @if(kvfj(Auth::user()->permisos,'productos'))
            <li>
                <a href="{{ url('/admin/productos/1') }}" class="lk-productos lk-producto_add lk-buscar_producto lk-producto_editar
                lk-producto_galeria_add"><i class="fa-solid fa-box-open"></i> Productos</a>
            </li>
            @endif

        </ul>
    </div>

</div>
