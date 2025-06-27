@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2>Registrar Entrada de Inventario de Plantas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('gvff.admin.plant_inventory.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Unidad Productiva - Bodega</label>
            <select name="productive_unit_warehouse_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($productiveUnitWarehouses as $puw)
                    <option value="{{ $puw->id }}">
                        {{ $puw->productive_unit->name }} - {{ $puw->warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>

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
@endsection
