@extends('gvff::layouts.masterusersNarvas')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-br from-green-50 to-green-200 overflow-hidden">
        <!-- Fondo decorativo con hojas y partículas -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
            <div class="leaf leaf4"></div>
            <div class="particle particle1"></div>
            <div class="particle particle2"></div>
            <div class="particle particle3"></div>
        </div>

        <div class="container mx-auto px-4 py-16 relative z-10">
            <!-- Encabezado -->
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-green-900 text-center mb-12 animate__animated animate__fadeInDown tracking-tight">
                Acerca de Nosotros
            </h1>

            <!-- Contenido principal -->
            <div class="bg-white/90 rounded-3xl shadow-2xl p-8 md:p-12 mb-8 backdrop-blur-md border border-green-100 animate__animated animate__fadeInUp">
                <!-- Misión, Visión y Objetivo -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-12">
                    <div class="p-6 bg-green-50/80 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <h3 class="text-xl md:text-2xl font-semibold text-green-800 mb-3">Misión</h3>
                        <p class="text-gray-700 text-sm md:text-base leading-relaxed">Promover el cultivo sostenible de plantas, apoyando a comunidades locales con recursos y conocimientos para preservar el medio ambiente.</p>
                    </div>
                    <div class="p-6 bg-green-50/80 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <h3 class="text-xl md:text-2xl font-semibold text-green-800 mb-3">Visión</h3>
                        <p class="text-gray-700 text-sm md:text-base leading-relaxed">Ser líderes en la reforestación y el desarrollo de viveros ecológicos, inspirando un futuro verde para las próximas generaciones.</p>
                    </div>
                    <div class="p-6 bg-green-50/80 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <h3 class="text-xl md:text-2xl font-semibold text-green-800 mb-3">Objetivo</h3>
                        <p class="text-gray-700 text-sm md:text-base leading-relaxed">Crear un ecosistema digital que facilite la gestión de viveros, fomentando la educación ambiental y el crecimiento de proyectos verdes.</p>
                    </div>
                </div>

                <!-- Tarjetas de desarrolladores -->
                <h3 class="text-2xl md:text-3xl font-semibold text-green-900 mb-8 text-center">Nuestro Equipo</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="dev-card relative bg-gradient-to-b from-green-50 to-green-100 p-6 rounded-2xl shadow-lg transition-all duration-300 group overflow-hidden">
                        <img src="{{ asset('modules/gvff/images/logo2.jpeg') }}" alt="Juan Pérez" class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        <p class="text-center font-semibold mt-4 text-green-900 text-lg group-hover:text-green-700 transition-colors duration-300">Ignacio Chilito</p>
                        <p class="text-center text-sm text-gray-600 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">Líder de Desarrollo</p>
                    </div>
                    <div class="dev-card relative bg-gradient-to-b from-green-50 to-green-100 p-6 rounded-2xl shadow-lg transition-all duration-300 group overflow-hidden">
                        <img src="{{ asset('modules/gvff/images/Penagos.jpeg') }}" alt="María Gómez" class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        <p class="text-center font-semibold mt-4 text-green-900 text-lg group-hover:text-green-700 transition-colors duration-300">Maria Alejandra Penagos</p>
                        <p class="text-center text-sm text-gray-600 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">Diseñadora UI/UX</p>
                    </div>
                    <div class="dev-card relative bg-gradient-to-b from-green-50 to-green-100 p-6 rounded-2xl shadow-lg transition-all duration-300 group overflow-hidden">
                        <img src="{{ asset('modules/gvff/images/Jesus.jpeg') }}" alt="Carlos López" class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        <p class="text-center font-semibold mt-4 text-green-900 text-lg group-hover:text-green-700 transition-colors duration-300">Jesus David Quiza Roa</p>
                        <p class="text-center text-sm text-gray-600 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">Backend Developer</p>
                    </div>
                    <div class="dev-card relative bg-gradient-to-b from-green-50 to-green-100 p-6 rounded-2xl shadow-lg transition-all duration-300 group overflow-hidden">
                        <img src="{{ asset('modules/gvff/images/logo2.jpeg') }}" alt="Ana Torres" class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        <p class="text-center font-semibold mt-4 text-green-900 text-lg group-hover:text-green-700 transition-colors duration-300">Jhon Fredy Burgos</p>
                        <p class="text-center text-sm text-gray-600 mt-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">QA Specialist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos personalizados -->
    <style>
        /* Hojas decorativas */
        .leaf {
            position: absolute;
            width: 24px;
            height: 24px;
            background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
            background-size: contain;
            opacity: 0.3;
            animation: float 14s infinite ease-in-out;
        }

        .leaf1 { top: 10%; left: 5%; animation-delay: 0s; }
        .leaf2 { top: 35%; left: 80%; animation-delay: 2s; }
        .leaf3 { top: 65%; left: 15%; animation-delay: 5s; }
        .leaf4 { top: 20%; left: 75%; animation-delay: 8s; }

        /* Partículas decorativas */
        .particle {
            position: absolute;
            width: 6px;
            height: 6px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 50%;
            animation: float-particle 16s infinite ease-in-out;
        }

        .particle1 { top: 15%; left: 25%; animation-delay: 1s; }
        .particle2 { top: 55%; left: 65%; animation-delay: 3s; }
        .particle3 { top: 75%; left: 35%; animation-delay: 6s; }

        /* Animaciones */
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(100px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        @keyframes float-particle {
            0% { transform: translateY(0) scale(1); opacity: 0.7; }
            50% { transform: translateY(120px) scale(1.4); opacity: 0.4; }
            100% { transform: translateY(0) scale(1); opacity: 0.7; }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate__fadeInDown {
            animation: fadeInDown 1s ease-out;
        }

        .animate__fadeInUp {
            animation: fadeInUp 1.2s ease-out;
        }

        /* Asegurar que las imágenes no se desborden */
        .dev-card img {
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection