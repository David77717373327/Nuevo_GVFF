@extends('gvff::layouts.masterusersNarvas')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-b from-green-50 to-green-200 overflow-hidden">
        <!-- Fondo decorativo con hojas flotantes -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>

        <div class="container mx-auto px-4 py-12 relative z-10">
            <!-- Encabezado -->
            <h1 class="text-4xl md:text-5xl font-bold text-center text-green-800 mb-8 animate__animated animate__fadeIn">
                Descubre Nuestros Viveros
            </h1>

            <!-- Buscador -->
            <div class="flex flex-col sm:flex-row justify-center mb-8">
                <div class="relative w-full sm:w-1/3">
                    <input type="text" id="search" placeholder="Buscar viveros..." class="w-full p-3 pl-10 rounded-full border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-green-600"></i>
                </div>
            </div>

            <!-- Sección educativa sobre viveros -->
            <div class="bg-emerald-50 rounded-2xl shadow-lg p-6 mb-8 border border-green-200 animate__animated animate__fadeInUp">
                <h2 class="text-3xl font-bold text-green-800 mb-4">¿Qué es un Vivero?</h2>
                <p class="text-gray-600 mb-4">Un vivero es un espacio dedicado al cultivo, cuidado y desarrollo de plantas, desde semillas hasta plántulas listas para trasplante o venta. Estos lugares son esenciales para preservar la biodiversidad y apoyar la reforestación.</p>
                <h3 class="text-2xl font-semibold text-green-700 mb-3">Tipos de plantas que se cultivan</h3>
                <div class="relative overflow-hidden" id="plant-carousel">
                    <div class="flex space-x-4 animate-scroll" id="plant-slides">
                        <div class="min-w-[200px] bg-green-50 p-4 rounded-lg shadow-md hover:shadow-lg transition">
                            <img src="{{ asset('modules/gvff/images/plants/orquidea.jpg') }}" alt="Orquídea" class="w-full h-32 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen orquidea.jpg no encontrada');">
                            <p class="text-center font-semibold mt-2">Orquídea</p>
                            <p class="text-sm text-gray-500">Flor exótica de colores vibrantes.</p>
                        </div>
                        <div class="min-w-[200px] bg-green-50 p-4 rounded-lg shadow-md hover:shadow-lg transition">
                            <img src="{{ asset('modules/gvff/images/plants/elecho.jpg') }}" alt="Elecho" class="w-full h-32 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen elecho.jpg no encontrada');">
                            <p class="text-center font-semibold mt-2">Elecho</p>
                            <p class="text-sm text-gray-500">Planta de sombra resistente.</p>
                        </div>
                        <div class="min-w-[200px] bg-green-50 p-4 rounded-lg shadow-md hover:shadow-lg transition">
                            <img src="{{ asset('modules/gvff/images/plants/captus.jpg') }}" alt="Captus" class="w-full h-32 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen captus.jpg no encontrada');">
                            <p class="text-center font-semibold mt-2">Captus</p>
                            <p class="text-sm text-gray-500">Planta suculenta adaptable al desierto.</p>
                        </div>
                        <div class="min-w-[200px] bg-green-50 p-4 rounded-lg shadow-md hover:shadow-lg transition">
                            <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Bambú" class="w-full h-32 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen carucel1.jpg no encontrada');">
                            <p class="text-center font-semibold mt-2">Bambú</p>
                            <p class="text-sm text-gray-500">Planta de rápido crecimiento y gran resistencia.</p>
                        </div>
                        <div class="min-w-[200px] bg-green-50 p-4 rounded-lg shadow-md hover:shadow-lg transition">
                            <img src="{{ asset('modules/gvff/images/plants/desarrollador1.jpg') }}" alt="Lavanda" class="w-full h-32 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen lavanda.jpg no encontrada');">
                            <p class="text-center font-semibold mt-2">Lavanda</p>
                            <p class="text-sm text-gray-500">Aromática y utilizada en jardinería ornamental.</p>
                        </div>
                        <div class="min-w-[200px] bg-green-50 p-4 rounded-lg shadow-md hover:shadow-lg transition">
                            <img src="{{ asset('modules/gvff/images/plants/carrucel2.jpg') }}" alt="Rosa" class="w-full h-32 object-cover rounded" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen rosa.jpg no encontrada');">
                            <p class="text-center font-semibold mt-2">Rosa</p>
                            <p class="text-sm text-gray-500">Flor clásica de belleza y fragancia intensa.</p>
                        </div>
                    </div>
                    <button id="prev" class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white p-2 rounded-full hover:bg-green-600 transition">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button id="next" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-green-500 text-white p-2 rounded-full hover:bg-green-600 transition">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Lista de viveros -->
            <div id="nurseries-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($nurseries as $nursery)
                    <div class="nursery-card bg-white rounded-2xl shadow-lg overflow-hidden transform transition-all duration-300 hover:shadow-2xl">
                        <!-- Imagen -->
                        <div class="relative">
                            @if ($nursery->image)
                                <img src="{{ asset($nursery->image) }}" alt="{{ $nursery->name }}" class="w-full h-56 object-cover">
                            @else
                                <img src="{{ asset('modules/gvff/images/nurseries/default.jpg') }}" alt="Imagen por defecto" class="w-full h-56 object-cover">
                            @endif
                            <div class="absolute top-0 right-0 bg-green-600 text-white text-xs font-semibold px-3 py-1 rounded-bl-lg">
                                Público
                            </div>
                        </div>
                        <!-- Contenido -->
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-green-800 mb-3">{{ $nursery->name }}</h2>
                            <p class="text-gray-600 mb-2"><i class="fas fa-map-marker-alt text-green-600 mr-2"></i> {{ $nursery->location }}</p>
                            <p class="text-gray-600 mb-2"><i class="fas fa-seedling text-green-600 mr-2"></i> Capacidad: {{ $nursery->max_capacity }}</p>
                            <p class="text-gray-500 text-sm mb-4">{{ Str::limit($nursery->description, 120) }}</p>
                            <a href="{{ route('gvff.user.nurseries.show', $nursery->id) }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition">Ver Detalles</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Estilos personalizados -->
    <style>
        /* Animación de hojas flotantes */
        .leaf {
            position: absolute;
            width: 20px;
            height: 20px;
            background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
            background-size: contain;
            opacity: 0.3;
            animation: float 10s infinite ease-in-out;
        }

        .leaf1 { top: 10%; left: 10%; animation-delay: 0s; }
        .leaf2 { top: 30%; left: 80%; animation-delay: 2s; }
        .leaf3 { top: 60%; left: 20%; animation-delay: 4s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(100px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        /* Animaciones de entrada */
        .animate__fadeIn {
            animation: fadeIn 1s ease-in;
        }

        .animate__fadeInUp {
            animation: fadeInUp 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Estilo del carrusel */
        #plant-carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 20px 0;
        }

        #plant-slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        #prev, #next {
            z-index: 10;
        }

        .animate-scroll {
            animation: scroll 8s infinite linear;
        }

        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }
    </style>

    <!-- Script para búsqueda y carrusel -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const nurseryCards = document.querySelectorAll('.nursery-card');

            // Función de búsqueda
            function filterNurseries() {
                const search = searchInput.value.toLowerCase();

                nurseryCards.forEach(card => {
                    const name = card.querySelector('h2').textContent.toLowerCase();

                    if (name.includes(search)) {
                        card.style.display = 'block';
                        card.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterNurseries);

            // Control del carrusel
            const slides = document.getElementById('plant-slides');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            let slideWidth = slides.querySelector('.min-w-[200px]').offsetWidth + 16; // Incluye el gap
            let currentPosition = 0;
            const totalSlides = slides.children.length;

            function updateCarousel() {
                slides.style.transform = `translateX(${currentPosition * slideWidth}px)`;
            }

            prevButton.addEventListener('click', () => {
                if (currentPosition < 0) {
                    currentPosition += 1;
                    updateCarousel();
                }
            });

            nextButton.addEventListener('click', () => {
                if (currentPosition > -(totalSlides - 1)) {
                    currentPosition -= 1;
                    updateCarousel();
                }
            });

            // Desactivar animación automática al interactuar
            prevButton.addEventListener('click', () => slides.classList.remove('animate-scroll'));
            nextButton.addEventListener('click', () => slides.classList.remove('animate-scroll'));
        });
    </script>
@endsection