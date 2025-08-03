@extends('gvff::layouts.master')

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

        h2 {
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
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
                    Registrar Entrada de Inventario de Plantas
                </h2>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('gvff.admin.plant_inventory.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Unidad Productiva - Bodega</label>
                            <select name="productive_unit_warehouse_id" class="form-control @error('productive_unit_warehouse_id') is-invalid @enderror" required>
                                <option value="">Seleccione...</option>
                                @foreach($productiveUnitWarehouses as $puw)
                                    <option value="{{ $puw->id }}">
                                        {{ $puw->productive_unit->name }} - {{ $puw->warehouse->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('productive_unit_warehouse_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Planta</label>
                            <select name="plant_id" class="form-control @error('plant_id') is-invalid @enderror" required>
                                @foreach(Modules\GVFF\Entities\Plant::all() as $plant)
                                    <option value="{{ $plant->id }}">{{ $plant->common_name }}</option>
                                @endforeach
                            </select>
                            @error('plant_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror" required>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Fecha de Producción</label>
                            <input type="date" name="production_date" class="form-control @error('production_date') is-invalid @enderror">
                            @error('production_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Tipo de Movimiento</label>
                            <select name="movement_type_id" class="form-control @error('movement_type_id') is-invalid @enderror" required>
                                @foreach($movementTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('movement_type_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit" class="btn btn-success">Registrar Entrada</button>
                        <a href="{{ route('gvff.admin.plant_inventory.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
<<<<<<< HEAD

        <div class="mb-3">
            <label>Planta</label>
            <select name="plant_id" class="form-control" required>
                @foreach(Modules\GVFF\Entities\Plant::all() as $plant)
                    <option value="{{ $plant->id }}">{{ $plant->common_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Cantidad</label>
            <input type="number" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fecha de Producción</label>
            <input type="date" name="production_date" class="form-control">
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Tipo de Movimiento</label>
            <select name="movement_type_id" class="form-control" required>
                @foreach($movementTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Registrar Entrada</button>
    </form>
</div>
=======
    </div>
>>>>>>> ff560a38d36cbddf65f5d63e95146827ec9535e0
@endsection