<?php

   namespace Modules\GVFF\Http\Controllers;

   use Illuminate\Http\Request;
   use Illuminate\Routing\Controller;
   use Modules\GVFF\Entities\Plant;

   class UserOrnamentalPlantsController extends Controller
   {
       public function ornamental()
       {
        try {
            $plants = Plant::where('plant_type', 'ornamental')
                           ->where('available', true)
                           ->get();
            return view('gvff::user.plants.ornamental', compact('plants'));
        } catch (\Exception $e) {
            Log::error('Error fetching ornamental plants: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->back()->withErrors(['general' => 'Ocurrió un error al cargar las plantas ornamentales.']);
        }
       }
   }
