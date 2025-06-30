<?php

namespace Modules\GVFF\Http\Controllers;

use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Plant;
use Modules\GVFF\Entities\Fauna;


class GVFFController extends Controller

{
    //funcion para el administrador
    public function index()
{
    // Get the count of unique nurseries from the plants table
    $totalNurseries = Plant::distinct('nurseries_id')->count('nurseries_id');
    $totalPlants = Plant::count();
    $totalFauna = Fauna::count();
    $ornamentalPlants = Plant::where('plant_type', 'ornamental')->count();
        $medicinalPlants = Plant::where('plant_type', 'medicinal')->count();
        $ventaPlants = Plant::where('plant_type', 'venta')->count();
        $forestalPlants = Plant::where('plant_type', 'forestal')->count();

    // Pass the count to the view
    return view('gvff::index', compact('totalNurseries', 'totalPlants', 'totalFauna', 'ornamentalPlants', 'medicinalPlants', 'ventaPlants', 'forestalPlants'));
}

    //Funcion para los aprensices que no necesitan autenticacion
    public function welcome()
    {
        if (Auth::check()) {
            // Si el usuario está autenticado, redirigir a la ruta del administrador
            return redirect()->route('gvff.index');
        }
        
        return view('gvff::welcome');
    }
    
    
    public function create()
    {
        return view('gvff::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('gvff::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('gvff::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
