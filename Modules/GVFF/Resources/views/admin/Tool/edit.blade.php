@extends('gvff::layouts.master')

@section('content')
<div class="container mt-5 col-md-6">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Editar Herramienta</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('gvff.admin.Tool.update', $tool->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $tool->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" class="form-control" required>{{ old('description', $tool->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="activo" {{ $tool->status == 'activo' ? 'selected' : '' }}>Activo</option>
                        <option value="inactivo" {{ $tool->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="available" class="form-label">Disponible</label>
                    <select name="available" class="form-select">
                        <option value="1" {{ $tool->available ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ !$tool->available ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="acquisition_date" class="form-label">Fecha de Adquisición</label>
                    <input type="date" name="acquisition_date" class="form-control" value="{{ $tool->acquisition_date }}">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Actualizar</button>
                    <a href="{{ route('gvff.admin.Tool.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
