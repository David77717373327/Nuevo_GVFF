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
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'min_stock' => 'required|integer|min:1',
            'description' => 'required|string',
            'status' => 'required',
            'available' => 'required|boolean',
            'acquisition_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/tools'), $imageName);
            $data['image'] = 'uploads/tools/' . $imageName;
        }

        InventoryTool::create($data);

        return redirect()->route('gvff.admin.Tool.index')
            ->with('success', '✅ La herramienta se guardó correctamente.');
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
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'min_stock' => 'required|integer|min:1',
            'description' => 'required|string',
            'status' => 'required',
            'available' => 'required|boolean',
            'acquisition_date' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Si se sube una nueva imagen, reemplazar la anterior
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/tools'), $imageName);
            $data['image'] = 'uploads/tools/' . $imageName;

            // Eliminar imagen anterior si existe
            if ($tool->image && file_exists(public_path($tool->image))) {
                unlink(public_path($tool->image));
            }
        }

        $tool->update($data);

        return redirect()->route('gvff.admin.Tool.index')
            ->with('success', '✅ La herramienta se actualizó correctamente.');
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
