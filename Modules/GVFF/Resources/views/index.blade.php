@extends('gvff::layouts.master')

@push('styles')
    <!-- Add Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endpush

@section('content')
 <div class="container mx-auto">
    <!-- Page Header -->
    <div class="mb-12 relative h-[300px] ">
        <!-- Background Image with Blur Effect (Local) -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('modules/gvff/images/cefati.png') }}'); opacity: 3;"></div>
        <div class="relative z-10 flex items-center justify-center h-full text-center py-4">
        <h1 class="text-3xl font-semibold text-white animate__animated animate__fadeInUp animate__delay-1s max-w-2xl mx-auto">
                Bienvenido al Sistema de Gestión de Viveros. Administra viveros, plantas, fauna y más desde esta plataforma profesional.
            </h1>
        </div>
    </div>
</div>
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Card: Total Nurseries -->
            <div class="card bg-white p-4 rounded-lg shadow-md relative">
                <div class="flex">
                    <!-- Image: Takes 50% of the card width -->
                    <div class="w-1/2">
                        <img src="{{ asset('modules/gvff/images/crear una imagen de vivero.png') }}" alt="Vivero" class="w-full h-40 object-cover rounded-lg">
                    </div>
                    <!-- Content: Takes 50% of the card width -->
                    <div class="w-1/2 flex flex-col justify-center items-center pl-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Total Viveros</h3>
                        <p class="text-2xl font-bold text-gray-900 text-center">{{ $totalNurseries }}</p>
                    </div>
                </div>
                <!-- Orange Line -->
                <div class="absolute w-full h-1 bg-green-500 bottom-0 left-0 transform translate-y-1/2"></div>
            </div>

            <!-- Card: Total Plants -->
            <div class="card bg-white p-4 rounded-lg shadow-md relative">
                <div class="flex">
                    <!-- Image: Takes 50% of the card width -->
                    <div class="w-1/2">
                        <img src="{{ asset('modules/gvff/images/planta.png') }}" alt="Planta" class="w-full h-40 object-cover rounded-lg">
                    </div>
                    <!-- Content: Takes 50% of the card width -->
                    <div class="w-1/2 flex flex-col justify-center items-center pl-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Total Plantas</h3>
                        <p class="text-2xl font-bold text-gray-900 text-center">{{ $totalPlants }}</p>
                        <div class="mt-2 text-base font-semibold text-gray-600">
                            <p>Ornamentales: {{ $ornamentalPlants }}</p>
                            <p>Medicinales: {{ $medicinalPlants }}</p>
                            <p>En Venta: {{ $ventaPlants }}</p>
                        </div>
                    </div>
                </div>
                <!-- Orange Line -->
                <div class="absolute w-full h-1 bg-green-500 bottom-0 left-0 transform translate-y-1/2"></div>
            </div>

            <!-- Card: Total Fauna -->
            <div class="card bg-white p-4 rounded-lg shadow-md relative">
                <div class="flex">
                    <!-- Image: Takes 50% of the card width -->
                    <div class="w-1/2">
                        <img src="{{ asset('modules/gvff/images/vivero.png') }}" alt="Fauna" class="w-full h-40 object-cover rounded-lg">
                    </div>
                    <!-- Content: Takes 50% of the card width -->
                    <div class="w-1/2 flex flex-col justify-center items-center pl-4">
                        <h3 class="text-lg font-semibold text-gray-800 text-center">Fauna</h3>
                        <p class="text-2xl font-bold text-gray-900 text-center">{{ $totalFauna }}</p>
                    </div>
                </div>
                <!-- Orange Line -->
                <div class="absolute w-full h-1 bg-green-500 bottom-0 left-0 transform translate-y-1/2"></div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-3xl font-extrabold text-gray-800 mb-4 animate__animated animate__fadeIn tracking-wide">Acciones Rápidas</h2>
            <p class="text-lg font-medium text-gray-600 mb-4 animate__animated animate__fadeIn animate__delay-1s">Realiza acciones rápidas para gestionar viveros y plantas.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('gvff.admin.nurseries.create') }}" class="card p-4 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105 transform" style="background-image: url('https://alverdevivo.org/wp-content/uploads/2021/01/vivero-scaled.jpg'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);">
                    <i class="fa-solid fa-leaf text-2xl mb-2 animate__animated animate__pulse"></i>
                    <span class="font-extrabold text-xl tracking-tight">Nuevo Vivero</span>
                </a>
                <a href="{{ route('gvff.admin.plants.create') }}" class="card p-4 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105 transform" style="background-image: url('https://curiosidadessobre.es/wp-content/uploads/2024/03/Curiosidades-sobre-las-plantas.jpg'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);">
                    <i class="fa-solid fa-seedling text-2xl mb-2 animate__animated animate__pulse"></i>
                    <span class="font-extrabold text-xl tracking-tight">Nueva Planta</span>
                </a>
                <a href="{{ route('gvff.admin.faunas.create') }}" class="card p-4 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105 transform" style="background-image: url('https://th.bing.com/th/id/OIP.QdTR8wNFD3lBLKb-Aq6OEgHaE9?w=1024&h=685&rs=1&pid=ImgDetMain'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);">
                    <i class="fa-solid fa-paw text-2xl mb-2 animate__animated animate__pulse"></i>
                    <span class="font-extrabold text-xl tracking-tight">Nueva Fauna</span>
                </a>
                <a href="{{ route('gvff.admin.plants.venta.create') }}" class="card p-4 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105 transform" style="background-image: url('https://1.bp.blogspot.com/-Qw5sUgKt0UA/YJiBSk7YPKI/AAAAAAAAAYQ/-PYKipvO4K4lJiBkn9Rk80Z9YArS6fAgwCPcBGAYYCw/w1200-h630-p-k-no-nu/venta-de-plantas-portada.png'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);">
                    <i class="fa-solid fa-shopping-cart text-2xl mb-2 animate__animated animate__pulse"></i>
                    <span class="font-extrabold text-xl tracking-tight">Registrar Venta</span>
                </a>
            </div>
        </div>
    </div>
@endsection