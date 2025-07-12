@extends('gvff::layouts.master')

@section('content')
    <style>
        :root {
            --primary-color: #2f4f2f;
            --accent-color:#066243;
            --text-color: #1e293b;
            --ornamental-color: #10b981;
            --medicinal-color: #ef4444;
            --forestal-color: #4b5563;
            
            
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
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--accent-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            animation: fadeIn 1.2s ease-in-out;
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

        .btn-primary {
            background: var(--accent-color);
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

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
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

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
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

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
            .form-control {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="form-section" data-aos="fade-up">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container" data-aos="zoom-in">
                <h1 class="text-3xl md:text-4xl font-bold text-[var(--accent-color)] text-center mb-6 animate__animated animate__fadeIn">
                    Editar Planta
                </h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('gvff.admin.plants.update', $plants) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nurseries_id">Vivero</label>
                        <select name="nurseries_id" id="nurseries_id" class="form-control @error('nurseries_id') is-invalid @enderror" required>
                            <option value="">Seleccione un vivero</option>
                            @foreach ($nurseries as $nursery)
                                <option value="{{ $nursery->id }}" {{ old('nurseries_id', $plants->nurseries_id) == $nursery->id ? 'selected' : '' }}>{{ $nursery->name }}</option>
                            @endforeach
                        </select>
                        @error('nurseries_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="common_name">Nombre Común</label>
                        <input type="text" name="common_name" id="common_name" class="form-control @error('common_name') is-invalid @enderror" value="{{ old('common_name', $plants->common_name) }}" required>
                        @error('common_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="scientific_name">Nombre Científico</label>
                        <input type="text" name="scientific_name" id="scientific_name" class="form-control @error('scientific_name') is-invalid @enderror" value="{{ old('scientific_name', $plants->scientific_name) }}" required>
                        @error('scientific_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="plant_type">Tipo de Planta</label>
                        <select name="plant_type" id="plant_type" class="form-control @error('plant_type') is-invalid @enderror" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="ornamental" {{ old('plant_type', $plants->plant_type) == 'ornamental' ? 'selected' : '' }}>Ornamental</option>
                            <option value="forestal" {{ old('plant_type', $plants->plant_type) == 'forestal' ? 'selected' : '' }}>Forestal</option>
                            <option value="medicinal" {{ old('plant_type', $plants->plant_type) == 'medicinal' ? 'selected' : '' }}>Medicinal</option>
                            <option value="venta" {{ old('plant_type', $plants->plant_type) == 'venta' ? 'selected' : '' }}>Venta</option>
                        </select>
                        @error('plant_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="structure_type">Tipo de Estructura</label>
                        <select name="structure_type" id="structure_type" class="form-control @error('structure_type') is-invalid @enderror">
                            <option value="">Seleccione un tipo</option>
                            <option value="tree" {{ old('structure_type', $plants->structure_type) == 'tree' ? 'selected' : '' }}>Árbol</option>
                            <option value="shrub" {{ old('structure_type', $plants->structure_type) == 'shrub' ? 'selected' : '' }}>Arbusto</option>
                            <option value="herb" {{ old('structure_type', $plants->structure_type) == 'herb' ? 'selected' : '' }}>Hierba</option>
                        </select>
                        @error('structure_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="family">Familia</label>
                        <input type="text" name="family" id="family" class="form-control @error('family') is-invalid @enderror" value="{{ old('family', $plants->family) }}">
                        @error('family')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="characteristics">Características</label>
                        <textarea name="characteristics" id="characteristics" class="form-control @error('characteristics') is-invalid @enderror">{{ old('characteristics', $plants->characteristics) }}</textarea>
                        @error('characteristics')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="benefits">Beneficios</label>
                        <textarea name="benefits" id="benefits" class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits', $plants->benefits) }}</textarea>
                        @error('benefits')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="properties">Propiedades</label>
                        <textarea name="properties" id="properties" class="form-control @error('properties') is-invalid @enderror">{{ old('properties', $plants->properties) }}</textarea>
                        @error('properties')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="traditional_uses">Usos Tradicionales</label>
                        <textarea name="traditional_uses" id="traditional_uses" class="form-control @error('traditional_uses') is-invalid @enderror">{{ old('traditional_uses', $plants->traditional_uses) }}</textarea>
                        @error('traditional_uses')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">Seleccione un estado</option>
                            <option value="healthy" {{ old('status', $plants->status) == 'healthy' ? 'selected' : '' }}>Saludable</option>
                            <option value="endangered" {{ old('status', $plants->status) == 'endangered' ? 'selected' : '' }}>En peligro</option>
                            <option value="critical" {{ old('status', $plants->status) == 'critical' ? 'selected' : '' }}>Crítico</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="inventory">Inventario</label>
                        <input type="number" name="inventory" id="inventory" class="form-control @error('inventory') is-invalid @enderror" value="{{ old('inventory', $plants->inventory) }}" required>
                        @error('inventory')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if($plants->plant_type == 'venta')
                        <div class="form-group">
                            <label for="price">Precio</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plants->price) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message}}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="location">Ubicación</label>
                        <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location', $plants->location) }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image">Imagen</label>
                        <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                        @if ($plants->image)
                            <img src="{{ asset($plants->image) }}" alt="{{ $plants->common_name }}" width="100" class="mt-2">
                        @endif
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="available">Disponible</label>
                        <input type="hidden" name="available" value="0">
                        <input type="checkbox" name="available" id="available" value="1" {{ old('available', $plants->available) ? 'checked' : '' }}>
                    </div>
                    <div class="form-group">
                        <label for="observations">Observaciones</label>
                        <textarea name="observations" id="observations" class="form-control @error('observations') is-invalid @enderror">{{ old('observations', $plants->observations) }}</textarea>
                        @error('observations')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Actualizar Planta</button>
                    <a href="{{ route('gvff.admin.plants.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
            <!-- Floating decorative leaves -->
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>
    </div>
@endsection