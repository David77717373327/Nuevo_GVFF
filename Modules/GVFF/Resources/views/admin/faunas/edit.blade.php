@extends('gvff::layouts.master')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container mt-5">
    <h1>Edit Fauna</h1>
    <form action="{{ route('gvff.admin.faunas.update', $fauna) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="scientific_name">Scientific Name</label>
            <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name', $fauna->scientific_name) }}" required>
            @error('scientific_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="common_name">Common Name</label>
            <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name', $fauna->common_name) }}" required>
            @error('common_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="habitat">Habitat</label>
            <input type="text" name="habitat" id="habitat" class="form-control @error('habitat') is-invalid @enderror" value="{{ old('habitat', $fauna->habitat) }}">
            @error('habitat')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="diet">Diet</label>
            <textarea name="diet" id="diet" class="form-control @error('diet') is-invalid @enderror">{{ old('diet', $fauna->diet) }}</textarea>
            @error('diet')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                <option value="">Select a status</option>
                <option value="stable" {{ old('status', $fauna->status) == 'stable' ? 'selected' : '' }}>Stable</option>
                <option value="critical" {{ old('status', $fauna->status) == 'critical' ? 'selected' : '' }}>Critical</option>
                <option value="extinct" {{ old('status', $fauna->status) == 'extinct' ? 'selected' : '' }}>Extinct</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="location">Location</label>
            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $fauna->location) }}">
            @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
            @if ($fauna->image)
                <img src="{{ asset($fauna->image) }}" alt="{{ $fauna->common_name }}" class="img-thumbnail mt-2" style="max-width: 100px;">
            @endif
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update Fauna</button>
        <a href="{{ route('gvff.admin.faunas.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
@endsection