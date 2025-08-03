<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión de Viveros</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">
    <!-- Animate.css for Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            transition: all 0.3s ease;
        }
        h1 {
            color: black;
        }

        .sidebar {
            transition: all 0.3s ease;
            height: 100vh;
            position: fixed;
            z-index: 50;
            width: 250px;
            overflow-y: auto;
            overflow-x: hidden;
            background-color: #ffffff;
        }

        .sidebar .sidebar-content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #000000;
            text-decoration: none;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: white;
            color: green;
            transform: translateX(5px);
        }

        .sidebar .menu-item i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            min-height: 100vh;
            background-color: #f1f5f9;
        }

        .submenu {
            display: none;
            margin-left: 1rem;
            transition: all 0.3s ease;
        }

        .submenu.active {
            display: block;
        }

        .submenu-list {
            list-style-type: none;
            padding-left: 0;
        }

        .submenu-list li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.25rem;
        }

        .submenu-list li a {
            display: block;
            padding: 0.5rem 1rem;
            color: #000000;
            transition: all 0.3s ease;
        }

        .submenu-list li a:hover {
            background-color: #ffffff;
            transform: translateX(5px);
        }

        

        .menu-item.submenu-toggle {
            position: relative;
        }

        .menu-item.submenu-toggle .arrow {
            margin-left: auto;
            transition: transform 0.3s ease;
        }

        .menu-item.submenu-toggle.active .arrow {
            transform: rotate(180deg);
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col">
    <!-- Main Content Area -->
    <div class="flex flex-1">
        <!-- Sidebar -->
        <aside class="sidebar text-white flex flex-col shadow-lg">
            <div class="sidebar-content">
                <div class="p-6 border-b border-gray-700 text-center">
                    <div class="flex justify-center">
                        <img src="{{ asset('modules/gvff/images/logo-.png') }}" alt="Vivero"
                            class="rounded-full w-32 h-14 object-cover object shadow-md hover:shadow-lg hover:translate-y-1 transition-all duration-300">
                    </div>     @auth
                    @if (checkRol('gvff.admin'))
                        <div class="p-4 text-lg font-semibold text-center text-black">
                            Administrador
                        </div>
                    @endif
                @endauth
                </div>
                <!-- Add "Administrador" below the logo -->
           
                <nav class="flex-1 p-4">
                    <a href="{{ route('gvff.index') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('gvff.admin.nurseries.index') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-leaf"></i> Viveros
                    </a>
                    <a href="{{ route('gvff.admin.plants.index') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-seedling"></i> Plantas
                    </a>
                    <a href="{{ route('gvff.admin.faunas.index') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-paw"></i> Fauna
                    </a>
                    <a href="{{ route('gvff.admin.plant_inventory.entrance') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-warehouse"></i> Entrada de Inventario
                    </a>
                    <a href="{{ route('gvff.admin.plant_inventory.index') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-list-ul"></i> Inventario de Plantas
                    </a>
                    <a href="{{ route('gvff.admin.plant_inventory.sale.index') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-cash-register"></i> Registrar Venta
                    </a>
                    <a href="{{ route('gvff.admin.plant_inventory.sale.history') }}"
                        class="menu-item block mb-2 rounded-lg hover:bg-red-600 transition">
                        <i class="fa-solid fa-landmark"></i> Historial de Ventas
                    </a>
                    <a href="#" class="menu-item submenu-toggle block mb-2 rounded-lg hover:bg-red-600 transition"
                        onclick="toggleSubmenu(event, 'herramientas-submenu')">
                        <i class="fa-solid fa-hammer"></i> Herramientas
                        <i class="fa-solid fa-chevron-down arrow"></i>
                    </a>
                    <div class="submenu" id="herramientas-submenu">
                        <ul class="submenu-list">
                            <li><a href="{{ route('gvff.admin.Tool.index') }}"><i class="fa-solid fa-hammer"></i> Nueva
                                    Herramientas</a></li>
                        </ul>
                    </div>
                    <div class="p-4 border-t border-green-700">
                        <a href="{{ route('logout') }}" class="block py-2 px-4 rounded-lg hover:bg-red-600 transition"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                            class="block py-2 px-4 rounded-lg hover:bg-red-600 transition">
                            <i class="fa-solid fa-sign-out-alt mr-2"></i> Cerrar Sesión
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
            </div>
        </aside>
        <!-- Main Content -->
        <main class="flex-1 ml-[250px] p-8 main-content">
            @yield('content')
        </main>
    </div>
    <!-- JavaScript for Submenu Toggle -->
    <script>
        function toggleSubmenu(event, submenuId) {
            event.preventDefault();
            const submenu = document.getElementById(submenuId);
            if (!submenu) return;

            const isActive = submenu.classList.contains('active');
            document.querySelectorAll('.submenu').forEach(sub => sub.classList.remove('active'));
            document.querySelectorAll('.submenu-toggle').forEach(toggle => toggle.classList.remove('active'));
            if (!isActive) {
                submenu.classList.add('active');
                event.currentTarget.classList.add('active');
            } else {
                submenu.classList.remove('active');
                event.currentTarget.classList.remove('active');
            }

            if (!submenu.classList.contains('active')) {
                const parentSection = submenuId.split('-')[0];
                window.location.hash = `#${parentSection}`;
            }
        }
    </script>
    @stack('scripts')
</body>

</html>