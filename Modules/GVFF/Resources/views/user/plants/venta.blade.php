@extends('gvff::layouts.masterusersNarvas')

@section('title', 'Plantas en Venta')

@section('content')

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



<div class="plant-section">
    <div class="header-section">
        <h1>Producto del mes</h1>
    </div>
    <div class="grid" id="plants-list">
        @foreach ($plants as $plant)
            @if ($plant->available && $plant->price)
                <div class="plant-card" data-type="{{ $plant->plant_type ?? 'ornamental' }}" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="plant-image">
                        <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}" alt="{{ $plant->common_name }}" 
                             onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="placeholder hidden">Imagen no disponible</div>
                    </div>
                    <div class="plant-details">
                        <h2>{{ $plant->common_name }}</h2>
                        <p>Tamaño: </p>
                        <span class="size-input">50 x 50</span><br>
                        

                        <p>Cantidad:</p>
                        <div class="quantity-container">                            
    <div class="quantity-input">
        <button class="quantity-btn" aria-label="Decrease quantity">-</button>
        <input type="number" id="quantity" value="1" min="1" class="quantity-input-field">
        <button class="quantity-btn" aria-label="Increase quantity">+</button>
    </div>
</div>
                        <p>$ {{ number_format($plant->price, 2) }} <span>Los gastos de envío se calculan en la pantalla de pago</span></p>
                        <div class="buttons">
                            <button class="add-to-cart">Agregar al carrito</button>
                            <button class="buy-now">Comprar ahora</button>
                        </div>
                        <div class="extra-links">
                            <a href="#">Share</a>
                            <a href="#">Ver todos los detalles</a>
                            <a href="https://wa.me/1234567890?text=Hola,%20quiero%20comprar%20{{ urlencode($plant->common_name) }}%20(%20${{ number_format($plant->price, 2) }}).">
                                <img src="https://img.icons8.com/color/24/000000/whatsapp.png" alt="WhatsApp">
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    @if ($plants->isEmpty())
        <p class="text-[var(--text-color)] text-center text-xl">No hay plantas en venta disponibles en este momento.</p>
    @endif
</div>

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