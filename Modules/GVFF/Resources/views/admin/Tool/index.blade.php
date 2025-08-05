@extends('gvff::layouts.master')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- 🔹 Estilos DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
    #tools-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        background: transparent;
    }
    #tools-table th {
        background: #e9f7ef;
        border: none !important;
        color: #198754;
        font-weight: 600;
        text-align: center;
    }
    #tools-table td {
        background: #fff;
        border: none !important;
        box-shadow: 0 2px 8px rgba(25,135,84,0.07);
        border-radius: 12px;
        vertical-align: middle !important;
        text-align: center;
    }
    #tools-table tbody tr {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    #tools-table tbody tr:hover {
        box-shadow: 0 4px 16px rgba(25,135,84,0.12);
        transform: translateY(-2px) scale(1.01);
        background: #f6fff9 !important;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        padding: 0.2em 0.8em;
        margin: 0 2px;
        border-radius: 6px;
        border: 1px solid #d1e7dd;
        background: #e9f7ef;
        color: #198754 !important;
        transition: background 0.2s;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: #198754 !important;
        color: #fff !important;
    }
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 0.3em 0.8em;
    }
    .dataTables_wrapper .dataTables_length select {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 0.2em 0.6em;
    }
    .btn-sm i {
        color: #198754 !important;
        font-size: 1.2em;
    }
    .btn:hover i, .btn-sm:hover i {
        color: #145c32 !important;
        transform: scale(1.15);
    }
    td:last-child {
        white-space: nowrap;
    }
</style>

@section('content')
<div class="container ">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-success"><i class="bi bi-tools"></i> Listado de Herramientas</h2>
        <a href="{{ route('gvff.admin.Tool.create') }}" class="btn btn-success text-white">
            <i class="bi bi-plus-circle"></i> Nueva Herramienta
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-body bg-white">
            <div class="table-responsive">
                <table id="tools-table" class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Stock Mínimo</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                            <th>Fecha Adquisición</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tools as $tool)
                        <tr>
                            <td>{{ $tool->id }}</td>
                            <td class="fw-bold">{{ $tool->name }}</td>
                            <td>{{ Str::limit($tool->description, 40, '...') }}</td>
                            <td>{{ $tool->quantity }}</td>
                            <td>{{ $tool->min_stock }}</td>
                            <td>
                                @if ($tool->image)
                                    <img src="{{ asset($tool->image) }}" width="60" class="rounded border">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $tool->status == 'activo' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($tool->status) }}
                                </span>
                            </td>
                            <td>{{ $tool->acquisition_date ? \Carbon\Carbon::parse($tool->acquisition_date)->format('d/m/Y') : 'Sin registro' }}</td>
                            <td>
                                <a href="{{ route('gvff.admin.Tool.show', $tool->id) }}" class="btn" title="Ver">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('gvff.admin.Tool.edit', $tool->id) }}" class="btn" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('gvff.admin.Tool.destroy', $tool->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" onclick="return confirm('¿Eliminar herramienta?')" title="Eliminar">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- 🔹 JS DataTables -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#tools-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        dom: '<"row"<"col-sm-6"l><"col-sm-6 text-end"Bf>>rtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                className: 'btn btn-success',
                exportOptions: { columns: [0,1,2,3,4,6,7] },
                filename: 'Listado_Herramientas'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                className: 'btn btn-success',
                exportOptions: { columns: [0,1,2,3,4,6,7] },
                orientation: 'landscape',
                pageSize: 'A4',
                filename: 'Listado_Herramientas',
                title: 'Listado de Herramientas'
            }
        ]
    });
});
</script>
@endsection
