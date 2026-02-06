@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Usuarios</h2>
    <a href="{{ url('/usuarios/formulario') }}" class="btn btn-primary" style="background-color: #ff6600; border: none;">Añadir Nuevo</a>
</div>

<table class="table table-hover table-bordered shadow-sm text-center">
    <thead class="table-success">
        <tr>
            <th>ID</th>
            <th>Imagen</th> 
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Acciones</th> {{-- Cambiamos Estado por Acciones --}}
        </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>
                @if($u->imagen)
                    <img src="{{ asset('storage/' . $u->imagen) }}" alt="Foto" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                @else
                    <img src="{{ asset('img/default-user.png') }}" style="width: 50px; border-radius: 50%;">
                @endif
            </td>
            <td class="text-start">{{ $u->nombres }} {{ $u->apellidos }}</td>
            <td class="text-start">{{ $u->correo }}</td>
            <td>{{ $u->direccion }}</td>
            <td>
                <div class="d-flex gap-1">
                    {{-- Botón Editar --}}
                    <a href="{{ url('/usuarios/editar/' . $u->id) }}" class="btn btn-success btn-sm fw-bold flex-fill">
                        Editar
                    </a>

                    {{-- Botón Borrar --}}
                    <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" class="flex-fill">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm fw-bold w-100" 
                                onclick="return confirm('¿Eliminar a este usuario?')">
                            Borrar
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection