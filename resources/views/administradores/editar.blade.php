@extends('layouts.plantilla')
@section('contenido')

<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <h4>Editar Administrador: {{ $administrador->nombres }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/administradores/actualizar/'.$administrador->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                {{-- Importante: Aunque Laravel usa POST en la ruta, 
                     algunos prefieren poner @method('PUT') si la ruta fuera PUT --}}

                <div class="row">
                    {{-- Nombres --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombres:</label>
                        <input type="text" name="nombres" class="form-control" value="{{ $administrador->nombres }}" required>
                    </div>

                    {{-- Apellidos --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control" value="{{ $administrador->apellidos }}" required>
                    </div>
                </div>

                <div class="row">
                    {{-- Correo --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Correo Electrónico:</label>
                        <input type="email" name="correo" class="form-control" value="{{ $administrador->correo }}" required>
                    </div>

                    {{-- Usuario --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nombre de Usuario:</label>
                        <input type="text" name="usuario" class="form-control" value="{{ $administrador->usuario }}" required>
                    </div>
                </div>

                <div class="row">
                    {{-- Rol --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Rol / Cargo:</label>
                        <select name="rol" class="form-select">
                            <option value="SuperAdmin" {{ $administrador->rol == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
                            <option value="Editor" {{ $administrador->rol == 'Editor' ? 'selected' : '' }}>Editor</option>
                            <option value="Moderador" {{ $administrador->rol == 'Moderador' ? 'selected' : '' }}>Moderador</option>
                        </select>
                    </div>

                    {{-- Imagen --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Foto de Perfil:</label>
                        <div class="mb-2">
                            @if($administrador->imagen)
                                <img src="{{ asset('storage/'.$administrador->imagen) }}" class="rounded-circle" width="80" height="80" style="object-fit: cover;">
                                <small class="text-muted d-block">Imagen actual</small>
                            @endif
                        </div>
                        <input type="file" name="imagen" class="form-control">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Actualizar Datos</button>
                    <a href="{{ url('/administradores/listado') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection