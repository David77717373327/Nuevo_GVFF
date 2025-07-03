@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2>Editar Herramienta</h2>
    <form action="{{ route('gvff.admin.tool.update', $tool->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $tool->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $tool->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select name="status" id="status" class="form-control">
                <option value="activo" {{ $tool->status == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ $tool->status == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.tool.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection