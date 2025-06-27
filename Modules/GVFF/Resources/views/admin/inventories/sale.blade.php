@extends('gvff::layouts.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Venta de Plantas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('gvff.admin.plant_inventory.sale.store') }}" method="POST" id="saleForm">
        @csrf

        <div class="mb-3">
            <label for="productive_unit_warehouse_id">Selecciona la Bodega</label>
            <select name="productive_unit_warehouse_id" id="productive_unit_warehouse_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($warehouses as $bodega)
                    <option value="{{ $bodega->id }}">
                        {{ $bodega->productive_unit->name }} - {{ $bodega->warehouse->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div id="plantsSection" style="display:none;">
            <h4>Agregar Plantas a la Venta</h4>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="plant_select">Seleccione Planta</label>
                    <select id="plant_select" class="form-control">
                        <option value="">Seleccione...</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Disponible</label>
                    <input type="text" id="plant_stock" class="form-control" readonly>
                </div>
                <div class="col-md-2">
                    <label>Cantidad a Vender</label>
                    <input type="number" id="plant_quantity" class="form-control" min="1">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-success" id="addPlant">Agregar</button>
                </div>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Planta</th>
                        <th>Cantidad Disponible</th>
                        <th>Cantidad a Vender</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="saleTable">
                    <!-- Plantas agregadas -->
                </tbody>
            </table>

            <h4 class="mt-4">Datos del Cliente</h4>
            <div class="mb-3">
                <label for="document_number">Número de Documento del Cliente</label>
                <input type="text" id="document_number" class="form-control" required>
                <button type="button" class="btn btn-secondary mt-2" id="searchPerson">Buscar Cliente</button>
            </div>

            <div id="clientInfo" style="display:none;">
                <p><strong>Cliente:</strong> <span id="clientName"></span></p>
                <input type="hidden" name="client_id" id="client_id">
            </div>

            <button type="submit" class="btn btn-primary mt-3">Registrar Venta</button>
        </div>
    </form>
</div>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let availablePlants = {};

$(document).ready(function () {

    $('#productive_unit_warehouse_id').on('change', function () {
        const warehouseId = $(this).val();
        if (warehouseId) {
            $.ajax({
                url: `/gvff/admin/plant_inventory/sale/get_plants/${warehouseId}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#plant_select').empty().append('<option value="">Seleccione...</option>');
                    availablePlants = {};

                    if (data.length > 0) {
                        data.forEach(function (item) {
                            $('#plant_select').append(`<option value="${item.id}">${item.plant_name}</option>`);
                            availablePlants[item.id] = item;
                        });
                        $('#plantsSection').show();
                    } else {
                        alert('No hay plantas disponibles en esta bodega.');
                        $('#plantsSection').hide();
                    }
                },
                error: function () {
                    alert('Error al cargar las plantas.');
                }
            });
        } else {
            $('#plantsSection').hide();
        }
    });

    $('#plant_select').on('change', function () {
        const plantId = $(this).val();
        if (plantId && availablePlants[plantId]) {
            $('#plant_stock').val(availablePlants[plantId].amount);
        } else {
            $('#plant_stock').val('');
        }
    });

    $('#addPlant').on('click', function () {
        const plantId = $('#plant_select').val();
        const plantName = $('#plant_select option:selected').text();
        const stock = parseInt($('#plant_stock').val());
        const quantity = parseInt($('#plant_quantity').val());

        if (!plantId || quantity <= 0 || quantity > stock) {
            alert('Verifique la selección y la cantidad.');
            return;
        }

        if ($(`#row_${plantId}`).length > 0) {
            alert('Esta planta ya fue agregada.');
            return;
        }

        $('#saleTable').append(`
            <tr id="row_${plantId}">
                <td>${plantName}</td>
                <td>${stock}</td>
                <td>
                    <input type="number" name="plants[${plantId}]" class="form-control" value="${quantity}" min="1" max="${stock}" required>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" onclick="$('#row_${plantId}').remove();">Eliminar</button>
                </td>
            </tr>
        `);

        $('#plant_select').val('');
        $('#plant_stock').val('');
        $('#plant_quantity').val('');
    });

    $('#searchPerson').on('click', function () {
        const doc = $('#document_number').val();
        if (doc) {
            $.ajax({
                url: `/gvff/admin/plant_inventory/sale/search/${doc}`,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.id) {
                        $('#clientInfo').show();
                        $('#clientName').text(data.name);
                        $('#client_id').val(data.id);
                    } else {
                        alert('Cliente no encontrado.');
                        $('#clientInfo').hide();
                    }
                },
                error: function () {
                    alert('Error al buscar el cliente.');
                }
            });
        }
    });

});
</script>
