<?php

   namespace Modules\GVFF\Http\Controllers;

   use Illuminate\Http\Request;
   use Illuminate\Routing\Controller;
   use Modules\GVFF\Entities\Plant;

   class UserPlantSearchController extends Controller
   {
       public function search(Request $request)
       {
        try {
            $query = $request->input('query');
            $plants = Plant::where('available', true)
                ->where(function ($q) use ($query) {
                    $q->where('common_name', 'like', "%{$query}%")
                      ->orWhere('scientific_name', 'like', "%{$query}%")
                      ->orWhere('characteristics', 'like', "%{$query}%")
                      ->orWhere('properties', 'like', "%{$query}%")
                      ->orWhere('traditional_uses', 'like', "%{$query}%");
                })
                ->get();
            return view('gvff::user.plants.search', compact('plants', 'query'));
        } catch (\Exception $e) {
            Log::error('Error searching plants: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al realizar la búsqueda.']);
        }
       }
   }
