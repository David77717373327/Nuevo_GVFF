@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas Ornamentales - Viveros y Plantas')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-b from-green-50 to-green-200 overflow-hidden">
        <!-- Fondo decorativo con hojas flotantes -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>

        <div class="container mx-auto px-6 py-16 relative z-10">
            <!-- Encabezado con imágenes grandes -->
            <div class="text-center mb-12">
                <div class="flex justify-center items-center space-x-8">
                    <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Hoja Izquierda" class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110">
                    <h1 class="text-5xl md:text-6xl font-bold text-green-800 leading-tight animate__animated animate__fadeIn">
                        Explora las Magníficas Plantas Ornamentales
                    </h1>
                    <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Hoja Derecha" class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110" style="transform: rotate(180deg);">
                </div>
            </div>

            <!-- Filtros y buscador -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-6 md:space-y-0 md:space-x-6">
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="search" placeholder="Buscar plantas..." class="w-full p-4 pl-12 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 placeholder-gray-400 font-medium">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-green-600"></i>
                </div>
                <select id="filter" class="w-full md:w-auto p-4 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 font-medium">
                    <option value="all">Todas las plantas</option>
                    <option value="tree">Árboles</option>
                    <option value="shrub">Arbustos</option>
                    <option value="herb">Hierbas</option>
                </select>
            </div>

            <!-- Información sobre plantas ornamentales -->
           <div class="bg-white rounded-xl shadow-xl p-8 mb-12 animate__animated animate__fadeIn flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('modules/gvff/images/users/ornamental.png') }}" alt="Planta Ornamental" class="w-full h-auto object-cover rounded-lg shadow-md">
                </div>
                <div class="w-full md:w-2/3">
                    <h3 class="text-3xl font-semibold text-green-800 mb-6">¿Qué es una Planta Ornamental?</h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        Las plantas ornamentales son aquellas cultivadas principalmente por su belleza estética, ya sea por sus flores, hojas, forma o color. Se utilizan para decorar jardines, interiores, parques y espacios públicos, aportando valor visual y ambiental. Estas plantas no suelen tener un uso práctico directo (como medicinal o alimenticio), sino que se valoran por su capacidad de embellecer el entorno. Ejemplos comunes incluyen rosas, helechos y cactus decorativos. Además, muchas de ellas contribuyen a la biodiversidad y pueden mejorar la calidad del aire.
                    </p>
                </div>
            </div>

             <h3 class="text-3xl font-semibold text-green-800 mb-6">Plantas Ornamentales Encontradas en el SENA</h3>

            <!-- Grid de plantas -->
            <div id="plants-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if($plants->isNotEmpty())
                    @foreach($plants as $plant)
                        @if($plant->available)
                            <div class="plant-card bg-white rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl" data-category="{{ $plant->structure_type ?? 'all' }}" data-inventory="{{ $plant->inventory ?? 0 }}">
                                <!-- Imagen -->
                                <div class="relative">
                                    <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/users/palma.png') }}" alt="{{ $plant->common_name }}" class="w-full h-64 object-cover">
                                    <div class="absolute top-0 right-0 bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-bl-lg">
                                        {{ ucfirst($plant->structure_type ?? 'No especificada') }}
                                    </div>
                                </div>
                                <!-- Contenido -->
                                <div class="p-6">
                                    <h2 class="text-2xl font-semibold text-green-800 mb-4">{{ $plant->common_name }}</h2>
                                    <p class="text-gray-700 mb-3"><i class="fas fa-seedling text-green-700 mr-3"></i> Tipo: {{ ucfirst($plant->plant_type ?? 'No especificado') }}</p>
                                    <p class="text-gray-700 mb-3"><i class="fas fa-leaf text-green-700 mr-3"></i> Familia: {{ $plant->family ?? 'No especificada' }}</p>
                                    <p class="text-gray-600 text-base mb-6">{{ Str::limit($plant->characteristics ?? 'No disponible', 120) }}</p>
                                    <button class="btn-cta inline-block bg-green-700 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300 open-modal" 
                                        data-plant-id="{{ $plant->id }}" 
                                        data-plant-name="{{ $plant->common_name }}" 
                                        data-plant-scientific="{{ $plant->scientific_name }}" 
                                        data-plant-desc="{{ $plant->characteristics ?? 'No disponible' }}" 
                                        data-plant-image="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}" 
                                        data-plant-status="{{ $plant->status ?? 'No disponible' }}" 
                                        data-plant-benefits="{{ $plant->benefits ?? 'No disponible' }}" 
                                        data-plant-uses="{{ $plant->traditional_uses ?? 'No disponible' }}" 
                                        data-plant-family="{{ $plant->family ?? 'No especificada' }}" 
                                        data-plant-type="{{ $plant->plant_type ?? 'No especificado' }}" 
                                        data-plant-location="{{ $plant->location ?? 'No especificada' }}" 
                                        data-plant-inventory="{{ $plant->inventory ?? 0 }}">Ver Detalles</button>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-center text-gray-700 text-xl">No hay plantas ornamentales disponibles en este momento.</p>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div id="plantModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 animate__animated animate__fadeIn">
            <div class="bg-white rounded-xl p-8 max-w-md md:max-w-2xl w-full mx-4 relative transform transition-all duration-300 max-h-[90vh] overflow-y-auto">
                <button class="absolute top-6 right-6 text-gray-600 hover:text-gray-800" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img id="modalImage" src="" alt="Planta" class="w-full h-64 md:h-80 object-cover rounded-lg mb-6">
                <h3 id="modalName" class="text-3xl font-semibold text-green-800 mb-5"></h3>
                <p id="modalScientific" class="text-gray-700 text-lg mb-4"><strong>Nombre Científico:</strong> </p>
                <p id="modalType" class="text-gray-700 text-lg mb-4"><strong>Tipo:</strong> </p>
                <p id="modalFamily" class="text-gray-700 text-lg mb-4"><strong>Familia:</strong> </p>
                <p id="modalStructure" class="text-gray-700 text-lg mb-4"><strong>Estructura:</strong> </p>
                <p id="modalLocation" class="text-gray-700 text-lg mb-4"><strong>Ubicación:</strong> </p>
                <p id="modalDesc" class="text-gray-700 text-lg mb-4"><strong>Descripción:</strong> </p>
                <p id="modalBenefits" class="text-gray-700 text-lg mb-4"><strong>Beneficios:</strong> </p>
                <p id="modalUses" class="text-gray-700 text-lg mb-4"><strong>Usos Tradicionales:</strong> </p>
                <p id="modalStatus" class="text-gray-700 text-lg mb-6"><strong>Estado:</strong> </p>
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

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Estilos de las tarjetas */
        .plant-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .plant-card:hover {
            transform: scale(1.05);
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
    </style>

    <!-- Script para filtros y búsqueda -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            // Cerrar modal
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

            // Modal dinámico
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', () => {
                    const modal = document.getElementById('plantModal');
                    const modalStatus = document.getElementById('modalStatus');
                    const status = button.getAttribute('data-plant-status').toLowerCase();

                    modalStatus.style.color = status === 'healthy' ? '#10b981' : status === 'endangered' ? '#ef4444' : status === 'critical' ? '#dc2626' : '#6b7280';

                    const modalImage = document.getElementById('modalImage');
                    const modalName = document.getElementById('modalName');
                    const modalScientific = document.getElementById('modalScientific');
                    const modalType = document.getElementById('modalType');
                    const modalFamily = document.getElementById('modalFamily');
                    const modalStructure = document.getElementById('modalStructure');
                    const modalLocation = document.getElementById('modalLocation');
                    const modalDesc = document.getElementById('modalDesc');
                    const modalBenefits = document.getElementById('modalBenefits');
                    const modalUses = document.getElementById('modalUses');

                    modalImage.src = button.dataset.plantImage;
                    modalName.textContent = button.dataset.plantName;
                    modalScientific.innerHTML = `<strong>Nombre Científico:</strong> ${button.dataset.plantScientific}`;
                    modalType.innerHTML = `<strong>Tipo:</strong> ${button.dataset.plantType.charAt(0).toUpperCase() + button.dataset.plantType.slice(1)}`;
                    modalFamily.innerHTML = `<strong>Familia:</strong> ${button.dataset.plantFamily}`;
                    modalStructure.innerHTML = `<strong>Estructura:</strong> ${button.dataset.plantStructure ? button.dataset.plantStructure.charAt(0).toUpperCase() + button.dataset.plantStructure.slice(1) : 'No especificada'}`;
                    modalLocation.innerHTML = `<strong>Ubicación:</strong> ${button.dataset.plantLocation}`;
                    modalDesc.innerHTML = `<strong>Descripción:</strong> ${button.dataset.plantDesc}`;
                    modalBenefits.innerHTML = `<strong>Beneficios:</strong> ${button.dataset.plantBenefits}`;
                    modalUses.innerHTML = `<strong>Usos Tradicionales:</strong> ${button.dataset.plantUses}`;
                    modalStatus.innerHTML = `<strong>Estado:</strong> ${button.dataset.plantStatus}`;
                    modal.classList.remove('hidden');
                });
            });
        });
    </script>
@endsection