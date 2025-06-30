<?php

   namespace Modules\GVFF\Http\Controllers;

   use Illuminate\Http\Request;
   use Illuminate\Routing\Controller;
   use Modules\GVFF\Entities\Plant;

   class UserMedicinalPlantsController extends Controller
   {
       public function medicinal()
       {
        try {
            $plants = Plant::where('plant_type', 'medicinal')
                           ->where('available', true)
                           ->get();
            return view('gvff::user.plants.medicinal', compact('plants'));
        } catch (\Exception $e) {
            Log::error('Error fetching medicinal plants: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al cargar las plantas medicinales.']);
        }
       }
   }
