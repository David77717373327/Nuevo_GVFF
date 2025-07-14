@extends('gvff::layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-success">Inventario de Plantas</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm rounded overflow-hidden">
            <thead class="table-success text-center">
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
            <tbody class="text-center">
                @forelse($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->plant->common_name ?? 'No definido' }}</td>
                        <td>{{ $inventory->productive_unit_warehouse->productive_unit->name ?? 'No definido' }}</td>
                        <td>{{ $inventory->productive_unit_warehouse->warehouse->name ?? 'No definido' }}</td>
                        <td>{{ $inventory->description }}</td>
                        <td>{{ $inventory->amount }}</td>
                        <td>
                            @if($inventory->stock < 5)
                                <span class="badge bg-danger">{{ $inventory->stock }}</span>
                            @elseif($inventory->stock < 10)
                                <span class="badge bg-warning text-dark">{{ $inventory->stock }}</span>
                            @else
                                <span class="badge bg-success">{{ $inventory->stock }}</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($inventory->production_date)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">No hay inventario registrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
