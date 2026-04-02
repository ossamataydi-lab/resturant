@extends('layouts.app')

@section('content')
    <div class="pt-24 pb-16 min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Page Title -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-[#c5a059] to-[#0f1113] rounded-full mb-4 shadow-lg">
                    <i class="fas fa-utensils text-3xl text-white"></i>
                </div>
                <h1 class="text-4xl md:text-5xl font-serif text-gray-900 mb-4">{{ __('messages.our_menu') }}</h1>
                <p class="text-gray-600 max-w-xl mx-auto">{{ __('messages.choose_your_dishes') }}</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">

                <!-- LEFT SECTION: Menu (Notre Carte) -->
                <div class="lg:w-2/3">
                    <!-- Tabs System -->
                    <div class="bg-white rounded-2xl shadow-sm p-2 mb-6 flex flex-wrap gap-2 overflow-x-auto">
                        @if (isset($categories) && $categories->count() > 0)
                            @foreach ($categories as $index => $category)
                                <button
                                    class="tab-btn px-6 py-3 rounded-xl font-medium transition-all duration-300 whitespace-nowrap {{ $index === 0 ? 'bg-gradient-to-r from-[#c5a059] to-[#0f1113] text-white shadow-md' : 'text-gray-600 hover:bg-gray-100' }}"
                                    data-category="{{ $category->id }}">
                                    <i class="fas fa-utensils mr-2"></i>{{ $category->name }}
                                </button>
                            @endforeach
                        @endif
                    </div>

                    <!-- Products Grid -->
                    <div id="products-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if (isset($categories) && $categories->count() > 0)
                            @foreach ($categories as $category)
                                @foreach ($category->products as $product)
                                    <div class="product-card bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 category-{{ $category->id }}"
                                        data-category="{{ $category->id }}">
                                        <div class="relative h-48 overflow-hidden group">
                                            @if ($product->image)
                                                <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80' }}"
                                                    alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                            @else
                                                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                                    <i class="fas fa-utensils text-4xl text-gray-400"></i>
                                                </div>
                                            @endif
                                            <!-- Beautiful Price Tag -->
                                            <div class="absolute top-3 right-3 bg-gradient-to-r from-[#c5a059] to-[#0f1113] px-4 py-1.5 rounded-full text-sm font-bold text-white shadow-lg transform transition-transform duration-300 hover:scale-105">
                                                {{ number_format($product->price, 2) }} {{ $settings->signe_price ?? '€' }}
                                            </div>
                                            <!-- Category Badge -->
                                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg text-xs font-medium text-gray-600">
                                                {{ $category->name }}
                                            </div>
                                        </div>
                                        <div class="p-5">
                                            <h3 class="font-semibold text-lg text-gray-900 mb-2">{{ $product->name }}</h3>
                                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $product->description }}
                                            </p>

                                            <!-- Quantity Controls -->
                                            <div class="flex items-center justify-between">
                                                <div
                                                    class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                                    <button
                                                        class="qty-btn minus px-4 py-2 bg-gray-100 hover:bg-[#c5a059] hover:text-white transition-colors"
                                                        data-id="{{ $product->id }}">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <span class="qty-display px-4 py-2 font-medium min-w-[40px] text-center"
                                                        data-id="{{ $product->id }}">0</span>
                                                    <button
                                                        class="qty-btn plus px-4 py-2 bg-gray-100 hover:bg-[#c5a059] hover:text-white transition-colors"
                                                        data-id="{{ $product->id }}">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                                <button
                                                    class="add-btn bg-[#0f1113] text-white px-5 py-2 rounded-xl font-medium hover:bg-[#c5a059] transition-colors"
                                                    data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                    data-price="{{ $product->price }}">
                                                    {{ __('messages.add') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @else
                            <div class="col-span-2 text-center py-12">
                                <i class="fas fa-utensils text-6xl text-gray-300 mb-4"></i>
                                <p class="text-gray-500">{{ __('messages.no_products') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- RIGHT SECTION: Order Summary (Votre Panier) -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24 border border-gray-100">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-[#c5a059] to-[#0f1113] rounded-xl flex items-center justify-center">
                                    <i class="fas fa-shopping-basket text-white"></i>
                                </div>
                                <h2 class="text-2xl font-serif text-gray-900">{{ __('messages.your_cart') }}</h2>
                            </div>
                            <span
                                class="cart-count bg-gradient-to-r from-[#c5a059] to-[#0f1113] text-white text-sm font-medium px-3 py-1 rounded-full shadow-md">0</span>
                        </div>

                        <!-- Cart Items -->
                        <div id="cart-items" class="space-y-4 max-h-[400px] overflow-y-auto mb-6">
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-shopping-basket text-4xl mb-3 text-gray-300"></i>
                                <p>{{ __('messages.cart_empty') }}</p>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="border-t pt-4 mb-6">
                            <div class="flex justify-between items-center bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl">
                                <span class="text-lg font-medium text-gray-700">{{ __('messages.order_total') }}</span>
                                <span id="cart-total" class="text-3xl font-bold bg-gradient-to-r from-[#c5a059] to-[#0f1113] bg-clip-text text-transparent">0.00
                                    {{ $settings->signe_price ?? '€' }}</span>
                            </div>
                        </div>

                        <!-- Checkout Form -->
                        <form id="checkout-form" class="space-y-4">
                            <!-- Order Type -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.order_type') }}</label>
                                <div class="flex gap-4">
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="order_type" value="takeaway" class="peer sr-only"
                                            checked>
                                        <div
                                            class="px-4 py-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-[#0f1113] peer-checked:bg-[#0f1113] peer-checked:text-white transition-all">
                                            <i class="fas fa-shopping-bag mb-1"></i>
                                            <p class="text-sm font-medium">{{ __('messages.takeaway') }}</p>
                                        </div>
                                    </label>
                                    <label class="flex-1 cursor-pointer">
                                        <input type="radio" name="order_type" value="delivery" class="peer sr-only">
                                        <div
                                            class="px-4 py-3 border-2 border-gray-200 rounded-xl text-center peer-checked:border-[#0f1113] peer-checked:bg-[#0f1113] peer-checked:text-white transition-all">
                                            <i class="fas fa-motorcycle mb-1"></i>
                                            <p class="text-sm font-medium">{{ __('messages.delivery') }}</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Address (shown only for delivery) -->
                            <div id="address-field" class="hidden">
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.delivery_address') }}</label>
                                <input type="text" name="address" id="address"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0f1113] focus:outline-none transition-colors"
                                    placeholder="{{ __('messages.address_placeholder') }}">
                            </div>

                            <!-- Name -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.full_name') }}</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0f1113] focus:outline-none transition-colors"
                                    placeholder="{{ __('messages.name_placeholder') }}">
                            </div>

                            <!-- Phone -->
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-2">{{ __('messages.phone') }}</label>
                                <input type="tel" name="phone" id="phone" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-[#0f1113] focus:outline-none transition-colors"
                                    placeholder="{{ __('messages.phone_placeholder') }}">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" id="confirm-order-btn"
                                class="w-full bg-gradient-to-r from-[#c5a059] to-[#0f1113] text-white py-4 rounded-xl font-semibold text-lg hover:shadow-lg hover:scale-[1.02] transition-all disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-check-circle mr-2"></i>{{ __('messages.confirm_order') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Tab active state */
        .tab-btn.active {
            background: #0f1113 !important;
            color: white !important;
        }

        /* Product card selected state */
        .product-card.in-cart {
            border: 2px solid #c5a059;
        }

        /* Hide products by default except first category */
        .product-card[data-category] {
            display: none;
        }

        .product-card.category-1 {
            display: block;
        }

        /* Smooth scrollbar for cart */
        #cart-items::-webkit-scrollbar {
            width: 6px;
        }

        #cart-items::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #cart-items::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }

        #cart-items::-webkit-scrollbar-thumb:hover {
            background: #a1a1a1;
        }
    </style>

    <script>
        // Currency symbol from settings
        const currencySymbol = @json($settings->signe_price ?? '€');

        // Cart data stored in localStorage for persistence
        let cartData = JSON.parse(localStorage.getItem('cart')) || {};

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize cart from localStorage
            loadCartFromStorage();

            // Tab switching
            const tabBtns = document.querySelectorAll('.tab-btn');
            tabBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const categoryId = this.dataset.category;

                    // Update active tab
                    tabBtns.forEach(b => {
                        b.classList.remove('active', 'bg-[#0f1113]', 'text-white');
                        b.classList.add('text-gray-600', 'hover:bg-gray-100');
                    });
                    this.classList.add('active', 'bg-[#0f1113]', 'text-white');
                    this.classList.remove('text-gray-600', 'hover:bg-gray-100');

                    // Show/hide products
                    document.querySelectorAll('.product-card').forEach(card => {
                        if (card.dataset.category === categoryId) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Quantity buttons
            document.querySelectorAll('.qty-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const isPlus = this.classList.contains('plus');
                    const display = document.querySelector(`.qty-display[data-id="${productId}"]`);
                    let qty = parseInt(display.textContent) || 0;

                    if (isPlus) {
                        qty++;
                    } else {
                        qty = Math.max(0, qty - 1);
                    }

                    display.textContent = qty;

                    // Update product card visual state
                    const card = this.closest('.product-card');
                    if (qty > 0) {
                        card.classList.add('in-cart');
                    } else {
                        card.classList.remove('in-cart');
                    }
                });
            });

            // Add to cart button
            document.querySelectorAll('.add-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const productId = this.dataset.id;
                    const productName = this.dataset.name;
                    const productPrice = parseFloat(this.dataset.price);

                    const display = document.querySelector(`.qty-display[data-id="${productId}"]`);
                    let qty = parseInt(display.textContent) || 0;

                    if (qty === 0) {
                        qty = 1;
                        display.textContent = 1;
                        this.closest('.product-card').classList.add('in-cart');
                    }

                    // Add to local cart
                    if (cartData[productId]) {
                        cartData[productId].quantity += qty;
                    } else {
                        cartData[productId] = {
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: qty
                        };
                    }

                    // Save to localStorage
                    localStorage.setItem('cart', JSON.stringify(cartData));

                    // Update cart UI
                    updateCartUI();

                    // Show toast using global function from layout
                    if (typeof showToast === 'function') {
                        const addedMsg = "{{ __('messages.added_to_cart') }}";
                        showToast(productName + ' ' + addedMsg);
                    }

                    // Reset display
                    display.textContent = 0;
                });
            });

            // Order type toggle
            document.querySelectorAll('input[name="order_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const addressField = document.getElementById('address-field');
                    const addressInput = document.getElementById('address');

                    if (this.value === 'delivery') {
                        addressField.classList.remove('hidden');
                        addressInput.setAttribute('required', 'required');
                    } else {
                        addressField.classList.add('hidden');
                        addressInput.removeAttribute('required');
                        addressInput.value = '';
                    }
                });
            });

            // Checkout form submission
            document.getElementById('checkout-form').addEventListener('submit', function(e) {
                e.preventDefault();

                if (Object.keys(cartData).length === 0) {
                    if (typeof showToast === 'function') {
                        const emptyMsg = "{{ __('messages.empty_cart') }}";
                        showToast(emptyMsg, false);
                    } else {
                        alert('{{ __('messages.empty_cart') }}');
                    }
                    return;
                }

                const formData = new FormData();
                formData.append('type', document.querySelector('input[name="order_type"]:checked').value);
                formData.append('name', document.getElementById('name').value);
                formData.append('phone', document.getElementById('phone').value);
                formData.append('address', document.getElementById('address').value || '');
                formData.append('_token', '{{ csrf_token() }}');

                // Convert cart to items array
                const items = Object.values(cartData).map(item => ({
                    product_id: item.id,
                    quantity: item.quantity
                }));
                formData.append('items', JSON.stringify(items));

                const submitBtn = document.getElementById('confirm-order-btn');
                submitBtn.disabled = true;
                submitBtn.textContent = '{{ __('messages.processing') }}';

                fetch('{{ route('order.place') }}', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (typeof showToast === 'function') {
                                showToast('{{ __('messages.order_placed') }}');
                            }
                            // Clear cart
                            cartData = {};
                            localStorage.removeItem('cart');
                            updateCartUI();

                            // Reset form
                            document.getElementById('checkout-form').reset();
                            document.getElementById('address-field').classList.add('hidden');

                            // Reset all quantity displays
                            document.querySelectorAll('.qty-display').forEach(display => {
                                display.textContent = '0';
                            });
                            document.querySelectorAll('.product-card').forEach(card => {
                                card.classList.remove('in-cart');
                            });

                            // Redirect to success or show confirmation
                            setTimeout(() => {
                                window.location.href = '{{ route('home') }}';
                            }, 2000);
                        } else {
                            if (typeof showToast === 'function') {
                                const errorMsg = "{{ __('messages.order_error') }}";
                                showToast(data.message || errorMsg, false);
                            } else {
                                alert(data.message || '{{ __('messages.order_error') }}');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        if (typeof showToast === 'function') {
                            showToast('Erreur lors de la commande', false);
                        } else {
                            alert('Erreur lors de la commande');
                        }
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Confirmer la commande';
                    });
            });

            // Load cart from localStorage
            function loadCartFromStorage() {
                cartData = JSON.parse(localStorage.getItem('cart')) || {};
                updateCartUI();
            }

            // Update cart UI
            function updateCartUI() {
                const cartItemsContainer = document.getElementById('cart-items');
                const cartTotal = document.getElementById('cart-total');
                const cartCount = document.querySelector('.cart-count');

                const items = Object.values(cartData);

                if (items.length === 0) {
                    cartItemsContainer.innerHTML = `
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-shopping-basket text-4xl mb-3 text-gray-300"></i>
                        <p>Votre panier est vide</p>
                    </div>
                `;
                    cartTotal.textContent = '0.00 ' + currencySymbol;
                    cartCount.textContent = '0';
                    return;
                }

                let total = 0;
                let html = '';

                items.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    html += `
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl" data-id="${item.id}">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900">${item.name}</h4>
                            <p class="text-sm text-gray-500">${item.price.toFixed(2)} ${currencySymbol} × ${item.quantity}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center border border-gray-200 rounded-lg">
                                <button class="cart-qty-btn px-2 py-1 hover:text-[#c5a059]" data-id="${item.id}" data-action="decrease">
                                    <i class="fas fa-minus text-xs"></i>
                                </button>
                                <span class="px-2 text-sm font-medium">${item.quantity}</span>
                                <button class="cart-qty-btn px-2 py-1 hover:text-[#c5a059]" data-id="${item.id}" data-action="increase">
                                    <i class="fas fa-plus text-xs"></i>
                                </button>
                            </div>
                            <span class="font-semibold text-[#0f1113] min-w-[60px] text-right">${itemTotal.toFixed(2)} ${currencySymbol}</span>
                            <button class="remove-item text-red-400 hover:text-red-600 p-1" data-id="${item.id}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                });

                cartItemsContainer.innerHTML = html;
            cartTotal.textContent = total.toFixed(2) + ' ' + currencySymbol;
                cartCount.textContent = items.length;

                // Update product card states and sync quantities
                document.querySelectorAll('.product-card').forEach(card => {
                    const productId = card.querySelector('.add-btn').dataset.id;
                    if (cartData[productId]) {
                        card.classList.add('in-cart');
                        // Sync quantity display in menu with cart
                        const qtyDisplay = card.querySelector('.qty-display');
                        if (qtyDisplay) {
                            qtyDisplay.textContent = cartData[productId].quantity;
                        }
                    } else {
                        card.classList.remove('in-cart');
                        // Reset quantity display when removed from cart
                        const qtyDisplay = card.querySelector('.qty-display');
                        if (qtyDisplay) {
                            qtyDisplay.textContent = '0';
                        }
                    }
                });

                // Attach event listeners to cart item buttons
                document.querySelectorAll('.cart-qty-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        const action = this.dataset.action;

                        if (cartData[productId]) {
                            if (action === 'increase') {
                                cartData[productId].quantity++;
                            } else {
                                cartData[productId].quantity--;
                                if (cartData[productId].quantity <= 0) {
                                    delete cartData[productId];
                                }
                            }

                            localStorage.setItem('cart', JSON.stringify(cartData));
                            updateCartUI();
                        }
                    });
                });

                document.querySelectorAll('.remove-item').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const productId = this.dataset.id;
                        delete cartData[productId];
                        localStorage.setItem('cart', JSON.stringify(cartData));
                        updateCartUI();
                        if (typeof showToast === 'function') {
                            showToast('Produit supprimé du panier');
                        }
                    });
                });
            }
        });
    </script>
@endsection
