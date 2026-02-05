@extends('layouts.plantilla')
@section('contenido')
<div class="card shadow-sm border-warning">
    <div class="card-header bg-warning text-dark">
        <h5><i class="fas fa-utensils"></i> Nueva Receta</h5>
    </div>
    <div class="card-body">
        {{-- ¡IMPORTANTE: Agregamos el enctype para las fotos! --}}
        <form action="{{ url('/recetas/guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf 

            <div class="mb-3">
                <label class="form-label">Nombre de la Receta</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Chilaquiles Verdes" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción / Pasos de preparación</label>
                <textarea name="descripcion" class="form-control" rows="4" placeholder="Describe cómo preparar el plato..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen de la Receta (Imagen Principal)</label>
                <input type="file" name="imagen" class="form-control" accept="image/*" required>
                <small class="text-muted">Formatos permitidos: JPG, PNG. Máximo 2MB.</small>
            </div>

            {{-- IDs fijos para la versión rápida del examen --}}
            <input type="hidden" name="usuario_id" value="1">
            <input type="hidden" name="tipo_plato_id" value="1">
            <input type="hidden" name="origen_id" value="1">
            <input type="hidden" name="dieta_id" value="1">
            
            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Receta
                </button>
                <a href="{{ url('/recetas/listado') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection