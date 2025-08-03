@extends('gvff::layouts.master')

@section('content')
    <div class="container mt-5 col-md-8">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-gradient bg-success text-white">
                <h4 class="mb-0"><i class="bi bi-tools"></i> Nueva Herramienta</h4>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('gvff.admin.Tool.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf


                    <div class="mt-3">
                        <label for="image" class="form-label fw-bold">Imagen de la Herramienta</label>
                        <input type="file" name="image" class="form-control shadow-sm" accept="image/*">
                    </div>
                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="name" class="form-control shadow-sm" placeholder="Ej: Martillo"
                                required>
                        </div>

                        <!-- Cantidad -->
                        <div class="col-md-3">
                            <label for="quantity" class="form-label fw-bold">Cantidad</label>
                            <input type="number" name="quantity" class="form-control shadow-sm" min="1" required>
                        </div>

                        <!-- Stock mínimo -->
                        <div class="col-md-3">
                            <label for="min_stock" class="form-label fw-bold">Stock Mínimo</label>
                            <input type="number" name="min_stock" class="form-control shadow-sm" min="1" required>
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div class="mt-3">
                        <label for="description" class="form-label fw-bold">Descripción</label>
                        <textarea name="description" class="form-control shadow-sm" rows="3" placeholder="Describe la herramienta..."
                            required></textarea>
                    </div>

                    <div class="row g-3 mt-3">
                        <!-- Estado -->
                        <div class="col-md-6">
                            <label for="status" class="form-label fw-bold">Estado</label>
                            <select name="status" class="form-select shadow-sm">
                                <option value="activo" selected>Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <!-- Disponible -->
                        <div class="col-md-6">
                            <label for="available" class="form-label fw-bold">Disponible</label>
                            <select name="available" class="form-select shadow-sm">
                                <option value="1" selected>Sí</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    <!-- Fecha adquisición -->
                    <div class="mt-3">
                        <label for="acquisition_date" class="form-label fw-bold">Fecha de Adquisición</label>
                        <input type="date" name="acquisition_date" class="form-control shadow-sm">
                    </div>

                    <!-- Botones -->
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ route('gvff.admin.Tool.index') }}" class="btn btn-outline-secondary me-2">
                            <i class="bi bi-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success shadow-sm">
                            <i class="bi bi-save"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
