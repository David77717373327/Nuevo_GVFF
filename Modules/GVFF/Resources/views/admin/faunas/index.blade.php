@extends('gvff::layouts.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Gestión de Faunas</h1>
    <a href="{{ route('gvff.admin.faunas.create') }}" class="btn btn-primary btn-sm mb-3">Crear Nueva Fauna</a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">Nombre Científico</th>
                <th scope="col">Nombre Común</th>
                <th scope="col">Hábitat</th>
                <th scope="col">Estado</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($faunas as $fauna)
                <tr>
                    <td>{{ $fauna->scientific_name }}</td>
                    <td>{{ $fauna->common_name }}</td>
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
                        <a href="{{ route('gvff.admin.faunas.edit', $fauna) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('gvff.admin.faunas.destroy', $fauna) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta fauna?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay faunas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection