@extends('gvff::layouts.master')

@section('title', 'Edit Nursery')

@section('content')
    <style>
        :root {
            --primary-color: #2f4f2f;
            --text-color: #1e293b;
            --ornamental-color: #10b981;
            --medicinal-color: #ef4444;
            --forestal-color: #4b5563;
        }

        .form-section {
            min-height: 100vh;
            padding: 3rem 0;
            background: #f8fafc; /* Light neutral background */
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .alert-success {
            background-color: #d1fae5;
            color: var(--primary-color);
            border: 1px solid #a7f3d0;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #f87171;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-primary {
            background: #0b5a40;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            border: none;
        }

        .btn-primary:hover {
            background: #0b5a40;
            color: #ffffff;
            outline: none;
        }

        .btn-secondary {
            background: #6b7280;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            transition: background 0.3s ease, transform 0.3s ease;
            border: none;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .form-control, .form-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--ornamental-color);
            box-shadow: 0 0 5px rgba(132, 204, 22, 0.3);
        }

        .form-control-file {
            padding: 0.5rem;
        }

        .is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        h1 {
            color: #0b5a40;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
            .form-control, .form-select {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="form-section">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container">
                <h1 class="text-3xl md:text-4xl font-bold text-center mb-6">
                    Editar Vivero
                </h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('gvff.admin.nurseries.update', $nurseries) }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-6 form-group">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $nurseries->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $nurseries->location) }}" required>
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="max_capacity" class="form-label">Max Capacity</label>
                        <input type="number" name="max_capacity" id="max_capacity" class="form-control @error('max_capacity') is-invalid @enderror" value="{{ old('max_capacity', $nurseries->max_capacity) }}" required>
                        @error('max_capacity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="classification" class="form-label">Classification</label>
                        <select name="classification" id="classification" class="form-select @error('classification') is-invalid @enderror" required>
                            <option value="public" {{ old('classification', $nurseries->classification) == 'public' ? 'selected' : '' }}>Public</option>
                            <option value="private" {{ old('classification', $nurseries->classification) == 'private' ? 'selected' : '' }}>Private</option>
                        </select>
                        @error('classification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3">{{ old('description', $nurseries->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($nurseries->image)
                        <div class="col-md-6 form-group d-flex align-items-end">
                            <img src="{{ asset('storage/' . $nurseries->image) }}" alt="Nursery Image" class="img-thumbnail" width="150">
                        </div>
                    @endif
                    <div class="col-12 form-group">
                        <button type="submit" class="btn btn-primary">Actualizar Vivero</button>
                        <a href="{{ route('gvff.admin.nurseries.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection