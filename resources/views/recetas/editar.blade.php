@extends('layouts.plantilla')

@section('contenido')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4>Editar Receta: {{ $receta->nombre }}</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('/recetas/actualizar/'.$receta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Nombre de la Receta</label>
                <input type="text" name="nombre" class="form-control" value="{{ $receta->nombre }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Descripción / Pasos</label>
                <textarea name="descripcion" class="form-control" rows="4">{{ $receta->descripcion }}</textarea>
            </div>

            {{-- SECCIÓN DE LAS 3 IMÁGENES --}}
            <div class="row border p-3 mb-4 rounded bg-light">
                <label class="form-label fw-bold w-100">Galería de Imágenes (3 fotos requeridas)</label>
                
                @for ($i = 1; $i <= 3; $i++)
                    @php 
                        $col = ($i == 1) ? 'imagen_uno' : (($i == 2) ? 'imagen_dos' : 'imagen_tres');
                        $inputName = 'imagen' . $i;
                    @endphp
                    <div class="col-md-4 text-center">
                        <label class="small text-muted">Imagen {{ $i }}</label>
                        <div class="mb-2">
                            @if($receta->$col)
                                <img src="{{ asset('storage/'.$receta->$col) }}" class="img-thumbnail" style="height: 120px; width: 100%; object-fit: cover;">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center" style="height: 120px;">Sin foto</div>
                            @endif
                        </div>
                        {{-- Sin 'required' por ser edición --}}
                        <input type="file" name="{{ $inputName }}" class="form-control form-control-sm" accept="image/*">
                    </div>
                @endfor
            </div>

            {{-- SECCIÓN DE SELECTS (RELACIONES FORÁNEAS) --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tipo de Plato</label>
                    <select name="tipo_plato_id" class="form-select" required>
                        @foreach($tiposPlato as $tipo)
                            <option value="{{ $tipo->id }}" {{ $receta->tipo_plato_id == $tipo->id ? 'selected' : '' }}>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Origen</label>
                    <select name="origen_id" class="form-select" required>
                        @foreach($origenes as $origen)
                            <option value="{{ $origen->id }}" {{ $receta->origen_id == $origen->id ? 'selected' : '' }}>
                                {{ $origen->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Tipo de Dieta</label>
                    <select name="dieta_id" class="form-select" required>
                        @foreach($dietas as $dieta)
                            <option value="{{ $dieta->id }}" {{ $receta->dieta_id == $dieta->id ? 'selected' : '' }}>
                                {{ $dieta->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Chef / Colaborador</label>
                    <select name="usuario_id" class="form-select" required>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ $receta->usuario_id == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->nombres }} {{ $usuario->apellidos }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-4 text-end">
                <a href="{{ url('/recetas/listado') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success px-5">Actualizar Receta</button>
            </div>
        </form>
    </div>
</div>
@endsection