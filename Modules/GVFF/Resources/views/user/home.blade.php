@extends('gvff::layouts.masterusers')

@section('title', 'Inicio - Viveros y Plantas')

@section('content')
    <!-- Welcome Section -->
    <section class="mt-20 text-center" data-aos="fade-up">
        <h1 class="text-4xl font-bold text-green-800 mb-4">Bienvenido a Viveros y Plantas</h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-6">¡Buenos días! Hoy es {{ date('l, F j, Y, g:i A T') }}. Descubre una amplia variedad de plantas sostenibles y explora nuestra pasión por la naturaleza. ¡Cultiva con nosotros!</p>
        <!-- Temporarily removed nurseries link until route is defined -->
    </section>

    <!-- Featured Plants Section -->
    <section class="mt-20" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Plantas Destacadas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300" data-aos="zoom-in">
                <img src="{{ asset('modules/gvff/images/plants/papaya-1746365289.png') }}" alt="Papaya" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Papaya</h3>
                <p class="text-gray-600">Fruta tropical con beneficios para la digestión.</p>
                <a href="{{ route('gvff.user.plants.medicinal') }}" class="btn-cta inline-block mt-4 px-4 py-2 text-white rounded-lg text-sm">Ver Más</a>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300" data-aos="zoom-in" data-aos-delay="100">
                <img src="{{ asset('modules/gvff/images/plants/sandia-1746472453.png') }}" alt="Sandía" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Sandía</h3>
                <p class="text-gray-600">Rica en agua y perfecta para climas cálidos.</p>
                <a href="{{ route('gvff.user.plants.ornamental') }}" class="btn-cta inline-block mt-4 px-4 py-2 text-white rounded-lg text-sm">Ver Más</a>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('modules/gvff/images/plants/pera-1748213764.jpg') }}" alt="Pera" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Pera</h3>
                <p class="text-gray-600">Árbol frutal adaptable y nutritivo.</p>
                <a href="{{ route('gvff.user.plants.forestal') }}" class="btn-cta inline-block mt-4 px-4 py-2 text-white rounded-lg text-sm">Ver Más</a>
            </div>
        </div>
    </section>
@endsection