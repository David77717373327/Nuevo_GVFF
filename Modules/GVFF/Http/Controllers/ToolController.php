<?php
namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\InventoryTool;

class ToolController extends Controller
{
    public function index()
    {
        $tools = InventoryTool::all();
        return view('gvff::admin.Tool.index', compact('tools'));
    }

    public function create()
    {
        return view('gvff::admin.Tool.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:inventory_tools,name',
            'description' => 'nullable|string',
        ]);

        InventoryTool::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'DISPONIBLE',
        ]);

        return redirect()->route('gvff.admin.Tool.index')->with('success', 'Herramienta registrada correctamente.');
    }

    public function edit($id)
    {
        $tool = InventoryTool::findOrFail($id);
        return view('gvff::admin.Tool.edit', compact('tool'));
    }

    public function update(Request $request, $id)
{
    $tool = InventoryTool::findOrFail($id);

    $request->validate([
        'name' => 'required|string|unique:tools,name,' . $tool->id,
        'description' => 'required|string',
        'status' => 'required|string',
        'available' => 'required|boolean',
        'acquisition_date' => 'nullable|date',
    ]);

    $tool->update([
        'name' => $request->name,
        'description' => $request->description,
        'status' => $request->status,
        'available' => $request->available,
        'acquisition_date' => $request->acquisition_date,
    ]);

    return redirect()->route('gvff.admin.Tool.index')->with('success', 'Herramienta actualizada correctamente.');
}

    public function destroy($id)
    {
        InventoryTool::destroy($id);
        return redirect()->back()->with('success', 'Herramienta eliminada.');
    }
    public function show($id)
{
    $tool = InventoryTool::findOrFail($id);

    return view('gvff::admin.Tool.show', compact('tool'));
}

    // Consultar disponibilidad con AJAX
    public function checkAvailability($id)
    {
        $tool = InventoryTool::find($id);

        if (!$tool) {
            return response()->json(['available' => false, 'message' => 'Herramienta no encontrada.']);
        }

        $disponible = $tool->status === 'DISPONIBLE';
        return response()->json([
            'available' => $disponible,
            'message' => $disponible ? 'La herramienta está disponible.' : 'La herramienta no está disponible.'
        ]);
    }
}
