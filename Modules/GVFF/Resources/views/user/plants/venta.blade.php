@extends('gvff::layouts.masterusers')
@section('title', 'Plantas en Venta')

@push('styles')
    <!-- Bootstrap CSS for alerts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush

@section('content')
    <section class="mt-20" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Plantas en Venta</h2>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-auto max-w-3xl" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($plants->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
                @foreach ($plants as $plant)
                    @if ($plant->available && $plant->price)
                        <div class="bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                            <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}" alt="{{ $plant->common_name }}" class="w-full h-48 object-cover rounded mb-4">
                            <h3 class="text-xl font-bold text-green-700 mb-2">{{ $plant->common_name }}</h3>
                            <p class="text-gray-600 mb-2"><i class="fas fa-leaf mr-2"></i><strong>Nombre Científico:</strong> {{ $plant->scientific_name }}</p>
                            <p class="text-gray-600 mb-2"><i class="fas fa-info-circle mr-2"></i><strong>Descripción:</strong> {{ $plant->characteristics ?? 'Sin descripción' }}</p>
                            <p class="text-gray-600 mb-2"><i class="fas fa-dollar-sign mr-2"></i><strong>Precio:</strong> ${{ number_format($plant->price, 2) }}</p>
                            <a href="https://wa.me/1234567890?text=Quiero%20comprar%20{{ urlencode($plant->common_name) }}%20por%20${{ number_format($plant->price, 2) }}" class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Comprar</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p class="text-gray-600 text-center">No hay plantas en venta disponibles en este momento.</p>
        @endif
    </section>

    @push('scripts')
        <!-- Bootstrap JS for alerts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    @endpush
@endsection