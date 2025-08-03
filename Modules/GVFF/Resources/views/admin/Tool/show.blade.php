@extends('gvff::layouts.master')

@section('content')
<div class="container mt-5 col-md-6">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Detalles de la Herramienta</h4>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <strong>Nombre:</strong>
                <p>{{ $tool->name }}</p>
            </div>

            <div class="mb-3">
                <strong>Descripción:</strong>
                <p>{{ $tool->description }}</p>
            </div>

            <div class="mb-3">
                <strong>Estado:</strong>
                @if($tool->status == 'activo')
                    <span class="badge bg-success">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </div>

            <div class="mb-3">
                <strong>Disponible:</strong>
                <p>{{ $tool->available ? 'Sí' : 'No' }}</p>
            </div>

            <div class="mb-3">
                <strong>Fecha de Adquisición:</strong>
                <p>{{ $tool->acquisition_date ? $tool->acquisition_date : 'No registrada' }}</p>
            </div>

            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('gvff.admin.Tool.index') }}" class="btn btn-secondary me-2">Volver</a>
                <a href="{{ route('gvff.admin.Tool.edit', $tool->id) }}" class="btn btn-success">Editar</a>
            </div>
        </div>
    </div>
</div>
@endsection
