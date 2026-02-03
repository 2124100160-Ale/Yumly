@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center">
    <h2>Listado de Usuarios</h2>
    <a href="{{ url('/usuarios/formulario') }}" class="btn btn-primary">Añadir Nuevo</a>
</div>

<table class="table table-hover table-bordered mt-3 shadow-sm">
    <thead class="table-success">
        <tr>
            <th>ID</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    @foreach($usuarios as $u)
<tr>
    <td>{{ $u->id }}</td>
    <td>{{ $u->nombres }} {{ $u->apellidos }}</td>
    <td>{{ $u->correo }}</td>
    <td>{{ $u->direccion }}</td>
</tr>
@endforeach
</tbody>
</table>
@endsection