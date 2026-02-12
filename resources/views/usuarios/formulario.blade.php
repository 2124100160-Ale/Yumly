@extends('layouts.plantilla')

@section('contenido')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4>Registro de Nuevo Usuario (Colaborador)</h4>
    </div>
    
    <div class="card-body">
        {{-- MODIFICACIÓN: Agregamos enctype="multipart/form-data" para permitir archivos --}}
        <form action="{{ url('/usuarios/guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombres</label>
                    <input type="text" name="nombres" class="form-control" placeholder="Ej. Juan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" placeholder="Ej. Pérez" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="correo" class="form-control" placeholder="juan@correo.com" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <textarea name="direccion" class="form-control" rows="2"></textarea>
            </div>

            {{-- NUEVO: Campo para la imagen de perfil --}}
            <div class="mb-3">
                <label class="form-label">Foto de Perfil (Obligatoria)</label>
                {{-- Según la regla: tipo file y required en creación --}}
                <input type="file" name="imagen" class="form-control" accept="image/*" required>
                <small class="text-muted">Formatos permitidos: JPG, JPEG, PNG.</small>
            </div>

            {{-- Input oculto para la contraseña --}}
            <input type="hidden" name="contraseña" value="user123">

            <div class="d-grid">
                <button type="submit" class="btn btn-success">Registrar Usuario</button>
            </div>
        </form>
    </div>
</div>
@endsection