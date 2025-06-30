@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas Forestales')

@section('content')
    <section class="mt-20" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Plantas Forestales</h2>
        @if($plants->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                @foreach($plants as $plant)
                    @if($plant->available)
                        <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300" data-aos="zoom-in">
                            <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}" alt="{{ $plant->common_name }}" class="w-full h-48 object-cover rounded mb-4">
                            <h3 class="text-xl font-bold text-green-700 mb-2">{{ $plant->common_name }}</h3>
                            <p class="text-gray-600 mb-2"><strong>Nombre Científico:</strong> {{ $plant->scientific_name }}</p>
                            <p class="text-gray-600 mb-2"><strong>Descripción:</strong> {{ $plant->characteristics ?? 'No disponible' }}</p>
                            <a href="https://wa.me/1234567890?text=Quiero%20información%20sobre%20{{ urlencode($plant->common_name) }}" class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Consultar</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-gray-600 text-center">No hay plantas forestales disponibles en este momento.</p>
        @endif
    </section>
@endsection
```