@extends('layouts.plantilla')

@section('contenido')
<h2 class="text-orange">Catálogo de Orígenes</h2>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>País / Región</th>
                </tr>
            </thead>
            <tbody>
                @foreach($origenes as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->nombre }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection