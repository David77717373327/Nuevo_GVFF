@extends('gvff::layouts.master')

@section('title', 'Gestión de Viveros')

@section('content')
<!-- DataTables CSS (Bootstrap 5) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<style>
    :root {
        --primary-color: #2f4f2f;
        --accent-color: #248b41;
        --text-color: #1e293b;
        --success-color: #198754;
    }

    #nurseries-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        background: transparent;
    }
    #nurseries-table th {
        background: #e9f7ef;
        border: none !important;
        color: var(--success-color);
        font-weight: 600;
        text-align: center;
    }
    #nurseries-table td {
        background: #fff;
        border: none !important;
        box-shadow: 0 2px 8px rgba(25,135,84,0.07);
        border-radius: 12px;
        vertical-align: middle !important;
        text-align: center;
    }
    #nurseries-table tbody tr {
        transition: box-shadow 0.2s, transform 0.2s;
    }
    #nurseries-table tbody tr:hover {
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
        color: var(--success-color) !important;
        transition: background 0.2s;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: var(--success-color) !important;
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
        color: var(--success-color) !important;
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
        color: var(--success-color);
        font-size: 1rem;
    }
    .dataTables_length select {
        margin: 0 0.3em;
        background: #e9f7ef;
        color: var(--success-color);
    }
    .dt-buttons {
        margin-left: 10px;
    }
    .plant-image {
        max-width: 80px;
        max-height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }
    .form-section {
        min-height: 100vh;
        padding: 3rem 0;
        position: relative;
        overflow: hidden;
    }
    .form-section .leaf {
        position: absolute;
        width: 24px;
        height: 24px;
        background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
        background-size: contain;
        animation: float 6s infinite ease-in-out;
        opacity: 0.3;
    }
    .form-section .leaf1 { top: 10%; left: 5%; animation-delay: 0s; }
    .form-section .leaf2 { top: 25%; left: 80%; animation-delay: 0.5s; }
    .form-section .leaf3 { top: 40%; left: 15%; animation-delay: 1s; }
    .form-section .leaf4 { top: 55%; left: 70%; animation-delay: 1.5s; }
    .form-section .leaf5 { top: 70%; left: 10%; animation-delay: 2s; }
    .form-section .leaf6 { top: 20%; left: 60%; animation-delay: 2.5s; }
    .form-section .leaf7 { top: 60%; left: 30%; animation-delay: 3s; }
    .form-section .leaf8 { top: 35%; left: 90%; animation-delay: 3.5s; }
    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(120px) rotate(180deg); }
        100% { transform: translateY(0) rotate(360deg); }
    }
    h1 {
        color: var(--success-color);
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
        animation: fadeIn 1.2s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .alert-success {
        background-color: #d1fae5;
        color: var(--primary-color);
        border: 1px solid #a7f3d0;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    .btn-primary {
        background: var(--success-color);
        color: #ffffff;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 8px rgba(25,135,84,0.2);
    }
    .btn-primary:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25,135,84,0.3);
    }
    .btn-create-table {
        background: var(--success-color);
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.3s ease, transform 0.3s ease;
        border: none;
        box-shadow: 0 2px 6px rgba(25, 135, 84, 0.2);
        display: inline-block;
        text-align: center;
        width: 100%;
        margin: 0.5rem 0;
    }
    .btn-create-table:hover {
        background: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(25, 135, 84, 0.3);
    }
    .btn-create-table:active {
        transform: translateY(0);
        box-shadow: 0 2px 4px rgba(25, 135, 84, 0.2);
    }
</style>

<div class="form-section" data-aos="fade-up">
    <div class="container mx-auto px-6 py-16">
        <h1 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
            Gestión de Viveros
        </h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table id="nurseries-table" class="table align-middle">
                <thead class="table-success">
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Capacidad Máxima</th>
                        <th>Clasificación</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($nurseries as $nursery)
                    <tr>
                        <td>{{ $nursery->name }}</td>
                        <td>{{ $nursery->location }}</td>
                        <td>{{ $nursery->max_capacity }}</td>
                        <td>{{ ucfirst($nursery->classification) }}</td>
                        <td>{{ $nursery->description ?? 'Sin descripción' }}</td>
                        <td>
                            @if ($nursery->image)
                                <img src="{{ asset('storage/' . $nursery->image) }}" alt="{{ $nursery->name }}" class="plant-image">
                            @else
                                <span>Sin imagen</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('gvff.admin.nurseries.showPlants', $nursery) }}" class="btn btn-sm" title="Ver Plantas">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a href="{{ route('gvff.admin.nurseries.edit', $nursery) }}" class="btn btn-sm" title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('gvff.admin.nurseries.destroy', $nursery) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vivero?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" title="Eliminar">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay viveros registrados.</td>
                    </tr>
                    @endforelse
                    <tr>
                        <td colspan="7" class="text-center">
                            <a href="{{ route('gvff.admin.nurseries.create') }}" class="btn-create-table">
                                Crear Nuevo Vivero
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="leaf leaf1"></div>
    <div class="leaf leaf2"></div>
    <div class="leaf leaf3"></div>
    <div class="leaf leaf4"></div>
    <div class="leaf leaf5"></div>
    <div class="leaf leaf6"></div>
    <div class="leaf leaf7"></div>
    <div class="leaf leaf8"></div>
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
    var table = $('#nurseries-table').DataTable({
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
                    columns: [0,1,2,3,4]
                },
                filename: 'Listado_Viveros'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                className: 'btn btn-success',
                exportOptions: {
                    columns: [0,1,2,3,4]
                },
                orientation: 'landscape',
                pageSize: 'A4',
                filename: 'Listado_Viveros',
                title: 'Listado de Viveros'
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