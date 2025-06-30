<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Nurseries;

class UserHomeController extends Controller
{
    public function index()
    {
        try {
            $nurseries = Nurseries::where('classification', 'public')
                                 ->where('max_capacity', '>', 0)
                                 ->withCount('plants')
                                 ->take(3)
                                 ->get();
            return view('gvff::user.home', compact('nurseries'));
        } catch (\Exception $e) {
            \Log::error('Error fetching nurseries for home: ' . $e->getMessage(), ['exception' => $e]);
            return view('gvff::user.home')->withErrors(['general' => 'Ocurrió un error al cargar los viveros destacados.']);
        }
    }
}
