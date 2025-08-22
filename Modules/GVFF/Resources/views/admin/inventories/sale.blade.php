
@extends('gvff::layouts.master')

@section('content')
<!-- DataTables CSS (Bootstrap 5) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
    :root {
        --primary-color: #2f4f2f;
        --text-color: #1e293b;
        --success-color: #198754;
        --danger-color: #dc3545;
    }

    .form-section {
        min-height: 100vh;
        padding: 3rem 0;
        background: #f8fafc;
        position: relative;
    }

    .form-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        position: relative;
        z-index: 1;
    }

    h2 {
        color: var(--success-color);
        font-weight: 700;
    }

    .table {
        border-collapse: separate !important;
        border-spacing: 0 12px !important;
        background: transparent;
    }

    .table th {
        background: #e9f7ef;
        border: none !important;
        color: var(--success-color);
        font-weight: 600;
        text-align: center;
        padding: 0.75rem;
    }

    .table td {
        background: #fff;
        border: none !important;
        box-shadow: 0 2px 8px rgba(25,135,84,0.07);
        border-radius: 12px;
        vertical-align: middle !important;
        text-align: center;
        padding: 0.75rem;
    }

    .table tbody tr {
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .table tbody tr:hover {
        box-shadow: 0 4px 16px rgba(25,135,84,0.12);
        transform: translateY(-2px) scale(1.01);
        background: #f6fff9 !important;
    }

    .form-control {
        border-radius: 6px;
        border: 1px solid #ced4da;
        padding: 0.5rem 1rem;
    }

    .btn-success {
        background-color: var(--success-color) !important;
        color: #fff !important;
        border: none !important;
        padding: 0.5rem 1rem;
        border-radius: 6px;
    }

    .btn-success:hover {
        background-color: #145c32 !important;
    }

    .btn-secondary {
        background-color: #6c757d !important;
        color: #fff !important;
        border: none !important;
        padding: 0.5rem 1rem;
        border-radius: 6px;
    }

    .btn-secondary:hover {
        background-color: #5a6268 !important;
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
        background-color: #f8d7da;
        color: var(--danger-color);
        border: 1px solid #f5c6cb;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1.5rem;
        text-align: center;
    }

    #plantsSection, #clientInfo {
        margin-top: 1.5rem;
        padding: 1rem;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .leaf {
        position: absolute;
        background: url('https://www.transparentpng.com/thumb/leaf/leaf-png-11.png') no-repeat;
        background-size: contain;
        width: 50px;
        height: 50px;
        z-index: 0;
    }

    .leaf1 { top: 10%; left: 5%; }
    .leaf2 { top: 50%; right: 5%; }
    .leaf3 { bottom: 10%; left: 10%; }

    @media (max-width: 768px) {
        .form-container {
            padding: 1rem;
        }
        .table th,
        .table td {
            font-size: 0.875rem;
            padding: 0.5rem;
        }
        .form-control {
            font-size: 0.875rem;
        }
        .btn-success, .btn-secondary {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }
        .leaf {
            width: 30px;
            height: 30px;
        }
    }
</style>

<div class="form-section" data-aos="fade-up">
    <div class="container mx-auto px-6 py-16">
        <div class="form-container" data-aos="zoom-in">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
                Venta de Plantas
            </h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <form action="{{ route('gvff.admin.plant_inventory.sale.store') }}" method="POST" id="saleForm">
                @csrf
                
                <div class="mb-3">
                    <label for="productive_unit_warehouse_id" class="form-label">Selecciona la Bodega</label>
                    <select name="productive_unit_warehouse_id" id="productive_unit_warehouse_id" class="form-control" required>
                        <option value="">Seleccione...</option>
                        @foreach($warehouses as $bodega)
                            <option value="{{ $bodega->id }}">
                                {{ $bodega->productive_unit->name }} - {{ $bodega->warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="plantsSection">
                    <h4 class="text-lg font-semibold mb-3">Agregar Plantas a la Venta</h4>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="plant_select" class="form-label">Seleccione Planta</label>
                            <select id="plant_select" class="form-control" disabled>
                                <option value="">Seleccione una bodega primero...</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Disponible</label>
                            <input type="text" id="plant_amount" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Precio Unitario</label>
                            <input type="text" id="plant_price" class="form-control" readonly>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Cantidad a Vender</label>
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
                                <th>Precio Unitario</th>
                                <th>Cantidad a Vender</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="saleTable">
                            <!-- Plantas agregadas -->
                        </tbody>
                    </table>

                    <div class="mt-3">
                        <h4 class="text-lg font-semibold"><strong>Total de la Venta:</strong> <span id="totalPrice">0</span></h4>
                        <input type="hidden" name="total_price" id="total_price_input">
                    </div>

                    <h4 class="mt-4 text-lg font-semibold">Datos del Cliente</h4>
                    <div class="mb-3">
                        <label for="document_number" class="form-label">Número de Documento del Cliente</label>
                        <input type="text" id="document_number" class="form-control" required>
                    </div>

                    <div id="clientInfo" style="display:none;">
                        <p class="mb-2"><strong>Cliente:</strong> <span id="clientName"></span></p>
                        <input type="hidden" name="client_id" id="client_id">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <button type="button" class="btn btn-secondary w-100" id="searchPerson">Buscar Cliente</button>
                        </div>
                        <div class="col-md-6 mb-3">
                            <button type="submit" class="btn btn-success w-100">Registrar Venta</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="leaf leaf1"></div>
        <div class="leaf leaf2"></div>
        <div class="leaf leaf3"></div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let availablePlants = {};

function updateTotalPrice() {
    let total = 0;
    $('#saleTable tr').each(function() {
        const quantity = parseFloat($(this).find('input[name^="plants"]').val()) || 0;
        const price = parseFloat($(this).find('.subtotal').data('price')) || 0;
        const subtotal = quantity * price;
        $(this).find('.subtotal').text(subtotal.toFixed(2));
        total += subtotal;
    });
    $('#totalPrice').text(total.toFixed(2));
    $('#total_price_input').val(total.toFixed(2));
}

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
                        $('#plant_select').prop('disabled', false);
                    } else {
                        alert('No hay plantas disponibles en esta bodega.');
                        $('#plant_select').prop('disabled', true).val('').append('<option value="">No hay plantas disponibles</option>');
                    }
                },
                error: function () {
                    alert('Error al cargar las plantas.');
                    $('#plant_select').prop('disabled', true).val('').append('<option value="">Error al cargar</option>');
                }
            });
        } else {
            $('#plant_select').prop('disabled', true).empty().append('<option value="">Seleccione una bodega primero...</option>');
            availablePlants = {};
        }
    });

    $('#plant_select').on('change', function () {
        const plantId = $(this).val();
        if (plantId && availablePlants[plantId]) {
            const plantData = availablePlants[plantId];
            $('#plant_amount').val(plantData.amount);
            $('#plant_price').val(parseFloat(plantData.price || 0).toFixed(2));
        } else {
            $('#plant_amount').val('');
            $('#plant_price').val('');
        }
    });

    $('#addPlant').on('click', function () {
        const plantId = $('#plant_select').val();
        const plantName = $('#plant_select option:selected').text();
        const amount = parseInt($('#plant_amount').val());
        const price = parseFloat(availablePlants[plantId]?.price) || 0;
        const quantity = parseInt($('#plant_quantity').val());

        if (!plantId || quantity <= 0 || quantity > amount || !availablePlants[plantId]) {
            alert('La cantidad solicitada no puede ser mayor a la disponible.');
            return;
        }

        if ($(`#row_${plantId}`).length > 0) {
            alert('Esta planta ya fue agregada.');
            return;
        }

        const subtotal = (quantity * price).toFixed(2);

        $('#saleTable').append(`
            <tr id="row_${plantId}">
                <td>${plantName}</td>
                <td>${amount}</td>
                <td>${price.toFixed(2)}</td>
                <td>
                    <input type="number" name="plants[${plantId}]" class="form-control plant-quantity" value="${quantity}" min="1" max="${amount}" required>
                </td>
                <td class="subtotal" data-price="${price}">${subtotal}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-plant" data-id="${plantId}">Eliminar</button>
                </td>
            </tr>
        `);

        updateTotalPrice();

        $('#plant_select').val('');
        $('#plant_stock').val('');
        $('#plant_price').val('');
        $('#plant_quantity').val('');
    });

    $(document).on('click', '.remove-plant', function () {
        const plantId = $(this).data('id');
        $(`#row_${plantId}`).remove();
        updateTotalPrice();
    });

    $(document).on('change', '.plant-quantity', function () {
        const quantity = parseInt($(this).val());
        const max = parseInt($(this).attr('max'));
        if (quantity < 1 || quantity > max) {
            alert('Cantidad inválida.');
            $(this).val(1);
        }
        updateTotalPrice();
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
<<<<<<< HEAD
@endsection
=======



@endsection

>>>>>>> 5f26a60a962c70528d5158c774b951d3151c48a1
