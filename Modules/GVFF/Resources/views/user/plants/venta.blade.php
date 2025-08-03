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
                        <button id="clear-cart" class="clear-cart-btn"><i class="fas fa-trash"></i> Vaciar Carrito</button>
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

            // Asegurar que el botón y el panel se mantengan en posición relativa al desplazamiento
            function updatePosition() {
                const scrollPosition = window.scrollY || window.pageYOffset;
                cartButtonContainer.style.top = (60 + scrollPosition) + 'px'; // Ajusta la posición del botón
                cartPanel.style.top = (60 + scrollPosition) + 'px'; // Ajusta la posición del panel
            }

            // Escuchar el evento de scroll
            window.addEventListener('scroll', updatePosition);

            // Inicializar la posición
            updatePosition();

            // Inicializar AOS (Animate On Scroll)
            AOS.init({
                duration: 1500,
                once: true,
            });

            // Carrito de compras
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Guardar carrito en localStorage
            function saveCart() {
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartDisplay();
            }

            // Actualizar la visualización del carrito
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

            // Mostrar notificación
            function showNotification(message) {
                const notification = document.getElementById('notification');
                const notificationMessage = document.getElementById('notification-message');
                notificationMessage.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
                notification.style.display = 'flex';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }

            // Agregar al carrito
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

            // Manejo de cantidad en las tarjetas
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

            // Manejo de cantidad y eliminación en el panel
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

            // Manejo de cambio directo en el input del panel
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

            // Abrir/cerrar panel
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
                }, 300); // Espera a que termine la animación
            });

            // Vaciar carrito
            document.getElementById('clear-cart').addEventListener('click', function() {
                cart = [];
                saveCart();
            });

            // Comprar ahora (enviar a WhatsApp)
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

            // Checkout desde el panel
            document.getElementById('checkout').addEventListener('click', checkoutCart);

            // Filtrado dinámico
            document.addEventListener('DOMContentLoaded', function () {
                updateCartDisplay();
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

            setInterval(() => moveCarousel(1), 5000);

            document.querySelector('.carousel').addEventListener('click', (e) => e.stopPropagation());

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
        });
    </script>
@endsection