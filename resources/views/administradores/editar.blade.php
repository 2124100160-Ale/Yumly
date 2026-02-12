@extends('layouts.plantilla')
@section('contenido')

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-warning text-dark">
            <h4 class="mb-0"><i class="fas fa-user-shield"></i> Editar Administrador: {{ $administrador->nombres }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ url('/administradores/actualizar/'.$administrador->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    {{-- Nombres --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nombres:</label>
                        <input type="text" name="nombres" class="form-control" value="{{ $administrador->nombres }}" required>
                    </div>

                    {{-- Apellidos --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Apellidos:</label>
                        <input type="text" name="apellidos" class="form-control" value="{{ $administrador->apellidos }}" required>
                    </div>
                </div>

                <div class="row">
                    {{-- Correo --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Correo Electrónico:</label>
                        <input type="email" name="correo" class="form-control" value="{{ $administrador->correo }}" required>
                    </div>

                    {{-- Usuario --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nombre de Usuario:</label>
                        <input type="text" name="usuario" class="form-control" value="{{ $administrador->usuario }}" required>
                    </div>
                </div>

                <div class="row align-items-center">
                    {{-- Rol --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Rol / Cargo:</label>
                        <select name="rol" class="form-select">
                            <option value="SuperAdmin" {{ $administrador->rol == 'SuperAdmin' ? 'selected' : '' }}>SuperAdmin</option>
                            <option value="Editor" {{ $administrador->rol == 'Editor' ? 'selected' : '' }}>Editor</option>
                            <option value="Moderador" {{ $administrador->rol == 'Moderador' ? 'selected' : '' }}>Moderador</option>
                        </select>
                    </div>

                    {{-- Imagen - Sección mejorada --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Foto de Perfil Actual:</label>
                        <div class="d-flex align-items-center gap-3 border p-2 rounded bg-light">
                            @if($administrador->imagen)
                                <img src="{{ asset('storage/'.$administrador->imagen) }}" 
                                     class="img-thumbnail rounded-circle" 
                                     width="80" height="80" 
                                     style="object-fit: cover; border: 2px solid #ffc107;">
                            @else
                                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 80px; height: 80px;">
                                    <i class="fas fa-user fa-2x"></i>
                                </div>
                            @endif
                            
                            <div class="flex-grow-1">
                                <label class="small text-muted d-block mb-1">Cargar nueva foto (opcional):</label>
                                <input type="file" name="imagen" class="form-control form-control-sm" accept="image/*">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-top pt-3 text-end">
                    <a href="{{ url('/administradores/listado') }}" class="btn btn-secondary px-4">Cancelar</a>
                    <button type="submit" class="btn btn-warning px-4 fw-bold">Actualizar Datos</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection