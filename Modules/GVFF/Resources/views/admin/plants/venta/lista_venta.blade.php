@extends('gvff::layouts.master')

   @section('content')
    <div class="container mx-auto p-6">
          
     <div class="mb-8">
        <h3 class="text-2xl font-semibold mb-4">Plantas en Venta</h3>
        @if($plants->where('plant_type', 'venta')->isNotEmpty())
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Imagen</th>
                        <th class="py-3 px-4 text-left">Nombre Científico</th>
                        <th class="py-3 px-4 text-left">Nombre Común</th>
                        <th class="py-3 px-4 text-left">Inventario</th>
                        <th class="py-3 px-4 text-left">Descripción</th>
                          <th class="py-3 px-4 text-left">Precio</th>
                        <th class="py-3 px-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plants->where('plant_type', 'venta') as $plant)
                        <tr class="hover:bg-gray-100">
                            <td class="py-3 px-4">
                                @if($plant->image)
                                    <img src="{{ asset('storage/' . $plant->image) }}" alt="{{ $plant->common_name }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-gray-600">Sin imagen</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">{{ $plant->scientific_name }}</td>
                            <td class="py-3 px-4">{{ $plant->common_name }}</td>
                            <td class="py-3 px-4">{{ $plant->inventory }}</td>
                            <td class="py-3 px-4">{{ $plant->characteristics ?? 'Sin descripción' }}</td>
                            <td class="py-3 px-4">{{ number_format($plant->price, 2) }} €</td>
                            <td class="py-3 px-4">
                                <a href="{{ route('gvff.admin.plants.edit', $plant) }}" class="btn btn-warning btn-sm">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-600">No hay plantas en venta registradas.</p>
        @endif
    </div>
    </div>
   @endsection