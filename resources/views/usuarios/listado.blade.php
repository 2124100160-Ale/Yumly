@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-dark"><i class="fas fa-users"></i> Listado de Usuarios</h2>
    <a href="{{ url('/usuarios/formulario') }}" class="btn btn-primary shadow-sm" style="background-color: #ff6600; border: none;">
        <i class="fas fa-plus-circle"></i> Añadir Nuevo
    </a>
</div>
<div class="text-end mb-3">
    <span class="me-2 text-muted">Sesión iniciada como: {{ Auth::user()->nombres }}</span>
    <a href="{{ url('/logout') }}" class="btn btn-sm btn-outline-dark">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</div>

{{-- Alerta de éxito opcional --}}
@if(session('exito'))
    <div class="alert alert-success shadow-sm border-0"><i class="fas fa-check"></i> {{ session('exito') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead class="table-success text-dark">
                <tr>
                    <th class="ps-3">ID</th>
                    <th>Imagen</th> 
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $u)
                <tr>
                    <td class="ps-3 fw-bold text-muted">{{ $u->id }}</td>
                    <td>
    @if($u->google_id && $u->imagen)
        {{-- Si el usuario entró por Google, mostramos el link directo --}}
        <img src="{{ $u->imagen }}" 
             alt="Foto Google" 
             class="rounded-circle border"
             style="width: 45px; height: 45px; object-fit: cover;">
    @elseif($u->imagen)
        {{-- Si es un usuario normal con imagen subida al servidor --}}
        <img src="{{ asset('storage/' . $u->imagen) }}" 
             alt="Foto Local" 
             class="rounded-circle border"
             style="width: 45px; height: 45px; object-fit: cover;">
    @else
        {{-- Si no tiene foto --}}
        <div class="rounded-circle bg-light d-inline-flex align-items-center justify-content-center border" style="width: 45px; height: 45px;">
            <i class="fas fa-user-tag text-secondary"></i>
        </div>
    @endif
</td>
                    <td class="text-start">
                        <div class="fw-bold">{{ $u->nombres }} {{ $u->apellidos }}</div>
                    </td>
                    <td class="text-start">{{ $u->correo }}</td>
                    <td class="text-muted small">{{ $u->direccion ?? 'Sin dirección' }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            {{-- Botón Editar --}}
                            <a href="{{ url('/usuarios/editar/' . $u->id) }}" class="btn btn-outline-success btn-sm shadow-sm px-3">
                                <i class="fas fa-edit"></i> Editar
                            </a>

                            {{-- Botón Borrar --}}
                            <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm px-3" 
                                        onclick="return confirm('¿Eliminar permanentemente a {{ $u->nombres }}?')">
                                    <i class="fas fa-trash-alt"></i> Borrar
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