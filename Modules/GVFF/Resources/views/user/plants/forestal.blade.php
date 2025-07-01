@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas Forestales - Viveros y Plantas')

@section('content')
    <div class="relative min-h-screen bg-white overflow-hidden transition-colors duration-500">
        <!-- Fondo con hojas flotantes -->
        <div class="absolute inset-0 pointer-events-none z-0">
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
            <div class="leaf leaf4"></div>
            <div class="leaf leaf5"></div>
            <div class="leaf leaf6"></div>
        </div>

        <!-- Botón de modo oscuro -->
        <button id="theme-toggle" class="fixed top-4 right-4 z-50 p-2 rounded-full bg-green-500 dark:bg-green-600 text-white shadow-lg hover:bg-green-600 dark:hover:bg-green-700 transition-all duration-300">
            <svg id="theme-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </button>

        <div class="container mx-auto px-6 py-16 relative z-10">
            <!-- Encabezado con imágenes de hojas -->
            <div class="text-center mb-12">
                <div class="flex justify-center items-center space-x-8">
                    <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Hoja Izquierda" class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110">
                    <h1 class="text-5xl md:text-6xl font-bold text-black leading-tight animate__animated animate__fadeIn">
                        Explora las Magníficas Plantas Forestales
                    </h1>
                    <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Hoja Derecha" class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110" style="transform: rotate(180deg);">
                </div>
            </div>

            <!-- Carrusel de plantas destacadas -->
            <div class="relative mb-12">
                <div id="featured-carousel" class="relative overflow-hidden rounded-3xl shadow-2xl">
                    <div class="flex transition-transform duration-700 ease-in-out" id="carousel-items">
                        @foreach($plants->where('featured', true)->take(3) as $index => $plant)
                            <div class="carousel-item flex-none w-full">
                                <div class="relative h-96 bg-cover bg-center rounded-3xl" style="background-image: url('{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/' . ['captus.jpg', 'elecho.jpg', 'orquidea.jpg'][$index % 3]) }}')">
                                    <div class="absolute inset-0 bg-green-700/30 flex items-center justify-center">
                                        <div class="text-center text-white">
                                            <h3 class="text-3xl font-bold mb-2">{{ $plant->common_name }}</h3>
                                            <p class="text-lg">{{ Str::limit($plant->characteristics ?? 'No disponible', 100) }}</p>
                                            <button class="inline-block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 open-modal" 
                                                data-plant-id="{{ $plant->id }}" 
                                                data-plant-name="{{ $plant->common_name }}" 
                                                data-plant-scientific="{{ $plant->scientific_name }}" 
                                                data-plant-desc="{{ $plant->characteristics ?? 'No disponible' }}" 
                                                data-plant-image="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/' . ['captus.jpg', 'elecho.jpg', 'orquidea.jpg'][$index % 3]) }}" 
                                                data-plant-status="{{ $plant->status ?? 'No disponible' }}" 
                                                data-plant-benefits="{{ $plant->benefits ?? 'No disponible' }}" 
                                                data-plant-uses="{{ $plant->traditional_uses ?? 'No disponible' }}" 
                                                data-plant-family="{{ $plant->family ?? 'No especificada' }}" 
                                                data-plant-type="{{ $plant->plant_type ?? 'No especificado' }}" 
                                                data-plant-structure="{{ $plant->structure_type ?? 'No especificada' }}">Ver Detalles</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button id="carousel-prev" class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-green-500 text-white p-3 rounded-full hover:bg-green-600 transition-all">←</button>
                    <button id="carousel-next" class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-green-500 text-white p-3 rounded-full hover:bg-green-600 transition-all">→</button>
                </div>
            </div>

            <!-- Filtros y buscador -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-6 md:space-y-0 md:space-x-6">
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="search" placeholder="Buscar plantas..." class="w-full p-4 pl-12 rounded-lg border border-green-300 dark:border-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-300 font-medium">
                    <svg class="w-6 h-6 absolute left-4 top-1/2 transform -translate-y-1/2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <select id="filter" class="w-full md:w-auto p-4 rounded-lg border border-green-300 dark:border-green-400 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 dark:text-gray-200 font-medium">
                    <option value="all">Todas las plantas</option>
                    <option value="tree">Árboles</option>
                    <option value="shrub">Arbustos</option>
                    <option value="herb">Hierbas</option>
                </select>
            </div>

            <!-- Información sobre plantas forestales -->
            <div class="bg-white dark:bg-green-800/80 rounded-xl shadow-xl p-8 mb-12 animate__animated animate__fadeIn flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('modules/gvff/images/plants/captus.jpg') }}" alt="Planta Forestal" class="w-full h-auto object-cover rounded-lg shadow-md">
                </div>
                <div class="w-full md:w-2/3">
                    <h3 class="text-3xl font-semibold text-green-800 dark:text-green-100 mb-6">¿Qué es una Planta Forestal?</h3>
                    <p class="text-gray-700 dark:text-gray-200 text-lg leading-relaxed">
                        Las plantas forestales son especies vegetales que forman parte de ecosistemas boscosos, contribuyendo a la biodiversidad, la conservación del suelo y la regulación del clima. Estas incluyen árboles, arbustos y hierbas que prosperan en entornos naturales o reforestados. Además de su valor ecológico, muchas plantas forestales tienen usos tradicionales, medicinales o maderables, y son esenciales para mantener el equilibrio ambiental y proporcionar hábitats para la fauna silvestre.
                    </p>
                </div>
            </div>

            <!-- Grid de plantas -->
            <div id="plants-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($plants->isNotEmpty())
                    @foreach($plants as $index => $plant)
                        @if($plant->available)
                            <div class="plant-card bg-white dark:bg-green-800/80 rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl" data-category="{{ $plant->structure_type ?? 'all' }}" data-inventory="{{ $plant->inventory ?? 0 }}">
                                <!-- Imagen -->
                                <div class="relative">
                                    <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/' . ['captus.jpg', 'elecho.jpg', 'orquidea.jpg'][$index % 3]) }}" alt="{{ $plant->common_name }}" class="w-full h-64 object-cover">
                                    <div class="absolute top-0 right-0 bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-bl-lg">
                                        {{ ucfirst($plant->structure_type ?? 'No especificada') }}
                                    </div>
                                    <button class="favorite-btn absolute top-4 left-4 text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition-colors" data-id="{{ $plant->id }}">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </button>
                                </div>
                                <!-- Contenido -->
                                <div class="p-6">
                                    <h2 class="text-2xl font-semibold text-green-800 dark:text-green-100 mb-4">{{ $plant->common_name }}</h2>
                                    <p class="text-gray-700 dark:text-gray-200 mb-3"><i class="fas fa-seedling text-green-600 mr-3"></i> Tipo: {{ ucfirst($plant->plant_type ?? 'No especificado') }}</p>
                                    <p class="text-gray-700 dark:text-gray-200 mb-3"><i class="fas fa-leaf text-green-600 mr-3"></i> Familia: {{ $plant->family ?? 'No especificada' }}</p>
                                    <p class="text-gray-600 dark:text-gray-400 text-base mb-6">{{ Str::limit($plant->characteristics ?? 'No disponible', 120) }}</p>
                                    <button class="btn-cta inline-block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 open-modal" 
                                        data-plant-id="{{ $plant->id }}" 
                                        data-plant-name="{{ $plant->common_name }}" 
                                        data-plant-scientific="{{ $plant->scientific_name }}" 
                                        data-plant-desc="{{ $plant->characteristics ?? 'No disponible' }}" 
                                        data-plant-image="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/' . ['captus.jpg', 'elecho.jpg', 'orquidea.jpg'][$index % 3]) }}" 
                                        data-plant-status="{{ $plant->status ?? 'No disponible' }}" 
                                        data-plant-benefits="{{ $plant->benefits ?? 'No disponible' }}" 
                                        data-plant-uses="{{ $plant->traditional_uses ?? 'No disponible' }}" 
                                        data-plant-family="{{ $plant->family ?? 'No especificada' }}" 
                                        data-plant-type="{{ $plant->plant_type ?? 'No especificado' }}" 
                                        data-plant-structure="{{ $plant->structure_type ?? 'No especificada' }}">Ver Detalles</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-center text-gray-700 dark:text-gray-200 text-xl">No hay plantas forestales disponibles en este momento.</p>
                @endif
            </div>

            <!-- Modal -->
            <div id="plantModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 animate__animated animate__fadeIn">
                <div class="bg-white dark:bg-green-800/80 rounded-xl p-6 max-w-lg w-full mx-4 relative transform transition-all duration-300 max-h-[80vh] overflow-y-auto">
                    <button class="absolute top-4 right-4 text-gray-600 dark:text-gray-200 hover:text-gray-800 dark:hover:text-gray-100" id="closeModal">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <img id="modalImage" src="" alt="Planta" class="w-full h-48 md:h-64 object-cover rounded-lg mb-4">
                    <h3 id="modalName" class="text-2xl font-semibold text-green-800 dark:text-green-100 mb-4"></h3>
                    <p id="modalScientific" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Nombre Científico:</strong> </p>
                    <p id="modalType" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Tipo:</strong> </p>
                    <p id="modalFamily" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Familia:</strong> </p>
                    <p id="modalStructure" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Estructura:</strong> </p>
                    <p id="modalDesc" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Descripción:</strong> </p>
                    <p id="modalBenefits" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Beneficios:</strong> </p>
                    <p id="modalUses" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Usos Tradicionales:</strong> </p>
                    <p id="modalStatus" class="text-gray-700 dark:text-gray-200 text-base mb-3"><strong>Estado:</strong> </p>
                </div>
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
            opacity: 0.4;
            animation: fall 12s infinite ease-in-out;
        }

        .leaf1 { top: -10%; left: 5%; animation-delay: 0s; animation-duration: 12s; }
        .leaf2 { top: -10%; left: 20%; animation-delay: 2s; animation-duration: 14s; }
        .leaf3 { top: -10%; left: 35%; animation-delay: 4s; animation-duration: 10s; }
        .leaf4 { top: -10%; left: 50%; animation-delay: 6s; animation-duration: 13s; }
        .leaf5 { top: -10%; left: 70%; animation-delay: 8s; animation-duration: 11s; }
        .leaf6 { top: -10%; left: 90%; animation-delay: 10s; animation-duration: 15s; }

        @keyframes fall {
            0% { transform: translateY(-100vh) rotate(0deg) scale(1); }
            100% { transform: translateY(100vh) rotate(720deg) scale(0.8); }
        }

        /* Animaciones de entrada */
        .animate__fadeIn {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Efectos 3D en tarjetas */
        .plant-card {
            perspective: 1000px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .plant-card:hover {
            transform: scale(1.05) rotateX(2deg) rotateY(2deg);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .btn-cta {
            transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-cta:hover {
            background: #34d399;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Estilo del carrusel */
        .carousel-item {
            transition: transform 0.7s ease-in-out;
        }
    </style>

    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Modo oscuro
            const themeToggle = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const html = document.documentElement;
            themeToggle.addEventListener('click', () => {
                html.classList.toggle('dark');
                themeIcon.innerHTML = html.classList.contains('dark') 
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>';
            });

            // Búsqueda y filtros
            const searchInput = document.getElementById('search');
            const filterSelect = document.getElementById('filter');
            const plantCards = document.querySelectorAll('.plant-card');

            function filterPlants() {
                const search = searchInput.value.toLowerCase();
                const filter = filterSelect.value;
                plantCards.forEach(card => {
                    const name = card.querySelector('h2').textContent.toLowerCase();
                    const category = card.dataset.category;
                    const matchesSearch = name.includes(search);
                    const matchesFilter = filter === 'all' || category === filter;
                    if (matchesSearch && matchesFilter) {
                        card.style.display = 'block';
                        card.classList.add('animate__animated', 'animate__fadeIn');
                    } else {
                        card.style.display = 'none';
                    }
                });
            }
            searchInput.addEventListener('input', filterPlants);
            filterSelect.addEventListener('change', filterPlants);

            // Carrusel principal
            const carousel = document.getElementById('carousel-items');
            const prevBtn = document.getElementById('carousel-prev');
            const nextBtn = document.getElementById('carousel-next');
            let currentIndex = 0;
            const items = document.querySelectorAll('.carousel-item');
            const totalItems = items.length;

            function updateCarousel() {
                carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            nextBtn.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            });

            prevBtn.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            });

            // Auto-rotación del carrusel
            setInterval(() => {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            }, 5000);

            // Modal dinámico
            const modal = document.getElementById('plantModal');
            const closeModal = document.getElementById('closeModal');
            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', () => {
                    const modalStatus = document.getElementById('modalStatus');
                    const status = button.getAttribute('data-plant-status').toLowerCase();
                    modalStatus.style.color = status === 'healthy' ? '#10b981' : status === 'endangered' ? '#ef4444' : status === 'critical' ? '#dc2626' : '#6b7280';

                    const modalImage = document.getElementById('modalImage');
                    const modalName = document.getElementById('modalName');
                    const modalScientific = document.getElementById('modalScientific');
                    const modalType = document.getElementById('modalType');
                    const modalFamily = document.getElementById('modalFamily');
                    const modalStructure = document.getElementById('modalStructure');
                    const modalDesc = document.getElementById('modalDesc');
                    const modalBenefits = document.getElementById('modalBenefits');
                    const modalUses = document.getElementById('modalUses');

                    modalImage.src = button.dataset.plantImage;
                    modalName.textContent = button.dataset.plantName;
                    modalScientific.innerHTML = `<strong>Nombre Científico:</strong> ${button.dataset.plantScientific}`;
                    modalType.innerHTML = `<strong>Tipo:</strong> ${button.dataset.plantType.charAt(0).toUpperCase() + button.dataset.plantType.slice(1)}`;
                    modalFamily.innerHTML = `<strong>Familia:</strong> ${button.dataset.plantFamily}`;
                    modalStructure.innerHTML = `<strong>Estructura:</strong> ${button.dataset.plantStructure.charAt(0).toUpperCase() + button.dataset.plantStructure.slice(1)}`;
                    modalDesc.innerHTML = `<strong>Descripción:</strong> ${button.dataset.plantDesc}`;
                    modalBenefits.innerHTML = `<strong>Beneficios:</strong> ${button.dataset.plantBenefits}`;
                    modalUses.innerHTML = `<strong>Usos Tradicionales:</strong> ${button.dataset.plantUses}`;
                    modalStatus.innerHTML = `<strong>Estado:</strong> ${button.dataset.plantStatus}`;
                    modal.classList.remove('hidden');
                });
            });

            // Sistema de favoritos
            const favoriteButtons = document.querySelectorAll('.favorite-btn');
            favoriteButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.classList.toggle('text-red-500');
                    btn.classList.toggle('text-gray-400');
                    const plantId = btn.dataset.id;
                    console.log(`Toggled favorite for plant ID: ${plantId}`);
                });
            });

            // Movimiento de hojas con el ratón
            document.addEventListener('mousemove', (e) => {
                const x = (e.clientX / window.innerWidth - 0.5) * 30;
                const y = (e.clientY / window.innerHeight - 0.5) * 30;
                document.querySelectorAll('.leaf').forEach(leaf => {
                    const delay = parseFloat(leaf.style.animationDelay) || 0;
                    leaf.style.transform = `translate(${x}px, ${y}px) rotate(${Math.sin(Date.now() / 1000 + delay) * 15}deg)`;
                });
            });
        });
    </script>
@endsection