@extends('layouts.plantilla')

@section('contenido')
<div class="text-center py-5">
    <h1 class="display-4 fw-bold text-orange">¡Bienvenido a Yumly!</h1>
    <p class="lead">Planificador de Recetas Colaborativo</p>
    <hr class="my-4">
</div>

<div class="row text-center">
    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 h-100">
            <div class="card-body">
                <h3 class="card-title">Recetas</h3>
                <p class="card-text">Gestiona el catálogo de platillos y sus ingredientes.</p>
                <a href="{{ url('/recetas/listado') }}" class="btn btn-warning">Ir a Recetas</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 h-100">
            <div class="card-body">
                <h3 class="card-title">Usuarios</h3>
                <p class="card-text">Administra a los colaboradores de la comunidad.</p>
                <a href="{{ url('/usuarios/listado') }}" class="btn btn-success">Ir a Usuarios</a>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card shadow border-0 h-100">
            <div class="card-body">
                <h3 class="card-title">Administración</h3>
                <p class="card-text">Control de moderadores y roles del sistema.</p>
                <a href="{{ url('/administradores/listado') }}" class="btn btn-primary">Ir a Admin</a>
            </div>
        </div>
    </div>
</div>
@endsection