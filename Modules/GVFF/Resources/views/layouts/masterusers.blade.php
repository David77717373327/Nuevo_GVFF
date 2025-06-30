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
    <style>
        /* Estilos personalizados */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6f3e6 0%, #ffffff 100%);
            overflow-x: hidden;
        }
        .navbar {
            transition: all 0.4s ease;
            background: linear-gradient(90deg, rgba(34, 197, 94, 0.95), rgba(21, 128, 61, 0.95));
            animation: gradientShift 10s ease infinite;
            z-index: 1000;
        }
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .navbar.scrolled {
            background: linear-gradient(90deg, rgba(21, 128, 61, 0.98), rgba(5, 150, 105, 0.98));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        .nav-links li a {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .nav-links li a:hover {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }
        .nav-links li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: #facc15;
            transition: left 0.3s ease;
        }
        .nav-links li a:hover::after {
            left: 0;
        }
        .dropdown:hover .dropdown-menu {
            display: flex;
            opacity: 1;
            transform: translateY(0);
            z-index: 1001;
        }
        .dropdown-menu {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.4s ease;
            background: linear-gradient(135deg, rgba(21, 128, 61, 0.95), rgba(5, 150, 105, 0.95));
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1001;
        }
        .dropdown-menu li a {
            transition: all 0.3s ease;
        }
        .dropdown-menu li a:hover {
            transform: translateX(10px);
            background: rgba(255, 255, 255, 0.1);
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
        }
        .hamburger-menu {
            display: none;
        }
        .nav-links.active {
            transform: translateX(0);
        }
        @media (max-width: 768px) {
            .hamburger-menu {
                display: block;
            }
            .nav-links {
                display: none;
                position: fixed;
                top: 0;
                right: 0;
                height: 100vh;
                width: 75%;
                background: linear-gradient(90deg, rgba(34, 197, 94, 0.95), rgba(21, 128, 61, 0.95));
                flex-direction: column;
                padding: 2rem;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                z-index: 1000;
            }
            .nav-links.active {
                display: flex;
            }
            .dropdown-menu {
                position: static;
                width: 100%;
                background: transparent;
                box-shadow: none;
                z-index: 1001;
            }
        }
        .tooltip {
            position: absolute;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.5rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
            pointer-events: none;
            z-index: 1002;
        }
        .nav-links li:hover .tooltip {
            opacity: 1;
            transform: translateY(0);
        }
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
            background: linear-gradient(45deg, #f59e0b, #ef4444);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        #main-carousel {
            transition: height 0.5s ease;
        }
        #main-carousel.shrink {
            height: 0px;
            overflow: hidden;
        }
        .swiper-thumbs {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            gap: 10px;
            z-index: 10;
        }
        .swiper-thumbs .swiper-slide {
            width: 80px;
            height: 50px;
            background-size: cover;
            background-position: center;
            opacity: 0.7;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        .swiper-thumbs .swiper-slide:hover {
            opacity: 1;
            transform: scale(1.05);
        }
        .search-input {
            transition: all 0.3s ease;
        }
        .search-input:focus {
            box-shadow: 0 0 10px rgba(34, 197, 94, 0.5);
        }

        #main-carousel {
    transition: transform 0.5s ease, opacity 0.5s ease;
    transform-origin: top;
    z-index: 10;
}

#main-carousel.shrink {
    transform: scaleY(0.3);
    opacity: 0.4;
}
.dropdown-menu {
    z-index: 50;
}
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="sticky top-0 z-50">
        <!-- Barra de navegación -->
        <nav class="navbar text-white py-4 z-50 relative">
            <div class="container mx-auto px-4 flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('modules/gvff/images/logo3jpg.jpg') }}" alt="Vivero Logo" class="h-14 w-auto rounded-full shadow-lg transform hover:scale-110 transition-all duration-300">
                    <span class="ml-4 text-3xl font-bold text-white tracking-wide">Viveros y Plantas</span>
                </div>
                <!-- Menú hamburguesa -->
                <div class="hamburger-menu md:hidden text-3xl cursor-pointer">
                    <i class="fas fa-bars"></i>
                </div>
                <!-- Menú -->
                <ul class="nav-links flex space-x-10 md:flex items-center text-lg font-semibold">
                    <li data-aos="fade-right" data-aos-delay="100" class="relative">
                        <a href="#" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                            <i class="fas fa-home animate-pulse"></i>
                            <span>Inicio</span>
                            <!-- <a href="#">Inicio</a> -->
                        </a>
                        <span class="tooltip top-12 left-1/2 -translate-x-1/2">Explora nuestra página principal</span>
                    </li>
                    <li data-aos="fade-right" data-aos-delay="200" class="relative">
                        <a href="#" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                            <i class="fas fa-leaf animate-spin-slow"></i>
                            <span>Viveros</span>
                            <!-- <a href="#">Viveros</a> -->
                        </a>
                        <span class="tooltip top-12 left-1/2 -translate-x-1/2">Descubre nuestros viveros públicos y privados</span>
                    </li>
                    <li class="relative dropdown" data-aos="fade-right" data-aos-delay="300">
                        <a href="#" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                            <i class="fas fa-seedling animate-bounce"></i>
                            <span>Plantas</span>
                            <i class="fas fa-chevron-down ml-1 transform transition-transform duration-300 group-hover:rotate-180"></i>
                        </a>
                       <!-- Tooltip -->
<span class="tooltip top-12 left-1/2 -translate-x-1/2">
    Explora nuestras categorías de plantas
</span>

<!-- Lista desplegable -->
<ul class="dropdown-menu absolute hidden bg-green-700 text-white rounded-lg shadow-xl mt-2 w-48 z-50 flex-col">
    <!-- Ornamentales -->
    <li>
        <a href="#" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition">
            <i class="fas fa-seedling"></i>
            <span>Ornamentales</span>
        </a>
    </li>

    <!-- Forestales -->
    <li>
        <a href="#" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition">
            <i class="fas fa-tree"></i>
            <span>Forestales</span>
        </a>
    </li>

    <!-- Medicinales -->
    <li>
        <a href="#" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition">
            <i class="fas fa-mortar-pestle"></i>
            <span>Medicinales</span>
        </a>
    </li>

    <!-- En Venta -->
    <li>
        <a href="#" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition">
            <i class="fas fa-shopping-cart"></i>
            <span>En Venta</span>
        </a>
    </li>

    <!-- Destacadas -->
    <li>
        <a href="#" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition">
            <i class="fas fa-star text-yellow-400"></i>
            <span>Destacadas</span>
        </a>
    </li>
</ul>
                    </li>
                    <li data-aos="fade-right" data-aos-delay="400" class="relative">
                        <a href="#" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                            <i class="fas fa-info-circle animate-pulse"></i>
                            <span>Acerca de</span>
                            <!-- <a href="#">Acerca de</a> -->
                        </a>
                        <span class="tooltip top-12 left-1/2 -translate-x-1/2">Conoce nuestra misión y visión</span>
                    </li>
                    <li data-aos="fade-right" data-aos-delay="500" class="relative">
                        <a href="https://wa.me/1234567890" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                            <i class="fab fa-whatsapp animate-bounce"></i>
                            <span>Contacto</span>
                        </a>
                        <span class="tooltip top-12 left-1/2 -translate-x-1/2">Contáctanos por WhatsApp</span>
                    </li>
                    <li data-aos="fade-right" data-aos-delay="600" class="relative">
                        <form action="#" class="flex items-center">
                            <input type="text" placeholder="Buscar plantas..." class="search-input px-3 py-2 rounded-l-md bg-white text-gray-800 focus:outline-none">
                            <button type="submit" class="px-3 py-2 bg-green-600 rounded-r-md hover:bg-green-700">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <span class="tooltip top-12 left-1/2 -translate-x-1/2">Busca plantas por nombre</span>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Carrusel -->
        <div id="main-carousel" class="swiper mySwiper relative transition-all duration-500" data-aos="fade-in" style="z-index: 10;">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="relative">
                        <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Vivero 1" class="carousel-image">
                        <div class="absolute bottom-16 left-10 carousel-caption text-white max-w-md">
                            <h2 class="text-4xl font-bold mb-2">Descubre Nuestros Viveros</h2>
                            <p class="text-lg">Explora una amplia variedad de plantas sostenibles cultivadas con cuidado.</p>
                            <a href="#" class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Ver Viveros</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative">
                        <img src="{{ asset('modules/gvff/images/plants/carrucel2.jpg') }}" alt="Planta 1" class="carousel-image">
                        <div class="absolute bottom-16 left-10 carousel-caption text-white max-w-md">
                            <h2 class="text-4xl font-bold mb-2">Plantas Medicinales</h2>
                            <p class="text-lg">Aprovecha los beneficios naturales para tu salud y bienestar.</p>
                            <a href="#" class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Explorar Medicinales</a>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="relative">
                        <img src="{{ asset('modules/gvff/images/plants/carucel1.jpg') }}" alt="Planta 2" class="carousel-image">
                        <div class="absolute bottom-16 left-10 carousel-caption text-white max-w-md">
                            <h2 class="text-4xl font-bold mb-2">Ornamentales y Forestales</h2>
                            <p class="text-lg">Embellece tu hogar o entorno con nuestras plantas únicas.</p>
                            <a href="#" class="btn-cta inline-block mt-4 px-6 py-3 text-white rounded-lg">Ver Plantas</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next text-white"></div>
            <div class="swiper-button-prev text-white"></div>
            <div class="swiper-pagination"></div>
            
            <div class="swiper-thumbs absolute bottom-4 w-full">
                <div class="swiper-wrapper flex justify-center space-x-4">
                    <div class="swiper-slide w-24 h-16 bg-cover bg-center opacity-60 hover:opacity-100 transition" style="background-image: url('{{ asset('modules/gvff/images/plants/carucel1.jpg') }}');"></div>
                    <div class="swiper-slide w-24 h-16 bg-cover bg-center opacity-60 hover:opacity-100 transition" style="background-image: url('{{ asset('modules/gvff/images/plants/carrucel2.jpg') }}');"></div>
                    <div class="swiper-slide w-24 h-16 bg-cover bg-center opacity-60 hover:opacity-100 transition" style="background-image: url('{{ asset('modules/gvff/images/plants/carucel1.jpg') }}');"></div>
                </div>
            </div>
        </div>
    </header>

    <!-- Sección adicional informativa -->
    <section class="mt-20" data-aos="fade-up">
        <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Conoce Más Sobre Nuestras Plantas</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 px-4">
            <div class="bg-white rounded-xl shadow-lg p-6" data-aos="zoom-in">
                <img src="{{ asset('modules/gvff/images/plants/papaya-1746365289.png') }}" alt="Papaya" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Papaya</h3>
                <p class="text-gray-600">Fruta tropical con múltiples beneficios para la digestión y fácil de cultivar en climas cálidos.</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" data-aos="zoom-in" data-aos-delay="100">
                <img src="{{ asset('modules/gvff/images/plants/sandia-1746472453.png') }}" alt="Sandía" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Sandía</h3>
                <p class="text-gray-600">Rica en agua y refrescante. Ideal para suelos con buen drenaje y exposición solar completa.</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('modules/gvff/images/plants/pera-1748213764.jpg') }}" alt="Pera" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Pera</h3>
                <p class="text-gray-600">Árbol frutal que se adapta a diversos suelos. Sus frutos son dulces, suaves y nutritivos.</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" data-aos="zoom-in">
                <img src="{{ asset('modules/gvff/images/plants/papaya-1746365289.png') }}" alt="Papaya" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Papaya</h3>
                <p class="text-gray-600">Fruta tropical con múltiples beneficios para la digestión y fácil de cultivar en climas cálidos.</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" data-aos="zoom-in" data-aos-delay="100">
                <img src="{{ asset('modules/gvff/images/plants/sandia-1746472453.png') }}" alt="Sandía" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Sandía</h3>
                <p class="text-gray-600">Rica en agua y refrescante. Ideal para suelos con buen drenaje y exposición solar completa.</p>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6" data-aos="zoom-in" data-aos-delay="200">
                <img src="{{ asset('modules/gvff/images/plants/pera-1748213764.jpg') }}" alt="Pera" class="w-full h-48 object-cover rounded mb-4">
                <h3 class="text-xl font-bold text-green-700 mb-2">Pera</h3>
                <p class="text-gray-600">Árbol frutal que se adapta a diversos suelos. Sus frutos son dulces, suaves y nutritivos.</p>
            </div>
        </div>
    </section>

    <!-- Contenido principal -->
    <main class="flex-1 container mx-auto px-4 py-12">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-green-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div data-aos="fade-up">
                    <h3 class="text-2xl font-bold mb-4">Sobre Nosotros</h3>
                    <p>Somos una empresa dedicada a la conservación y distribución de plantas y viveros, promoviendo la sostenibilidad y la conexión con la naturaleza.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-2xl font-bold mb-4">Enlaces Rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-yellow-300 transition">Inicio</a></li>
                        <li><a href="#" class="hover:text-yellow-300 transition">Viveros</a></li>
                        <li><a href="#" class="hover:text-yellow-300 transition">Plantas</a></li>
                        <li><a href="https://wa.me/1234567890" class="hover:text-yellow-300 transition">Contacto</a></li>
                    </ul>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-bold mb-4">Contáctanos</h3>
                    <p><i class="fas fa-phone mr-2"></i><a href="https://wa.me/1234567890" class="hover:text-yellow-300 transition">WhatsApp: +57 123 456 7890</a></p>
                    <p><i class="fas fa-envelope mr-2"></i><a href="mailto:info@viveros.com" class="hover:text-yellow-300 transition">info@viveros.com</a></p>
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-2xl hover:text-yellow-300 transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-300 transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-2xl hover:text-yellow-300 transition"><i class="fab fa-twitter"></i></a>
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

        // Barra de navegación al hacer scroll
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            const carousel = document.getElementById('main-carousel');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
                carousel.classList.add('shrink');
            } else {
                navbar.classList.remove('scrolled');
                carousel.classList.remove('shrink');
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
        const carousel = document.getElementById('main-carousel');
window.addEventListener('scroll', () => {
    const scroll = window.scrollY;
    const maxScroll = 300;

    const scale = Math.max(0.3, 1 - scroll / maxScroll);
    const opacity = Math.max(0.3, 1 - scroll / maxScroll);

    carousel.style.transform = `scaleY(${scale})`;
    carousel.style.opacity = opacity;
});
    </script>
</body>
</html>