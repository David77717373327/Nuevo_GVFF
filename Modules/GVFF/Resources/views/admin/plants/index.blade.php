@extends('gvff::layouts.master')

@section('content')
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
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: #f59e0b;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
            border: none;
            margin-right: 0.5rem;
        }

        .btn-warning:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #ef4444;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
            border: none;
            margin-right: 0.5rem;
        }

        .btn-danger:hover {
            background: #dc2626;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #22c55e;
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
            border: none;
        }

        .btn-success:hover {
            background: #16a34a;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            margin-top: 1.5rem;
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border: 1px solid #e2e8f0;
        }

        th {
            background: var(--primary-color);
            color: #ffffff;
            font-weight: 600;
        }

        td img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
            th, td {
                padding: 0.75rem;
                font-size: 0.875rem;
            }
            td img {
                width: 60px;
            }
        }
    </style>

    <div class="form-section" data-aos="fade-up">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container" data-aos="zoom-in">
                <h1 class="text-3xl md:text-4xl font-bold text-[var(--accent-color)] text-center mb-6 animate__animated animate__fadeIn">
                    Gestión de Plantas
                </h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('gvff.admin.plants.create') }}" class="btn btn-primary mb-3">Crear Nueva Planta</a>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre Común</th>
                            <th>Nombre Científico</th>
                            <th>Vivero</th>
                            <th>Tipo</th>
                            <th>Inventario</th>
                            <th>Disponible</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plants as $plant)
                            <tr>
                                <td>{{ $plant->common_name }}</td>
                                <td>{{ $plant->scientific_name }}</td>
                                <td>{{ $plant->nurseries->name ?? 'Sin vivero' }}</td>
                                <td>{{ $plant->plant_type }}</td>
                                <td>{{ $plant->inventory }}</td>
                                <td>{{ $plant->available ? 'Sí' : 'No' }}</td>
                                <td>
                                    <img src="{{ asset($plant->image) }}" alt="{{ $plant->common_name }}" width="80">
                                </td>
                                <td>
                                    <a href="{{ route('gvff.admin.plants.edit', $plant) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('gvff.admin.plants.destroy', $plant) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                    </form>
                                    <a href="{{ route('gvff.admin.plants.sell', $plant) }}" class="btn btn-success btn-sm">Vender</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Hojas flotantes decorativas -->
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>
    </div>
@endsection