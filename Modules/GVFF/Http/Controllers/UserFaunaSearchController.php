<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Fauna;
use Log;

class UserFaunaSearchController extends Controller
{
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
            $faunas = Fauna::where('status', 'active') // Ajusta 'active' según tu lógica de estado
                ->where(function ($q) use ($query) {
                    $q->where('common_name', 'like', "%{$query}%")
                      ->orWhere('scientific_name', 'like', "%{$query}%")
                      ->orWhere('habitat', 'like', "%{$query}%")
                      ->orWhere('diet', 'like', "%{$query}%")
                      ->orWhere('location', 'like', "%{$query}%");
                })
                ->get();
            return view('gvff::user.fauna.search', compact('faunas', 'query'));
        } catch (\Exception $e) {
            Log::error('Error searching fauna: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al realizar la búsqueda.']);
        }
    }
}