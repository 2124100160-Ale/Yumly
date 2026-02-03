@extends('layouts.plantilla')
@section('contenido')
<h3>Listado de Administradores</h3>
@if(session('exito'))
    <div class="alert alert-success">{{ session('exito') }}</div>
@endif
<table class="table table-striped table-hover mt-3">
    <thead class="table-dark">
        <tr>
            <th>ID</th><th>Usuario</th><th>Correo</th><th>Rol</th><th>Estado</th>
        </tr>
    </thead>
    <<tbody>
    @foreach($administradores as $admin)
    <tr>
        <td>{{ $admin->id }}</td>
        {{-- Concatenamos nombres y apellidos --}}
        <td>{{ $admin->nombres }} {{ $admin->apellidos }}</td>
        <td>{{ $admin->correo }}</td>
        <td>
            <span class="badge bg-primary">{{ $admin->rol }}</span>
        </td>
        <td class="text-center">
            @if($admin->estado == 1)
                <span class="text-success">● Activo</span>
            @else
                <span class="text-danger">● Inactivo</span>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
</table>
@endsection