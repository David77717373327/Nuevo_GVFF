<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Fauna;
use Illuminate\Support\Facades\Log;

class UserFaunaController extends Controller
{
    public function index()
    {
        try {
            $faunas = Fauna::where('status', 'active')->get();
            // Depuración
            \Log::info('Faunas con status "active": ', $faunas->toArray());
            if ($faunas->isEmpty()) {
                \Log::warning('No hay faunas con status "active". Mostrando todos los registros como prueba.');
                $faunas = Fauna::all(); // Temporal: muestra todos los registros
                \Log::info('Todos los faunas: ', $faunas->toArray());
            }
            return view('gvff::user.fauna.index', compact('faunas'));
        } catch (\Exception $e) {
            \Log::error('Error fetching faunas: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al cargar las faunas.']);
        }
    }

    public function show($id)
    {
        try {
            $fauna = Fauna::findOrFail($id);
            return view('gvff::user.fauna.show', compact('fauna'));
        } catch (\Exception $e) {
            Log::error('Error fetching fauna: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al cargar la fauna.']);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $faunas = Fauna::where('status', 'active')
                ->where(function ($q) use ($query) {
                    $q->where('common_name', 'like', "%{$query}%")
                      ->orWhere('scientific_name', 'like', "%{$query}%");
                })
                ->get();
            return view('gvff::user.fauna.search_results', compact('faunas'));
        } catch (\Exception $e) {
            Log::error('Error searching faunas: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al buscar las faunas.']);
        }
    }
}