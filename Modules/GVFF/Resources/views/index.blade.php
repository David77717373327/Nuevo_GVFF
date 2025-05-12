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
            <div class="card bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fa-solid fa-leaf text-3xl text-green-600 mr-4"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Viveros</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalNurseries }}</p>
                    </div>
                </div>
            </div>
            <!-- Card: Total Plants -->
            <div class="card bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fa-solid fa-seedling text-3xl text-green-600 mr-4"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Total Plantas</h3>
                        <p class="text-2xl font-bold text-gray-900">245</p>
                    </div>
                </div>
            </div>
            <!-- Card: Pending Tasks -->
            <div class="card bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center">
                    <i class="fa-solid fa-tasks text-3xl text-green-600 mr-4"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-700">Tareas Pendientes</h3>
                        <p class="text-2xl font-bold text-gray-900">8</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Acciones Rápidas</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('gvff.admin.nurseries.create') }}" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition">
                    <i class="fa-solid fa-leaf text-2xl mb-2"></i>
                    <span>Nuevo Vivero</span>
                </a>
                <a href="{{ route('gvff.admin.plants.create') }}" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition">
                    <i class="fa-solid fa-seedling text-2xl mb-2"></i>
                    <span>Nueva Planta</span>
                </a>
                <a href="#compras" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition">
                    <i class="fa-solid fa-receipt text-2xl mb-2"></i>
                    <span>Registrar Compra</span>
                </a>
                <a href="#seguimientos" class="card bg-green-600 text-white p-4 rounded-lg shadow-md hover:bg-green-700 transition">
                    <i class="fa-solid fa-chart-line text-2xl mb-2"></i>
                    <span>Ver Seguimientos</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div>
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Actividad Reciente</h2>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fa-solid fa-leaf text-green-600 mr-3"></i>
                        <span>Nuevo vivero "Vivero Central" registrado el 10/05/2025.</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-seedling text-green-600 mr-3"></i>
                        <span>Planta "Rosa Roja" añadida al catálogo el 09/05/2025.</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fa-solid fa-tasks text-green-600 mr-3"></i>
                        <span>Tarea "Revisión de Suministros" completada el 08/05/2025.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection