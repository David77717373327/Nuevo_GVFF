@extends('gvff::layouts.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h1>Crear Fauna</h1>
    <form action="{{ route('gvff.admin.faunas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="scientific_name">Nombre Científico</label>
            <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name') }}" required>
            @error('scientific_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="common_name">Nombre Común</label>
            <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name') }}" required>
            @error('common_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="habitat">Hábitat</label>
            <input type="text" name="habitat" id="habitat" class="form-control @error('habitat') is-invalid @enderror" value="{{ old('habitat') }}">
            @error('habitat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="diet">Dieta</label>
            <textarea name="diet" id="diet" class="form-control @error('diet') is-invalid @enderror">{{ old('diet') }}</textarea>
            @error('diet')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="status">Estado</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Seleccione un estado</option>
                <option value="stable" {{ old('status') == 'stable' ? 'selected' : '' }}>Estable</option>
                <option value="critical" {{ old('status') == 'critical' ? 'selected' : '' }}>Crítico</option>
                <option value="extinct" {{ old('status') == 'extinct' ? 'selected' : '' }}>Extinto</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="location">Ubicación</label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="image">Imagen</label>
            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Crear Fauna</button>
        <a href="{{ route('gvff.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush



@endsection