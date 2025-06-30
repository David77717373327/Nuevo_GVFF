<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Modules\GVFF\Entities\Plant;

class UserVentaPlantsController extends Controller
{
    /**
     * Display plants available for sale.
     *
     * @return \Illuminate\View\View
     */
    public function venta()
    {
        try {
            $plants = Plant::where('plant_type', 'venta')
                           ->where('available', true)
                           ->whereNotNull('price')
                           ->get();
            return view('gvff::user.plants.venta', compact('plants'));
        } catch (\Exception $e) {
            Log::error('Error fetching plants for sale: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->with('error', 'Ocurrió un error al cargar las plantas en venta.');
        }
    }
}