@extends('gvff::layouts.master')

@section('content')


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        :root {
            --primary-color: #2f4f2f; /* Dark green */
            --accent-color: #84cc16; /* Vibrant green */
            --text-color: #51b462; /* Dark slate */
            --table-bg: #ffffff; /* White background for table */
            --table-border: #e2e8f0; /* Light gray border */
        }

        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        h1 {
            color: var(--accent-color);
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        p {
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        .btn-secondary {
            background-color: #2dc968;
            color: #2effb9;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5c636a;
        }

        .table {
            background-color: var(--table-bg);
            border-radius: 6px;
            overflow: hidden;
        }

        .table-dark {
            background-color: var(--primary-color);
            color: #ffffff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(109, 253, 128, 0.295);
        }

        .table-bordered th, .table-bordered td {
            border-color: var(--table-border);
        }

        .img-thumbnail {
            max-width: 100px;
            height: auto;
            border: 1px solid var(--table-border);
            border-radius: 4px;
        }

        .alert-success {
            background-color: #d1fae5;
            color: var(--primary-color);
            border: 1px solid #a7f3d0;
            border-radius: 4px;
        }

        @media (max-width: 768px) {
            .table {
                font-size: 0.875rem;
            }
            .img-thumbnail {
                max-width: 60px;
            }
        }
    </style>

    <div class="container mt-5">
        <h1 class="mb-4">Plantas en el vivero: {{ $nurseries->name }}</h1>
        <p><strong>Clasificación del vivero:</strong> {{ ucfirst($nurseries->classification) }}</p>
        <a href="{{ route('gvff.admin.nurseries.index') }}" class="btn btn-secondary btn-sm mb-3">Volver a viveros</a>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
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
                                <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->common_name }}" class="img-thumbnail" style="max-width: 100px;">
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
@endsection

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush