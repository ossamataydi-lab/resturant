<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Délice Gourmand | Haute Cuisine</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,700;1,700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --gold: #c5a059;
            --dark: #0f1113;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }

        /* Nav Glassmorphism */
        .nav-glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: saturate(180%) blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .scrolled-nav {
            padding-top: 0.75rem !important;
            padding-bottom: 0.75rem !important;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.08);
        }

        /* Logo Style */
        .logo-font {
            font-family: 'Playfair Display', serif;
            letter-spacing: -0.02em;
        }

        /* Beautiful Logo Hover Effects */
        .logo-link {
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
        }

        .logo-link:hover {
            transform: scale(1.03);
        }

        .logo-link:hover .logo-text {
            color: var(--gold) !important;
            text-shadow: 0 0 20px rgba(197, 160, 89, 0.4);
        }

        .logo-link:hover .logo-img {
            filter: drop-shadow(0 0 8px rgba(197, 160, 89, 0.6));
        }

        .logo-text {
            transition: all 0.4s ease;
        }

        .logo-img {
            transition: all 0.4s ease;
        }

        /* Subtle animation for logo */
        @keyframes logoPulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.95;
            }
        }

        .logo-link {
            animation: logoPulse 3s ease-in-out infinite;
        }

        /* Modern Link Hover */
        .nav-item {
            position: relative;
            font-size: 0.8rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-weight: 500;
            color: var(--dark);
            transition: opacity 0.3s ease;
        }

        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--gold);
            transition: width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .nav-item:hover::after {
            width: 100%;
        }

        /* Luxury Button */
        .btn-gold {
            background: var(--dark);
            color: white;
            padding: 12px 30px;
            font-size: 0.75rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            border-radius: 0;
            /* Square borders are more modern/luxury */
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-gold:hover {
            background: var(--gold);
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(197, 160, 89, 0.2);
        }

        /* Mobile Menu */
        #mobile-menu {
            transition: all 0.5s cubic-bezier(0.77, 0, 0.175, 1);
            transform: translateX(100%);
        }

        #mobile-menu.open {
            transform: translateX(0);
        }

        /* Toast Animation */
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }

        /* Toast Notification Styles */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            padding: 15px 30px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            font-weight: 600;
            animation: slideUp 0.4s ease;
            color: white;
        }
    </style>
</head>

<body class="antialiased">

    <nav id="navbar" class="fixed top-0 z-[1000] w-full nav-glass px-8 py-6 transition-all duration-500">
        <div class="max-w-7xl mx-auto flex items-center justify-between">

            <a href="/" class="flex items-center space-x-2 group logo-link">
                @if ($settings->logo)
                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->name }}"
                        class="h-8 w-auto logo-img">
                    <span class="logo-font text-2xl font-bold tracking-tighter text-dark logo-text">
                        {{ $settings->name }}<span class="text-[var(--gold)]">.</span>
                    </span>
                @else
                    <span class="logo-font text-2xl font-bold tracking-tighter text-dark logo-text">
                        {{ $settings->name }}<span class="text-[var(--gold)]">.</span>
                    </span>
                @endif
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="nav-item">{{ __('messages.home') }}</a>
                <a href="{{ route('menu.index') }}" class="nav-item">{{ __('messages.menu') }}</a>
                <a href="{{ route('commande') }}" class="nav-item">{{ __('messages.order') }}</a>
                <a href="#chef" class="nav-item">{{ __('messages.chef') }}</a>
                <a href="{{ route('reservation.index') }}" class="btn-gold">
                    {{ __('messages.reserve') }}
                </a>

                <!-- Language Switcher -->
                <div class="flex items-center space-x-2 ml-4">
                    <a href="{{ route('language.switch', ['locale' => 'fr', 'redirect' => url()->current()]) }}"
                        class="text-sm font-medium {{ $currentLocale == 'fr' ? 'text-[var(--gold)]' : 'text-gray-400 hover:text-dark' }}">FR</a>
                    <span class="text-gray-300">|</span>
                    <a href="{{ route('language.switch', ['locale' => 'en', 'redirect' => url()->current()]) }}"
                        class="text-sm font-medium {{ $currentLocale == 'en' ? 'text-[var(--gold)]' : 'text-gray-400 hover:text-dark' }}">EN</a>
                    <span class='text-gray-300'>|</span>
                    <a href="{{ route('language.switch', ['locale' => 'ar', 'redirect' => url()->current()]) }}"
                        class="text-sm font-medium {{ $currentLocale == 'ar' ? 'text-[var(--gold)]' : 'text-gray-400 hover:text-dark' }}">AR</a>
                </div>
            </div>

            <button id="burger" class="md:hidden text-dark focus:outline-none">
                <div class="w-6 h-0.5 bg-black mb-1.5 transition-all" id="l1"></div>
                <div class="w-6 h-0.5 bg-black transition-all" id="l2"></div>
            </button>
        </div>
    </nav>

    <div id="mobile-menu"
        class="fixed inset-0 z-[999] bg-white flex flex-col items-center justify-center space-y-8 md:hidden">
        <a href="{{ route('home') }}"
            class="text-2xl font-light uppercase tracking-widest hover:text-[var(--gold)] transition-colors">{{ __('messages.home') }}</a>
        <a href="{{ route('menu.index') }}"
            class="text-2xl font-light uppercase tracking-widest hover:text-[var(--gold)] transition-colors">{{ __('messages.menu') }}</a>
        <a href="{{ route('commande') }}"
            class="text-2xl font-light uppercase tracking-widest hover:text-[var(--gold)] transition-colors">{{ __('messages.order') }}</a>
        <a href="#chef"
            class="text-2xl font-light uppercase tracking-widest hover:text-[var(--gold)] transition-colors">{{ __('messages.chef') }}</a>
        <a href="{{ route('reservation.index') }}"
            class="text-sm border-b border-black pb-2 mt-4">{{ __('messages.reserve_button') }}</a>

        <!-- Mobile Language Switcher -->
        <div class="flex items-center space-x-4 mt-4">
            <a href="{{ route('language.switch', ['locale' => 'fr', 'redirect' => url()->current()]) }}"
                class="text-lg font-medium {{ $currentLocale == 'fr' ? 'text-[var(--gold)]' : 'text-gray-400' }}">FR</a>
            <span class="text-gray-300">|</span>
            <a href="{{ route('language.switch', ['locale' => 'en', 'redirect' => url()->current()]) }}"
                class="text-lg font-medium {{ $currentLocale == 'en' ? 'text-[var(--gold)]' : 'text-gray-400' }}">EN</a>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Toast Notification -->
    <div id="toast" class="toast-notification" style="display: none;">
        <i class="fas fa-check-circle"></i>
        <span id="toastMessage">Produit ajouté au panier!</span>
    </div>

    @include('layouts.footer')
</body>

<script>
    const navbar = document.getElementById('navbar');
    const burger = document.getElementById('burger');
    const mobileMenu = document.getElementById('mobile-menu');
    const l1 = document.getElementById('l1');
    const l2 = document.getElementById('l2');

    // Scroll Effect
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled-nav');
        } else {
            navbar.classList.remove('scrolled-nav');
        }
    });

    // Burger Animation & Menu Toggle
    burger.addEventListener('click', () => {
        mobileMenu.classList.toggle('open');
        // Animate burger lines to X
        l1.classList.toggle('rotate-45');
        l1.classList.toggle('translate-y-1');
        l2.classList.toggle('-rotate-45');
        l2.classList.toggle('-translate-y-1');
    });

    // Cart Functions
    function showToast(message, isSuccess = true) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');
        const icon = toast.querySelector('i');

        toastMessage.textContent = message;
        icon.className = isSuccess ? 'fas fa-check-circle' : 'fas fa-exclamation-circle';
        toast.style.background = isSuccess ? 'linear-gradient(45deg, #28a745, #34ce57)' :
            'linear-gradient(45deg, #dc3545, #ff6b6b)';
        toast.style.display = 'flex';

        setTimeout(() => {
            toast.style.display = 'none';
        }, 3000);
    }

    function updateCartCount() {
        fetch('{{ route('order.getProduct') }}')
            .then(response => response.json())
            .then(data => {
                const cartCountElements = document.querySelectorAll('.cart-count');
                cartCountElements.forEach(el => {
                    el.textContent = data.cart_count;
                    el.style.display = data.cart_count > 0 ? 'flex' : 'none';
                });
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    // Add to cart function (used by both accueil and menu pages)
    function addToCart(productId, productName, productPrice, productImage = null) {
        const formData = new FormData();
        formData.append('product_id', productId);
        formData.append('quantity', 1);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('{{ route('order.place') }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message || 'Produit ajouté au panier!');
                    updateCartCount();
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                showToast('Erreur lors de l\'ajout au panier', false);
            });
    }

    // Initialize cart count on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>
</body>

</html>
