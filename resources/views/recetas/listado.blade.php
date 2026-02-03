@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-orange">Catálogo de Recetas</h2>
    <a href="{{ url('/recetas/formulario') }}" class="btn btn-primary">
        + Sugerir Nueva Receta
    </a>
</div>
@if(session('exito'))
    <div class="alert alert-success">{{ session('exito') }}</div>
@endif
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Receta</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            @foreach($recetas as $r)
<tr>
    <td>{{ $r->id }}</td>
    <td><strong>{{ $r->nombre }}</strong></td>
    <td>{{ $r->descripcion }}</td>
    {{-- Estas son llaves foráneas (IDs), por ahora las mostramos así --}}
    <td>ID Origen: {{ $r->origen_id }}</td> 
</tr>
@endforeach
        </table>
    </div>
</div>
@endsection