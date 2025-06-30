
@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas Ornamentales - Viveros y Plantas')

@section('content')
    <!-- Contenedor principal -->
    <section class="mt-20 py-12 relative bg-green-50 overflow-hidden" data-aos="fade-up" style="background-image: url('{{ asset('modules/gvff/images/leaves/leaf1.png') }}'), url('{{ asset('modules/gvff/images/leaves/leaf2.png') }}'); background-position: 10% 10%, 90% 90%; background-repeat: no-repeat; background-size: 100px 100px;">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-center mb-8 relative" data-aos="fade-down">
                <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Leaf" class="w-10 h-10 inline-block transition-transform duration-300 hover:scale-110 animate-spin-slow" style="animation-duration: 8s;">
                <h2 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 via-green-600 to-green-800 animate-pulse hover:animate-bounce hover:text-green-900 transition-all duration-500 ease-in-out mx-4 px-6 py-2 bg-white bg-opacity-80 rounded-lg shadow-md">
                    Explora las Magníficas Plantas Ornamentales
                </h2>
                <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Leaf" class="w-10 h-10 inline-block transition-transform duration-300 hover:scale-110 animate-spin-slow" style="animation-duration: 10s; transform: rotate(180deg);">
            </div>

            <!-- Información sobre plantas ornamentales -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8 transform hover:shadow-2xl transition-all duration-300" data-aos="fade-up" id="infoSection">
                <h3 class="text-2xl font-semibold text-green-700 mb-4">¿Qué es una Planta Ornamental?</h3>
                <p class="text-gray-600 leading-relaxed">
                    Las plantas ornamentales son aquellas cultivadas principalmente por su belleza estética, ya sea por sus flores, hojas, forma o color. Se utilizan para decorar jardines, interiores, parques y espacios públicos, aportando valor visual y ambiental. Estas plantas no suelen tener un uso práctico directo (como medicinal o alimenticio), sino que se valoran por su capacidad de embellecer el entorno. Ejemplos comunes incluyen rosas, helechos y cactus decorativos. Además, muchas de ellas contribuyen a la biodiversidad y pueden mejorar la calidad del aire.
                </p>
            </div>

            <!-- Grid de plantas -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @if($plants->isNotEmpty())
                    @foreach($plants as $plant)
                        @if($plant->available)
                            <div class="plant-card bg-white rounded-xl shadow-lg p-6 transform hover:scale-105 transition-all duration-300 relative" data-aos="zoom-in" data-category="{{ $plant->structure_type ?? 'all' }}" data-inventory="{{ $plant->inventory ?? 0 }}">
                                <span class="absolute top-2 left-2"></span>
                                <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/users/palma.png') }}" alt="{{ $plant->common_name }}" class="w-full h-48 object-cover rounded mb-4 hover:opacity-90 transition-opacity duration-300">
                                <h3 class="text-xl font-bold text-green-700 mb-2">{{ $plant->common_name }}</h3>
                                <p class="text-gray-600 mb-2"><strong>Nombre Científico:</strong> {{ $plant->scientific_name }}</p>
                                <p class="text-gray-600 mb-2"><strong>Estructura:</strong> {{ ucfirst($plant->structure_type ?? 'No especificada') }}</p>
                                <p class="text-gray-600 mb-2"><strong>Familia:</strong> {{ $plant->family ?? 'No especificada' }}</p>
                                <p class="text-gray-600 mb-2"><strong>Tipo:</strong> {{ ucfirst($plant->plant_type ?? 'No especificado') }}</p>
                                <p class="text-gray-600 mb-4"><strong>Disponibilidad:</strong> {{ $plant->available ? 'Disponible' : 'No disponible' }}</p>
                                <div class="flex space-x-2">
                                    <button class="btn-cta inline-block px-4 py-2 text-white rounded-lg open-modal" 
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
                    <p class="text-gray-600 text-center col-span-full">No hay plantas ornamentales disponibles en este momento.</p>
                @endif
            </div>
        </div>
        <div id="leafContainer" class="absolute top-0 left-0 w-full h-full pointer-events-none"></div>
    </section>

    <!-- Modal -->
    <div id="plantModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50" data-aos="fade-in">
        <div class="bg-white rounded-xl p-8 max-w-lg w-full mx-4 relative transform transition-all duration-300">
            <button class="absolute top-4 right-4 text-gray-600 hover:text-gray-800" id="closeModal">
                <i class="fas fa-times text-xl"></i>
            </button>
            <img id="modalImage" src="" alt="Planta" class="w-full h-64 object-cover rounded mb-4">
            <h3 id="modalName" class="text-2xl font-bold text-green-700 mb-2"></h3>
            <p id="modalScientific" class="text-gray-600 mb-2"><strong>Nombre Científico:</strong> </p>
            <p id="modalType" class="text-gray-600 mb-2"><strong>Tipo:</strong> </p>
            <p id="modalFamily" class="text-gray-600 mb-2"><strong>Familia:</strong> </p>
            <p id="modalStructure" class="text-gray-600 mb-2"><strong>Estructura:</strong> </p>
            <p id="modalLocation" class="text-gray-600 mb-2"><strong>Ubicación:</strong> </p>
            <p id="modalDesc" class="text-gray-600 mb-2"><strong>Descripción:</strong> </p>
            <p id="modalBenefits" class="text-gray-600 mb-2"><strong>Beneficios:</strong> </p>
            <p id="modalUses" class="text-gray-600 mb-2"><strong>Usos Tradicionales:</strong> </p>
            <p id="modalStatus" class="text-gray-600 mb-4"><strong>Estado:</strong> </p>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Inicializar AOS
        AOS.init({
            duration: 800,
            once: true,
        });

        // Aplicar estilos dinámicos
        function applyDynamicStyles() {
            // Estilos para las tarjetas de plantas
            document.querySelectorAll('.plant-card').forEach(card => {
                const category = card.getAttribute('data-category');
                const inventory = parseInt(card.getAttribute('data-inventory') || 0);
                const image = card.querySelector('img');

                // Colores según estructura (category)
                switch (category.toLowerCase()) {
                    case 'tree':
                        card.style.borderLeft = '4px solid #10b981'; // Verde para árboles
                        break;
                    case 'shrub':
                        card.style.borderLeft = '4px solid #8b5cf6'; // Púrpura para arbustos
                        break;
                    case 'herb':
                        card.style.borderLeft = '4px solid #f59e0b'; // Amarillo para hierbas
                        break;
                    default:
                        card.style.borderLeft = '4px solid #6b7280'; // Gris para no especificado
                }

                // Ajuste de tamaño de imagen según inventario
                if (inventory > 50) {
                    image.style.height = '60%'; // Imagen más grande si hay mucho inventario
                    card.style.height = 'auto';
                } else if (inventory > 0) {
                    image.style.height = '50%'; // Tamaño medio
                    card.style.height = 'auto';
                } else {
                    image.style.height = '40%'; // Más pequeño si inventario bajo
                    card.style.height = 'auto';
                }
            });

            // Animación de borde en la sección de información según número de plantas
            const plantCount = document.querySelectorAll('.plant-card').length;
            const infoSection = document.getElementById('infoSection');
            if (plantCount > 5) {
                infoSection.style.border = '2px solid #f59e0b';
                infoSection.style.animation = 'pulse 2s infinite';
            } else if (plantCount > 0) {
                infoSection.style.border = '2px solid #10b981';
                infoSection.style.animation = 'pulse 3s infinite';
            } else {
                infoSection.style.border = '2px solid #ef4444';
                infoSection.style.animation = 'pulse 4s infinite';
            }

            // Estilos dinámicos en el modal según estado
            document.querySelectorAll('.open-modal').forEach(button => {
                button.addEventListener('click', () => {
                    const modal = document.getElementById('plantModal');
                    const modalStatus = document.getElementById('modalStatus');
                    const status = button.getAttribute('data-plant-status').toLowerCase();

                    switch (status) {
                        case 'healthy':
                            modalStatus.style.color = '#10b981'; // Verde
                            break;
                        case 'endangered':
                            modalStatus.style.color = '#ef4444'; // Rojo
                            break;
                        case 'critical':
                            modalStatus.style.color = '#dc2626'; // Rojo más oscuro
                            break;
                        default:
                            modalStatus.style.color = '#6b7280'; // Gris
                    }

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
        }

        // Dinamic leaf placement
        function addDynamicLeaves() {
            const leafContainer = document.getElementById('leafContainer');
            const plantCount = document.querySelectorAll('.plant-card').length;
            const maxLeaves = Math.min(plantCount * 2, 10); // Up to 10 leaves

            for (let i = 0; i < maxLeaves; i++) {
                const leaf = document.createElement('img');
                leaf.src = '{{ asset('modules/gvff/images/leaves/leaf1.png') }}';
                leaf.className = 'absolute w-16 h-16 opacity-20 animate-float';
                leaf.style.left = `${Math.random() * 100}%`;
                leaf.style.top = `${Math.random() * 100}%`;
                leaf.style.transform = `rotate(${Math.random() * 360}deg)`;
                leafContainer.appendChild(leaf);
            }
        }

        // Modal cerrar
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

        // Asignar eventos al cargar la página
        document.addEventListener('DOMContentLoaded', () => {
            applyDynamicStyles();
            addDynamicLeaves();
        });

        // Definición de animaciones
        const styleSheet = document.styleSheets[0];
        styleSheet.insertRule(`
            @keyframes pulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        `, styleSheet.cssRules.length);
        styleSheet.insertRule(`
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-10px); }
            }
        `, styleSheet.cssRules.length);
        styleSheet.insertRule(`
            @keyframes float {
                0% { transform: translateY(0); }
                50% { transform: translateY(-20px); }
                100% { transform: translateY(0); }
            }
        `, styleSheet.cssRules.length);
    </script>

    <style>
        /* Estilos adicionales */
        .btn-cta {
            background: linear-gradient(45deg, #2e9450, #49c954);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .plant-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .plant-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }
        #plantModal {
            transition: all 0.3s ease;
        }
        #plantModal:not(.hidden) {
            opacity: 1;
            transform: scale(1);
        }
        #plantModal.hidden {
            opacity: 0;
            transform: scale(0.95);
        }
        .animate-spin-slow {
            animation: spin 3s linear infinite;
        }
        /* Estilos para hojas de fondo */
        section {
            background-attachment: fixed;
        }
        section::before {
            content: '';
            position: absolute;
            top: -50px;
            left: -50px;
            width: 150px;
            height: 150px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.3;
            animation: float 15s infinite ease-in-out;
        }
        section::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.3;
            animation: float 20s infinite ease-in-out reverse;
        }
    </style>
@endsection
