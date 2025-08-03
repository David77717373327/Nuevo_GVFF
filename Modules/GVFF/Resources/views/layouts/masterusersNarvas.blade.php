<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Viveros y Plantas - Explora la Naturaleza')</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        /* Estilos personalizados */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e6f3e6 0%, #ffffff 100%);
            overflow-x: hidden;
            margin: 0;
        }
        /* Estilos para la navegación */
        .navbar {
            background: #198754;
            z-index: 1000;
        }
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding-left: 0.5rem; /* Padding mínimo a la izquierda */
            padding-right: 0.5rem; /* Padding mínimo a la derecha */
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
            background: #15803d; /* bg-green-700 */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1001;
        }
        .dropdown-menu li a {
            color: white;
        }
        .dropdown-menu li a:hover {
            background: #166534; /* bg-green-800 */
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
        @media (min-width: 768px) {
            .nav-links {
                display: flex !important; /* Asegura que los enlaces estén visibles en escritorio */
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
                    <img src="{{ asset('modules/gvff/images/logo-.png') }}"
                         alt="Vivero Logo"
                         class="h-14 w-14 rounded-full shadow-md border-2 border-green-700 bg-white object-cover transition-transform duration-300 hover:scale-105" />
                    <span class="block text-xl md:text-2xl font-semibold text-white tracking-wide leading-tight">
                        Viveros y Plantas
                    </span>
                </div>
                <!-- Menú hamburguesa y enlaces a la derecha -->
                <div class="flex items-center gap-2">
                    <ul class="nav-links hidden md:flex items-center text-lg font-semibold">
                        <li data-aos="fade-right" data-aos-delay="100" class="relative">
                            <a href="{{ route('gvff.welcome') }}" class="flex items-center space-x-2 hover:text-yellow-800 transition-all duration-300">
                                <i class="fas fa-home animate-pulse"></i>
                                <span>Inicio</span>
                            </a>
                            <span class="tooltip">Explora nuestra página principal</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="200" class="relative">
                            <a href="{{ route('gvff.user.nurseries.index') }}" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-leaf animate-spin-slow"></i>
                                <span>Viveros</span>
                            </a>
                            <span class="tooltip">Descubre nuestros viveros públicos y privados</span>
                        </li>
                        <li class="relative dropdown group" data-aos="fade-right" data-aos-delay="300">
                            <a href="#" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-seedling animate-bounce"></i>
                                <span>Plantas</span>
                                <i class="fas fa-chevron-down ml-1 transform transition-transform duration-300 group-hover:rotate-180"></i>
                            </a>
                            <span class="tooltip">Explora nuestras categorías de plantas</span>
                            <ul class="dropdown-menu hidden flex-col rounded-lg shadow-xl mt-2 w-48 z-50">
                                <li><a href="{{ route('gvff.user.plants.ornamental') }}" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition"><i class="fas fa-seedling"></i><span>Ornamentales</span></a></li>
                                <li><a href="{{ route('gvff.user.plants.forestal') }}" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition"><i class="fas fa-tree"></i><span>Forestales</span></a></li>
                                <li><a href="{{ route('gvff.user.plants.medicinal') }}" class="flex items-center space-x-2 px-4 py-3 hover:bg-green-800 transition"><i class="fas fa-mortar-pestle"></i><span>Medicinales</span></a></li>
                            </ul>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="100" class="relative">
                            <a href="{{ route('gvff.user.plants.venta') }}" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-shopping-cart animate-pulse"></i>
                                <span>Venta</span>
                            </a>
                            <span class="tooltip">Explora nuestra página principal</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="400" class="relative">
                            <a href="{{ route('gvff.user.nurseries.about') }}" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fas fa-info-circle animate-pulse"></i>
                                <span>Acerca de</span>
                            </a>
                            <span class="tooltip">Conoce nuestra misión y visión</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="500" class="relative">
                            <a href="https://wa.me/1234567890" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
                                <i class="fab fa-whatsapp animate-bounce"></i>
                                <span>Contacto</span>
                            </a>
                            <span class="tooltip">Contáctanos por WhatsApp</span>
                        </li>
                        <li data-aos="fade-right" data-aos-delay="600" class="relative">
                            <a href="{{ route('cefa.welcome') }}" class="flex items-center space-x-2 hover:text-yellow-300 transition-all duration-300">
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

    <!-- Contenido dinámico -->
    <main class="flex-grow">
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
            duration: 800,
            once: true,
        });

        // Manejo del menú hamburguesa
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

        // Efecto de scroll para la navbar
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>
</html>