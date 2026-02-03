@extends('layouts.plantilla')

@section('contenido')
<div class="card shadow">
    <div class="card-header bg-success text-white">
        <h4>Registro de Nuevo Usuario (Colaborador)</h4>
    </div>
    
    <div class="card-body">
        {{-- CAMBIO 1: Agregamos action y method --}}
        <form action="{{ url('/usuarios/guardar') }}" method="POST">
            @csrf {{-- CAMBIO 2: Token de seguridad obligatorio --}}
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nombres</label>
                    {{-- CAMBIO 3: Agregamos name="nombres" --}}
                    <input type="text" name="nombres" class="form-control" placeholder="Ej. Juan" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Apellidos</label>
                    {{-- CAMBIO 4: Agregamos name="apellidos" --}}
                    <input type="text" name="apellidos" class="form-control" placeholder="Ej. Pérez" required>
                </div>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                {{-- CAMBIO 5: Agregamos name="correo" --}}
                <input type="email" name="correo" class="form-control" placeholder="juan@correo.com" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Dirección</label>
                {{-- CAMBIO 6: Agregamos name="direccion" --}}
                <textarea name="direccion" class="form-control" rows="2"></textarea>
            </div>

            {{-- CAMBIO 7: Input oculto para la contraseña (ya que su DB la pide) --}}
            <input type="hidden" name="contraseña" value="user123">

            <button type="submit" class="btn btn-success">Registrar Usuario</button>
        </form>
    </div>
</div>
@endsection