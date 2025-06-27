@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Inventario de Plantas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Planta</th>
                <th>Unidad Productiva</th>
                <th>Bodega</th>
                <th>Descripción</th>
                <th>Cantidad Registrada</th>
                <th>Stock Actual</th>
                <th>Fecha de Producción</th>
            </tr>
        </thead>
        <tbody>
            @forelse($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->id }}</td>
                    <td>{{ $inventory->plant->common_name ?? 'No definido' }}</td>
                    <td>{{ $inventory->productive_unit_warehouse->productive_unit->name ?? 'No definido' }}</td>
                    <td>{{ $inventory->productive_unit_warehouse->warehouse->name ?? 'No definido' }}</td>
                    <td>{{ $inventory->description }}</td>
                    <td>{{ $inventory->amount }}</td>
                    <td>{{ $inventory->stock }}</td>
                    <td>{{ $inventory->production_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay inventario registrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
