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

            <!-- Botón para abrir el panel del carrito -->
            <div class="cart-button-container">
                <button id="open-cart" class="cart-button">
                    <i class="fas fa-shopping-cart"></i>
                    <span id="cart-count">0</span>
                </button>
            </div>

            <!-- Panel lateral del carrito -->
            <div id="cart-panel" class="cart-panel" style="display: none;">
                <div class="cart-panel-content">
                    <button class="close-panel"><i class="fas fa-times"></i></button>
                    <h2><i class="fas fa-shopping-cart"></i> Carrito de Compras</h2>
                    <div id="cart-items" class="cart-items-scroll"></div>
                    <div id="cart-total" class="cart-total"></div>
                    <div class="panel-actions">
                        <button id="clear-cart" class="btn btn-danger clear-cart-btn"><i class="fas fa-trash"></i> Vaciar Carrito</button>
                        <button id="checkout" class="checkout-btn"><i class="fas fa-whatsapp"></i> Comprar ahora</button>
                    </div>
                </div>
            </div>

            <!-- Notificación de producto añadido -->
            <div id="notification" class="notification" style="display: none;">
                <span id="notification-message"></span>
            </div>

            <!-- Carrusel de Ofertas -->
            <div class="carousel">
                <div class="carousel-inner" id="carouselInner">
                    @if ($plants->where('available', true)->sortBy('price')->take(3)->isNotEmpty())
                        @foreach ($plants->where('available', true)->sortBy('price')->take(3) as $offerPlant)
                            <div class="carousel-item" data-index="{{ $loop->index }}">
                                @if ($offerPlant->image)
                                    <img src="{{ asset('storage/' . $offerPlant->image) }}" alt="{{ $offerPlant->common_name }}" 
                                         onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';"
                                         onerror="this.src='{{ asset('modules/gvff/images/plants/placeholder.jpg') }}'; this.style.opacity='1'; this.nextElementSibling.style.display='none';">
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
                        <div class="carousel-item" data-index="0">
                            <div class="placeholder">Imagen no disponible</div>
                        </div>
                    @endif
                </div>
                <button class="carousel-prev" onclick="moveCarousel(-1)">❮</button>
                <button class="carousel-next" onclick="moveCarousel(1)">❯</button>
                <div class="carousel-dots">
                    @if ($plants->where('available', true)->sortBy('price')->take(3)->isNotEmpty())
                        @foreach ($plants->where('available', true)->sortBy('price')->take(3) as $offerPlant)
                            <span class="carousel-dot" data-index="{{ $loop->index }}"></span>
                        @endforeach
                    @else
                        <span class="carousel-dot" data-index="0"></span>
                    @endif
                </div>
            </div>

            <div class="plant-section">
                <div class="header-section">
                    <h1>Producto del mes</h1>
                </div>
                <div class="grid" id="plants-list">
                    @foreach ($plants as $plant)
                        @if ($plant->available && $plant->price)
                            <div class="plant-card" data-type="{{ $plant->plant_type ?? 'ornamental' }}" 
                                 data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}" 
                                 data-plant-id="{{ $plant->id }}">
                                <div class="plant-image">
                                    <img src="{{ $plant->image ? asset('storage/' . $plant->image) : asset('modules/gvff/images/plants/placeholder.jpg') }}" 
                                         alt="{{ $plant->common_name }}" 
                                         onload="this.style.opacity='1'; this.nextElementSibling.style.display='none';"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="placeholder hidden">Imagen no disponible</div>
                                </div>
                                <div class="plant-details">
                                    <h2>{{ $plant->common_name }}</h2>
                                    <p>Tamaño: <span class="size-input">50 x 50</span></p>
                                    <p>Cantidad:</p>
                                    <div class="quantity-container">
                                        <div class="quantity-input">
                                            <button class="quantity-btn minus" data-plant-id="{{ $plant->id }}">-</button>
                                            <input type="number" class="quantity-input-field" data-plant-id="{{ $plant->id }}" 
                                                   value="1" min="1">
                                            <button class="quantity-btn plus" data-plant-id="{{ $plant->id }}">+</button>
                                        </div>
                                    </div>
                                    <p>$ {{ number_format($plant->price, 2) }} <span>Los gastos de envío se calculan en la pantalla de pago</span></p>
                                    <div class="buttons">
                                        <button class="add-to-cart" data-plant-id="{{ $plant->id }}" 
                                                data-plant-name="{{ $plant->common_name }}" 
                                                data-plant-price="{{ $plant->price }}">Agregar al carrito</button>
                                        <button class="buy-now" data-plant-id="{{ $plant->id }}" 
                                                data-plant-name="{{ $plant->common_name }}" 
                                                data-plant-price="{{ $plant->price }}">Comprar ahora</button>
                                    </div>
                                    <div class="extra-links">
                                        <a href="#">Share</a>
                                        <a href="#">Ver todos los detalles</a>
                                        <a href="#" class="whatsapp-link" data-plant-id="{{ $plant->id }}"> 
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
    </div>

    <!-- Estilos personalizados -->
    <style>
        :root {
            --primary-color: #198754;
            --primary-dark: #145c3e;
            --text-color: #1e293b;
            --text-secondary: #4a5568;
        }

        /* Títulos y subtítulos */
        .header-section h1 {
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }

        .header-section p {
            color: var(--text-color);
            font-size: 1.25rem;
            font-weight: 400;
            text-align: center;
        }

        .cart-panel-content h2 {
            color: var(--primary-color);
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Botones */
        .cart-button,
        .add-to-cart,
        .buy-now,
        .clear-cart-btn,
        .checkout-btn,
        .carousel-prev,
        .carousel-next {
            background-color: var(--primary-color);
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .cart-button:hover,
        .add-to-cart:hover,
        .buy-now:hover,
        .clear-cart-btn:hover,
        .checkout-btn:hover,
        .carousel-prev:hover,
        .carousel-next:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .cart-button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        /* Carousel */
        .carousel {
            position: relative;
            width: 100%;
            max-width: 800px;
            margin: 0 auto 2rem;
            overflow: hidden;
            border-radius: 0.5rem;
        }

        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            flex: 0 0 100%;
            position: relative;
            height: 400px;
        }

        .carousel-item img,
        .carousel-item .placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .carousel-item .placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--text-secondary);
            color: #ffffff;
            font-size: 1.25rem;
            text-align: center;
        }

        .carousel-prev,
        .carousel-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            padding: 0.5rem 1rem;
        }

        .carousel-prev {
            left: 10px;
        }

        .carousel-next {
            right: 10px;
        }

        .carousel-dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
        }

        .carousel-dot {
            width: 12px;
            height: 12px;
            background-color: var(--primary-color);
            opacity: 0.5;
            border-radius: 50%;
            cursor: pointer;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .carousel-dot.active,
        .carousel-dot:hover {
            opacity: 1;
            transform: scale(1.2);
        }

        /* Notificación */
        .notification {
            background-color: var(--primary-color);
            color: #ffffff;
            padding: 1rem;
            border-radius: 0.5rem;
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Panel del carrito */
        .close-panel {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-color);
            cursor: pointer;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .close-panel:hover {
            color: var(--primary-color);
        }

        /* Responsividad */
        @media (max-width: 640px) {
            .carousel {
                max-width: 100%;
            }

            .carousel-item {
                height: 250px;
            }

            .carousel-prev,
            .carousel-next {
                font-size: 1.2rem;
                padding: 0.5rem;
            }

            .carousel-dot {
                width: 10px;
                height: 10px;
            }
        }
    </style>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/brands.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartButtonContainer = document.querySelector('.cart-button-container');
            const cartPanel = document.getElementById('cart-panel');
            const carouselInner = document.getElementById('carouselInner');
            const slides = document.querySelectorAll('.carousel-item');
            const dots = document.querySelectorAll('.carousel-dot');
            let currentSlide = 0;

            // Asegurar que el botón y el panel se mantengan en posición relativa al desplazamiento
            function updatePosition() {
                const scrollPosition = window.scrollY || window.pageYOffset;
                cartButtonContainer.style.top = (60 + scrollPosition) + 'px';
                cartPanel.style.top = (60 + scrollPosition) + 'px';
            }

            window.addEventListener('scroll', updatePosition);
            updatePosition();

            // Inicializar AOS
            AOS.init({
                duration: 1500,
                once: true,
            });

            // Carousel functionality
            function showSlide(index) {
                const totalSlides = slides.length;
                currentSlide = (index + totalSlides) % totalSlides;
                carouselInner.style.transform = `translateX(-${currentSlide * 100}%)`;
                dots.forEach(dot => dot.classList.remove('active'));
                if (dots[currentSlide]) {
                    dots[currentSlide].classList.add('active');
                }
            }

            function moveCarousel(direction) {
                showSlide(currentSlide + direction);
            }

            dots.forEach(dot => {
                dot.addEventListener('click', () => {
                    const index = parseInt(dot.getAttribute('data-index'));
                    showSlide(index);
                });
            });

            // Auto-slide every 5 seconds
            setInterval(() => moveCarousel(1), 5000);

            // Initialize carousel
            showSlide(0);

            // Carrito de compras
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            }

            function updateCartDisplay() {
                const cartItemsContainer = document.getElementById('cart-items');
                const cartTotalContainer = document.getElementById('cart-total');
                const cartCount = document.getElementById('cart-count');
                let total = 0;
                let itemCount = 0;

                cartItemsContainer.innerHTML = '';
                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = '<p>El carrito está vacío.</p>';
                } else {
                    cart.forEach(item => {
                        const subtotal = item.price * item.quantity;
                        total += subtotal;
                        itemCount += item.quantity;
                        const itemElement = document.createElement('div');
                        itemElement.className = 'cart-item';
                        itemElement.innerHTML = `
                            <div class="cart-item-details">
                                <p><strong>${item.name}</strong></p>
                                <p>Precio: $${item.price.toFixed(2)} x ${item.quantity} = $${subtotal.toFixed(2)}</p>
                            </div>
                            <div class="cart-item-actions">
                                <button class="quantity-btn minus" data-plant-id="${item.id}">-</button>
                                <input type="number" class="quantity-input-field" value="${item.quantity}" min="1" data-plant-id="${item.id}">
                                <button class="quantity-btn plus" data-plant-id="${item.id}">+</button>
                                <button class="remove-item" data-plant-id="${item.id}"><i class="fas fa-trash"></i></button>
                            </div>`;
                        cartItemsContainer.appendChild(itemElement);
                    });
                }

                cartTotalContainer.textContent = `Total: $${total.toFixed(2)}`;
                cartCount.textContent = itemCount;
            }

            function showNotification(message) {
                const notification = document.getElementById('notification');
                const notificationMessage = document.getElementById('notification-message');
                notificationMessage.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
                notification.style.display = 'flex';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }

            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const plantId = this.getAttribute('data-plant-id');
                    const plantName = this.getAttribute('data-plant-name');
                    const plantPrice = parseFloat(this.getAttribute('data-plant-price'));
                    const quantityInput = this.closest('.plant-card').querySelector('.quantity-input-field');
                    const quantity = parseInt(quantityInput.value) || 1;

                    const existingItem = cart.find(item => item.id === plantId);
                    if (existingItem) {
                        existingItem.quantity += quantity;
                    } else {
                        cart.push({
                            id: plantId,
                            name: plantName,
                            price: plantPrice,
                            quantity: quantity
                        });
                    }

                    saveCart();
                    showNotification(`${plantName} ha sido añadido al carrito (${quantity} unidad${quantity > 1 ? 'es' : ''})`);
                });
            });

            document.querySelectorAll('.plant-card .quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const plantId = this.getAttribute('data-plant-id');
                    const input = this.closest('.quantity-input').querySelector('.quantity-input-field');
                    let quantity = parseInt(input.value) || 1;

                    if (this.classList.contains('plus')) {
                        quantity++;
                    } else if (this.classList.contains('minus') && quantity > 1) {
                        quantity--;
                    }

                    input.value = quantity;
                });
            });

            document.addEventListener('click', function(e) {
                if (e.target.closest('.quantity-btn') && e.target.closest('#cart-items')) {
                    const plantId = e.target.closest('.quantity-btn').getAttribute('data-plant-id');
                    const item = cart.find(item => item.id === plantId);

                    if (e.target.closest('.quantity-btn').classList.contains('plus')) {
                        item.quantity++;
                    } else if (e.target.closest('.quantity-btn').classList.contains('minus') && item.quantity > 1) {
                        item.quantity--;
                    }

                    saveCart();
                } else if (e.target.closest('.remove-item')) {
                    const plantId = e.target.closest('.remove-item').getAttribute('data-plant-id');
                    cart = cart.filter(item => item.id !== plantId);
                    saveCart();
                }
            });

            document.addEventListener('input', function(e) {
                if (e.target.classList.contains('quantity-input-field') && e.target.closest('#cart-items')) {
                    const plantId = e.target.getAttribute('data-plant-id');
                    const item = cart.find(item => item.id === plantId);
                    const newQuantity = parseInt(e.target.value);
                    if (newQuantity >= 1) {
                        item.quantity = newQuantity;
                        saveCart();
                    } else {
                        e.target.value = item.quantity;
                    }
                }
            });

            document.getElementById('open-cart').addEventListener('click', function() {
                const cartPanel = document.getElementById('cart-panel');
                cartPanel.classList.toggle('open');
                cartPanel.style.display = 'block';
            });

            document.querySelector('.close-panel').addEventListener('click', function() {
                const cartPanel = document.getElementById('cart-panel');
                cartPanel.classList.remove('open');
                setTimeout(() => {
                    cartPanel.style.display = 'none';
                }, 300);
            });

            document.getElementById('clear-cart').addEventListener('click', function() {
                cart = [];
                saveCart();
            });

            function checkoutCart() {
                if (cart.length === 0) {
                    showNotification('El carrito está vacío');
                    return;
                }

                let message = "Hola, quiero realizar el siguiente pedido:\n\n";
                let total = 0;

                cart.forEach(item => {
                    const subtotal = item.price * item.quantity;
                    message += `${item.name} - Cantidad: ${item.quantity} - Subtotal: $${subtotal.toFixed(2)}\n`;
                    total += subtotal;
                });

                message += `\nTotal: $${total.toFixed(2)}\nPor favor, indíquenme los pasos para completar la compra.`;

                const whatsappNumber = "+573227220215";
                const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
                window.open(whatsappUrl, '_blank');

                cart = [];
                saveCart();
                document.getElementById('cart-panel').classList.remove('open');
                setTimeout(() => {
                    document.getElementById('cart-panel').style.display = 'none';
                }, 300);
            }

            document.querySelectorAll('.buy-now').forEach(button => {
                button.addEventListener('click', function() {
                    const plantId = this.getAttribute('data-plant-id');
                    const plantName = this.getAttribute('data-plant-name');
                    const plantPrice = parseFloat(this.getAttribute('data-plant-price'));
                    const quantityInput = this.closest('.plant-card').querySelector('.quantity-input-field');
                    const quantity = parseInt(quantityInput.value) || 1;

                    const existingItem = cart.find(item => item.id === plantId);
                    if (!existingItem) {
                        cart.push({
                            id: plantId,
                            name: plantName,
                            price: plantPrice,
                            quantity: quantity
                        });
                        saveCart();
                    }

                    checkoutCart();
                });
            });

            document.getElementById('checkout').addEventListener('click', checkoutCart);

            document.querySelector('.carousel').addEventListener('click', (e) => e.stopPropagation());

            document.querySelectorAll('img').forEach(img => {
                img.onload = function() {
                    this.style.opacity = '1';
                    this.nextElementSibling.style.display = 'none';
                };
                img.onerror = function() {
                    this.src = '{{ asset('modules/gvff/images/plants/placeholder.jpg') }}';
                    this.style.opacity = '1';
                    this.nextElementSibling.style.display = 'none';
                };
            });
        });
    </script>
@endsection
