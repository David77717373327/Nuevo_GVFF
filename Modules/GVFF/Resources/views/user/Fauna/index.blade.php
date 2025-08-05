@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Fauna - Viveros y Plantas')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-b from-blue-50 to-green-200 overflow-hidden">
        <!-- Fondo decorativo con siluetas de animales -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="animal animal1"></div>
            <div class="animal animal2"></div>
            <div class="animal animal3"></div>
        </div>

        <div class="container mx-auto px-6 py-16 relative z-10">
            <!-- Encabezado con imágenes grandes -->
            <div class="text-center mb-12">
                <div class="flex justify-center items-center space-x-8">
                    <img src="{{ asset('modules/gvff/images/users/animal.png') }}" alt="Animal Izquierda" class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110">
                    <h1 class="text-5xl md:text-6xl font-bold text-green-800 leading-tight animate__animated animate__fadeIn">
                        Explora la Fascinante Fauna
                    </h1>
                    <img src="{{ asset('modules/gvff/images/users/animal.png') }}" alt="Animal Derecha" class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110" style="transform: rotate(180deg);">
                </div>
            </div>

            <!-- Filtros y buscador -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-6 md:space-y-0 md:space-x-6">
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="search" placeholder="Buscar fauna..." class="w-full p-4 pl-12 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 placeholder-gray-400 font-medium">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-green-600"></i>
                </div>
                <select id="filter" class="w-full md:w-auto p-4 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 font-medium">
                    <option value="all">Toda la fauna</option>
                    <option value="mammal">Mamíferos</option>
                    <option value="bird">Aves</option>
                    <option value="reptile">Reptiles</option>
                </select>
            </div>
            
            <!-- Información sobre fauna -->
            <div class="bg-white rounded-xl shadow-xl p-8 mb-12 animate__animated animate__fadeIn flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/3">
                    <img src="{{ asset('modules/gvff/images/users/fauna.png') }}" alt="Fauna" class="w-full h-auto object-cover rounded-lg shadow-md">
                </div>
                <div class="w-full md:w-2/3">
                    <h3 class="text-3xl font-semibold text-green-800 mb-6">¿Qué es la Fauna?</h3>
                    <p class="text-gray-700 text-lg leading-relaxed">
                        La fauna abarca todos los animales que habitan un área específica, desde mamíferos y aves hasta reptiles e insectos. Estos seres vivos son esenciales para el equilibrio ecológico, contribuyendo a la polinización, dispersión de semillas y control de plagas. La fauna se clasifica según su hábitat y estado de conservación, y muchas especies enfrentan amenazas debido a la pérdida de hábitat. Ejemplos incluyen el tigre, el águila y la tortuga marina.
                    </p>
                </div>
            </div>

            <!-- Grid de fauna -->
            <div id="fauna-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(isset($faunas) && !$faunas->isEmpty())
                    @foreach($faunas as $fauna)
                        <div class="fauna-card bg-white rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl" data-category="{{ $fauna->habitat ?? 'all' }}" data-status="{{ $fauna->status ?? 'unknown' }}">
                            <div class="relative">
                                <img src="{{ $fauna->image ? asset('storage/' . $fauna->image) : asset('modules/gvff/images/users/animal-placeholder.png') }}" alt="{{ $fauna->common_name }}" class="w-full h-64 object-cover">
                                <div class="absolute top-0 right-0 bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-bl-lg">
                                    {{ ucfirst($fauna->habitat ?? 'No especificado') }}
                                </div>
                            </div>
                            <div class="p-6">
                                <h2 class="text-2xl font-semibold text-green-800 mb-4">{{ $fauna->common_name }}</h2>
                                <p class="text-gray-700 mb-3"><i class="fas fa-paw text-green-600 mr-3"></i> Tipo: {{ ucfirst($fauna->habitat ?? 'No especificado') }}</p>
                                <p class="text-gray-700 mb-3"><i class="fas fa-map-marker-alt text-green-600 mr-3"></i> Ubicación: {{ $fauna->location ?? 'No especificada' }}</p>
                                <p class="text-gray-600 text-base mb-6">{{ Str::limit($fauna->diet ?? 'No disponible', 120) }}</p>
                                <button class="btn-cta inline-block bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-300 open-modal" 
                                    data-fauna-id="{{ $fauna->id }}" 
                                    data-fauna-name="{{ $fauna->common_name }}" 
                                    data-fauna-scientific="{{ $fauna->scientific_name }}" 
                                    data-fauna-desc="{{ $fauna->diet ?? 'No disponible' }}" 
                                    data-fauna-image="{{ $fauna->image ? asset('storage/' . $fauna->image) : asset('modules/gvff/images/fauna/placeholder.jpg') }}" 
                                    data-fauna-status="{{ $fauna->status ?? 'No disponible' }}" 
                                    data-fauna-habitat="{{ $fauna->habitat ?? 'No especificado' }}" 
                                    data-fauna-location="{{ $fauna->location ?? 'No especificada' }}">Ver Detalles</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-center text-gray-700 text-xl">No hay fauna disponible. Depuración: {{ isset($faunas) ? 'Datos vacíos' : 'No se recibió $faunas' }}</p>
                @endif
            </div>
        </div>

        <!-- Modal -->
        <div id="faunaModal" class="fixed inset-0 bg-black bg-opacity-60 flex items-center justify-center hidden z-50 animate__animated animate__fadeIn">
            <div class="bg-white rounded-xl p-8 max-w-md md:max-w-2xl w-full mx-4 relative transform transition-all duration-300 max-h-[90vh] overflow-y-auto">
                <button class="absolute top-6 right-6 text-gray-600 hover:text-gray-800" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img id="modalImage" src="" alt="Fauna" class="w-full h-64 md:h-80 object-cover rounded-lg mb-6">
                <h3 id="modalName" class="text-3xl font-semibold text-green-800 mb-5"></h3>
                <p id="modalScientific" class="text-gray-700 text-lg mb-4"><strong>Nombre Científico:</strong> </p>
                <p id="modalHabitat" class="text-gray-700 text-lg mb-4"><strong>Hábitat:</strong> </p>
                <p id="modalLocation" class="text-gray-700 text-lg mb-4"><strong>Ubicación:</strong> </p>
                <p id="modalDesc" class="text-gray-700 text-lg mb-4"><strong>Dieta:</strong> </p>
                <p id="modalStatus" class="text-gray-700 text-lg mb-6"><strong>Estado:</strong> </p>
            </div>
        </div>
    </div>

    <!-- Estilos personalizados -->
    <style>
        .animal {
            position: absolute;
            width: 20px;
            height: 20px;
            background: url('https://img.icons8.com/ios-filled/50/000000/paw.png') no-repeat center;
            background-size: contain;
            animation: float 10s infinite ease-in-out;
        }

        .animal1 { top: 10%; left: 10%; animation-delay: 0s; }
        .animal2 { top: 30%; left: 80%; animation-delay: 2s; }
        .animal3 { top: 60%; left: 20%; animation-delay: 4s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(100px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        .animate__fadeIn {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fauna-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .fauna-card:hover {
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

    <!-- Script para filtros, búsqueda y modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const filterSelect = document.getElementById('filter');
            const faunaCards = document.querySelectorAll('.fauna-card');

            function filterFauna() {
                const search = searchInput.value.toLowerCase();
                const filter = filterSelect.value;

                faunaCards.forEach(card => {
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

            searchInput.addEventListener('input', filterFauna);
            filterSelect.addEventListener('change', filterFauna);

            const modal = document.getElementById('faunaModal');
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
                    const modal = document.getElementById('faunaModal');
                    const modalStatus = document.getElementById('modalStatus');
                    const status = button.getAttribute('data-fauna-status').toLowerCase();

                    modalStatus.style.color = status === 'active' ? '#10b981' : '#ef4444';

                    const modalImage = document.getElementById('modalImage');
                    const modalName = document.getElementById('modalName');
                    const modalScientific = document.getElementById('modalScientific');
                    const modalHabitat = document.getElementById('modalHabitat');
                    const modalLocation = document.getElementById('modalLocation');
                    const modalDesc = document.getElementById('modalDesc');

                    modalImage.src = button.dataset.faunaImage;
                    modalName.textContent = button.dataset.faunaName;
                    modalScientific.innerHTML = `<strong>Nombre Científico:</strong> ${button.dataset.faunaScientific}`;
                    modalHabitat.innerHTML = `<strong>Hábitat:</strong> ${button.dataset.faunaHabitat.charAt(0).toUpperCase() + button.dataset.faunaHabitat.slice(1)}`;
                    modalLocation.innerHTML = `<strong>Ubicación:</strong> ${button.dataset.faunaLocation}`;
                    modalDesc.innerHTML = `<strong>Dieta:</strong> ${button.dataset.faunaDesc}`;
                    modalStatus.innerHTML = `<strong>Estado:</strong> ${button.dataset.faunaStatus}`;
                    modal.classList.remove('hidden');
                });
            });
        });
    </script>
@endsection