@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-orange">Catálogo de Recetas</h2>
    <a href="{{ url('/recetas/formulario') }}" class="btn btn-primary">
        + Sugerir Nueva Receta
    </a>
</div>

@if(session('mensaje'))
    <div class="alert alert-success">{{ session('mensaje') }}</div>
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
            <tbody>
            @foreach($recetas as $r)
                <tr>
                    <td>{{ $r->id }}</td>
                    <td>
                        {{-- Mostramos solo la imagen_uno --}}
                        @if($r->imagen_uno)
                            <img src="{{ asset('storage/' . $r->imagen_uno) }}" 
                                 alt="Receta" 
                                 style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px;">
                        @else
                            <img src="{{ asset('img/no-recipe.png') }}" 
                                 style="width: 80px; border-radius: 8px;">
                        @endif
                    </td>
                    <td>
                        <strong>{{ $r->nombre }}</strong><br>
                        <small class="text-muted">{{ Str::limit($r->descripcion, 50) }}</small>
                    </td>
                    <td>
                        @if($r->estado == 1)
                            <span class="badge bg-success">Activa</span>
                        @else
                            <span class="badge bg-secondary">Pendiente</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{-- Botón de Editar que lleva a tu nueva función --}}
                        <a href="{{ url('/recetas/editar/' . $r->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        
                        {{-- Botón de Borrar (si lo necesitas) --}}
                        <form action="{{ url('/recetas/borrar/'.$r->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar receta?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection