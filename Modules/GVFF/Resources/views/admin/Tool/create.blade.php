@extends('gvff::layouts.master')

@section('content')
<div class="container mt-5 col-md-6">
    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Nueva Herramienta</h4>
        </div>

        <div class="card-body">
            <form action="{{ route('gvff.admin.Tool.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Estado</label>
                    <select name="status" class="form-select">
                        <option value="activo" selected>Activo</option>
                        <option value="inactivo">Inactivo</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="available" class="form-label">Disponible</label>
                    <select name="available" class="form-select">
                        <option value="1" selected>Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="acquisition_date" class="form-label">Fecha de Adquisición</label>
                    <input type="date" name="acquisition_date" class="form-control">
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success me-2">Guardar</button>
                    <a href="{{ route('gvff.admin.Tool.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
