@extends('gvff::layouts.master')

@section('content')
<!-- DataTables CSS (Bootstrap 5) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
    #faunas-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        background: transparent;
    }
    #faunas-table th {
        background: #e9f7ef;
        border: none !important;
        color: #198754;
        font-weight: 600;
        text-align: center;
    }
    #faunas-table td {
        background: #fff;
        border: none !important;
        box-shadow: 0 2px 8px rgba(25,135,84,0.07);
        border-radius: 12px;
        vertical-align: middle !important;
        text-align: center;
    }
    #faunas-table tbody tr {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    #faunas-table tbody tr:hover {
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
    .btn i, .btn-sm i {
        color: #198754 !important;
        background: none !important;
        font-size: 1.1em;
        margin-right: 0;
    }
    .btn, .btn-sm {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0.3rem 0.5rem;
    }
    .btn:hover i, .btn-sm:hover i {
        color: #145c32 !important;
        transform: scale(1.15);
    }
    td:last-child {
        white-space: nowrap;
    }
    .dataTables_length label {
        font-weight: 500;
        color: #198754;
        font-size: 1rem;
    }
    .dataTables_length select {
        margin: 0 0.3em;
        background: #e9f7ef;
        color: #198754;
    }
    /* Botones junto al buscador */
    .dt-buttons {
        margin-left: 10px;
    }

    /* Estilo dinámico para el título */
    .dynamic-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        color: #198754;
        text-transform: uppercase;
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 2rem;
        animation: fadeInDown 1.5s ease-in-out infinite alternate;
    }

    .dynamic-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50px;
        height: 4px;
        background: #198754;
        border-radius: 2px;
        animation: pulse 2s infinite ease-in-out;
    }

    @keyframes fadeInDown {
        0% { transform: translateY(0); opacity: 1; }
        100% { transform: translateY(-10px); opacity: 0.9; }
    }

    @keyframes pulse {
        0% { width: 50px; }
        50% { width: 70px; }
        100% { width: 50px; }
    }
</style>

<div class="form-section" data-aos="fade-up">
    <div class="container mx-auto px-6 py-16">
        <div class="form-container" data-aos="zoom-in">
            <h1 class="dynamic-title">
                Gestión de Faunas
            </h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('gvff.admin.faunas.create') }}" class="btn btn-success mb-3" style="background-color: #198754 !important; color: #fff !important; border: none !important;">
                Crear Nueva Fauna
            </a>

            <div class="table-responsive">
                <table id="faunas-table" class="table align-middle">
                    <thead class="table-success">
                        <tr>
                            <th>Nombre Común</th>
                            <th>Nombre Científico</th>
                            <th>Hábitat</th>
                            <th>Estado</th>
                            <th>Ubicación</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faunas as $fauna)
                            <tr>
                                <td>{{ $fauna->common_name }}</td>
                                <td>{{ $fauna->scientific_name }}</td>
                                <td>{{ $fauna->habitat ?? 'N/A' }}</td>
                                <td>{{ ucfirst($fauna->status == 'stable' ? 'Estable' : ($fauna->status == 'critical' ? 'Crítico' : 'Extinto')) }}</td>
                                <td>{{ $fauna->location ?? 'N/A' }}</td>
                                <td>
                                    @if ($fauna->image)
                                        <img src="{{ asset($fauna->image) }}" alt="{{ $fauna->common_name }}" class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('gvff.admin.faunas.edit', $fauna) }}" class="btn" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('gvff.admin.faunas.destroy', $fauna) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm" onclick="return confirm('¿Estás seguro?')" title="Eliminar">
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
        <div class="leaf leaf1"></div>
        <div class="leaf leaf2"></div>
        <div class="leaf leaf3"></div>
    </div>
</div>

<!-- jQuery, Bootstrap, DataTables y Buttons -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    var table = $('#faunas-table').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json',
            lengthMenu: 'Mostrar _MENU_ registros por página',
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: {
                previous: "Anterior",
                next: "Siguiente"
            }
        },
        responsive: true,
        dom: '<"row"<"col-sm-6"l><"col-sm-6 text-end"Bf>>rtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                },
                filename: 'Listado_Faunas'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5]
                },
                orientation: 'landscape',
                pageSize: 'A4',
                filename: 'Listado_Faunas',
                title: 'Listado de Faunas'
            }
        ]
    });

    $('.dataTables_length label').each(function(){
        $(this).contents().filter(function(){
            return this.nodeType === 3;
        }).first().replaceWith('Mostrar ');
    });
});
</script>
@endsection