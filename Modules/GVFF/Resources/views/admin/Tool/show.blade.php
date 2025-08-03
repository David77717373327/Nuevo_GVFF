@extends('gvff::layouts.master')

@section('content')
<div class="container mt-5 col-md-6">
    <div class="card shadow">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center ">
            <h4 class="mb-0">Detalles de la Herramienta</h4>
            <a href="{{ route('gvff.admin.Tool.index') }}" class="btn btn-light btn-sm">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>

        <div class="card-body">
            <!-- Imagen de la herramienta -->
            <div class="text-center mb-4">
                @if($tool->image)
                    <img src="{{ asset($tool->image) }}" alt="Imagen de {{ $tool->name }}" width="200" class="rounded shadow-sm border">
                @else
                    <div class="text-muted fst-italic">Sin imagen disponible</div>
                @endif
            </div>

            <!-- Nombre -->
            <div class="mb-3">
                <strong>Nombre:</strong>
                <p>{{ $tool->name }}</p>
            </div>

            <!-- Descripción -->
            <div class="mb-3">
                <strong>Descripción:</strong>
                <p>{{ $tool->description }}</p>
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <strong>Estado:</strong>
                @if($tool->status == 'activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </div>

            <!-- Disponible -->
            <div class="mb-3">
                <strong>Disponible:</strong>
                <p>{{ $tool->available ? 'Sí' : 'No' }}</p>
            </div>

            <!-- Fecha adquisición -->
            <div class="mb-3">
                <strong>Fecha de Adquisición:</strong>
                <p>{{ $tool->acquisition_date ? $tool->acquisition_date : 'No registrada' }}</p>
            </div>

            <!-- Botones -->
            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('gvff.admin.Tool.edit', $tool->id) }}" class="btn btn-success me-2">
                    <i class="bi bi-pencil"></i> Editar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
