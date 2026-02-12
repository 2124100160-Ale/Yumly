@extends('layouts.plantilla')
@section('contenido')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5><i class="fas fa-user-plus"></i> Registro de Administrador</h5>
    </div>
    <div class="card-body">
        {{-- MODIFICACIÓN: Agregamos enctype para permitir el envío de la foto --}}
        <form action="{{ url('/administradores/guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Nombres</label>
                    <input type="text" name="nombres" class="form-control" placeholder="Ej. Carlos" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" placeholder="Ej. Mendoza" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" placeholder="admin@yumly.com" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Usuario</label>
                    <input type="text" name="usuario" class="form-control" placeholder="carlos_admin" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Rol</label>
                    {{-- Cambiamos a form-select para mejor apariencia --}}
                    <select name="rol" class="form-select">
                        <option value="Superadmin">Superadmin</option>
                        <option value="Moderador">Moderador</option>
                        <option value="Editor">Editor</option>
                    </select>
                </div>
            </div>

            {{-- NUEVO: Campo de Imagen Obligatorio según la actividad --}}
            <div class="mb-4">
                <label class="form-label fw-bold">Foto de Perfil (Requerida)</label>
                <input type="file" name="imagen" class="form-control" accept="image/*" required>
                <div class="form-text">Debe ser una imagen clara del administrador.</div>
            </div>

            <input type="hidden" name="contraseña" value="admin123">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ url('/administradores/listado') }}" class="btn btn-secondary px-4">Cancelar</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save"></i> Registrar Administrador
                </button>
            </div>
        </form>
    </div>
</div>
@endsection