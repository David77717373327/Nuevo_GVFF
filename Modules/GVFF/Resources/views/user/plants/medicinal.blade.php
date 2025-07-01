@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas Medicinales')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-b from-ecfccb to-bbf7d0 overflow-hidden" id="pageContainer">
        <!-- Fondo decorativo con hojas flotantes -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>

        <div class="container mx-auto px-6 py-16 relative z-10">
            <!-- Encabezado con imágenes grandes -->
            <div class="text-center mb-12">
                <div class="flex justify-center items-center space-x-8 mb-6">
                    <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Hoja Izquierda"
                        class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110 filter drop-shadow-md">
                    <h1 class="text-5xl md:text-6xl font-bold text-84cc16 leading-tight animate__animated animate__fadeIn">
                        Descubre las Plantas Medicinales
                    </h1>
                    <img src="{{ asset('modules/gvff/images/users/hoja.png') }}" alt="Hoja Derecha"
                        class="w-24 md:w-32 h-24 md:h-32 object-contain transition-transform duration-300 hover:scale-110 filter drop-shadow-md"
                        style="transform: rotate(180deg);">
                </div>
            </div>

            <!-- Filtros y buscador -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-6 md:space-y-0 md:space-x-6">
                <div class="relative w-full md:w-1/3">
                    <input type="text" id="search" placeholder="Buscar plantas..."
                        class="w-full p-4 pl-12 rounded-lg border border-4a652e focus:outline-none focus:ring-2 focus:ring-84cc16 text-1e293b placeholder-4a652e/50 font-medium">
                    <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-84cc16"></i>
                </div>
                <select id="filter"
                    class="w-full md:w-auto p-4 rounded-lg border border-4a652e focus:outline-none focus:ring-2 focus:ring-84cc16 text-1e293b font-medium">
                    <option value="all">Todas las plantas</option>
                    <option value="herb">Hierbas</option>
                    <option value="tree">Árboles</option>
                    <option value="shrub">Arbustos</option>
                </select>
            </div>

            <!-- Información sobre plantas medicinales con carrusel mejorado -->
            <div class="bg-white rounded-xl shadow-xl p-8 mb-12 animate__animated animate__fadeIn info-section">
                <div class="flex flex-col md:flex-row items-center gap-8">
                    <div class="carousel relative w-full h-96 overflow-hidden rounded-lg">
                        <img src="{{ asset('modules/gvff/images/users/medicina3.jpg') }}" alt="Planta Medicinal 1"
                            class="carousel-item absolute w-full h-full object-cover transition-all duration-1500 ease-in-out zoom"
                            data-index="0">
                        <img src="{{ asset('modules/gvff/images/users/medicinal.jpg') }}" alt="Planta Medicinal 2"
                            class="carousel-item absolute w-full h-full object-cover opacity-0 zoom" data-index="1">
                        <img src="{{ asset('modules/gvff/images/users/medicinal2.jpg') }}" alt="Planta Medicinal 3"
                            class="carousel-item absolute w-full h-full object-cover opacity-0 zoom" data-index="2">
                        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-10">
                            <span class="carousel-dot w-3 h-3 bg-84cc16/50 rounded-full cursor-pointer"></span>
                            <span class="carousel-dot w-3 h-3 bg-84cc16/50 rounded-full cursor-pointer"></span>
                            <span class="carousel-dot w-3 h-3 bg-84cc16/50 rounded-full cursor-pointer"></span>
                        </div>
                    </div>       
                    <div class="w-full md:w-2/3">
                        <h3 class="text-3xl font-semibold text-84cc16 mb-6 info-title">¿Qué es una Planta Medicinal?</h3>
                        <p class="text-1e293b text-lg leading-relaxed info-text mb-4">
                            Las plantas medicinales son especies vegetales utilizadas por sus propiedades curativas y
                            terapéuticas, siendo parte de la medicina tradicional y moderna. Contienen compuestos bioactivos
                            que tratan afecciones como inflamaciones o problemas digestivos. Ejemplos: manzanilla, aloe vera
                            y menta.
                        </p>
                        <p class="text-1e293b text-lg leading-relaxed info-text mb-4">
                            <strong>Beneficios:</strong> Fortalecen el sistema inmunológico, reducen el estrés y promueven
                            la salud general.
                        </p>
                        <p class="text-1e293b text-lg leading-relaxed info-text mb-4">
                            <strong>Contraindicaciones:</strong> Algunas pueden causar alergias o interactuar con
                            medicamentos; consulta a un especialista.
                        </p>
                        <p class="text-1e293b text-lg leading-relaxed info-text">
                            <strong>Uso Moderno:</strong> Se emplean en suplementos, cosméticos y tratamientos farmacéuticos
                            innovadores.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Plantas Medicinales Encontradas en el SENA -->
            <div class="bg-white rounded-xl shadow-xl p-8 mb-12 animate__animated animate__fadeIn">
                <h3 class="text-3xl font-semibold text-84cc16 mb-6">Plantas Medicinales Encontradas en el SENA</h3>
                <div class="plant-container grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="plants-list">
                    @if($plants->isNotEmpty())
                        @foreach($plants as $plant)
                            @if($plant->available)
                                <div class="plant-card bg-white rounded-xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:bg-ecfccb/50 relative"
                                    data-category="{{ $plant->structure_type ?? 'all' }}" data-inventory="{{ $plant->inventory ?? 0 }}">
                                    <!-- Imagen estática con efecto de opacidad -->
                                    <div class="relative h-64 overflow-hidden">
                                        <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}"
                                            alt="{{ $plant->common_name }}"
                                            class="w-full h-full object-cover transition-opacity duration-300 static-image"
                                            data-speed="0.3">
                                        <div class="absolute top-0 right-0 bg-84cc16 text-white text-sm font-medium px-4 py-2 rounded-bl-lg shadow-md"
                                            data-tooltip="Tipo de planta">
                                            {{ ucfirst($plant->structure_type ?? 'No especificada') }}
                                        </div>
                                    </div>
                                    <!-- Contenido -->
                                    <div class="p-6">
                                        <h2 class="text-2xl font-semibold text-84cc16 mb-4 card-title">{{ $plant->common_name }}</h2>
                                        <p class="text-1e293b mb-3"><i class="fas fa-seedling text-84cc16 mr-3"></i> Tipo:
                                            {{ ucfirst($plant->plant_type ?? 'No especificado') }}</p>
                                        <p class="text-1e293b mb-3"><i class="fas fa-leaf text-84cc16 mr-3"></i> Propiedades:
                                            {{ $plant->properties ?? 'No disponible' }}</p>
                                        <p class="text-1e293b mb-3"><i class="fas fa-book-medical text-84cc16 mr-3"></i> Usos Trad.:
                                            {{ $plant->traditional_uses ?? 'No disponible' }}</p>
                                        <p class="text-4a652e/70 text-base mb-6 card-text">
                                            {{ Str::limit($plant->characteristics ?? 'Sin descripción', 120) }}</p>
                                        <button
                                            class="btn-cta inline-block bg-84cc16 text-white px-6 py-3 rounded-lg hover:bg-4a652e transition duration-300 expand-btn"
                                            data-plant-id="{{ $plant->id }}">
                                            Más Detalles
                                        </button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p class="text-center text-1e293b text-xl">No hay plantas medicinales disponibles en este momento.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="plantModal"
            class="fixed inset-0 bg-4a652e/70 flex items-center justify-center hidden z-50 animate__animated animate__fadeIn">
            <div
                class="bg-white rounded-xl p-8 max-w-md md:max-w-2xl w-full mx-4 relative transform transition-all duration-300 max-h-[90vh] overflow-y-auto">
                <button class="absolute top-6 right-6 text-1e293b hover:text-84cc16" id="closeModal">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <img id="modalImage" src="" alt="Planta"
                    class="w-full h-64 md:h-80 object-cover rounded-lg mb-6 transition-opacity duration-300 hover:opacity-90">
                <h3 id="modalName" class="text-3xl font-semibold text-84cc16 mb-5 modal-title"></h3>
                <p id="modalScientific" class="text-1e293b text-lg mb-4 modal-text"><strong>Nombre Científico:</strong> </p>
                <p id="modalType" class="text-1e293b text-lg mb-4 modal-text"><strong>Tipo:</strong> </p>
                <p id="modalProperties" class="text-1e293b text-lg mb-4 modal-text"><strong>Propiedades:</strong> </p>
                <p id="modalUses" class="text-1e293b text-lg mb-4 modal-text"><strong>Usos Tradicionales:</strong> </p>
                <p id="modalDesc" class="text-1e293b text-lg mb-4 modal-text"><strong>Descripción:</strong> </p>
                <p id="modalBenefits" class="text-1e293b text-lg mb-4 modal-text"><strong>Beneficios:</strong> </p>
                <p id="modalContraindications" class="text-1e293b text-lg mb-4 modal-text">
                    <strong>Contraindicaciones:</strong> </p>
                <p id="modalModernUses" class="text-1e293b text-lg mb-4 modal-text"><strong>Uso Moderno:</strong> </p>
                <p id="modalStatus" class="text-1e293b text-lg mb-6 modal-text"><strong>Estado:</strong> </p>
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

        .leaf1 {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .leaf2 {
            top: 30%;
            left: 80%;
            animation-delay: 2s;
        }

        .leaf3 {
            top: 60%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(100px) rotate(180deg);
            }

            100% {
                transform: translateY(0) rotate(360deg);
            }
        }

        /* Animaciones de entrada */
        .animate__fadeIn {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilos base con tema Natural */
        #pageContainer {
            color: #1e293b;
            transition: all 0.5s ease;
        }

        .info-section,
        .plant-card,
        #plantModal,
        .bio-card,
        .plant-container {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: all 0.5s ease;
        }

        .info-title,
        .card-title,
        .modal-title {
            color: #84cc16;
            transition: color 0.5s ease;
        }

        .info-text,
        .card-text,
        .modal-text {
            color: #1e293b;
            transition: color 0.5s ease;
        }

        .btn-cta {
            background-color: #84cc16;
            transition: background-color 0.5s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-cta:hover {
            background-color: #4a652e;
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        /* Estilos de las tarjetas */
        .plant-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.5s ease;
        }

        .plant-card:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        /* Carrusel y Parallax mejorado */
       .carousel {
            position: relative;
        }
        .carousel-item {
            transition: opacity 1.5s ease, transform 1.5s ease;
        }
        .carousel-item.active {
            opacity: 1;
            transform: scale(1.2) rotate(5deg);
        }
        .carousel-item:not(.active) {
            opacity: 0;
            transform: scale(0.8) rotate(-5deg);
        }
        .zoom {
            transition: transform 1.5s ease;
        }
        .carousel-item.active.zoom {
            transform: scale(1.3);
        }
        .carousel-dot {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .carousel-dot:hover {
            background-color: rgb(255, 255, 255);
            transform: scale(1.5);
        }
        .carousel-dot.active {
            background-color: rgb(255, 255, 255);
            transform: scale(1.5);
        }
        /* Imagen estática con efecto de opacidad */
        .static-image {
            transition: opacity 0.3s ease;
            opacity: 1;
        }

        .plant-card:hover .static-image {
            opacity: 0.5;
        }

        /* Tooltips */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4a652e;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.875rem;
            white-space: nowrap;
            z-index: 10;
            margin-bottom: 8px;
        }

        /* Efectos adicionales */
        img {
            transition: opacity 0.3s ease, transform 0.1s ease;
        }

        img:hover {
            opacity: 0.5;
        }

        .bio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
    </style>

    <!-- Script para filtros, búsqueda, carrusel, parallax y detalles -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const filterSelect = document.getElementById('filter');
            const plantCards = document.querySelectorAll('.plant-card');
            const carouselItems = document.querySelectorAll('.carousel-item');
            const carouselDots = document.querySelectorAll('.carousel-dot');
            let currentSlide = 0;

            // Función para filtrar plantas
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
            document.querySelectorAll('.btn-cta').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    const modal = document.getElementById('plantModal');
                    const modalName = document.getElementById('modalName');
                    const modalScientific = document.getElementById('modalScientific');
                    const modalType = document.getElementById('modalType');
                    const modalProperties = document.getElementById('modalProperties');
                    const modalUses = document.getElementById('modalUses');
                    const modalDesc = document.getElementById('modalDesc');
                    const modalBenefits = document.getElementById('modalBenefits');
                    const modalContraindications = document.getElementById('modalContraindications');
                    const modalModernUses = document.getElementById('modalModernUses');
                    const modalStatus = document.getElementById('modalStatus');
                    const plantCard = button.closest('.plant-card');
                    const plantImage = plantCard.querySelector('img').src;
                    const plantCommonName = plantCard.querySelector('h2').textContent;
                    const plantScientificName = plantCard.querySelector('p:nth-child(2)').textContent.replace('Nombre Científico: ', '');
                    const plantProperties = plantCard.querySelector('p:nth-child(3)').textContent.replace('Propiedades: ', '');
                    const plantTraditionalUses = plantCard.querySelector('p:nth-child(4)').textContent.replace('Usos Trad.: ', '');
                    const plantCharacteristics = plantCard.querySelector('p:nth-child(5)').textContent.replace('Descripción: ', '');
                    const plantBenefits = plantCard.querySelector('div.extra-info p:nth-child(1)')?.textContent.replace('Beneficios: ', '') ?? 'No disponible';
                    const plantContraindications = plantCard.querySelector('div.extra-info p:nth-child(2)')?.textContent.replace('Contraindic.: ', '') ?? 'No disponible';
                    const plantModernUses = plantCard.querySelector('div.extra-info p:nth-child(3)')?.textContent.replace('Uso Moderno: ', '') ?? 'No disponible';

                    modalImage.src = plantImage;
                    modalName.textContent = plantCommonName;
                    modalScientific.innerHTML = `<strong>Nombre Científico:</strong> ${plantScientificName}`;
                    modalType.innerHTML = `<strong>Tipo:</strong> ${plantCard.dataset.category.charAt(0).toUpperCase() + plantCard.dataset.category.slice(1) || 'No especificado'}`;
                    modalProperties.innerHTML = `<strong>Propiedades:</strong> ${plantProperties}`;
                    modalUses.innerHTML = `<strong>Usos Tradicionales:</strong> ${plantTraditionalUses}`;
                    modalDesc.innerHTML = `<strong>Descripción:</strong> ${plantCharacteristics}`;
                    modalBenefits.innerHTML = `<strong>Beneficios:</strong> ${plantBenefits}`;
                    modalContraindications.innerHTML = `<strong>Contraindicaciones:</strong> ${plantContraindications}`;
                    modalModernUses.innerHTML = `<strong>Uso Moderno:</strong> ${plantModernUses}`;
                    modalStatus.innerHTML = `<strong>Estado:</strong> ${plantCard.dataset.inventory > 0 ? 'Disponible' : 'No disponible'}`;
                    modal.classList.remove('hidden');
                });
            });

            // Carrusel automático mejorado
            function showSlide(index) {
                carouselItems.forEach(item => {
                    item.classList.remove('active');
                    item.style.transform = 'scale(1)';
                });
                carouselDots.forEach(dot => dot.classList.remove('active'));
                carouselItems[index].classList.add('active');
                carouselDots[index].classList.add('active');
                carouselItems[index].style.transform = 'scale(2)';
                currentSlide = (index + 1) % carouselItems.length;
            }

            setInterval(() => showSlide(currentSlide), 5000);
            carouselDots.forEach((dot, index) => {
                dot.addEventListener('click', () => showSlide(index));
            });
            showSlide(0);

            // Efecto Parallax (desactivado para imágenes de tarjetas)
            function parallaxEffect() {
                const scrollTop = window.pageYOffset;
                document.querySelectorAll('.parallax').forEach(img => {
                    const speed = parseFloat(img.getAttribute('data-speed'));
                    img.style.transform = `translateY(${scrollTop * speed}px)`;
                });
            }

            window.addEventListener('scroll', parallaxEffect);
            parallaxEffect();

            // Efectos dinámicos al hacer hover en tarjetas
            plantCards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.backgroundColor = 'rgba(236, 252, 203, 0.5)';
                    card.querySelector('img').style.transform = 'scale(1)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.backgroundColor = 'white';
                    card.querySelector('img').style.transform = 'scale(1)';
                });
            });
        });
    </script>
@endsection