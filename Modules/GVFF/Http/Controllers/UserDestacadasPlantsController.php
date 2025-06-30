<?php

   namespace Modules\GVFF\Http\Controllers;

   use Illuminate\Http\Request;
   use Illuminate\Routing\Controller;
   use Modules\GVFF\Entities\Plant;

   class UserDestacadasPlantsController extends Controller
   {
       public function destacadas()
       {
        try {
            $plants = Plant::where('available', true)
                           ->whereNotNull('price')
                           ->get();
            return view('gvff::user.plants.destacadas', compact('plants'));
        } catch (\Exception $e) {
            Log::error('Error fetching destacadas plants: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al cargar las plantas destacadas.']);
        }
       }
   }
