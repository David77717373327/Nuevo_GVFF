@extends('gvff::layouts.master')

@section('content')

    <style>
        :root {
            --primary-color: #2f4f2f; /* Dark green */
            
            --text-color: #1e293b; /* Dark slate */
            --ornamental-color: #10b981; /* Emerald */
            --medicinal-color: #ef4444; /* Red */
            --forestal-color: #4b5563; /* Gray */
            
            
        }

        .form-section {
            min-height: 100vh;
            background: var(--background-gradient);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .form-section .leaf {
            position: absolute;
            width: 24px;
            height: 24px;
            background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
            background-size: contain;
            animation: float 12s infinite ease-in-out;
            opacity: 0.3;
        }

        .form-section .leaf1 { top: 15%; left: 5%; animation-delay: 0s; }
        .form-section .leaf2 { top: 40%; left: 85%; animation-delay: 3s; }
        .form-section .leaf3 { top: 70%; left: 15%; animation-delay: 6s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(120px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        .animate__fadeIn {
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            color: var(--text-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control, .form-control-file {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus, .form-control-file:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 5px rgba(132, 204, 22, 0.3);
        }

        .form-control.is-invalid {
            border-color: var(--medicinal-color);
        }

        .invalid-feedback {
            color: var(--medicinal-color);
            font-size: 0.875rem;
        }

        .form-group select, .form-group textarea {
            width: 100%;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        

        #image-preview {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
            display: none;
            margin-top: 1rem;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }

        #plant-type-message {
            color: var(--text-color);
            font-weight: 500;
        }

        .form-group select#plant_type option[value="ornamental"] {
            color: var(--ornamental-color);
        }
        .form-group select#plant_type option[value="medicinal"] {
            color: var(--medicinal-color);
        }
        .form-group select#plant_type option[value="forestal"] {
            color: var(--forestal-color);
        }
        .form-group select#plant_type option[value="venta"] {
            color: var(--venta-color);
        }

        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="form-section" data-aos="fade-up">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container" data-aos="zoom-in">
                <h1 class="text-3xl md:text-4xl font-bold text-[var(--accent-color)] text-center mb-6 animate__animated animate__fadeIn">
                    Crear Planta
                </h1>
                <form action="{{ route('gvff.admin.plants.store') }}" method="POST" enctype="multipart/form-data" id="plant-form">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="nurseries_id">Vivero</label>
                            <select name="nurseries_id" id="nurseries_id" class="form-control @error('nurseries_id') is-invalid @enderror" required>
                                <option value="">Seleccione un vivero</option>
                                @foreach ($nurseries as $nursery)
                                    <option value="{{ $nursery->id }}" {{ old('nurseries_id') == $nursery->id ? 'selected' : '' }}>{{ $nursery->name }}</option>
                                @endforeach
                            </select>
                            @error('nurseries_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="common_name">Nombre Común</label>
                            <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name') }}" required>
                            @error('common_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="scientific_name">Nombre Científico</label>
                            <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name') }}" required>
                            @error('scientific_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="plant_type">Tipo de Planta</label>
                            <select name="plant_type" id="plant_type" class="form-control @error('plant_type') is-invalid @enderror" required>
                                <option value="">Seleccione un tipo</option>
                                <option value="ornamental" {{ old('plant_type') == 'ornamental' ? 'selected' : '' }}>Ornamental</option>
                                <option value="forestal" {{ old('plant_type') == 'forestal' ? 'selected' : '' }}>Forestal</option>
                                <option value="medicinal" {{ old('plant_type') == 'medicinal' ? 'selected' : '' }}>Medicinal</option>
                                <option value="venta" {{ old('plant_type') == 'venta' ? 'selected' : '' }}>Venta</option>
                            </select>
                            @error('plant_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="plant-type-message" class="mt-2 text-info"></div>
                        </div>
                        <div class="form-group" id="price-field" style="display: none;">
                            <label for="price">Precio</label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" step="0.01" min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="structure_type">Tipo de Estructura</label>
                            <select name="structure_type" id="structure_type" class="form-control @error('structure_type') is-invalid @enderror">
                                <option value="">Seleccione un tipo</option>
                                <option value="tree" {{ old('structure_type') == 'tree' ? 'selected' : '' }}>Árbol</option>
                                <option value="shrub" {{ old('structure_type') == 'shrub' ? 'selected' : '' }}>Arbusto</option>
                                <option value="herb" {{ old('structure_type') == 'herb' ? 'selected' : '' }}>Hierba</option>
                            </select>
                            @error('structure_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="family">Familia</label>
                            <input type="text" name="family" id="family" class="form-control @error('family') is-invalid @enderror" value="{{ old('family') }}">
                            @error('family')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="characteristics">Características</label>
                            <textarea name="characteristics" id="characteristics" class="form-control @error('characteristics') is-invalid @enderror">{{ old('characteristics') }}</textarea>
                            @error('characteristics')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="benefits">Beneficios</label>
                            <textarea name="benefits" id="benefits" class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits') }}</textarea>
                            @error('benefits')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="properties">Propiedades</label>
                            <textarea name="properties" id="properties" class="form-control @error('properties') is-invalid @enderror">{{ old('properties') }}</textarea>
                            @error('properties')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="traditional_uses">Usos Tradicionales</label>
                            <textarea name="traditional_uses" id="traditional_uses" class="form-control @error('traditional_uses') is-invalid @enderror">{{ old('traditional_uses') }}</textarea>
                            @error('traditional_uses')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Estado</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="">Seleccione un estado</option>
                                <option value="healthy" {{ old('status') == 'healthy' ? 'selected' : '' }}>Saludable</option>
                                <option value="endangered" {{ old('status') == 'endangered' ? 'selected' : '' }}>En peligro</option>
                                <option value="critical" {{ old('status') == 'critical' ? 'selected' : '' }}>Crítico</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inventory">Inventario</label>
                            <input type="number" name="inventory" id="inventory" class="form-control @error('inventory') is-invalid @enderror" value="{{ old('inventory', 0) }}" required>
                            @error('inventory')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="location">Ubicación</label>
                            <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen (máx. 5MB)</label>
                            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg">
                            <img id="image-preview" src="#" alt="Vista previa de la imagen" style="display: none;">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="available">Disponible</label>
                            <input type="checkbox" name="available" id="available" value="1" {{ old('available', 1) ? 'checked' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="observations">Observaciones</label>
                            <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror">{{ old('observations') }}</textarea>
                            @error('observations')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="btn btn-success">Crear Planta</button>
                        <a href="{{ route('gvff.admin.plants.index') }}" class="btn btn-secondary ml-2">Cancelar</a>
                    </div>
                </form>
            </div>
            <!-- Hojas flotantes decorativas -->
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>
    </div>

@push('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });

        document.addEventListener('DOMContentLoaded', function () {
            const plantTypeSelect = document.getElementById('plant_type');
            const priceField = document.getElementById('price-field');
            const priceInput = document.getElementById('price');
            const plantTypeMessage = document.getElementById('plant-type-message');
            const imageInput = document.getElementById('image');
            const imagePreview = document.getElementById('image-preview');

            // Color mapping for plant types
            const typeColors = {
                'ornamental': '#10b981',
                'medicinal': '#ef4444',
                'forestal': '#4b5563',
                'venta': '#84cc16'
            };

            function updateFormState() {
                const selectedType = plantTypeSelect.value;
                console.log('Tipo de planta seleccionado:', selectedType);

                // Show/hide price field
                if (selectedType === 'venta') {
                    priceField.style.display = 'block';
                    priceInput.setAttribute('required', 'required');
                } else {
                    priceField.style.display = 'none';
                    priceInput.removeAttribute('required');
                    priceInput.value = '';
                }

                // Update message with color
                const typeLabels = {
                    'ornamental': 'Ornamental',
                    'forestal': 'Forestal',
                    'medicinal': 'Medicinal',
                    'venta': 'Venta'
                };
                plantTypeMessage.textContent = selectedType ? `Tipo seleccionado: ${typeLabels[selectedType] || 'Desconocido'}` : '';
                plantTypeMessage.style.color = typeColors[selectedType] || '#1e293b';
            }

            // Image preview with size validation
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

            // Initialize form state
            updateFormState();

            // Listen for plant type changes
            plantTypeSelect.addEventListener('change', updateFormState);
        });
    </script>
@endpush
@endsection