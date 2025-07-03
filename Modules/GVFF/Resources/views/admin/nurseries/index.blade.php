@extends('gvff::layouts.master')

@section('title', 'Index')

@section('content')

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        :root {
            --primary-color: #2f4f2f;
            --accent-color: #84cc16;
            --text-color: #1e293b;
            --ornamental-color: #10b981;
            --medicinal-color: #ef4444;
            --forestal-color: #4b5563;
            --venta-color: #84cc16;
            --background-gradient: linear-gradient(to bottom, #f0fdf4, #d4f4dd);
        }

        .form-section {
            min-height: 100vh;
            background: var(--background-gradient);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
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

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--accent-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            animation: fadeIn 1.2s ease-in-out;
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

        .btn-primary {
            background: var(--accent-color);
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease, border-color 0.2s ease;
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-color);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-info {
            background: #3b82f6;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease, border-color 0.2s ease;
            border: none;
        }

        .btn-info:hover {
            background: #2563eb;
            border-color: #2563eb;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: #f59e0b;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease, border-color 0.2s ease;
            border: none;
        }

        .btn-warning:hover {
            background: #d97706;
            border-color: #d97706;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ef4444;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease, border-color 0.2s ease;
            border: none;
        }

        .btn-danger:hover {
            background: #dc2626;
            border-color: #dc2626;
            transform: translateY(-2px);
        }

        .table {
            background: #ffffff;
            border-radius: 6px;
            overflow: hidden;
        }

        .table-dark {
            background: var(--primary-color);
            color: #ffffff;
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
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
            <div class="form-container" data-aos="zoom-in">
                <h1 class="text-3xl md:text-4xl font-bold text-[var(--accent-color)] text-center mb-6 animate__animated animate__fadeIn">
                    Gestión de vivero
                </h1>
                <a href="{{ route('gvff.admin.nurseries.create') }}" class="btn btn-primary btn-sm mb-4">Crear nuevo vivero</a>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
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
                                    <a href="{{ route('gvff.admin.nurseries.showPlants', $nursery) }}" class="btn btn-info btn-sm">Ver</a>
                                    <a href="{{ route('gvff.admin.nurseries.edit', $nursery) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('gvff.admin.nurseries.destroy', $nursery) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este vivero?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
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
            </div>
            <!-- Floating decorative leaves -->
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush