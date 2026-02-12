@extends('layouts.plantilla')
@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="text-primary"><i class="fas fa-user-shield"></i> Listado de Administradores</h3>
    <a href="{{ url('/administradores/formulario') }}" class="btn btn-success shadow-sm">
        <i class="fas fa-plus"></i> Nuevo Administrador
    </a>
</div>

@if(session('exito'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('exito') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="table-responsive shadow-sm rounded">
    <table class="table table-hover align-middle mb-0 bg-white">
        <thead class="table-dark">
            <tr>
                <th class="ps-3">ID</th>
                <th class="text-center">Imagen</th> {{-- Requisito de la actividad --}}
                <th>Nombre Completo</th>
                <th>Correo</th>
                <th>Rol</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($administradores as $admin)
        <tr>
            <td class="ps-3 fw-bold text-muted">{{ $admin->id }}</td>
            <td class="text-center">
                {{-- Imagen circular según la instrucción --}}
                @if($admin->imagen)
                    <img src="{{ asset('storage/' . $admin->imagen) }}" 
                         alt="Admin {{ $admin->id }}" 
                         class="rounded-circle border"
                         style="width: 45px; height: 45px; object-fit: cover;">
                @else
                    {{-- Imagen por defecto si no hay ruta --}}
                    <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center border" style="width: 45px; height: 45px;">
                        <i class="fas fa-user text-secondary"></i>
                    </div>
                @endif
            </td>
            <td>
                <div class="fw-bold">{{ $admin->nombres }} {{ $admin->apellidos }}</div>
                <small class="text-muted">{{ $admin->usuario }}</small>
            </td>
            <td>{{ $admin->correo }}</td>
            <td>
                <span class="badge rounded-pill bg-info text-dark">{{ $admin->rol }}</span>
            </td>
            <td class="text-center">
                @if($admin->estado == 1)
                    <span class="badge bg-success-soft text-success border border-success px-2">Activo</span>
                @else
                    <span class="badge bg-danger-soft text-danger border border-danger px-2">Inactivo</span>
                @endif
            </td>
            <td class="text-center">
    <div class="d-flex justify-content-center gap-2">
        <a href="{{ url('/administradores/editar/' . $admin->id) }}" class="btn btn-sm btn-warning shadow-sm px-3">
            <i class="fas fa-edit"></i> <span class="d-none d-md-inline">Editar</span>
        </a>

        <form action="{{ url('/administradores/borrar/'.$admin->id) }}" method="POST" class="d-inline">
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
@endsection