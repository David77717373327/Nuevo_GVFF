@extends('gvff::layouts.master')

@section('title', 'Index')

@section('content')

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<style>
    :root {
        --primary-color: #2f4f2f;
        --accent-color: #248b41;
        --text-color: #1e293b;
        --ornamental-color: #10b981;
        --medicinal-color: #ef4444;
    }

    .form-section {
        min-height: 100vh;
        background: #ffffff;
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

    .animate__fadeIn {
        animation: fadeIn 1.2s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    h1 {
        color: var(--accent-color);
        font-weight: 700;
        text-align: center;
        margin-bottom: 1.5rem;
        animation: fadeIn 1.2s ease-in-out;
    }

    .alert-success, .alert-danger {
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    .alert-success {
        background-color: #d1fae5;
        color: var(--primary-color);
        border: 1px solid #a7f3d0;
    }

    .alert-danger {
        background-color: #fee2e2;
        color: #991b1b;
        border: 1px solid #fca5a5;
    }

    a.btn-primary, .btn-primary {
        background: var(--accent-color) !important; /* Misma color que el título */
        color: #ffffff !important;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: background 0.3s ease, transform 0.3s ease, border-color 0.2s ease;
        border: none;
    }

    a.btn-primary:hover, .btn-primary:hover {
        background: #1e6f33 !important; /* Verde más oscuro para hover, coherente con el diseño */
        transform: translateY(-2px);
    }

    .btn-info, .btn-warning, .btn-danger {
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
        transition: background 0.3s ease, transform 0.3s ease, border-color 0.2s ease;
        border: none;
    }

    .btn-info { background: #3b82f6; }
    .btn-info:hover { background: #2563eb; }

    .btn-warning { background: #f59e0b; }
    .btn-warning:hover { background: #d97706; }

    .btn-danger { background: #ef4444; }
    .btn-danger:hover { background: #dc2626; }

    /* Estilos de la tabla #nurseries-table (adaptados de #plants-table) */
    #nurseries-table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        background: transparent;
    }
    #nurseries-table th {
        background: #e9f7ef;
        border: none !important;
        color: #198754;
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
        font-size: 1.5em; /* Ajustado para mantener coherencia */
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

    .img-thumbnail {
        max-width: 100%;
        height: auto;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
    }

    @media (max-width: 768px) {
        .btn {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }

        .table {
            font-size: 0.875rem;
        }
    }
</style>

<div class="form-section" data-aos="fade-up">
    <div class="container mx-auto px-6 py-16">
        <h1 class="text-3xl md:text-4xl font-bold text-[var(--accent-color)] text-center mb-6 animate_animated animate_fadeIn">
            Gestión de vivero
        </h1>
        <a href="{{ route('gvff.admin.nurseries.create') }}" class="btn btn-primary btn-sm mb-4">Crear nuevo vivero</a>

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

        <table id="nurseries-table" class="table align-middle">
            <thead class="table-success">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Capacidad Máxima</th>
                    <th scope="col">Clasificación</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Imagen</th>
                    <th scope="col">Acciones</th>
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
                                <img src="{{ asset('storage/' . $nursery->image) }}" alt="{{ $nursery->name }}" class="img-thumbnail" style="max-width: 100px;">
                            @else
                                Sin imagen
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('gvff.admin.nurseries.showPlants', $nursery) }}" class="btn btn-sm">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a href="{{ route('gvff.admin.nurseries.edit', $nursery) }}" class="btn btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('gvff.admin.nurseries.destroy', $nursery) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vivero?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm">
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
            </tbody>
        </table>
        <div class="leaf leaf1"></div>
        <div class="leaf leaf2"></div>
        <div class="leaf leaf3"></div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush