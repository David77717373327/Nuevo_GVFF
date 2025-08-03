
@extends('gvff::layouts.master')

@section('content')



<!-- DataTables CSS (Bootstrap 5) -->



<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
    #plants-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        background: transparent;
        width: 100%; /* Asegura que la tabla ocupe el ancho completo */
    }
    #plants-table th {
        background: #e9f7ef;
        border: none !important;
        color: #198754;
        font-weight: 600;
        text-align: center;
        padding: 0.75rem; /* Espaciado consistente */
    }
    #plants-table td {
        background: #fff;
        border: none !important;
        box-shadow: 0 2px 8px rgba(25,135,84,0.07);
        border-radius: 12px;
        vertical-align: middle !important;
        text-align: center;
        padding: 0.75rem; /* Espaciado consistente */
    }
    #plants-table tbody tr {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    #plants-table tbody tr:hover {
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
    .dt-buttons {
        margin-left: 10px;
    }
    .badge {
        display: inline-block;
        padding: 0.25em 0.6em;
        font-size: 0.875rem;
        font-weight: 700;
        line-height: 1;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.25rem;
    }
    .badge.bg-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .badge.bg-warning {
        background-color: #ffc107;
        color: #000;
    }
    .badge.bg-success {
        background-color: #198754;
        color: #fff;
    }
    .form-section {
        min-height: 100vh;
        padding: 3rem 0;
        background: #f8fafc;
        position: relative;
    }
    .form-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        position: relative;
        z-index: 1;
    }
    h2 {
        color: #198754;
    }
    .alert-success {
        background-color: #d1fae5;
        color: #2f4f2f;
        border: 1px solid #a7f3d0;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .alert-danger {
        background-color: #f8d7da;
        color: #dc3545;
        border: 1px solid #f5c6cb;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .leaf {
        position: absolute;
        background: url('https://www.transparentpng.com/thumb/leaf/leaf-png-11.png') no-repeat;
        background-size: contain;
        width: 50px;
        height: 50px;
        z-index: 0;
    }
    .leaf1 { top: 10%; left: 5%; }
    .leaf2 { top: 50%; right: 5%; }
    .leaf3 { bottom: 10%; left: 10%; }
    @media (max-width: 768px) {
        .form-container {
            padding: 1rem;
        }
        #plants-table th,
        #plants-table td {
            font-size: 0.875rem;
        }
        .badge {
            font-size: 0.75rem;
        }
        .leaf {
            width: 30px;
            height: 30px;
        }
    }
</style>

<div class="form-section" data-aos="fade-up">
    <div class="container mx-auto px-6 py-16">
        <div class="form-container" data-aos="zoom-in">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
                Inventario de Plantas
            </h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="plants-table" class="table align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Planta</th>
                            <th>Unidad Productiva</th>
                            <th>Bodega</th>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Stock Minimo</th>
                            <th>Fecha de Producción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventories as $inventory)
                            <tr>
                                <td>{{ $inventory->id }}</td>
                                <td>{{ $inventory->plant->common_name ?? 'No definido' }}</td>
                                <td>{{ $inventory->productive_unit_warehouse->productive_unit->name ?? 'No definido' }}</td>
                                <td>{{ $inventory->productive_unit_warehouse->warehouse->name ?? 'No definido' }}</td>
                                <td>{{ $inventory->description }}</td>
                                <td>{{ $inventory->amount }}</td>
                                <td>
                                    @if($inventory->stock < 5)
                                        <span class="badge bg-danger">{{ $inventory->stock }}</span>
                                    @elseif($inventory->stock < 10)
                                        <span class="badge bg-warning text-dark">{{ $inventory->stock }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $inventory->stock }}</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($inventory->production_date)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No hay inventario registrado.</td>
                            </tr>
                        @endforelse
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
    var table = $('#plants-table').DataTable({
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
                    columns: [0,1,2,3,4,5,6,7]
                },
                filename: 'Listado_Inventario_Plantas'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6,7]
                },
                orientation: 'landscape',
                pageSize: 'A4',
                filename: 'Listado_Inventario_Plantas',
                title: 'Listado de Inventario de Plantas'
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
