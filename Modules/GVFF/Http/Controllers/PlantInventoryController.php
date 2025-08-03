<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\GVFF\Entities\MovementDetailPlant;
use Modules\GVFF\Entities\PlantInventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\WarehouseMovement;

class PlantInventoryController extends Controller
{
    public function index()
    {
        $inventories = PlantInventory::where('amount','>', 0)->with([
            'plant',
            'productive_unit_warehouse.productive_unit',
            'productive_unit_warehouse.warehouse'
        ])->orderBy('id', 'desc')->get();

        return view('gvff::admin.inventories.index', compact('inventories'));
    }

    public function entrance()
    {
        $productiveUnitWarehouses = ProductiveUnitWarehouse::with(['productive_unit', 'warehouse'])
            ->whereHas('productive_unit', function ($query) {
                $query->where('id', 18);
            })->first();
        $movementTypes = MovementType::where('name', 'Movimiento Entrada')->get();

        return view('gvff::admin.inventories.entrance', compact('productiveUnitWarehouses', 'movementTypes'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'productive_unit_warehouse_id' => 'required|exists:productive_unit_warehouses,id',
            'plant_id' => 'required|exists:plants,id',
            'amount' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
            'production_date' => 'nullable|date',
            'movement_type_id' => 'required|exists:movement_types,id',
        ]);

        DB::beginTransaction();

        try {

            // Crear movimiento de entrada
            $movement = Movement::create([
                'registration_date' => now(),
                'movement_type_id' => $request->movement_type_id,
                'voucher_number' => time(),
                'price' => 0,
                'observation' => 'Entrada de inventario de plantas',
                'state' => 'APROBADO',
            ]);

            // Registrar la bodega que recibe
            WarehouseMovement::create([
                'productive_unit_warehouse_id' => $request->productive_unit_warehouse_id,
                'movement_id' => $movement->id,
                'role' => 'RECIBE',
            ]);

            // Registrar responsable del movimiento
            MovementResponsibility::create([
                'person_id' => Auth::user()->person_id,
                'movement_id' => $movement->id,
                'role' => 'RECIBE',
                'date' => now(),
            ]);

            $plant_inventory = PlantInventory::where('plant_id', $request->plant_id)
                ->where('productive_unit_warehouse_id', $request->productive_unit_warehouse_id)
                ->where('production_date', $request->production_date)
                ->first();


            if ($plant_inventory) {
                // Si ya existe un inventario para esta planta, actualizarlo
                $plant_inventory->update([
                    'amount' => $plant_inventory->amount + $request->amount,
                    'stock' => $request->stock,
                ]);

            } else {
                // Si no existe, crear un nuevo inventario
                // Crear inventario de plantas
                $plant_inventory = PlantInventory::create([
                    'person_id' => Auth::user()->person_id,
                    'productive_unit_warehouse_id' => $request->productive_unit_warehouse_id,
                    'plant_id' => $request->plant_id,
                    'description' => $request->description,
                    'amount' => $request->amount,
                    'stock' => $request->stock,
                    'production_date' => $request->production_date,
                ]);
            }

            $plant_inventory->save();

            // Registrar detalle del movimiento
            MovementDetailPlant::create([
                'plant_inventory_id' => $plant_inventory->id,
                'movement_id' => $movement->id,
                'amount' => $request->amount,
                'price' => 0,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Entrada de inventario registrada correctamente.');
        } catch (\Exception $e) {

            DB::rollBack();

            Log::error('Error al registrar la entrada de inventario: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Ocurrió un error al registrar la entrada. Por favor, intente nuevamente.');
        }
    }

    public function sale()
    {
        $warehouses = ProductiveUnitWarehouse::with(['productive_unit', 'warehouse'])
            ->whereHas('productive_unit', function ($query) {
                $query->where('id', 18); // Filtra por Viveros Frutales (id 18)
            })->get();
        return view('gvff::admin.inventories.sale', compact('warehouses'));
    }

    /**
     * Traer las plantas disponibles en la bodega (AJAX)
     */
    public function getPlantsByWarehouse($warehouseId)
    {
        $plants = PlantInventory::selectRaw('plant_id, SUM(amount) as total_amount')
            ->with('plant') // Esto no funciona directamente con groupBy, se debe ajustar
            ->where('productive_unit_warehouse_id', $warehouseId)
            ->groupBy('plant_id')
            ->get();

        return response()->json($plants->map(function ($item) {
            return [
                'id' => $item->plant_id,
                'plant_name' => $item->plant->common_name ?? 'Sin nombre',
                'amount' => $item->total_amount,
                'price' => $item->plant->price ?? 0,
            ];
        }));
    }

    public function history()
    {
        $movements = Movement::orderBy('registration_date', 'desc')->wherehas('movement_detail_plants')->get();

        return view('gvff::admin.inventories.history', compact('movements'));
    }

    /**
     * Buscar cliente por número de documento (AJAX)
     */
    public function searchPerson($document)
    {
        $person = Person::where('document_number', $document)->first();

        if ($person) {

            return response()->json([
                'id' => $person->id,
                'name' => $person->first_name . ' ' . $person->first_last_name . ' ' . $person->second_last_name,
            ]);
        }

        return response()->json([]);
    }

    /**
     * Procesar la venta de plantas
     */
    public function processSale(Request $request)
    {
        $request->validate([
            'productive_unit_warehouse_id' => 'required|exists:productive_unit_warehouses,id',
            'client_id' => 'required|exists:people,id',
            'plants' => 'required|array',
        ]);

        DB::beginTransaction();

        try {
            $movementType = MovementType::where('name', 'Venta')->firstOrFail();
            $totalPrice = 0;

            $movement = Movement::create([
                'registration_date' => now(),
                'movement_type_id' => $movementType->id,
                'voucher_number' => time(),
                'price' => 0, // Se actualizará luego
                'observation' => 'Venta de plantas',
                'state' => 'APROBADO',
            ]);

            WarehouseMovement::create([
                'productive_unit_warehouse_id' => $request->productive_unit_warehouse_id,
                'movement_id' => $movement->id,
                'role' => 'Entrega',
            ]);

            MovementResponsibility::create([
                'person_id' => Auth::user()->person_id,
                'movement_id' => $movement->id,
                'role' => 'ENTREGA',
                'date' => now(),
            ]);

            MovementResponsibility::create([
                'person_id' => $request->client_id,
                'movement_id' => $movement->id,
                'role' => 'RECIBE',
                'date' => now(),
            ]);

            // 🔹 Ahora recorremos cada planta que se va a vender
            foreach ($request->plants as $plantId => $quantityRequested) {
                if ($quantityRequested <= 0)
                    continue;

                // 🔹 Buscar todos los registros de esa planta en el almacén, ordenados por fecha de producción (FIFO)
                $inventories = PlantInventory::with('plant')
                    ->where('productive_unit_warehouse_id', $request->productive_unit_warehouse_id)
                    ->where('plant_id', $plantId)
                    ->orderBy('production_date', 'asc')
                    ->get();

                $totalAvailable = $inventories->sum('amount');

                // 🔹 Validar stock suficiente sumando todos los registros
                if ($totalAvailable < $quantityRequested) {
                    throw new \Exception('Stock insuficiente para la planta: ' . ($inventories->first()->plant->common_name ?? 'Sin nombre'));
                }

                $remaining = $quantityRequested;

                foreach ($inventories as $inventory) {
                    if ($remaining <= 0)
                        break;

                    $deduct = min($inventory->amount, $remaining);
                    $inventory->amount -= $deduct;
                    $inventory->save();

                    // 🔹 Registrar cada descuento en MovementDetailPlant
                    MovementDetailPlant::create([
                        'plant_inventory_id' => $inventory->id,
                        'movement_id' => $movement->id,
                        'amount' => $deduct,
                        'price' => $inventory->plant->price ?? 0,
                    ]);

                    $totalPrice += ($inventory->plant->price ?? 0) * $deduct;

                    $remaining -= $deduct;
                }
            }

            // 🔹 Actualizar precio total del movimiento
            $movement->update(['price' => $totalPrice]);

            DB::commit();

            return redirect()->back()->with('success', 'Venta registrada exitosamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error al procesar la venta: ' . $e->getMessage());
        }
    }

}