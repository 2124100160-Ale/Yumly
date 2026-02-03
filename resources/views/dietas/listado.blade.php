<tbody>
    @foreach($dietas as $d)
    <tr>
        <td>{{ $d->id }}</td>
        <td>{{ $d->nombre }}</td>
        <td>
            <button class="btn btn-sm btn-danger">Eliminar</button>
        </td>
    </tr>
    @endforeach
</tbody>