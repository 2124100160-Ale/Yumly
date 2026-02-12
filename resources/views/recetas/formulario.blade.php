@extends('layouts.plantilla')

@section('contenido')
<div class="card shadow-sm border-warning">
    <div class="card-header bg-warning text-dark">
        <h5><i class="fas fa-utensils"></i> Nueva Receta (Registro Completo)</h5>
    </div>
    <div class="card-body">
        <form action="{{ url('/recetas/guardar') }}" method="POST" enctype="multipart/form-data">
            @csrf 

            <div class="mb-3">
                <label class="form-label fw-bold">Nombre de la Receta</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej: Chilaquiles Verdes" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descripción / Pasos de preparación</label>
                <textarea name="descripcion" class="form-control" rows="3" placeholder="Describe cómo preparar el plato..." required></textarea>
            </div>

            {{-- SECCIÓN DE LAS 3 IMÁGENES REQUERIDAS --}}
            <div class="row border p-3 mb-4 rounded bg-light text-center">
                <p class="fw-bold w-100 text-start"><i class="fas fa-camera"></i> Galería de Imágenes (Las 3 son obligatorias)</p>
                
                <div class="col-md-4 mb-3">
                    <label class="small fw-bold">Imagen Principal (1)</label>
                    <input type="file" name="imagen1" class="form-control form-control-sm" accept="image/*" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="small fw-bold">Imagen Secundaria (2)</label>
                    <input type="file" name="imagen2" class="form-control form-control-sm" accept="image/*" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="small fw-bold">Imagen Detalle (3)</label>
                    <input type="file" name="imagen3" class="form-control form-control-sm" accept="image/*" required>
                </div>
            </div>

            {{-- RELACIONES FORÁNEAS MEDIANTE SELECTS --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Chef / Colaborador</label>
                    <select name="usuario_id" class="form-select" required>
                        <option value="" selected disabled>Selecciona al autor...</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->nombres }} {{ $usuario->apellidos }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Origen del Plato</label>
                    <select name="origen_id" class="form-select" required>
                        <option value="" selected disabled>Selecciona el origen...</option>
                        @foreach($origenes as $origen)
                            <option value="{{ $origen->id }}">{{ $origen->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tipo de Plato</label>
                    <select name="tipo_plato_id" class="form-select" required>
                        <option value="" selected disabled>Ej: Postre, Entrada...</option>
                        @foreach($tiposPlato as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tipo de Dieta</label>
                    <select name="dieta_id" class="form-select" required>
                        <option value="" selected disabled>Ej: Vegana, Keto...</option>
                        @foreach($dietas as $dieta)
                            <option value="{{ $dieta->id }}">{{ $dieta->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mt-4 border-top pt-3 text-end">
                <a href="{{ url('/recetas/listado') }}" class="btn btn-secondary px-4">Cancelar</a>
                <button type="submit" class="btn btn-success px-4">
                    <i class="fas fa-save"></i> Guardar Receta Completa
                </button>
            </div>
        </form>
    </div>
</div>
@endsection