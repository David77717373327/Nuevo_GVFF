@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Historial de Movimientos de Inventario</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="mb-3">
        <label for="filterType">Filtrar por Tipo de Movimiento:</label>
        <select id="filterType" class="form-control" style="max-width: 200px;">
            <option value="">Mostrar Todos</option>
            <option value="Movimiento Entrada">Entradas</option>
            <option value="Venta">Ventas</option>
        </select> 
    </div>

    <table class="table table-striped" border="1" width="100%" cellpadding="5" id="history">
        <thead>
            <tr>
                <th>Comprobante</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Bodega</th>
                <th>Responsable Entrega</th>
                <th>Responsable Recibe</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movements as $movement)
                <tr class="movement-row" data-type="{{ $movement->movement_type->name }}">
                    <td>{{ $movement->voucher_number }}</td>
                    <td>{{ \Carbon\Carbon::parse($movement->registration_date)->format('d/m/Y H:i') }}</td>
                    <td>{{ $movement->movement_type->name }}</td>
                    <td>
                        @php
                            $bodega = $movement->warehouse_movements->firstWhere('role', 'Entrega') 
                                    ?? $movement->warehouse_movements->firstWhere('role', 'Recibe');
                        @endphp
                        {{ $bodega?->productive_unit_warehouse?->productive_unit?->name . ' - ' . $bodega?->productive_unit_warehouse?->warehouse?->name ?? 'N/A' }}
                    </td>
                    <td>
                        @php
                            $entrega = $movement->movement_responsibilities->firstWhere('role', 'ENTREGA');
                        @endphp
                        {{ $entrega ? $entrega->person->first_name : 'N/A' }}
                    </td>
                    <td>
                        @php
                            $recibe = $movement->movement_responsibilities->firstWhere('role', 'RECIBE');
                        @endphp
                        {{ $recibe ? $recibe->person->first_name : 'N/A' }}
                    </td>
                    <td>
                        <button class="btn btn-success btn-toggle-detail" data-id="{{ $movement->id }}">
                            Ver Detalle
                        </button>
                    </td>
                </tr>

                <tr class="detail-row" id="detail-{{ $movement->id }}" style="display:none;">
                    <td colspan="7">
                        <table class="table table-bordered" width="100%" cellpadding="5">
                            <thead>
                                <tr>
                                    <th>Planta</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($movement->movement_detail_plants as $detail)
                                    <tr>
                                        <td>{{ $detail->plant_inventory->plant->common_name ?? 'Sin Nombre' }}</td>
                                        <td>{{ $detail->amount }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7">No se encontraron movimientos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {

    $('.btn-toggle-detail').on('click', function () {
        const id = $(this).data('id');
        $('#detail-' + id).toggle();
    });

    $('#filterType').on('change', function () {
        const filter = $(this).val();   
        $('.movement-row').each(function () {
            const type = $(this).data('type');
            
            if (filter === '') {
                $(this).show();
                $('#detail-' + $(this).find('.btn-toggle-detail').data('id')).hide();
            } else if (type === filter) {
                $(this).show();
            } else {
                $(this).hide();
                $('#detail-' + $(this).find('.btn-toggle-detail').data('id')).hide();
            }
        });
    });

});
</script>

