@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-orange"><i class="fas fa-book-open"></i> Catálogo de Recetas</h2>
    <a href="{{ url('/recetas/formulario') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> Sugerir Nueva Receta
    </a>
</div>

@if(session('mensaje'))
    <div class="alert alert-success shadow-sm border-0"><i class="fas fa-check-circle"></i> {{ session('mensaje') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Imágenes (3)</th> {{-- Requisito de fotos --}}
                    <th>Receta / Chef</th>
                    <th>Origen / Dieta</th> {{-- Nombres de relaciones --}}
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($recetas as $r)
                <tr>
                    <td class="ps-3 text-muted fw-bold">{{ $r->id }}</td>
                    <td>
                        {{-- Grupo de 3 miniaturas --}}
                        <div class="d-flex gap-1">
                            <img src="{{ asset('storage/' . $r->imagen_uno) }}" class="rounded shadow-sm" style="width: 45px; height: 35px; object-fit: cover;" title="Foto 1">
                            <img src="{{ asset('storage/' . $r->imagen_dos) }}" class="rounded shadow-sm" style="width: 45px; height: 35px; object-fit: cover;" title="Foto 2">
                            <img src="{{ asset('storage/' . $r->imagen_tres) }}" class="rounded shadow-sm" style="width: 45px; height: 35px; object-fit: cover;" title="Foto 3">
                        </div>
                    </td>
                    <td>
                        <strong>{{ $r->nombre }}</strong><br>
                        <small class="text-primary"><i class="fas fa-user-edit"></i> {{ $r->usuario->nombres ?? 'Sin autor' }}</small>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border"><i class="fas fa-globe-americas"></i> {{ $r->origen->nombre ?? 'N/A' }}</span><br>
                        <small class="text-muted"><i class="fas fa-leaf"></i> {{ $r->dieta->nombre ?? 'N/A' }}</small>
                    </td>
                    <td>
                        @if($r->estado == 1)
                            <span class="badge bg-success-soft text-success border border-success">Activa</span>
                        @else
                            <span class="badge bg-secondary-soft text-secondary border">Pendiente</span>
                        @endif
                    </td>
                    <td class="text-center">
    <div class="d-flex justify-content-center gap-2">
        <a href="{{ url('/recetas/editar/' . $r->id) }}" class="btn btn-sm btn-warning shadow-sm px-3">
            <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Editar</span>
        </a>

        <form action="{{ url('/recetas/borrar/'.$r->id) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger shadow-sm px-3" onclick="return confirm('¿Seguro que deseas borrar?')">
                <i class="fas fa-trash"></i> <span class="d-none d-md-inline">Borrar</span>
            </button>
        </form>
    </div>
</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection