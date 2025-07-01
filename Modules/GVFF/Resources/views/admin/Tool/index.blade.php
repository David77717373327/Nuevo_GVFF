@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Herramientas</h2>

    <a href="{{ route('gvff.admin.tools.create') }}" class="btn btn-primary mb-3">Nueva Herramienta</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tools as $tool)
                    <tr>
                        <td>{{ $tool->name }}</td>
                        <td>{{ $tool->description }}</td>   
                        <td>{{ $tool->status }}</td>
                        <td>
                            <button class="btn btn-success btn-sm btn-check-availability" data-id="{{ $tool->id }}">Ver Disponibilidad</button>
                            <span id="availability-{{ $tool->id }}"></span>
                        </td>
                        <td>
                            <a href="{{ route('gvff.admin.tools.edit', $tool->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('gvff.admin.tools.destroy', $tool->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar herramienta?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    $('.btn-check-availability').on('click', function () {
        const id = $(this).data('id');
        $.ajax({
            url: `/gvff/admin/tools/check/${id}`,
            type: 'GET',
            success: function (res) {
                const msg = res.message;
                const color = res.available ? 'green' : 'red';
                $('#availability-' + id).html(`<strong style="color:${color}">${msg}</strong>`);
            },
            error: function () {
                alert('Error al consultar disponibilidad.');
            }
        });
    });
});
</script>
