@extends('layouts.plantilla')

@section('contenido')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h3 class="mb-0">Editar Usuario: {{ $usuario->nombres }}</h3>
        </div>
        <div class="card-body">
            <form action="{{ url('/usuarios/actualizar/' . $usuario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nombres</label>
                        <input type="text" name="nombres" class="form-control" value="{{ $usuario->nombres }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" value="{{ $usuario->apellidos }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Correo Electrónico</label>
                    <input type="email" name="correo" class="form-control" value="{{ $usuario->correo }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Dirección</label>
                    <input type="text" name="direccion" class="form-control" value="{{ $usuario->direccion }}">
                </div>

                <div class="mb-3 p-3 border rounded bg-light">
                    <label class="form-label fw-bold">Imagen de Perfil</label><br>
                    <div class="d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/' . $usuario->imagen) }}" alt="Foto" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        <div>
                            <label class="form-label small text-muted">Subir nueva imagen (opcional)</label>
                            <input type="file" name="imagen" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Guardar Cambios</button>
                    <a href="{{ url('/usuarios/listado') }}" class="btn btn-secondary px-4">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection