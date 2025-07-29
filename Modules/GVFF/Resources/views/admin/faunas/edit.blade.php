@extends('gvff::layouts.master')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
@endpush

@section('content')
    <style>
        :root {
            --primary-color: #2f4f2f;
            --text-color: #1e293b;
            --success-color: #198754;
        }

        .form-section {
            min-height: 100vh;
            padding: 3rem 0;
            background: #f8fafc;
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
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

        .form-control, .form-select, .form-control-file {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-control:focus, .form-select:focus, .form-control-file:focus {
            outline: none;
            border-color: var(--success-color);
            box-shadow: 0 0 5px rgba(25,135,84,0.3);
        }

        .is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        #image-preview {
            max-width: 150px;
            height: 150px;
            object-fit: contain;
            margin-top: 1rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            display: none;
        }

        h1 {
            color: var(--success-color);
        }

        .btn-success {
            background: var(--success-color);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            border: none;
        }

        .btn-success:hover {
            background: var(--success-color);
            color: #ffffff;
            outline: none;
        }

        .btn-secondary {
            background: #6b7280;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-weight: 500;
            border: none;
        }

        .btn-secondary:hover {
            background: #6b7280;
            color: #ffffff;
            outline: none;
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

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-control, .form-select {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="form-section">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container">
                <h1 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
                    Editar Especie
                </h1>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('gvff.admin.faunas.update', $fauna) }}" method="POST" enctype="multipart/form-data" id="fauna-form">
                    @csrf
                    @method('PUT')
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="scientific_name" class="form-label">Nombre científico</label>
                            <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name', $fauna->scientific_name) }}" required>
                            @error('scientific_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="common_name" class="form-label">Nombre común</label>
                            <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name', $fauna->common_name) }}" required>
                            @error('common_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="habitat" class="form-label">Habitat</label>
                            <input type="text" name="habitat" id="habitat" class="form-control @error('habitat') is-invalid @enderror" value="{{ old('habitat', $fauna->habitat) }}">
                            @error('habitat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="diet" class="form-label">Dieta</label>
                            <textarea name="diet" id="diet" class="form-control @error('diet') is-invalid @enderror">{{ old('diet', $fauna->diet) }}</textarea>
                            @error('diet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status" class="form-label">Estado</label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="">Select a status</option>
                                <option value="stable" {{ old('status', $fauna->status) == 'stable' ? 'selected' : '' }}>Estable</option>
                                <option value="critical" {{ old('status', $fauna->status) == 'critical' ? 'selected' : '' }}>Critico</option>
                                <option value="extinct" {{ old('status', $fauna->status) == 'extinct' ? 'selected' : '' }}>Extinguido</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location" class="form-label">Ubicación</label>
                            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $fauna->location) }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Imagen (máx. 5MB)</label>
                            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                            <img id="image-preview" src="#" alt="Vista previa de la imagen">
                            @if ($fauna->image)
                                <img src="{{ asset($fauna->image) }}" alt="{{ $fauna->common_name }}" class="img-thumbnail mt-2" style="max-width: 100px;">
                            @endif
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="btn btn-success">Actualizar Fauna</button>
                        <a href="{{ route('gvff.admin.faunas.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    if (file.size > 5000 * 1024) { // 5000KB limit
                        alert('El archivo excede el tamaño máximo de 5MB.');
                        imageInput.value = '';
                        imagePreview.src = '#';
                        imagePreview.style.display = 'none';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.src = '#';
                    imagePreview.style.display = 'none';
                }
            });
        });
    </script>
@endpush
@endsection