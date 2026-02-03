@extends('layouts.plantilla')
@section('contenido')
<div class="card shadow-sm border-warning">
    <div class="card-header bg-warning text-dark"><h5>Nueva Receta</h5></div>
    <div class="card-body">
        <form action="{{ url('/recetas/guardar') }}" method="POST">
    @csrf {{-- ¡Sin esto Laravel te dará error 419! --}}
    <div class="mb-3">
        <label>Nombre de la Receta</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" required></textarea>
    </div>
    {{-- Por ahora usaremos IDs fijos para no complicarnos con los select --}}
    <input type="hidden" name="usuario_id" value="1">
    <input type="hidden" name="tipo_plato_id" value="1">
    <input type="hidden" name="origen_id" value="1">
    <input type="hidden" name="dieta_id" value="1">
    
    <button type="submit" class="btn btn-success">Guardar Receta</button>
</form>
    </div>
</div>
@endsection