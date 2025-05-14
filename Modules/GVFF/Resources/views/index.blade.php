@extends('gvff::layouts.master')

@section('content')
    <div class="container mx-auto">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Panel de Administración</h1>
            <p class="text-gray-600">Bienvenido al Sistema de Gestión de Viveros. Administra viveros, plantas, y más desde aquí.</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Card: Total Nurseries -->
    <div class="card bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('modules/gvff/images/faunas/gato-1747067617.jpg') }}" alt="Fauna" class="w-20 h-20 object-cover rounded-full border-2 border-green-500">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Total Viveros</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalNurseries }}</p>
            </div>
        </div>
    </div>
    <!-- Card: Total Plants -->
    <div class="card bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('modules/gvff/images/faunas/gato-1747067617.jpg') }}" alt="Fauna" class="w-20 h-20 object-cover rounded-full border-2 border-green-100">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Total Plantas</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalPlants }}</p>
            </div>
        </div>
    </div>
    <!-- Card: Fauna -->
    <div class="card bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('modules/gvff/images/faunas/gato-1747067617.jpg') }}" alt="Fauna" class="w-20 h-20 object-cover rounded-full border-2 border-green-100">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Fauna</h3>
                <p class="text-2xl font-bold text-gray-900">{{ $totalFauna }}</p>
            </div>
        </div>
    </div>
</div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Acciones Rápidas</h2>
            <p class="text-gray-600 mb-4">Realiza acciones rápidas para gestionar viveros y plantas.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                 <a href="{{ route('gvff.admin.nurseries.create') }}" class="card p-4 rounded-lg shadow-md hover:shadow-lg transition" style="background-image: url('https://images.unsplash.com/photo-1501854140801-50d01698950b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7);">
                <i class="fa-solid fa-leaf text-2xl mb-2"></i>
                <span class="font-semibold">Nuevo Vivero</span>
            </a>
                <a href="{{ route('gvff.admin.plants.create') }}" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition"  style="background-image: url('https://curiosidadessobre.es/wp-content/uploads/2024/03/Curiosidades-sobre-las-plantas.jpg'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7)">
                    <i class="fa-solid fa-seedling text-2xl mb-2"></i>
                    <span>Nueva Planta</span>
                </a>
                <a href="{{ route('gvff.admin.faunas.create') }}" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition" style="background-image: url('https://th.bing.com/th/id/OIP.QdTR8wNFD3lBLKb-Aq6OEgHaE9?w=1024&h=685&rs=1&pid=ImgDetMain'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7)">
                    <i class="fa-solid fa-paw text-2xl mb-2"></i>
                    <span>Nueva Fauna</span>

                <a href="{{ route('gvff.admin.plants.venta.create') }}" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition"style="background-image: url('https://1.bp.blogspot.com/-Qw5sUgKt0UA/YJiBSk7YPKI/AAAAAAAAAYQ/-PYKipvO4K4lJiBkn9Rk80Z9YArS6fAgwCPcBGAYYCw/w1200-h630-p-k-no-nu/venta-de-plantas-portada.png'); background-size: cover; background-position: center; color: white; text-shadow: 0 0 5px rgba(0, 0, 0, 0.7)">
                    <i class="fa-solid fa-shopping-cart text-2xl mb-2"></i>
                    <span>Registrar Venta</span>
                </a>
                </div>
        </div>

  
@endsection