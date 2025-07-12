<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Nurseries;

class GVFFNurseriesUserController extends Controller
{
    public function index()
    {
        // Obtener todos los viveros (o filtrar por 'public' si es necesario)
        $nurseries = Nurseries::where('classification', 'public')->get();
        return view('gvff::user.nurseries.index', compact('nurseries'));
    }


        public function show(Nurseries $nurseries)
        {
            return view('gvff::user.nurseries.show', compact('nurseries'));
        }



        public function about()
    {
        // Datos ficticios para la vista (puedes reemplazarlos con una base de datos)
        $developers = [
    ['name' => 'Juan Pérez', 'role' => 'Líder de Desarrollo', 'image' => asset('modules/gvff/images/plants/carrucel2.jpg')],
    ['name' => 'María Gómez', 'role' => 'Diseñadora UI/UX', 'image' => asset('modules/gvff/images/plants/carrucel2.jpg')],
    ['name' => 'Carlos López', 'role' => 'Backend Developer', 'image' => asset('modules/gvff/images/plants/carrucel2.jpg')],
];
        return view('gvff::user.nurseries.about', compact('developers'));
    }

    public function destroy(Nurseries $nursery)
{
    try {
        // Verificamos si tiene plantas asociadas
        if ($nursery->plants()->count() > 0) {
            return redirect()->route('gvff.admin.nurseries.index')
                ->with('error', 'El vivero no se puede eliminar, tiene registros asociados.');
        }

        // Intentar eliminar
        $nursery->delete();

        return redirect()->route('gvff.admin.nurseries.index')
            ->with('success', 'Vivero eliminado exitosamente.');
    } catch (QueryException $e) {
        
        return redirect()->route('gvff.admin.nurseries.index')
            ->with('error', 'No se pudo eliminar el vivero por restricciones en la base de datos.');
    }
}
}
