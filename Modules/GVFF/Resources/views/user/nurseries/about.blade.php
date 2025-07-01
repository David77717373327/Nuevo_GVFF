@extends('gvff::layouts.masterusersNarvas')

@section('content')
    <div class="relative min-h-screen bg-gradient-to-br from-green-100 to-yellow-200 overflow-hidden">
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
            <h1 class="text-5xl md:text-6xl font-extrabold text-green-800 text-center mb-12 animate__animated animate__fadeInDown">
                Acerca de Nosotros
            </h1>

            <!-- Contenido visible por defecto -->
            <div class="bg-white/80 rounded-2xl shadow-xl p-8 mb-8 backdrop-blur-sm border border-green-200 animate__animated animate__fadeInUp">
                <!-- Misión, Visión y Objetivo -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                    <div class="p-6 bg-green-50 rounded-xl shadow-md hover:shadow-lg transition">
                        <h3 class="text-2xl font-semibold text-green-700 mb-3">Misión</h3>
                        <p class="text-gray-600">Nuestra misión es promover el cultivo sostenible de plantas, apoyando a comunidades locales con recursos y conocimientos para preservar el medio ambiente.</p>
                    </div>
                    <div class="p-6 bg-green-50 rounded-xl shadow-md hover:shadow-lg transition">
                        <h3 class="text-2xl font-semibold text-green-700 mb-3">Visión</h3>
                        <p class="text-gray-600">Ser líderes en la reforestación y el desarrollo de viveros ecológicos, inspirando un futuro verde para las próximas generaciones.</p>
                    </div>
                    <div class="p-6 bg-green-50 rounded-xl shadow-md hover:shadow-lg transition">
                        <h3 class="text-2xl font-semibold text-green-700 mb-3">Objetivo</h3>
                        <p class="text-gray-600">Crear un ecosistema digital que facilite la gestión de viveros, fomentando la educación ambiental y el crecimiento de proyectos verdes.</p>
                    </div>
                </div>

                <!-- Tarjetas de desarrolladores con efecto innovador -->
                <h3 class="text-2xl font-semibold text-green-700 mb-6">Nuestro Equipo</h3>
                <div class="flex flex-col md:flex-row gap-6 justify-center">
                    <div class="dev-card relative bg-gradient-to-b from-yellow-50 to-green-100 p-6 rounded-xl shadow-md transition-all duration-300 group">
                        <img src="{{ asset('modules/gvff/images/plants/desarrollador1.jpg') }}" alt="Juan Pérez" class="w-full h-40 object-cover rounded-lg transition-opacity duration-300 group-hover:opacity-80" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <p class="text-center font-semibold mt-2 text-green-800 transition-colors duration-300 group-hover:text-green-600">Juan Pérez</p>
                        <p class="text-center text-sm text-gray-600 hidden group-hover:block transition-all duration-300">Líder de Desarrollo</p>
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <div class="dev-card relative bg-gradient-to-b from-yellow-50 to-green-100 p-6 rounded-xl shadow-md transition-all duration-300 group">
                        <img src="{{ asset('modules/gvff/images/plants/desarrollador1.jpg') }}" alt="María Gómez" class="w-full h-40 object-cover rounded-lg transition-opacity duration-300 group-hover:opacity-80" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <p class="text-center font-semibold mt-2 text-green-800 transition-colors duration-300 group-hover:text-green-600">María Gómez</p>
                        <p class="text-center text-sm text-gray-600 hidden group-hover:block transition-all duration-300">Diseñadora UI/UX</p>
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <div class="dev-card relative bg-gradient-to-b from-yellow-50 to-green-100 p-6 rounded-xl shadow-md transition-all duration-300 group">
                        <img src="{{ asset('modules/gvff/images/plants/desarrollador1.jpg') }}" alt="Carlos López" class="w-full h-40 object-cover rounded-lg transition-opacity duration-300 group-hover:opacity-80" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <p class="text-center font-semibold mt-2 text-green-800 transition-colors duration-300 group-hover:text-green-600">Carlos López</p>
                        <p class="text-center text-sm text-gray-600 hidden group-hover:block transition-all duration-300">Backend Developer</p>
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <div class="dev-card relative bg-gradient-to-b from-yellow-50 to-green-100 p-6 rounded-xl shadow-md transition-all duration-300 group">
                        <img src="{{ asset('modules/gvff/images/plants/desarrollador1.jpg') }}" alt="Ana Torres" class="w-full h-40 object-cover rounded-lg transition-opacity duration-300 group-hover:opacity-80" onerror="this.src='https://via.placeholder.com/150'; console.log('Imagen desarrollador1.jpg no encontrada');">
                        <p class="text-center font-semibold mt-2 text-green-800 transition-colors duration-300 group-hover:text-green-600">Ana Torres</p>
                        <p class="text-center text-sm text-gray-600 hidden group-hover:block transition-all duration-300">QA Specialist</p>
                        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/leaf.png')] opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estilos personalizados -->
    <style>
        .leaf {
            position: absolute;
            width: 20px;
            height: 20px;
            background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
            background-size: contain;
            opacity: 0.4;
            animation: float 12s infinite ease-in-out;
        }

        .leaf1 { top: 15%; left: 5%; animation-delay: 0s; }
        .leaf2 { top: 40%; left: 85%; animation-delay: 3s; }
        .leaf3 { top: 70%; left: 10%; animation-delay: 6s; }
        .leaf4 { top: 25%; left: 70%; animation-delay: 9s; }

        .particle {
            position: absolute;
            width: 5px;
            height: 5px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float-particle 15s infinite ease-in-out;
        }

        .particle1 { top: 10%; left: 20%; animation-delay: 1s; }
        .particle2 { top: 50%; left: 70%; animation-delay: 4s; }
        .particle3 { top: 80%; left: 30%; animation-delay: 7s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(80px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        @keyframes float-particle {
            0% { transform: translateY(0) scale(1); opacity: 0.6; }
            50% { transform: translateY(150px) scale(1.5); opacity: 0.3; }
            100% { transform: translateY(0) scale(1); opacity: 0.6; }
        }

        .animate__fadeInDown {
            animation: fadeInDown 1s ease-out;
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate__fadeInUp {
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .dev-card {
            position: relative;
            overflow: hidden;
        }

        .dev-card .hidden {
            transform: translateY(10px);
        }

        .dev-card:hover .hidden {
            transform: translateY(0);
        }
    </style>
@endsection