@extends('gvff::layouts.master')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

@section('content')
<div class="container">
    <h2 class="mb-4 text-success">Listado de Herramientas</h2>

    <a href="{{ route('gvff.admin.Tool.create') }}" class="btn btn-success mb-4">
        <i class="bi bi-plus-circle"></i> Nueva Herramienta
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-success">
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Disponibilidad</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tools as $tool)
                    <tr>
                        <td>{{ $tool->name }}</td>
                        <td>{{ $tool->description }}</td>
                        <td>
                            @if($tool->status == 'activo')
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-outline-success btn-sm btn-check-availability" data-id="{{ $tool->id }}">
                                <i class="bi bi-search"></i> Ver
                            </button>
                            <span id="availability-{{ $tool->id }}" class="ms-2"></span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('gvff.admin.Tool.show', $tool->id) }}" class="btn btn-info btn-sm me-1">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('gvff.admin.Tool.edit', $tool->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('gvff.admin.Tool.destroy', $tool->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar herramienta?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function () {
    $('.btn-check-availability').click(function () {
        const id = $(this).data('id');
        $.get(`/gvff/admin/Tool/check/${id}`, function (res) {
            const color = res.available ? 'green' : 'red';
            $(`#availability-${id}`).html(`<strong style="color:${color}">${res.message}</strong>`);
        }).fail(() => alert('Error al consultar disponibilidad.'));
    });
});
</script>
@endsection
