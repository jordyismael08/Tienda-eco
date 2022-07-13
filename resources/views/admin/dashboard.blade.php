@extends('admin.master')
@section('title','Dashboard')
@section('content')
<div class="container-fluid">
    @if(kvfj(Auth::user()->permisos,'dashboard-small-stats'))
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fa-solid fa-chart-line"></i> Estadísticas rápidas</h2>
        </div>
    </div>

    <div class="row mtop16">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-user-check"></i> Usuarios registrado</h2>
                </div>
                <div class="inside">
                    <div class="big_count">{{ $users }}</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-clipboard-list"></i> Listado de productos</h2>
                </div>
                <div class="inside">
                    <div class="big_count">{{ $productos }}</div>
                </div>
            </div>
        </div>

        @if(kvfj(Auth::user()->permisos,'dashboard-sell_today'))
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-cart-shopping"></i> Ordenes del dia</h2>
                </div>
                <div class="inside">
                    <div class="big_count">0</div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fa-solid fa-file-invoice-dollar"></i> Facturados del dia</h2>
                </div>
                <div class="inside">
                    <div class="big_count">0</div>
                </div>
            </div>
        </div>
        @endif

    </div>
    @endif
</div>
@endsection
