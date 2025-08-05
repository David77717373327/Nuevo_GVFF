<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viveros y Plantas - Explora la Naturaleza</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Swiper JS para el carrusel -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- AOS para animaciones en scroll -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        /* Estilos inline para el carrusel */
        .carousel-image {
            height: 600px;
            object-fit: cover;
            width: 100%;
            transform: scale(1.1);
            transition: transform 10s ease;
        }

        .swiper-slide-active .carousel-image {
            transform: scale(1);
        }

        .carousel-caption {
            background: rgba(0, 0, 0, 0.6);
            padding: 1.5rem;
            border-radius: 0.75rem;
            transform: translateY(20px);
            opacity: 0;
            animation: slideUp 1s ease forwards 0.5s;
            z-index: 10;
        }

        @keyframes slideUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .btn-cta {
            background-color: #198754;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        #main-carousel {
            transition: transform 1.2s cubic-bezier(0.4, 0, 0.2, 1), opacity 1.2s cubic-bezier(0.4, 0, 0.2, 1), max-height 1.2s cubic-bezier(0.4, 0, 0.2, 1), margin 1.2s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: top;
            z-index: 5;
            position: relative;
            max-height: 700px;
            overflow: hidden;
            background: linear-gradient(135deg, #e6f3e6 0%, #ffffff 100%);
            margin-bottom: 2rem;
        }

        #main-carousel.shrink {
            transform: scaleY(0.7);
            opacity: 0;
            max-height: 0;
            margin-bottom: 0;
            pointer-events: none;
        }

        /* Estilos para la navegación */
        .navbar {
            background: #198754;
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-left: 0.5rem;
            /* Padding mínimo a la izquierda */
            padding-right: 0.5rem;
            /* Padding mínimo a la derecha */
        }

        .nav-links.active {
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: linear-gradient(90deg, rgba(34, 197, 94, 0.95), rgba(21, 128, 61, 0.95));
            padding: 1rem;
            z-index: 40;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
        }

        @media (min-width: 768px) {
            .nav-links {
                display: flex !important;
                /* Asegura que los enlaces estén visibles en escritorio */
            }

            .dropdown-menu {
                position: absolute;
                top: 100%;
                left: 0;
                width: 200px;
            }
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50">
        <!-- Barra de navegación -->
        <nav class="navbar text-white py-3 z-45 relative">
            <div class="nav-container">
                <!-- Logo a la izquierda -->
                <div class="nav-logo flex items-center space-x-4">
                    <img src="{{ asset('modules/gvff/images/logo2.jpeg') }}" alt="Vivero Logo"
                        class="h-14 w-14 rounded-full shadow-md border-2 border-green-700 bg-white object-cover transition-transform duration-300 hover:scale-105" />
                    <span class="block text-xl md:text-2xl font-semibold text-white tracking-wide leading-tight">
                        Viveros, plantas y fauna
                    </span>
                </div>
                <!-- Menú hamburguesa y enlaces a la derecha -->
                <div class="flex items-center gap-2">
                    <ul class="nav-links hidden md:flex items-center text-lg font-semibold">
                        <li data-aos="fade-right" data-aos-delay="100" class="relative">
                            <a href="{{ route('gvff.welcome') }}"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-home animate-pulse"></i>
                                <span>Inicio</span>
                            </a>
                            <span class="tooltip">Explora nuestra página principal</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="200" class="relative">
                            <a href="{{ route('gvff.user.nurseries.index') }}"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-leaf animate-spin-slow"></i>
                                <span>Viveros</span>
                            </a>
                            <span class="tooltip">Descubre nuestros viveros públicos y privados</span>
                        </li>
                        <li class="relative dropdown group" data-aos="fade-right" data-aos-delay="300">
                            <a href="#"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-seedling animate-bounce"></i>
                                <span>Plantas</span>
                                <i
                                    class="fas fa-chevron-down ml-1 transform transition-transform duration-300 group-hover:rotate-180"></i>
                            </a>
                            <span class="tooltip">Explora nuestras categorías de plantas</span>
                            <ul
                                class="dropdown-menu hidden flex-col bg-green-700 text-white rounded-lg shadow-xl mt-2 w-48 z-50">
                                <li><a href="{{ route('gvff.user.plants.ornamental') }}"
                                        class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition"><i
                                            class="fas fa-seedling"></i><span>Ornamentales</span></a></li>
                                <li><a href="{{ route('gvff.user.plants.forestal') }}"
                                        class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition"><i
                                            class="fas fa-tree"></i><span>Forestales</span></a></li>
                                <li><a href="{{ route('gvff.user.plants.medicinal') }}"
                                        class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition"><i
                                            class="fas fa-mortar-pestle"></i><span>Medicinales</span></a></li>
                            </ul>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="400" class="relative">
                            <a href="{{ route('gvff.user.nurseries.about') }}"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-info-circle animate-pulse"></i>
                                <span>Acerca de</span>
                            </a>
                            <span class="tooltip">Conoce nuestra misión y visión</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="100" class="relative">
                            <a href="{{ route('gvff.user.plants.venta') }}"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-shopping-cart animate-pulse"></i>
                                <span>Venta</span>
                            </a>
                            <span class="tooltip">Explora nuestra página principal</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="500" class="relative">
                            <a href="https://wa.me/1234567890"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fab fa-whatsapp animate-bounce"></i>
                                <span>Contacto</span>
                            </a>
                            <span class="tooltip">Contáctanos por WhatsApp</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="600" class="relative">
                            <a href="{{ route('cefa.welcome') }}"
                                class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-external-link-alt"></i>
                                <span>SICEFA</span>
                            </a>
                        </li>
                    </ul>
                    <div class="hamburger-menu md:hidden text-3xl cursor-pointer">
                        <i class="fas fa-bars"></i>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Resto del código sin cambios -->
    <!-- Carrusel en una sección independiente -->
    <section class="relative mt-4">
        <div id="main-carousel" class="swiper mySwiper relative transition-all duration-500" data-aos="fade-in"
            style="z-index: 5;">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="relative w-full">
                        <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Vivero 1"
                            class="carousel-image w-full">
                        <div class="absolute bottom-16 left-10 carousel-caption text-white max-w-md">
                            <h2 class="text-4xl font-bold mb-2">Descubre Nuestros Viveros</h2>
                            <p class="text-lg">Explora una amplia variedad de plantas sostenibles cultivadas con
                                cuidado.</p>
                            <a href="#"
                                class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg bg-green-700 hover:bg-green-800 transition">Ver
                                Viveros</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative w-full">
                        <img src="{{ asset('modules/gvff/images/plants/carrucel2.jpg') }}" alt="Planta 1"
                            class="carousel-image w-full">
                        <div class="absolute bottom-16 left-10 carousel-caption text-white max-w-md">
                            <h2 class="text-4xl font-bold mb-2">Plantas Medicinales</h2>
                            <p class="text-lg">Aprovecha los beneficios naturales para tu salud y bienestar.</p>
                            <a href="#"
                                class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Explorar
                                Medicinales</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative w-full">
                        <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Planta 2"
                            class="carousel-image w-full">
                        <div class="absolute bottom-16 left-10 carousel-caption text-white max-w-md">
                            <h2 class="text-4xl font-bold mb-2">Ornamentales y Forestales</h2>
                            <p class="text-lg">Embellece tu hogar o entorno con nuestras plantas únicas.</p>
                            <a href="#" class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Ver
                                Plantas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
            <div class="swiper-pagination"></div>
            <div class="swiper-thumbs absolute bottom-4 w-full">
                <div class="swiper-wrapper flex justify-center space-x-4">
                    {{-- <div class="swiper-slide w-24 h-16 bg-cover bg-center opacity-60 hover:opacity-100 transition" style="background-image: url('{{ asset('modules/gvff/images/plants/carucel1.jpg') }}');"></div>
                    <div class="swiper-slide w-24 h-16 bg-cover bg-center opacity-60 hover:opacity-100 transition" style="background-image: url('{{ asset('modules/gvff/images/plants/carrucel2.jpg') }}');"></div>
                    <div class="swiper-slide w-24 h-16 bg-cover bg-center opacity-60 hover:opacity-100 transition" style="background-image: url('{{ asset('modules/gvff/images/plants/carucel1.jpg') }}');"></div> --}}
                </div>
            </div>
        </div>
    </section>

    <!-- Sección informativa de cards con glassmorphism y animación avanzada -->
    <section class="py-12 bg-gradient-to-b from-green-200 via-white to-green-100">
        <style>
            .glass-card {
                backdrop-filter: blur(10px);
                background: rgba(255, 255, 255, 0.4);
                border-radius: 20px;
                overflow: hidden;
                border: 1px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
                transform-style: preserve-3d;
                perspective: 1000px;
            }

            .glass-card:hover {
                transform: rotateY(5deg) scale(1.05);
                box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
            }

            .glass-image {
                transition: transform 0.6s ease;
            }

            .glass-card:hover .glass-image {
                transform: scale(1.15) rotate(2deg);
            }

            .glass-content {
                padding: 1.5rem;
                background: rgba(255, 255, 255, 0.6);
                backdrop-filter: blur(6px);
            }

            .glass-title {
                background: linear-gradient(to right, #166534, #10b981);
                -webkit-background-clip: text;
                color: transparent;
                font-weight: 700;
                font-size: 1.5rem;
            }

            .glass-description {
                color: #374151;
            }
        </style>
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center text-green-900 mb-12">Conoce más sobre las plantas</h2>
            <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-3">
                <!-- Card 1 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Tipos de plantas"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Tipos de plantas</h3>
                        <p class="glass-description">Explora la increíble variedad de especies vegetales y descubre sus
                            secretos.</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Cuidados básicos"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Cuidados básicos</h3>
                        <p class="glass-description">Aprende a proteger y nutrir tus plantas para que florezcan todo el
                            año.</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Cuidado ambiental"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Cuidado ambiental</h3>
                        <p class="glass-description">Contribuye a un entorno sostenible y ayuda a preservar la
                            biodiversidad.</p>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Huertos en casa"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Huertos en casa</h3>
                        <p class="glass-description">Crea tu propio huerto en casa y disfruta de alimentos frescos y
                            saludables.</p>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Plantas medicinales"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Plantas medicinales</h3>
                        <p class="glass-description">Descubre remedios naturales y cómo usarlos de manera responsable.
                        </p>
                    </div>
                </div>
                <!-- Card 6 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Sostenibilidad"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Sostenibilidad</h3>
                        <p class="glass-description">Impulsa prácticas sostenibles y cuida el planeta de forma
                            integral.</p>
                    </div>
                </div>
                <!-- Card 7 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Jardinería Urbana"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Jardinería Urbana</h3>
                        <p class="glass-description">Transforma espacios urbanos con técnicas de jardinería sostenible.
                        </p>
                    </div>
                </div>
                <!-- Card 8 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Plantas de Interior"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Plantas de Interior</h3>
                        <p class="glass-description">Decora tu hogar con plantas que purifican el aire y embellecen.
                        </p>
                    </div>
                </div>
                <!-- Card 9 -->
                <div class="glass-card">
                    <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Educación Ambiental"
                        class="glass-image w-full h-52 object-cover">
                    <div class="glass-content">
                        <h3 class="glass-title mb-2">Educación Ambiental</h3>
                        <p class="glass-description">Aprende y enseña sobre la importancia de la conservación
                            ambiental.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <footer class="bg-green-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div data-aos="fade-up">
                    <h3 class="text-2xl font-bold mb-4">Sobre Nosotros</h3>
                    <p>Somos una empresa dedicada a la conservación y distribución de plantas y viveros, promoviendo la
                        sostenibilidad y la conexión con la naturaleza.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-bold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-yellow-300 transition">Inicio</a></li>
                        <li><a href="#" class="hover:text-yellow-300 transition">Viveros</a></li>
                        <li><a href="#" class="hover:text-yellow-300 transition">Plantas</a></li>
                        <li><a href="https://wa.me/1234567890" class="hover:text-yellow-300 transition">Contacto</a>
                        </li>
                    </ul>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-bold mb-4">Contáctanos</h3>
                    <p><i class="fas fa-phone mr-2"></i><a href="https://wa.me/1234567890"
                            class="hover:text-yellow-300 transition">WhatsApp: +57 123 456 7890</a></p>
                    <p><i class="fas fa-envelope mr-2"></i><a href="mailto:info@viveros.com"
                            class="hover:text-yellow-300 transition">info@viveros.com</a></p>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-2xl hover:text-yellow-300 transition"><i
                                class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-300 transition"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-300 transition"><i
                                class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="mt-8 text-center">
                <p>© {{ date('Y') }} Viveros y Plantas. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Inicializar AOS
        AOS.init({
            duration: 1000,
            once: true,
        });

        // Inicializar Swiper
        const swiper = new Swiper('.mySwiper', {
            effect: 'fade',
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            thumbs: {
                swiper: {
                    el: '.swiper-thumbs',
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
            },
        });

        // Efecto de scroll
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const carousel = document.getElementById('main-carousel');
            const sectionPlants = document.querySelector('.section-plants');
            const scroll = window.scrollY;
            const maxScroll = 300;

            // Navbar efecto
            if (scroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            // Carrusel efecto progresivo
            const progress = Math.min(scroll / maxScroll, 1);
            const scale = 1 - 0.3 * progress;
            const opacity = 1 - progress;
            const maxHeight = 700 * (1 - progress);
            const marginBottom = 32 * (1 - progress);

            carousel.style.transform = `scaleY(${scale})`;
            carousel.style.opacity = opacity;
            carousel.style.maxHeight = `${maxHeight}px`;
            carousel.style.marginBottom = `${marginBottom}px`;

            // Espaciado progresivo para la siguiente sección
            if (sectionPlants) {
                sectionPlants.style.paddingTop = `${3 * (1 - progress)}rem`;
            }
        });

        // Menú hamburguesa
        const hamburger = document.querySelector('.hamburger-menu');
        const navLinks = document.querySelector('.nav-links');
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            hamburger.querySelector('i').classList.toggle('fa-bars');
            hamburger.querySelector('i').classList.toggle('fa-times');
        });

        // Submenú en móviles
        const dropdown = document.querySelector('.dropdown');
        dropdown.addEventListener('click', (e) => {
            if (window.innerWidth <= 768) {
                e.preventDefault();
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                dropdownMenu.classList.toggle('hidden');
            }
        });
    </script>
</body>

</html>
