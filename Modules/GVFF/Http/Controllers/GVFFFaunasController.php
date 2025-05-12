<?php

namespace Modules\GVFF\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GVFF\Entities\Fauna;
use Illuminate\Support\Str;

class GVFFFaunasController extends Controller
{
    public function index()
    {
        $faunas = Fauna::all();
        return view('gvff::admin.faunas.index', compact('faunas'));
    }

    public function create()
    {
        return view('gvff::admin.faunas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'scientific_name' => 'required|string|max:255|unique:faunas,scientific_name',
            'common_name' => 'required|string|max:255',
            'habitat' => 'nullable|string|max:255',
            'diet' => 'nullable|string',
            'status' => 'required|in:stable,critical,extinct',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fauna = new Fauna();
        $fauna->scientific_name = $request->input('scientific_name');
        $fauna->common_name = $request->input('common_name');
        $fauna->habitat = $request->input('habitat');
        $fauna->diet = $request->input('diet');
        $fauna->status = $request->input('status');
        $fauna->location = $request->input('location');
    

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $name_image = Str::slug($fauna->common_name) . '-' . time() . '.' . $extension;
            $image->move(public_path('modules/gvff/images/faunas/'), $name_image);
            $fauna->image = 'modules/gvff/images/faunas/' . $name_image;
        }

        $fauna->save();

        return redirect()->route('gvff.admin.faunas.index')->with('success', 'Fauna created successfully.');
    }

    public function edit(Fauna $fauna)
    {
        return view('gvff::admin.faunas.edit', compact('fauna'));
    }

    public function update(Request $request, Fauna $fauna)
    {
        $request->validate([
            'scientific_name' => 'required|string|max:255|unique:faunas,scientific_name,' . $fauna->id,
            'common_name' => 'required|string|max:255',
            'habitat' => 'nullable|string|max:255',
            'diet' => 'nullable|string',
            'status' => 'required|in:stable,critical,extinct',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fauna->scientific_name = $request->input('scientific_name');
        $fauna->common_name = $request->input('common_name');
        $fauna->habitat = $request->input('habitat');
        $fauna->diet = $request->input('diet');
        $fauna->status = $request->input('status');
        $fauna->location = $request->input('location');
    
        if ($request->hasFile('image')) {
            // Eliminar imagen antigua si existe
            if ($fauna->image && file_exists(public_path($fauna->image))) {
                unlink(public_path($fauna->image));
            }
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $name_image = Str::slug($fauna->common_name) . '-' . time() . '.' . $extension;
            $image->move(public_path('modules/gvff/images/faunas/'), $name_image);
            $fauna->image = 'modules/gvff/images/faunas/' . $name_image;
        }

        $fauna->save();

        return redirect()->route('gvff.admin.faunas.index')->with('success', 'Fauna updated successfully.');
    }

    public function destroy(Fauna $fauna)
    {
        if ($fauna->image && file_exists(public_path($fauna->image))) {
            unlink(public_path($fauna->image));
        }
        $fauna->delete();

        return redirect()->route('gvff.admin.faunas.index')->with('success', 'Fauna deleted successfully.');
    }
}