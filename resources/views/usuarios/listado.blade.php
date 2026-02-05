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
            <th>Imagen</th> <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Estado</th> 
        </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>
                <img src="{{ asset('storage/' . $u->imagen) }}" alt="Foto" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
            </td>
            <td class="text-start">{{ $u->nombres }} {{ $u->apellidos }}</td>
            <td class="text-start">{{ $u->correo }}</td>
            <td>{{ $u->direccion }}</td>
            <td>
                <a href="{{ url('/usuarios/editar/' . $u->id) }}" class="btn btn-success btn-sm w-100 fw-bold">
                    Editar
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection