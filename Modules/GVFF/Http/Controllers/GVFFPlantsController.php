<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Plant;
use Modules\GVFF\Entities\Nurseries;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;


class GVFFPlantsController extends Controller
{
    public function index()
    {
        $plants = Plant::all();
        return view('gvff::admin.plants.index', compact('plants'));
    }



    public function listaOrnamental()
    {
        $plants = Plant::where('plant_type', 'ornamental')->get();
        return view('gvff::admin.plants.ornamental.lista_ornamental', compact('plants'));
    }

    public function listaMedicinal()
    {
        $plants = Plant::where('plant_type', 'medicinal')->get();
        return view('gvff::admin.plants.medicinal.lista_medicinal', compact('plants'));
    }

    public function listaForestal()
    {
        $plants = Plant::where('plant_type', 'forestal')->get();
        $nurseries = Nurseries::all();
        return view('gvff::admin.plants.forestal.lista_forestal', compact('plants', 'nurseries'));
    }

    public function listaVenta()
    {
        $plants = Plant::where('plant_type', 'venta')->get();
        return view('gvff::admin.plants.venta.lista_venta', compact('plants'));
    }

    public function create()
    {
        $nurseries = Nurseries::all();
        return view('gvff::admin.plants.create', compact('nurseries'));
    }
    public function createOrnamental()
    {
        $nurseries = Nurseries::all();
        return view('gvff::admin.plants.ornamental.create_ornamental', compact('nurseries'));
    }
    public function createMedicinal()
    {
        $nurseries = Nurseries::all();
        return view('gvff::admin.plants.medicinal.create_medicinal', compact('nurseries'));
    }
    public function createForestal()
    {
        $nurseries = Nurseries::all();
        return view('gvff::admin.plants.forestal.create_forestal', compact('nurseries'));
    }
    public function createVenta()
    {
        $nurseries = Nurseries::all();
        return view('gvff::admin.plants.venta.create_venta', compact('nurseries'));
    }





    
protected function storePlant(Request $request, $isAjax = false)
{
    try {
        $rules = [
            'nurseries_id' => 'required|exists:nurseries,id',
            'scientific_name' => 'required|string|max:255|unique:plants,scientific_name',
            'common_name' => 'required|string|max:255',
            'plant_type' => 'required|in:ornamental,forestal,medicinal,venta',
            'structure_type' => 'nullable|in:tree,shrub,herb',
            'family' => 'nullable|string|max:255',
            'characteristics' => 'nullable|string',
            'benefits' => 'nullable|string',
            'properties' => 'nullable|string',
            'traditional_uses' => 'nullable|string',
            'status' => 'nullable|in:healthy,endangered,critical',
            'inventory' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'available' => 'boolean',
            'observations' => 'nullable|string',
        ];

        

        $validatedData = $request->validate($rules);
        $validatedData['available'] = $request->has('available') && $request->input('available') == 1;


        if ($request->hasFile('image')) {
            $name_image = Str::slug($request->input('common_name')) . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('plants', $name_image, 'public');
            $validatedData['image'] = $path;
        }

        Plant::create($validatedData);

        if ($isAjax) {
            return response()->json(['success' => true, 'message' => 'Planta creada con éxito.']);
        }
        
        Log::info('Planta creada con éxito', ['data' => $validatedData, 'user' => auth()->user() ? auth()->user()->id : 'No autenticado']);
        return redirect()->route('gvff.admin.plants.index')->with('success', 'Planta creada con éxito.');
    } catch (ValidationException $e) {
        Log::error('Validation error in storePlant: ' . json_encode($e->validator->errors()), ['request' => $request->all()]);
        if ($isAjax) {
            return response()->json(['success' => false, 'errors' => $e->validator->errors()], 422);
        }
        throw $e;
    } catch (Throwable $e) {
        Log::error('Error in storePlant: ' . $e->getMessage(), ['exception' => $e, 'request' => $request->all()]);
        if ($isAjax) {
            return response()->json(['success' => false, 'errors' => ['general' => 'Ocurrió un error al crear la planta: ' . $e->getMessage()]], 500);
        }
        throw $e;
    }
}



public function store(Request $request)
    {
        return $this->storePlant($request);
    }

    public function storeOrnamental(Request $request)
    {
        return $this->storePlant($request);
    }

    public function storeMedicinal(Request $request)
    {
        return $this->storePlant($request);
    }

    public function storeVenta(Request $request)
    {
        return $this->storePlant($request);
    }



public function storeForestal(Request $request)
{
    \Log::info('Solicitud recibida en storeForestal', [
        'user' => auth()->check() ? auth()->user()->id : 'No autenticado',
        'data' => $request->all()
    ]);
    // Comment out to avoid error until User model is updated
    // if (auth()->check()) {
    //     \Log::info('Permisos del usuario: ' . json_encode(auth()->user()->getAllPermissions()->pluck('slug')));
    // }
    return $this->storePlant($request, true);
}

    public function sell($id)
    {
        $plants = Plant::findOrFail($id);
        return view('gvff::admin.plants.sell', compact('plants'));
    }

    public function processSell(Request $request, $id)
    {
        $request->validate([
            'price' => 'required|numeric|min:0',
        ]);

        $plants = Plant::findOrFail($id);
        $plants->price = $request->price;
        $plants->save();

        return redirect()->route('gvff.admin.plants.index')->with('success', 'Precio de venta actualizado con éxito.');
    }

    public function edit(Plant $plants)
    {
        $nurseries = nurseries::all();
        return view('gvff::admin.plants.edit', compact('plants', 'nurseries'));
    }

    public function update(Request $request, Plant $plants)
    {
        $request->validate([
            'nurseries_id' => 'required|exists:nurseries,id',
            'scientific_name' => 'required|string|max:255|unique:plants,scientific_name,' . $plants->id,
            'common_name' => 'required|string|max:255',
            'plant_type' => 'required|in:ornamental,forestal,medicinal,venta',
            'structure_type' => 'nullable|in:tree,shrub,herb',
            'family' => 'nullable|string|max:255',
            'characteristics' => 'nullable|string',
            'benefits' => 'nullable|string',
            'properties' => 'nullable|string',
            'traditional_uses' => 'nullable|string',
            'status' => 'nullable|in:healthy,endangered,critical',
            'inventory' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'available' => 'boolean',
            'observations' => 'nullable|string',
        ]);

        $plants->nurseries_id = $request->input('nurseries_id');
        $plants->scientific_name = $request->input('scientific_name');
        $plants->common_name = $request->input('common_name');
        $plants->plant_type = $request->input('plant_type');
        $plants->structure_type = $request->input('structure_type');
        $plants->family = $request->input('family');
        $plants->characteristics = $request->input('characteristics');
        $plants->benefits = $request->input('benefits');
        $plants->properties = $request->input('properties');
        $plants->traditional_uses = $request->input('traditional_uses');
        $plants->status = $request->input('status');
        $plants->inventory = $request->input('inventory');
        $plants->price = $request->input('price');
        $plants->location = $request->input('location');
        $plants->available = $request->boolean('available');
        $plants->observations = $request->input('observations');

        if ($request->hasFile('image')) {
            if ($plants->image && file_exists(public_path($plants->image))) {
                unlink(public_path($plants->image));
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $name_image = \Str::slug($plants->common_name) . '-' . time() . '.' . $extension;
            $image->move(public_path('modules/gvff/images/plants/'), $name_image);
            $plants->image = 'modules/gvff/images/plants/' . $name_image;
        }

        $plants->save();

        return redirect()->route('gvff.admin.plants.index')->with('success', 'Planta actualizada con éxito.');
    }
        public function destroy(Plant $plants)
    {
        try {
            if ($plants->image && Storage::disk('public')->exists($plants->image)) {
                Storage::disk('public')->delete($plants->image);
            }
            $plants->delete();
            return redirect()->route('gvff.admin.plants.index')->with('success', 'Planta eliminada con éxito.');
        } catch (\Exception $e) {
            Log::error('Error in destroy: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al eliminar la planta: ' . $e->getMessage()]);
        }
    }
}