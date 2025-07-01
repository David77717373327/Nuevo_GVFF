@extends('gvff::layouts.master')

@section('content')
<div class="container mx-auto max-w-lg mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6 text-center">Nueva Herramienta</h2>

    <form action="{{ route('gvff.admin.tools.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
            <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label for="description" class="block text-gray-700 font-semibold mb-2">Descripción:</label>
            <textarea name="description" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
        </div>

        <button type="submit" class="w-full bg-green-600 text-white font-semibold py-2 rounded hover:bg-black-700 transition">Guardar</button>
    </form>
</div>
@endsection
