@extends('layouts.plantilla')
@section('contenido')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white"><h5>Registro de Administrador</h5></div>
    <div class="card-body">
        <form action="{{ url('/administradores/guardar') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control" required>
        </div>
    </div>
    <div class="mb-3">
        <label>Correo Electrónico</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>Usuario</label>
            <input type="text" name="usuario" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>Rol</label>
            <select name="rol" class="form-control">
                <option value="Superadmin">Superadmin</option>
                <option value="Moderador">Moderador</option>
            </select>
        </div>
    </div>
    <input type="hidden" name="contraseña" value="admin123"> {{-- Contraseña temporal --}}
    <button type="submit" class="btn btn-primary">Registrar Administrador</button>
</form>
    </div>
</div>
@endsection