@extends('layouts.plantilla')
@section('contenido')
<div class="d-flex justify-content-between align-items-center">
    <h3>Listado de Administradores</h3>
    <a href="{{ url('/administradores/formulario') }}" class="btn btn-success">Nuevo Administrador</a>
</div>

@if(session('exito'))
    <div class="alert alert-success mt-2">{{ session('exito') }}</div>
@endif

<table class="table table-striped table-hover mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Imagen</th> {{-- Nueva columna --}}
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Estado</th>
            <th>Acciones</th> {{-- Nueva columna --}}
        </tr>
    </thead>
    <tbody>
    @foreach($administradores as $admin)
    <tr>
        <td>{{ $admin->id }}</td>
        <td>
            {{-- Mostramos la imagen circular --}}
            @if($admin->imagen)
                <img src="{{ asset('storage/' . $admin->imagen) }}" 
                     alt="Foto" 
                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
            @else
                <img src="{{ asset('img/default-admin.png') }}" 
                     style="width: 50px; border-radius: 50%;">
            @endif
        </td>
        <td>{{ $admin->nombres }} {{ $admin->apellidos }}</td>
        <td>{{ $admin->correo }}</td>
        <td>
            <span class="badge bg-primary">{{ $admin->rol }}</span>
        </td>
        <td>
            @if($admin->estado == 1)
                <span class="text-success">● Activo</span>
            @else
                <span class="text-danger">● Inactivo</span>
            @endif
        </td>
        <td>
    <div class="d-flex gap-2">
        {{-- Botón para ir a editar --}}
        <a href="{{ url('/administradores/editar/' . $admin->id) }}" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>

        {{-- BOTÓN PARA BORRAR --}}
        <form action="{{ route('administradores.destroy', $admin->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" 
                    onclick="return confirm('¿Estás seguro de que deseas eliminar a este administrador?')">
                <i class="fas fa-trash-alt"></i> Borrar
            </button>
        </form>
    </div>
</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection