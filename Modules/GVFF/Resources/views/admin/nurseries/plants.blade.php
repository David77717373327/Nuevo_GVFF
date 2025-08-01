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
    }
    #plants-table th {
        background: #e9f7ef;
        border: none !important;
        color: #198754;
        font-weight: 600;
        text-align: center;
    }
    #plants-table td {
        background: #fff;
        border: none !important;
        box-shadow: 0 2px 8px rgba(25,135,84,0.07);
        border-radius: 12px;
        vertical-align: middle !important;
        text-align: center;
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
    /* Botones junto al buscador */
    .dt-buttons {
        margin-left: 10px;
    }
    .form-section {
        position: relative;
        overflow: hidden;
    }
    .form-section .leaf {
        position: absolute;
        width: 24px;
        height: 24px;
        background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
        background-size: contain;
        animation: float 12s infinite ease-in-out;
        opacity: 0.3;
    }
    .form-section .leaf1 { top: 15%; left: 5%; animation-delay: 0s; }
    .form-section .leaf2 { top: 40%; left: 85%; animation-delay: 3s; }
    .form-section .leaf3 { top: 70%; left: 15%; animation-delay: 6s; }
    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(120px) rotate(180deg); }
        100% { transform: translateY(0) rotate(360deg); }
    }
    .alert-success {
        background-color: #d1e7dd;
        color: #0f5132;
        border: 1px solid #a3cfbb;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .btn-success {
        background-color: #198754 !important;
        color: #fff !important;
        padding: 0.75rem 1.5rem;
        border-radius: 6px;
        font-weight: 500;
        transition: background 0.2s, transform 0.2s;
        border: none !important;
    }
    .btn-success:hover {
        background-color: #145c32 !important;
        transform: translateY(-2px);
    }
    h1 {
        color: #198754;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
        animation: fadeIn 1.2s ease-in-out;
    }
    .animate__fadeIn {
        animation: fadeIn 1.2s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .img-thumbnail {
        max-width: 60px; /* Reducido para controlar el tamaño */
        max-height: 60px; /* Añadido para limitar altura */
        border: 1px solid #e9ecef;
        border-radius: 4px;
        object-fit: cover; /* Ajusta la imagen sin deformarla */
    }
    @media (max-width: 768px) {
        #plants-table {
            font-size: 0.875rem;
        }
        .img-thumbnail {
            max-width: 40px;
            max-height: 40px;
        }
    }
    /* Ajuste para botones de exportación */
    .dt-button {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
    }
    .dt-button:hover {
        background: none !important;
    }
</style>

<div class="form-section" data-aos="fade-up">
    <div class="container mx-auto px-6 py-16">
        <div class="form-container" data-aos="zoom-in">
            <h1 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
                Plantas en el vivero: {{ $nurseries->name }}
            </h1>
            <p><strong>Clasificación del vivero:</strong> {{ ucfirst($nurseries->classification) }}</p>
            <a href="{{ route('gvff.admin.nurseries.index') }}" class="btn btn-success mb-3">Volver a viveros</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="plants-table" class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Común</th>
                            <th scope="col">Nombre Científico</th>
                            <th scope="col">Tipo de Planta</th>
                            <th scope="col">Inventario</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Disponible</th>
                            <th scope="col">Imagen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($plants as $plant)
                            <tr>
                                <td>{{ $plant->common_name }}</td>
                                <td>{{ $plant->scientific_name }}</td>
                                <td>{{ ucfirst($plant->plant_type) }}</td>
                                <td>{{ $plant->inventory }}</td>
                                <td>{{ $plant->price ? number_format($plant->price, 2) : 'N/A' }}</td>
                                <td>{{ $plant->available ? 'Sí' : 'No' }}</td>
                                <td>
                                    @if ($plant->image)
                                        <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->common_name }}" class="img-thumbnail">
                                    @else
                                        Sin imagen
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay plantas registradas en este vivero.</td>
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
                text: '<i class="fas fa-file-excel" style="color: #198754;"></i>',
                className: 'btn',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                filename: 'Plantas_{{ $nurseries->name }}'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf" style="color: #198754;"></i>',
                className: 'btn',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                },
                orientation: 'landscape',
                pageSize: 'A4',
                filename: 'Plantas_{{ $nurseries->name }}',
                title: 'Listado de Plantas - {{ $nurseries->name }}'
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