@extends('layouts.plantilla')
@section('contenido')
<div class="card">
    <div class="card-header bg-success text-white">
        <h4>Editar Receta: {{ $receta->nombre }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('/recetas/actualizar/'.$receta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nombre de la Receta</label>
                <input type="text" name="nombre" class="form-control" value="{{ $receta->nombre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción / Pasos</label>
                <textarea name="descripcion" class="form-control" rows="4">{{ $receta->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Imagen Actual</label>
                <div>
                    @if($receta->imagen_uno)
                        <img src="{{ asset('storage/'.$receta->imagen_uno) }}" width="200" class="img-thumbnail mb-2">
                    @else
                        <p class="text-muted">No tiene imagen registrada.</p>
                    @endif
                </div>
                <input type="file" name="imagen" class="form-control">
            </div>

            {{-- Aquí irían tus selects para Tipo de Plato, Dieta, etc. --}}

            <button type="submit" class="btn btn-success">Actualizar Receta</button>
            <a href="{{ url('/recetas/listado') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
</div>
@endsection