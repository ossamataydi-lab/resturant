@extends('layouts.app')

@section('content')
    <section id="menu-dashboard">

        <div class="container py-5">

            <!-- HEADER -->
            <div class="menu-header text-center mb-5">

                <!-- Search & Filter Row -->
                <div class="search-filter-wrapper mx-auto mt-4">
                    <div class="search-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="menuSearch" placeholder="{{ __('messages.search_placeholder') }}"
                            class="search-input">
                        <button class="clear-search" id="clearSearch" style="display: none;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="filter-row">
                        <!-- Category Filter Pills -->
                        <div class="category-pills" id="categoryPills">
                            <button class="pill active" data-category="all">
                                <i class="fas fa-th-large"></i> {{ __('messages.all') }}
                            </button>
                            @foreach ($categories as $category)
                                <button class="pill" data-category="cat-{{ $category->id }}">
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="sort-wrapper">
                            <select id="sortSelect" class="sort-select">
                                <option value="default">{{ __('messages.sort_by') }}</option>
                                <option value="price-asc">{{ __('messages.price_asc') }}</option>
                                <option value="price-desc">{{ __('messages.price_desc') }}</option>
                                <option value="name-asc">{{ __('messages.name_asc') }}</option>
                                <option value="name-desc">{{ __('messages.name_desc') }}</option>
                                <option value="rating">{{ __('messages.rating') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Results Count -->
                <div class="results-info mt-3">
                    <span id="resultsCount">{{ __('messages.all_dishes') }} ({{ $categories->sum(fn($c) => $c->products->count()) }})</span>
                </div>
            </div>

            <!-- CATEGORIES -->
            @foreach ($categories as $category)
                <div class="menu-category-section mb-5" id="cat-{{ $category->id }}"
                    data-category-id="{{ $category->id }}">
                    <div class="category-header">
                        <h3 class="category-title">
                            <span class="category-icon">
                                @if ($category->name === 'Entrées')
                                    <i class="fas fa-carrot"></i>
                                @elseif($category->name === 'Plats Principaux')
                                    <i class="fas fa-utensils"></i>
                                @elseif($category->name === 'Desserts')
                                    <i class="fas fa-birthday-cake"></i>
                                @elseif($category->name === 'Boissons')
                                    <i class="fas fa-glass-cheers"></i>
                                @else
                                    <i class="fas fa-plate-wheat"></i>
                                @endif
                            </span>
                            {{ $category->name }}
                        </h3>
                        <span class="item-count">{{ $category->products->count() }} {{ __('messages.dishes') }}</span>
                    </div>

                    <div class="menu-grid">
                        @forelse($category->products as $product)
                            <div class="menu-item-col" data-name="{{ strtolower($product->name) }}"
                                data-price="{{ $product->price }}" data-rating="4" data-category="cat-{{ $category->id }}"
                                data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                data-product-description="{{ $product->description }}"
                                data-product-price="{{ $product->price }}"
                                data-product-image="{{ asset($product->image ?? 'images/default-food.jpg') }}"
                                data-product-discount="{{ $product->discount ?? 0 }}"
                                data-product-status="{{ $product->status }}"
                                data-product-is-featured="{{ $product->is_featured ?? 0 }}">
                                <div class="menu-card">

                                    <!-- IMAGE -->
                                    <div class="image-wrapper">
                                        <img src="{{ asset($product->image ?? 'images/default-food.jpg') }}" loading="lazy"
                                            alt="{{ $product->name }}">

                                        <!-- Badges -->
                                        <div class="badges">
                                            @if ($product->status)
                                                <div class="status available">{{ __('messages.available') }}</div>
                                            @else
                                                <div class="status unavailable">{{ __('messages.unavailable') }}</div>
                                            @endif
                                            @if (isset($product->discount) && $product->discount > 0)
                                                <div class="discount-badge">-{{ $product->discount }}%</div>
                                            @endif
                                            @if (isset($product->is_featured) && $product->is_featured)
                                                <div class="featured-badge"><i class="fas fa-star"></i> {{ __('messages.popular') }}</div>
                                            @endif
                                        </div>

                                        <!-- Quick View Button - Icon Style -->
                                        <button class="qv-btn" onclick="openQuickView({{ $product->id }})" title="{{ __('messages.quick_view') }}">
                                            <i class="fas fa-expand"></i>
                                        </button>

                                        <!-- Favorite Button -->
                                        <button class="favorite-btn" onclick="toggleFavorite(this)"
                                            aria-label="{{ __('messages.add_to_favorites') }}">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </div>

                                    <!-- CONTENT -->
                                    <div class="card-content">
                                        <div class="title-price">
                                            <h5>{{ $product->name }}</h5>
                                            <div class="price-wrapper">
                                                @if (isset($product->discount) && $product->discount > 0)
                                                    <span class="original-price">{{ number_format($product->price, 2) }}
                                                        {{ $settings->signe_price ?? 'DH' }}</span>
                                                    <span class="price discounted">
                                                        {{ number_format($product->price * (1 - $product->discount / 100), 2) }}
                                                        {{ $settings->signe_price ?? 'DH' }}
                                                    </span>
                                                @else
                                                    <span class="price">
                                                        {{ number_format($product->price, 2) }}
                                                        {{ $settings->signe_price ?? 'DH' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <p class="description">
                                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                        </p>

                                        <!-- RATING -->
                                        <div class="rating-wrapper">
                                            <div class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= 4 ? 'active-star' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <span class="rating-count">({{ rand(10, 50) }} {{ __('messages.reviews') }})</span>
                                        </div>

                                        <!-- CART -->
                                        <div class="cart-section">
                                            @if ($product->status)
                                                <form class="add-to-cart-form" data-product-id="{{ $product->id }}">
                                                    @csrf
                                                    <div class="cart-controls">
                                                        <div class="quantity-selector">
                                                            <button type="button" class="qty-btn minus"
                                                                onclick="updateQty(this, -1)">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input type="number" name="quantity" value="1"
                                                                min="1" max="10" readonly>
                                                            <button type="button" class="qty-btn plus"
                                                                onclick="updateQty(this, 1)">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                        <a href="{{ route('commande') }}" class="add-btn">
                                                            <i class="fas fa-shopping-bag"></i>
                                                            <span class="btn-text">{{ __('messages.order_now') }}</span>
                                                        </a>
                                                    </div>
                                                </form>
                                            @else
                                                <button class="disabled-btn" disabled>
                                                    <i class="fas fa-times-circle"></i> {{ __('messages.out_of_stock') }}
                                                </button>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-utensils"></i>
                                <p>{{ __('messages.no_dishes_available') }}</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach

            <!-- Empty Search Results -->
            <div class="no-results" id="noResults" style="display: none;">
                <div class="no-results-content">
                    <i class="fas fa-search"></i>
                    <h3>{{ __('messages.no_results') }}</h3>
                    <p>{{ __('messages.try_different') }}</p>
                    <button class="reset-btn" onclick="resetFilters()">
                        <i class="fas fa-redo"></i> {{ __('messages.reset_filters') }}
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- Quick View Modal -->
    <div id="quickViewModal" class="quick-view-modal" style="display: none;">
        <div class="quick-view-overlay" onclick="closeQuickView()"></div>
        <div class="quick-view-content">
            <button class="quick-view-close" onclick="closeQuickView()">
                <i class="fas fa-times"></i>
            </button>
            <div id="quickViewContent">
                <!-- Content loaded dynamically -->
            </div>
        </div>
    </div>

    <style>
        /* Quick View Modal Styles */
        .quick-view-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-view-modal.show {
            display: flex;
        }

        .quick-view-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            animation: fadeIn 0.3s ease;
        }

        .quick-view-content {
            position: relative;
            background: white;
            border-radius: 20px;
            max-width: 800px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.4s ease;
        }

        .quick-view-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: white;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quick-view-close:hover {
            background: #dc3545;
            color: white;
            transform: rotate(90deg);
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Quick View Content Styles */
        .quick-view-body {
            display: flex;
            flex-wrap: wrap;
        }

        .quick-view-image {
            flex: 1;
            min-width: 300px;
        }

        .quick-view-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px 0 0 20px;
        }

        .quick-view-details {
            flex: 1;
            min-width: 300px;
            padding: 35px;
        }

        .quick-view-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .quick-view-badge.available {
            background: linear-gradient(45deg, #28a745, #34ce57);
        }

        .quick-view-badge.unavailable {
            background: linear-gradient(45deg, #6c757d, #adb5bd);
        }

        .quick-view-badge.discount {
            background: linear-gradient(45deg, #ffc107, #ffcd39);
            color: #333;
        }

        .quick-view-badge.featured {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
        }

        .quick-view-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #333;
            margin: 15px 0;
        }

        .quick-view-description {
            color: #666;
            line-height: 1.8;
            margin-bottom: 20px;
            font-size: 0.95rem;
        }

        .quick-view-price {
            margin-bottom: 25px;
        }

        .quick-view-price .current {
            font-size: 1.5rem;
            font-weight: 700;
            color: #dc3545;
        }

        .quick-view-price .original {
            font-size: 1rem;
            color: #999;
            text-decoration: line-through;
            margin-right: 10px;
        }

        .quick-view-price .discounted {
            color: #28a745;
        }

        .quick-view-btn {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            color: white;
            border: none;
            padding: 15px 35px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s;
            width: fit-content;
        }

        .quick-view-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3);
        }

        .quick-view-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        @media (max-width: 768px) {
            .quick-view-content {
                width: 95%;
                max-height: 95vh;
            }

            .quick-view-body {
                flex-direction: column;
            }

            .quick-view-image {
                min-width: 100%;
                height: 250px;
            }

            .quick-view-image img {
                border-radius: 20px 20px 0 0;
            }
        }
    </style>

    <!-- Scroll to Top Button -->
    <button class="scroll-to-top" id="scrollToTop" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>
    <style>
        /* Base Styles */
        body {
            background: linear-gradient(135deg, #f8f9fa, #fdf2f2);
            font-family: 'Poppins', sans-serif;

        }

        .subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        /* Search & Filter Wrapper */
        .search-filter-wrapper {
            max-width: 900px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 15px;
            padding-top: 100px;
        }

        .search-wrapper {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
            display: flex;
            justify-content: center;
        }

        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }

        .search-input {
            width: 100%;
            padding: 16px 45px 16px 50px;
            border-radius: 50px;
            border: 2px solid transparent;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            outline: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .search-input:focus {
            border-color: #dc3545;
            box-shadow: 0 5px 25px rgba(220, 53, 69, 0.2);
        }

        .clear-search {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            padding: 5px;
            transition: color 0.3s;
        }

        .clear-search:hover {
            color: #dc3545;
        }

        /* Filter Row */
        .filter-row {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
            width: 100%;
            gap: 20px;
            margin-top: 25px;
        }

        /* Category Pills */
        .category-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
        }

        .pill {
            padding: 10px 20px;
            border-radius: 30px;
            border: 2px solid #eee;
            background: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pill:hover {
            border-color: #dc3545;
            color: #dc3545;
        }

        .pill.active {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            color: white;
            border-color: transparent;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* Sort Select */
        .sort-wrapper {
            display: flex;
            justify-content: center;
        }

        .sort-select {
            padding: 10px 35px 10px 15px;
            border-radius: 25px;
            border: 2px solid #eee;
            background: white;
            cursor: pointer;
            font-size: 0.9rem;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23666' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            transition: border-color 0.3s;
        }

        .sort-select:focus {
            border-color: #dc3545;
        }

        /* Results Info */
        .results-info {
            color: #666;
            font-size: 0.9rem;
        }

        /* Category Header */
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 50px 0 25px;
            padding: 0 15px 20px;
            border-bottom: 2px solid #eee;
            flex-wrap: wrap;
            gap: 15px;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 0;
        }

        .category-icon {
            width: 45px;
            height: 45px;
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
        }

        .item-count {
            background: #f8f9fa;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }

        /* GRID */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 0 15px;
            padding-left:23px;
            width: 100%;
        }

        /* CARD */
        .menu-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }

        .menu-card.hidden {
            display: none;
        }

        /* Image Wrapper */
        .image-wrapper {
            position: relative;
            overflow: hidden;
        }

        .image-wrapper img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .menu-card:hover img {
            transform: scale(1.12);
        }

        /* Badges */
        .badges {
            position: absolute;
            top: 15px;
            left: 15px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            z-index: 2;
        }

        .status {
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .available {
            background: linear-gradient(45deg, #28a745, #34ce57);
        }

        .unavailable {
            background: linear-gradient(45deg, #6c757d, #adb5bd);
        }

        .discount-badge {
            background: linear-gradient(45deg, #ffc107, #ffcd39);
            color: #333;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 700;
        }

        .featured-badge {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            color: white;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Quick View Button - Always visible */
        .quick-view-btn {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            white-space: nowrap;
            z-index: 5;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .quick-view-btn:hover {
            transform: translateX(-50%) translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }

        .quick-view-btn i {
            font-size: 0.9rem;
        }

        /* Quick View Icon Button */
        .qv-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.95);
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 5;
            opacity: 0;
        }

        .menu-card:hover .qv-btn {
            opacity: 1;
        }

        .qv-btn:hover {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            color: white;
            transform: translate(-50%, -50%) scale(1.1);
        }

        .qv-btn i {
            font-size: 1.2rem;
        }

        /* Favorite Button */
        .favorite-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            border: none;
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            z-index: 2;
        }

        .favorite-btn:hover {
            transform: scale(1.1);
        }

        .favorite-btn.active {
            background: #dc3545;
            color: white;
            animation: heartBeat 0.3s ease;
        }

        @keyframes heartBeat {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.3);
            }
        }

        /* Card Content */
        .card-content {
            padding: 25px;
        }

        .title-price {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 12px;
        }

        .title-price h5 {
            font-weight: 700;
            font-size: 1.1rem;
            color: #333;
            margin: 0;
            flex: 1;
        }

        .price-wrapper {
            text-align: right;
        }

        .price {
            color: #dc3545;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .original-price {
            display: block;
            font-size: 0.85rem;
            color: #999;
            text-decoration: line-through;
            margin-bottom: 2px;
        }

        .price.discounted {
            color: #28a745;
        }

        .description {
            font-size: 0.9rem;
            color: #777;
            margin: 10px 0 15px;
            line-height: 1.5;
        }

        /* Rating */
        .rating-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .rating {
            display: flex;
            gap: 2px;
        }

        .rating i {
            color: #ddd;
            font-size: 0.85rem;
            transition: color 0.3s;
        }

        .active-star {
            color: #ffc107;
        }

        .rating-count {
            font-size: 0.8rem;
            color: #999;
        }

        /* Cart Section */
        .cart-controls {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        /* Quantity Selector */
        .quantity-selector {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            border-radius: 12px;
            overflow: hidden;
        }

        .qty-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: transparent;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
        }

        .qty-btn:hover {
            background: #dc3545;
            color: white;
        }

        .quantity-selector input {
            width: 40px;
            height: 36px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: 600;
            color: #333;
        }

        .quantity-selector input:focus {
            outline: none;
        }

        /* Add Button */
        .add-btn {
            flex: 1;
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            border: none;
            color: white;
            border-radius: 12px;
            padding: 10px 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-weight: 600;
        }

        .add-btn:hover {
            background: linear-gradient(45deg, #c82333, #e4606d);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .add-btn:active {
            transform: translateY(0);
        }

        .btn-text {
            display: none;
        }

        @media(min-width: 576px) {
            .btn-text {
                display: inline;
            }
        }

        /* Disabled Button */
        .disabled-btn {
            width: 100%;
            background: linear-gradient(45deg, #ccc, #ddd);
            border: none;
            padding: 12px;
            border-radius: 12px;
            color: #888;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        /* Empty State */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state p {
            font-size: 1.1rem;
        }

        /* No Results */
        .no-results {
            text-align: center;
            padding: 80px 20px;
        }

        .no-results-content i {
            font-size: 5rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-results-content h3 {
            color: #333;
            margin-bottom: 10px;
        }

        .no-results-content p {
            color: #666;
            margin-bottom: 25px;
        }

        .reset-btn {
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            border: none;
            color: white;
            padding: 14px 30px;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .reset-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(220, 53, 69, 0.3);
        }

        /* Modal Styles */
        .modal {
            display: none;
        }

        .modal.show {
            display: block;
        }

        .modal-dialog {
            max-width: 800px;
        }

        .modal-content {
            border: none;
            border-radius: 25px;
            overflow: hidden;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: white;
            cursor: pointer;
            z-index: 10;
            transition: all 0.3s;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .modal-close:hover {
            background: #dc3545;
            color: white;
        }

        /* Scroll to Top */
        .scroll-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background: linear-gradient(45deg, #dc3545, #ff6b6b);
            color: white;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(220, 53, 69, 0.3);
            z-index: 1000;
        }

        .scroll-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            transform: translateY(-5px);
        }

        /* Toast Notification */
        .toast-notification {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background: linear-gradient(45deg, #28a745, #34ce57);
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            z-index: 1001;
            font-weight: 600;
        }

        .toast-notification.show {
            transform: translateX(-50%) translateY(0);
        }

        .toast-notification i {
            font-size: 1.2rem;
        }

        /* Loading Animation */
        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }

            100% {
                background-position: 200% 0;
            }
        }

        .loading {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        /* MOBILE */
        @media(max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }

            .image-wrapper img {
                height: 180px;
            }

            .search-filter-wrapper {
                padding: 0 10px;
            }

            .filter-row {
                flex-direction: column;
                align-items: stretch;
                gap: 15px;
            }

            .category-pills {
                justify-content: flex-start;
                overflow-x: auto;
                flex-wrap: nowrap;
                padding-bottom: 10px;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }

            .category-pills::-webkit-scrollbar {
                display: none;
            }

            .pill {
                flex-shrink: 0;
                padding: 8px 16px;
                font-size: 0.85rem;
            }

            .sort-wrapper {
                width: 100%;
                display: flex;
                justify-content: center;
            }

            .sort-select {
                width: 100%;
                max-width: 300px;
            }

            .title-price {
                flex-direction: column;
                gap: 8px;
            }

            .price-wrapper {
                text-align: left;
            }

            .cart-controls {
                flex-direction: column;
                gap: 10px;
            }

            .quantity-selector {
                width: 100%;
                justify-content: center;
            }

            .add-btn {
                width: 100%;
            }

            .category-header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
                margin: 30px 0 20px;
                padding: 0 10px 15px;
            }

            .menu-grid {
                grid-template-columns: 1fr;
                gap: 20px;
                padding: 0 10px;
            }

            .card-content {
                padding: 20px;
            }
        }

        /* TABLET */
        @media(min-width: 769px) and (max-width: 1024px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* SMALL MOBILE */
        @media(max-width: 480px) {
            .search-input {
                padding: 14px 40px 14px 45px;
                font-size: 0.95rem;
            }

            .category-title {
                font-size: 1.3rem;
            }

            .category-icon {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }

        /* Fade animation for filtering */
        .menu-item-col {
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Staggered animation for cards */
        .menu-grid:hover .menu-item-col {
            animation: none;
        }

        .menu-grid:hover .menu-item-col:hover {
            animation: pulse 0.3s ease;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.02);
            }
        }
    </style>

<script>
// Translation strings for JavaScript
        const translations = {
            productsFound: '{{ __("messages.products_found") }}',
            allDishes: '{{ __("messages.all_dishes") }}',
            addedToFavorites: '{{ __("messages.added_to_favorites") }}',
            productAdded: '{{ __("messages.product_added") }}',
            quickView: '{{ __("messages.quick_view") }}',
            addToCart: '{{ __("messages.add_to_cart") }}',
            unavailable: '{{ __("messages.unavailable") }}',
            productNotFound: '{{ __("messages.product_not_found") }}',
            popular: '{{ __("messages.popular") }}',
            available: '{{ __("messages.available") }}'
        };

        // Get currency from settings (passed from PHP)
        const currencySymbol = @json($settings->signe_price ?? 'DH');

        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('menuSearch');
            const clearBtn = document.getElementById('clearSearch');
            const categoryPills = document.querySelectorAll('.pill');
            const sortSelect = document.getElementById('sortSelect');
            const menuItems = document.querySelectorAll('.menu-item-col');
            const noResults = document.getElementById('noResults');
            const resultsCount = document.getElementById('resultsCount');
            const scrollToTopBtn = document.getElementById('scrollToTop');

            // Search functionality
            searchInput.addEventListener('input', function() {
                const value = this.value.toLowerCase();
                clearBtn.style.display = value ? 'block' : 'none';
                filterItems();
            });

            clearBtn.addEventListener('click', function() {
                searchInput.value = '';
                clearBtn.style.display = 'none';
                filterItems();
            });

            // Category filter
            categoryPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    categoryPills.forEach(p => p.classList.remove('active'));
                    this.classList.add('active');
                    filterItems();
                });
            });

            // Sort functionality
            sortSelect.addEventListener('change', function() {
                sortItems(this.value);
            });

            // Combined filter and sort function
            function filterItems() {
                const searchValue = searchInput.value.toLowerCase();
                const activeCategory = document.querySelector('.pill.active').dataset.category;
                let visibleCount = 0;

                menuItems.forEach(item => {
                    const name = item.dataset.name;
                    const category = item.dataset.category;

                    const matchesSearch = name.includes(searchValue);
                    const matchesCategory = activeCategory === 'all' || category === activeCategory;

                    if (matchesSearch && matchesCategory) {
                        item.classList.remove('hidden');
                        item.style.display = '';
                        visibleCount++;
                    } else {
                        item.classList.add('hidden');
                        item.style.display = 'none';
                    }
                });

                // Show/hide category sections
                document.querySelectorAll('.menu-category-section').forEach(section => {
                    const sectionId = 'cat-' + section.dataset.categoryId;
                    const hasVisibleItems = Array.from(section.querySelectorAll('.menu-item-col')).some(
                        item => !item.classList.contains('hidden')
                    );

                    if (activeCategory !== 'all' && activeCategory !== sectionId) {
                        section.style.display = 'none';
                    } else if (!hasVisibleItems && searchValue) {
                        section.style.display = 'none';
                    } else {
                        section.style.display = '';
                    }
                });

                // Update results count
                const totalItems = document.querySelectorAll('.menu-item-col:not(.hidden)').length;
                resultsCount.textContent = `${totalItems} ${translations.productsFound}`;

                // Show no results message
                noResults.style.display = totalItems === 0 ? 'block' : 'none';
            }

            // Sort function
            function sortItems(sortType) {
                menuItems.forEach(item => {
                    const card = item.closest('.menu-grid');
                    const items = Array.from(card.querySelectorAll('.menu-item-col:not(.hidden)'));

                    items.sort((a, b) => {
                        const priceA = parseFloat(a.dataset.price);
                        const priceB = parseFloat(b.dataset.price);
                        const nameA = a.dataset.name;
                        const nameB = b.dataset.name;
                        const ratingA = parseInt(a.dataset.rating);
                        const ratingB = parseInt(b.dataset.rating);

                        switch (sortType) {
                            case 'price-asc':
                                return priceA - priceB;
                            case 'price-desc':
                                return priceB - priceA;
                            case 'name-asc':
                                return nameA.localeCompare(nameB);
                            case 'name-desc':
                                return nameB.localeCompare(nameA);
                            case 'rating':
                                return ratingB - ratingA;
                            default:
                                return 0;
                        }
                    });

                    items.forEach(sortedItem => card.appendChild(sortedItem));
                });
            }

// Reset filters
            window.resetFilters = function() {
                searchInput.value = '';
                clearBtn.style.display = 'none';
                sortSelect.value = 'default';
                categoryPills.forEach(p => p.classList.remove('active'));
                document.querySelector('.pill[data-category="all"]').classList.add('active');

                menuItems.forEach(item => {
                    item.classList.remove('hidden');
                    item.style.display = '';
                });

                document.querySelectorAll('.menu-category-section').forEach(section => {
                    section.style.display = '';
                });

                noResults.style.display = 'none';
                resultsCount.textContent = translations.allDishes;
            };

            // Scroll to top button
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    scrollToTopBtn.classList.add('visible');
                } else {
                    scrollToTopBtn.classList.remove('visible');
                }
            });

            // Scroll to top function
            window.scrollToTop = function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };

        // Make functions globally accessible
        window.openQuickView = function(productId) {
            const modal = document.getElementById('quickViewModal');
            const content = document.getElementById('quickViewContent');

            // Find the product element with this ID
            const productElement = document.querySelector(`[data-product-id="${productId}"]`);

            if (productElement) {
                const name = productElement.dataset.productName;
                let description = productElement.dataset.productDescription;
                const price = parseFloat(productElement.dataset.productPrice);
                const image = productElement.dataset.productImage;
                const discount = parseInt(productElement.dataset.productDiscount);
                const status = productElement.dataset.productStatus === '1';
                const isFeatured = productElement.dataset.productIsFeatured === '1';

                const discountedPrice = discount > 0 ? (price * (1 - discount / 100)).toFixed(2) : null;

                // Handle empty description
                if (!description || description.trim() === '' || description === 'null') {
                    description = 'Aucune description disponible pour ce plat.';
                }

                let badgesHTML = '';
                if (status) {
                    badgesHTML += '<span class="quick-view-badge available"><i class="fas fa-check-circle"></i> {{ __("messages.available") }}</span>';
                } else {
                    badgesHTML += '<span class="quick-view-badge unavailable"><i class="fas fa-times-circle"></i> {{ __("messages.unavailable") }}</span>';
                }
                if (discount > 0) {
                    badgesHTML += '<span class="quick-view-badge discount"><i class="fas fa-tag"></i> -' + discount + '%</span>';
                }
                if (isFeatured) {
                    badgesHTML += '<span class="quick-view-badge featured"><i class="fas fa-star"></i> {{ __("messages.popular") }}</span>';
                }

                let priceHTML = '';
                if (discountedPrice) {
                    priceHTML = '<span class="original">' + price.toFixed(2) + ' ' + currencySymbol + '</span>' +
                        '<span class="current discounted">' + discountedPrice + ' ' + currencySymbol + '</span>';
                } else {
                    priceHTML = '<span class="current">' + price.toFixed(2) + ' ' + currencySymbol + '</span>';
                }

                content.innerHTML = `
                    <div class="quick-view-body">
                        <div class="quick-view-image">
                            <img src="${image}" alt="${name}">
                        </div>
                        <div class="quick-view-details">
                            <div style="margin-bottom: 15px;">
                                ${badgesHTML}
                            </div>
                            <h2 class="quick-view-title">${name}</h2>
                            <p class="quick-view-description">${description}</p>
                            <div class="quick-view-price">
                                ${priceHTML}
                            </div>
                            ${status ? `
                                <button onclick="addToQuickViewProduct(${productId})" class="quick-view-modal-btn">
                                    <i class="fas fa-shopping-bag"></i> {{ __("messages.add_to_cart") }}
                                </button>
                                ` : `
                                <button class="quick-view-modal-btn" disabled style="background: #ccc;">
                                    <i class="fas fa-times-circle"></i> {{ __("messages.unavailable") }}
                                </button>
                                `}
                        </div>
                    </div>
                `;
            } else {
                content.innerHTML = '<div style="padding: 30px; text-align: center;"><p>{{ __("messages.product_not_found") }}</p></div>';
            }

            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        };

        window.closeQuickView = function() {
            const modal = document.getElementById('quickViewModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        };

        window.toggleFavorite = function(btn) {
            btn.classList.toggle('active');
            const icon = btn.querySelector('i');
            if (btn.classList.contains('active')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                showToast(translations.addedToFavorites + ' ❤️');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        };

        window.resetFilters = function() {
            searchInput.value = '';
            clearBtn.style.display = 'none';
            sortSelect.value = 'default';
            categoryPills.forEach(p => p.classList.remove('active'));
            document.querySelector('.pill[data-category="all"]').classList.add('active');

            menuItems.forEach(item => {
                item.classList.remove('hidden');
                item.style.display = '';
            });

            document.querySelectorAll('.menu-category-section').forEach(section => {
                section.style.display = '';
            });

            noResults.style.display = 'none';
            resultsCount.textContent = translations.allDishes;
        };

        window.scrollToTop = function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

            // Close modal on outside click
            document.getElementById('quickViewModal').addEventListener('click', function(e) {
                if (e.target.classList.contains('quick-view-overlay')) {
                    closeQuickView();
                }
            });

            // Toast notification
            function showToast(message) {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toastMessage');
                toastMessage.textContent = message;
                toast.classList.add('show');

                setTimeout(() => {
                    toast.classList.remove('show');
                }, 3000);
            }

            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeQuickView();
                }
            });
        });
    </script>
