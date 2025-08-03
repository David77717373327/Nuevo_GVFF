@extends('gvff::layouts.master')

@section('content')
<div class="container mt-5 col-md-8">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-gradient bg-success text-white text-center">
            <h4 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Herramienta</h4>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('gvff.admin.Tool.update', $tool->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold">Nombre</label>
                        <input type="text" name="name" class="form-control shadow-sm" value="{{ $tool->name }}" required>
                    </div>

                    <!-- Cantidad -->
                    <div class="col-md-3">
                        <label for="quantity" class="form-label fw-bold">Cantidad</label>
                        <input type="number" name="quantity" class="form-control shadow-sm" min="1" value="{{ $tool->quantity }}" required>
                    </div>

                    <!-- Stock mínimo -->
                    <div class="col-md-3">
                        <label for="min_stock" class="form-label fw-bold">Stock Mínimo</label>
                        <input type="number" name="min_stock" class="form-control shadow-sm" min="1" value="{{ $tool->min_stock }}" required>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mt-3">
                    <label for="description" class="form-label fw-bold">Descripción</label>
                    <textarea name="description" class="form-control shadow-sm" rows="3" required>{{ $tool->description }}</textarea>
                </div>

                <div class="row g-3 mt-3">
                    <!-- Estado -->
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-bold">Estado</label>
                        <select name="status" class="form-select shadow-sm">
                            <option value="activo" {{ $tool->status == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ $tool->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <!-- Disponible -->
                    <div class="col-md-6">
                        <label for="available" class="form-label fw-bold">Disponible</label>
                        <select name="available" class="form-select shadow-sm">
                            <option value="1" {{ $tool->available ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ !$tool->available ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>

                <!-- Fecha adquisición -->
                <div class="mt-3">
                    <label for="acquisition_date" class="form-label fw-bold">Fecha de Adquisición</label>
                    <input type="date" name="acquisition_date" class="form-control shadow-sm" value="{{ $tool->acquisition_date }}">
                </div>

                <!-- Imagen -->
                <div class="mt-3">
                    <label for="image" class="form-label fw-bold">Imagen de la Herramienta</label>
                    @if($tool->image)
                        <div class="mb-2">
                            <img src="{{ asset($tool->image) }}" width="100" class="rounded border shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="image" class="form-control shadow-sm" accept="image/*">
                    <small class="text-muted">Puedes subir una nueva imagen para reemplazar la actual.</small>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('gvff.admin.Tool.index') }}" class="btn btn-outline-secondary me-2">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success shadow-sm">
                        <i class="bi bi-save"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
