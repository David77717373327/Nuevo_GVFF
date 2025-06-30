<?php

   namespace Modules\GVFF\Http\Controllers;

   use Illuminate\Http\Request;
   use Illuminate\Routing\Controller;
   use Modules\GVFF\Entities\Plant;

   class UserForestalPlantsController extends Controller
   {
       public function forestal()
       {
        try {
            $plants = Plant::where('plant_type', 'forestal')
                           ->where('available', true)
                           ->get();
            return view('gvff::user.plants.forestal', compact('plants'));
        } catch (\Exception $e) {
            Log::error('Error fetching forestal plants: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al cargar las plantas forestales.']);
        }
       }
   }