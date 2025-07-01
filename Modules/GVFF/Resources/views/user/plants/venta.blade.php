@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas en Venta')

@section('content')
    <style>
        :root {
            --primary-color: #2f4f2f;
            --accent-color: #84cc16;
            --text-color: #1e293b;
            --background-gradient: linear-gradient(to bottom, #f0fdf4, #d4f4dd);
            --card-hover-gradient: linear-gradient(145deg, #ffffff, #e6f3e6);
            --shadow-light: 0 8px 20px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .plant-section {
            min-height: 100vh;
            background: var(--background-gradient);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            animation: fadeInBackground 1.5s ease-in-out;
        }

        @keyframes fadeInBackground {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .plant-section .leaf {
            position: absolute;
            width: 24px;
            height: 24px;
            background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
            background-size: contain;
            animation: float 12s infinite ease-in-out;
            opacity: 0.3;
        }

        .plant-section .leaf1 { top: 15%; left: 5%; animation-delay: 0s; }
        .plant-section .leaf2 { top: 40%; left: 85%; animation-delay: 3s; }
        .plant-section .leaf3 { top: 70%; left: 15%; animation-delay: 6s; }
        .plant-section .leaf4 { top: 25%; right: 10%; animation-delay: 1.5s; }
        .plant-section .leaf5 { top: 55%; right: 20%; animation-delay: 4.5s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(120px) rotate(180deg) scale(1.2); }
            100% { transform: translateY(0) rotate(360deg) scale(1); }
        }

        .animate__fadeIn {
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .header-section {
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            animation: slideUp 1s ease-out;
        }

        @keyframes slideUp {
            from { transform: translateY(50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .header-section h1 {
            font-size: 2.5rem;
            color: var(--accent-color);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .header-section p {
            color: var(--text-color);
            font-size: 1.1rem;
        }

        .filter-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            background: #e2e8f0;
            color: var(--text-color);
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .filter-btn.active, .filter-btn:hover {
            background: var(--accent-color);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            padding: 0 1rem;
        }

        .plant-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding-bottom: 1rem;
        }

        .plant-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            background: var(--card-hover-gradient);
        }

        .plant-card img {
            height: 220px;
            width: 100%;
            object-fit: contain;
            background: #f8fafc;
            transition: transform 0.4s ease;
        }

        .plant-card:hover img {
            transform: scale(1.1);
        }

        .plant-card h3 {
            color: var(--accent-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 1rem 0 0.75rem;
        }

        .plant-card p {
            color: var(--text-color);
            font-size: 0.95rem;
            line-height: 1.5;
            margin-bottom: 0.5rem;
        }

        .btn-cta {
            background: var(--accent-color);
            color: #ffffff;
            padding: 0.75rem 1.75rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-cta:hover {
            background: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .btn-cta i {
            font-size: 1.1rem;
        }

        .alert {
            max-width: 600px;
            margin: 0 auto 2rem;
            border-radius: 8px;
            background: #fee2e2;
            color: #b91c1c;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: fadeIn 0.8s ease-in;
        }

        /* Carrusel de Ofertas */
        .carousel {
            max-width: 900px;
            margin: 2rem auto;
            overflow: hidden;
            position: relative;
            border-radius: 12px;
            box-shadow: var(--shadow-light);
            background: #ffffff;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.6s ease-in-out;
        }

        .carousel-item {
            min-width: 100%;
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .carousel-item .placeholder {
            width: 100%;
            height: 100%;
            background: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-color);
            font-size: 1.2rem;
            position: absolute;
            top: 0;
            left: 0;
        }

        .carousel-prev, .carousel-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: #ffffff;
            border: none;
            padding: 0.5rem;
            cursor: pointer;
            font-size: 1.5rem;
            z-index: 10;
            transition: background 0.3s ease;
        }

        .carousel-prev {
            left: 10px;
        }

        .carousel-next {
            right: 10px;
        }

        .carousel-prev:hover, .carousel-next:hover {
            background: var(--primary-color);
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .plant-card img {
                height: 180px;
            }

            .plant-card h3 {
                font-size: 1.25rem;
            }

            .btn-cta {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .carousel {
                height: 200px;
            }

            .carousel-item {
                height: 200px;
            }
        }

        @media (max-width: 640px) {
            .plant-section {
                padding: 2rem 1rem;
            }

            .filter-container {
                flex-direction: column;
                align-items: center;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .header-section p {
                font-size: 1rem;
            }
        }
    </style>

    <div class="plant-section" data-aos="fade-up">
        <div class="container mx-auto px-6 py-16 relative z-10">
            <!-- Encabezado -->
            <div class="header-section">
                <h1>Plantas en Venta</h1>
                <p>Explora nuestra selección de plantas únicas y saludables</p>
            </div>

            <!-- Carrusel de Ofertas (Plantas con menor precio) -->
            <div class="carousel">
                <div class="carousel-inner" id="carouselInner">
                    @if ($plants->where('available', true)->sortBy('price')->take(3)->isNotEmpty())
                        @foreach ($plants->where('available', true)->sortBy('price')->take(3) as $offerPlant)
                            <div class="carousel-item">
                                @if ($offerPlant->image)
                                    <img src="{{ asset('storage/' . $offerPlant->image) }}" alt="{{ $offerPlant->common_name }}" 
                                         onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="placeholder">Imagen no disponible</div>
                                @else
                                    <div class="placeholder">Imagen no disponible</div>
                                @endif
                                <div class="absolute bottom-4 left-4 text-white bg-[var(--primary-color)] p-2 rounded">
                                    <p>{{ $offerPlant->common_name }} - ${{ number_format($offerPlant->price, 2) }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="carousel-item">
                            <div class="placeholder">No hay plantas disponibles</div>
                        </div>
                    @endif
                </div>
                <button class="carousel-prev" onclick="moveCarousel(-1)">❮</button>
                <button class="carousel-next" onclick="moveCarousel(1)">❯</button>
            </div>

            <!-- Filtros -->
            <div class="filter-container" id="filter-buttons">
                <button class="filter-btn active" data-filter="all">Todas</button>
                <button class="filter-btn" data-filter="ornamental">Ornamentales</button>
                <button class="filter-btn" data-filter="medicinal">Medicinales</button>
                <button class="filter-btn" data-filter="forestal">Forestales</button>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($plants->isNotEmpty())
                <div class="grid" id="plants-list">
                    @foreach ($plants as $plant)
                        @if ($plant->available && $plant->price)
                            <div class="plant-card" data-type="{{ $plant->plant_type ?? 'ornamental' }}" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}" alt="{{ $plant->common_name }}" class="w-full" 
                                     onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="placeholder hidden">Imagen no disponible</div>
                                <div class="p-6">
                                    <h3>{{ $plant->common_name }}</h3>
                                    <p><i class="fas fa-leaf text-[var(--accent-color)] mr-2"></i><strong>Nombre Científico:</strong> {{ $plant->scientific_name }}</p>
                                    <p><i class="fas fa-info-circle text-[var(--accent-color)] mr-2"></i><strong>Descripción:</strong> {{ $plant->characteristics ?? 'Sin descripción' }}</p>
                                    <p><i class="fas fa-dollar-sign text-[var(--accent-color)] mr-2"></i><strong>Precio:</strong> ${{ number_format($plant->price, 2) }}</p>
                                    <a href="https://wa.me/1234567890?text=Hola,%20quiero%20comprar%20{{ urlencode($plant->common_name) }}%20(%20${{ number_format($plant->price, 2) }})." class="btn-cta mt-4">
                                        <i class="fas fa-shopping-cart"></i> Comprar Ahora
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-[var(--text-color)] text-center text-xl">No hay plantas en venta disponibles en este momento.</p>
            @endif
        </div>

        <!-- Hojas flotantes decorativas -->
        <div class="leaf leaf1"></div>
        <div class="leaf leaf2"></div>
        <div class="leaf leaf3"></div>
        <div class="leaf leaf4"></div>
        <div class="leaf leaf5"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });

        // Filtrado dinámico
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtons = document.querySelectorAll('.filter-btn');
            const plantCards = document.querySelectorAll('.plant-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function () {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.getAttribute('data-filter');

                    plantCards.forEach(card => {
                        const cardType = card.getAttribute('data-type').toLowerCase();
                        if (filter === 'all' || cardType === filter) {
                            card.style.display = 'flex';
                            card.classList.add('animate__animated', 'animate__fadeIn');
                            setTimeout(() => card.classList.remove('animate__animated', 'animate__fadeIn'), 1200);
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });

        // Carrusel dinámico
        let currentSlide = 0;
        const carouselInner = document.getElementById('carouselInner');
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;

        function moveCarousel(direction) {
            currentSlide = (currentSlide + direction + totalSlides) % totalSlides;
            carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;
        }

        // Automatizar carrusel
        setInterval(() => moveCarousel(1), 5000);

        // Prevenir clics accidentales en el carrusel
        document.querySelector('.carousel').addEventListener('click', (e) => e.stopPropagation());

        // Manejo de imágenes
        document.querySelectorAll('img').forEach(img => {
            img.onload = function() {
                this.style.opacity = '1';
                this.nextElementSibling.style.display = 'none';
            };
            img.onerror = function() {
                this.style.display = 'none';
                this.nextElementSibling.style.display = 'flex';
            };
        });
    </script>
@endsection