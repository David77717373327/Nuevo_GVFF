@extends('gvff::layouts.master')

@section('content')
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
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .filter-section {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: var(--text-color);
        }

        .form-control,
        .form-select {
            width: 100%;
            max-width: 200px;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--success-color);
            box-shadow: 0 0 5px rgba(25, 135, 84, 0.3);
        }

        #history-table {
            border-collapse: separate !important;
            border-spacing: 0 12px !important;
            background: transparent;
        }

        #history-table th {
            background: #e9f7ef;
            border: none !important;
            color: var(--success-color);
            font-weight: 600;
            text-align: center;
        }

        #history-table td {
            background: #fff;
            border: none !important;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.07);
            border-radius: 12px;
            vertical-align: middle !important;
            text-align: center;
        }

        #history-table tbody tr {
            transition: box-shadow 0.2s, transform 0.2s;
        }

        #history-table tbody tr:hover {
            box-shadow: 0 4px 16px rgba(25, 135, 84, 0.12);
            transform: translateY(-2px) scale(1.01);
            background: #f6fff9 !important;
        }

        .detail-row table {
            border-collapse: separate !important;
            border-spacing: 0 6px !important;
            background: transparent;
        }

        .detail-row table th {
            background: #e9f7ef;
            border: none !important;
            color: var(--success-color);
            font-weight: 600;
            text-align: center;
        }

        .detail-row table td {
            background: #fff;
            border: none !important;
            box-shadow: 0 2px 8px rgba(25, 135, 84, 0.07);
            border-radius: 6px;
            vertical-align: middle !important;
            text-align: center;
        }

        .btn-success {
            background: var(--success-color);
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
            border: none;
        }

        .btn-success:hover {
            background: var(--success-color);
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

        .alert-danger {
            background-color: #f8d7da;
            color: var(--danger-color);
            border: 1px solid #f5c6cb;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        h2 {
            color: var(--success-color);
            /* Fixed to match the green theme */
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }

            #history-table th,
            #history-table td {
                font-size: 0.875rem;
            }

            .detail-row table th,
            .detail-row table td {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="form-section">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-6 animate__animated animate__fadeIn">
                    Historial de Movimientos de Inventario
                </h2>

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="filter-section">
                    <label for="filterType" class="form-label">Filtrar por Tipo de Movimiento:</label>
                    <select id="filterType" class="form-select">
                        <option value="">Mostrar Todos</option>
                        <option value="Movimiento Entrada">Entradas</option>
                        <option value="Venta">Ventas</option>
                    </select>
                </div>

                <div class="table-responsive">
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
                                            $bodega =
                                                $movement->warehouse_movements->firstWhere('role', 'Entrega') ??
                                                $movement->warehouse_movements->firstWhere('role', 'Recibe');
                                        @endphp
                                        {{ $bodega?->productive_unit_warehouse?->productive_unit?->name . ' - ' . $bodega?->productive_unit_warehouse?->warehouse?->name ?? 'N/A' }}
                                    </td>
                                    <td>
                                        @php
                                            $entrega = $movement->movement_responsibilities->firstWhere(
                                                'role',
                                                'ENTREGA',
                                            );
                                        @endphp
                                        {{ $entrega ? $entrega->person->first_name : 'N/A' }}
                                    </td>
                                    <td>
                                        @php
                                            $recibe = $movement->movement_responsibilities->firstWhere(
                                                'role',
                                                'RECIBE',
                                            );
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
                                                @foreach ($movement->movement_detail_plants as $detail)
                                                    <tr>
                                                        <td>{{ $detail->plant_inventory->plant->common_name ?? 'Sin Nombre' }}
                                                        </td>
                                                        <td>{{ $detail->amount }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No se encontraron movimientos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-toggle-detail').on('click', function() {
            const id = $(this).data('id');
            $('#detail-' + id).toggle();
        });

        $('#filterType').on('change', function() {
            const filter = $(this).val();
            $('.movement-row').each(function() {
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
