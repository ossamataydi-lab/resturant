<!DOCTYPE html>
<html lang="{{ $currentLocale ?? 'fr' }}" dir="{{ $currentLocale == 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <div class="dashboard-wrapper">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-box">
                    {{ Str::limit($settings->logo_name ?? 'D', 1, '') }}
                </div>
                <span class="logo-text">
                    {{ $settings->logo_name ?? 'Délice Admin' }}
                </span>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li class="active"><a href="#"><i class="bi bi-speedometer2"></i>
                            <span>{{ __('messages.dashboard') }}</span></a></li>
                    <li><a href="{{ route('admin.commandes.index') }}"><i class="bi bi-box-seam"></i>
                            <span>{{ __('messages.commandes') }}</span></a></li>

                    <li>
                        <a href="{{ route('admin.products.index') }}"><i class="bi bi-egg-fried"></i>
                            <span>{{ __('messages.menu_items') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories.index') }}">
                            <i class="bi bi-folder2"></i>
                            <span>{{ __('messages.categories') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery.index') }}">
                            <i class="bi bi-folder2"></i>
                            <span>{{ __('messages.gallery') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.chef.index') }}">
                            <i class="bi bi-person-badge"></i>
                            <span>{{ __('messages.chef') }}</span>
                        </a>
                    </li>
                    <li><a href="{{ route('admin.reservations.index') }}"><i class="bi bi-calendar-check"></i>
                            <span>{{ __('messages.reservations') }}</span></a></li>
                    <li class="nav-separator"></li>
                    <li><a href="{{ route('admin.settings.index') }}"><i class="bi bi-gear"></i>
                            <span>{{ __('messages.settings') }}</span></a>
                    </li>
                    <li class="logout-item">
                        <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                            @csrf
                        </form>

                        <a href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>{{ __('messages.logout') }}</span>
                        </a>
                    </li>

                </ul>
            </nav>
        </aside>

        <main class="main-body">
            <header class="main-header">
                <div class="header-info">
                    <h1>{{ __('messages.dashboard') }}</h1>
                    <p>{{ __('messages.today') }} : {{ now()->format('d/m/Y') }}</p>
                </div>
                <div class="header-actions">
                    <button class="btn-refresh" onclick="location.reload()">🔄 {{ __('messages.refresh') }}</button>
                </div>

                <div class="language-selector">
                    <a href="{{ route('language.switch', ['locale' => 'fr', 'redirect' => url()->current()]) }}"
                        class="lang-link {{ $currentLocale == 'fr' ? 'active' : '' }}">FR</a>
                    <a href="{{ route('language.switch', ['locale' => 'en', 'redirect' => url()->current()]) }}"
                        class="lang-link {{ $currentLocale == 'en' ? 'active' : '' }}">EN</a>
                    <a href="{{ route('language.switch', ['locale' => 'ar', 'redirect' => url()->current()]) }}"
                        class="lang-link {{ $currentLocale == 'ar' ? 'active' : '' }}">AR</a>
                </div>

            </header>



            <div class="quick-actions">
                <a href="{{ route('admin.products.index') }}" class="action-card"><i class="bi bi-plus-circle"></i>
                    {{ __('messages.menu_items') }}</a>
                <a href="{{ route('admin.categories.index') }}" class="action-card"><i class="bi bi-folder-plus"></i>
                    {{ __('messages.categories') }}</a>
                <a href="{{ route('admin.Register-Login.register') }}" class="action-card"><i
                        class="bi bi-person-plus"></i> {{ __('messages.employee') }}</a>
            </div>

            <div class="stats-grid">
                <div class="stat-card blue">
                    <div class="stat-icon">🔢</div>
                    <div class="stat-data">
                        <span class="label">{{ __('messages.stats_orders') }}</span>
                        <span class="value">{{ $stats['today_orders'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="stat-card orange">
                    <div class="stat-icon">🍽</div>
                    <div class="stat-data">
                        <span class="label">{{ __('messages.stats_dishes') }}</span>
                        <span class="value">{{ $stats['total_products'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="stat-card red">
                    <div class="stat-icon">📦</div>
                    <div class="stat-data">
                        <span class="label">{{ __('messages.stats_pending') }}</span>
                        <span class="value">{{ $stats['pending_orders'] ?? 0 }}</span>
                    </div>
                </div>
                <div class="stat-card orange">
                    <div class="stat-icon">📋</div>
                    <div class="stat-data">
                        <span class="label">{{ __('messages.stats_reservations_pending') }}</span>
                        <span class="value">{{ $stats['pending_reservations'] ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <div class="charts-grid">
                <div class="chart-box">
                    <h6>📈 {{ __('messages.orders_performance') }}</h6>
                    <div class="canvas-container"><canvas id="ordersRevenueChart"></canvas></div>
                </div>
                <div class="chart-box">
                    <h6>🥘 {{ __('messages.popular_dishes') }}</h6>
                    <div class="canvas-container"><canvas id="popularDishesChart"></canvas></div>
                </div>
            </div>

            <div class="data-grid">
                <div class="content-card">
                    <div class="card-header">
                        <h5>{{ __('messages.latest_reservations') }}</h5>
                    </div>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>{{ __('messages.customer') }}</th>
                                    <th>{{ __('messages.phone') }}</th>
                                    <th>{{ __('messages.date') }}</th>
                                    <th>{{ __('messages.pers') }}</th>
                                    <th>{{ __('messages.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recent_reservations as $res)
                                    <tr>
                                        <td class="fw-bold">{{ $res->customer_name }}</td>
                                        <td class="fw-bold">{{ $res->customer_phone }} </td>
                                        <td>{{ \Carbon\Carbon::parse($res->reservation_time)->format('d/m H:i') }}</td>
                                        <td><span class="guest-pill">{{ $res->guests_count }}</span></td>
                                        <td>
                                            <span
                                                class="status-pill {{ $res->status == 'pending' ? 'pending' : 'confirmed' }}">
                                                {{ $res->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="content-card">
                    <div class="card-header">
                        <h5>{{ __('messages.popular_dishes') }}</h5>
                    </div>
                    <div class="products-list">
                        @foreach ($popular_products as $product)
                            <div class="product-row">
                                <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=100&q=80' }}"
                                    alt="{{ $product->name }}">
                                <div class="p-info">
                                    <span class="p-name">{{ $product->name }}</span>
                                    <span class="p-sales">{{ $product->order_items_count }}
                                        {{ __('messages.sales') }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </main>
    </div>

    <style>
        /* 🎨 MODERN DESIGN SYSTEM */
        :root {
            --sidebar-bg: #0f172a;
            --main-bg: #f8fafc;
            --accent: #4f46e5;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        /* Reset & Clean Overlap */
        body {
            background-color: var(--main-bg) !important;
            font-family: 'Inter', sans-serif !important;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        html {
            overflow-x: hidden;
        }

        footer {
            display: none !important;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 100;
            padding: 1.5rem 1rem;
            transition: width 0.3s ease;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
            padding: 0 10px;
        }

        .logo-box {
            background: var(--accent);
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-weight: 800;
            flex-shrink: 0;
        }

        .logo-text {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-nav li {
            margin-bottom: 4px;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.3s;
            white-space: nowrap;
            overflow: hidden;
        }

        .sidebar-nav a i {
            flex-shrink: 0;
            font-size: 1.2rem;
        }

        .sidebar-nav span {
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-nav li.active a,
        .sidebar-nav a:hover {
            background: #1e293b;
            color: white;
        }

        .sidebar-nav li.active a {
            background: var(--accent);
        }

        .nav-separator {
            height: 1px;
            background: #334155;
            margin: 1.5rem 0;
        }

        /* Main Area */
        .main-body {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 85px;
            transition: margin-left 0.3s ease, width 0.3s ease, padding 0.3s ease;
        }

        .main-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            gap: 20px;
            flex-wrap: wrap;
        }

        .main-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .main-header p {
            color: var(--text-muted);
            margin: 5px 0 0;
        }

        .btn-refresh {
            background: var(--white);
            border: 1px solid #e2e8f0;
            padding: 10px 18px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            box-shadow: var(--shadow);
        }

        /* Language Selector */
        .language-selector {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .lang-link {
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .lang-link:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .lang-link.active {
            background: var(--accent);
            color: white;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: var(--white);
            padding: 1rem;
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow);
            border: 1px solid transparent;
            transition: 0.3s;
        }

        .action-card:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        .action-card.promo {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.25rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1.25rem;
            border-radius: 16px;
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 4px solid #ddd;
        }

        .stat-card.blue {
            border-color: #3b82f6;
        }

        .stat-card.green {
            border-color: #10b981;
        }

        .stat-card.purple {
            border-color: #8b5cf6;
        }

        .stat-card.orange {
            border-color: #f59e0b;
        }

        .stat-card.red {
            border-color: #ef4444;
        }

        .stat-icon {
            font-size: 1.5rem;
        }

        .stat-data .label {
            display: block;
            color: var(--text-muted);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .stat-data .value {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        /* Charts */
        .charts-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-box {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .chart-box h6 {
            margin-bottom: 1.25rem;
            font-weight: 700;
            font-size: 1rem;
        }

        .canvas-container {
            height: 280px;
            position: relative;
        }

        /* Data Grid */
        .data-grid {
            display: grid;
            grid-template-columns: 1.6fr 1fr;
            gap: 1.5rem;
        }

        .content-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            padding: 1.5rem;
        }

        .card-header {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
        }

        .card-header h5 {
            margin: 0;
            font-weight: 700;
        }

        /* Table */
        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            color: var(--text-muted);
            font-size: 0.8rem;
            padding-bottom: 12px;
            text-transform: uppercase;
        }

        td {
            padding: 14px 0;
            border-top: 1px solid #f1f5f9;
            font-size: 0.9rem;
        }

        .status-pill {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .status-pill.confirmed {
            background: #dcfce7;
            color: #15803d;
        }

        .status-pill.pending {
            background: #fef3c7;
            color: #b45309;
        }

        .guest-pill {
            background: #f1f5f9;
            padding: 2px 8px;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Product List */
        .product-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .product-row img {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            object-fit: cover;
        }

        .p-name {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
        }

        .p-sales {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        /* ========== RESPONSIVE STYLES ========== */

        /* Tablet Styles (< 1024px) */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 80px;
            }

            .sidebar .logo-text,
            .sidebar span {
                display: none;
            }

            .sidebar-header {
                justify-content: center;
                padding: 0;
            }

            .sidebar-nav a {
                justify-content: center;
                padding: 12px;
            }

            .sidebar-nav a i {
                margin: 0;
            }

            .main-body {
                margin-left: 80px;
                width: calc(100% - 80px);
                padding: 60px 30px;
            }

            .charts-grid,
            .data-grid {
                grid-template-columns: 1fr;
            }

            .main-header {
                flex-wrap: wrap;
                gap: 15px;
            }

            .language-selector {
                order: -1;
                width: 100%;
                justify-content: center;
            }
        }

        /* Mobile Phone Styles (< 768px) */
        @media (max-width: 768px) {
            .dashboard-wrapper {
                flex-direction: column;
            }

            /* Sidebar - Fixed at bottom on mobile */
            .sidebar {
                width: 100%;
                height: auto;
                position: fixed;
                bottom: 0;
                top: auto;
                left: 0;
                padding: 0.5rem 0.25rem;
                display: flex;
                justify-content: space-around;
                align-items: center;
            }

            .sidebar-header {
                display: none;
            }

            .sidebar-nav {
                width: 100%;
            }

            .sidebar-nav ul {
                display: flex;
                justify-content: space-around;
                align-items: center;
                margin: 0;
                padding: 0;
            }

            .sidebar-nav li {
                margin: 0;
                flex: 1;
                text-align: center;
            }

            .sidebar-nav a {
                flex-direction: column;
                padding: 8px 4px;
                gap: 4px;
                font-size: 0.65rem;
            }

            .sidebar-nav a i {
                font-size: 1.3rem;
            }

            .sidebar-nav span {
                display: block;
                font-size: 0.6rem;
            }


            .sidebar-nav .nav-separator {
                display: none !important;
            }

            /* Main Body - Adjusted for bottom sidebar */
            .main-body {
                margin-left: 0;
                margin-bottom: 70px;
                width: 100%;
                padding: 20px 15px;
                padding-top: 60px;
            }

            /* Header */
            .main-header {
                flex-direction: row;
                align-items: center;
                gap: 10px;
                margin-bottom: 1.5rem;
            }

            .header-info h1 {
                font-size: 1.25rem;
            }

            .header-info p {
                font-size: 0.8rem;
            }

            .header-actions {
                display: none;
            }

            .language-selector {
                order: 0;
                width: auto;
                gap: 4px;
            }

            .lang-link {
                padding: 6px 10px;
                font-size: 0.8rem;
            }

            /* Quick Actions - Stack vertically */
            .quick-actions {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .action-card {
                padding: 0.85rem;
                font-size: 0.9rem;
            }

            /* Stats Grid - Single column */
            .stats-grid {
                grid-template-columns: 1fr 1fr;
                gap: 0.75rem;
                margin-bottom: 1.5rem;
            }

            .stat-card {
                padding: 0.75rem;
                gap: 10px;
            }

            .stat-icon {
                font-size: 1.1rem;
            }

            .stat-data .label {
                font-size: 0.7rem;
            }

            .stat-data .value {
                font-size: 1rem;
            }

            /* Charts Grid - Single column */
            .charts-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                margin-bottom: 1.5rem;
            }

            .chart-box {
                padding: 1rem;
            }

            .chart-box h6 {
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }

            .canvas-container {
                height: 200px;
            }

            /* Data Grid - Single column */
            .data-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .content-card {
                padding: 1rem;
            }

            .card-header {
                margin-bottom: 1rem;
                padding-bottom: 8px;
            }

            .card-header h5 {
                font-size: 1rem;
            }

            /* Table - No scrolling */
            .table-responsive {
                overflow-x: hidden;
            }

            table {
                width: 100%;
                min-width: auto;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 8px 6px;
                font-size: 0.75rem;
            }

            th {
                font-size: 0.65rem;
            }

            .status-pill {
                padding: 2px 6px;
                font-size: 0.65rem;
            }

            .guest-pill {
                padding: 2px 5px;
                font-size: 0.7rem;
            }

            /* Product List */
            .product-row {
                margin-bottom: 0.75rem;
            }

            .product-row img {
                width: 35px;
                height: 35px;
            }

            .p-name {
                font-size: 0.85rem;
            }

            .p-sales {
                font-size: 0.7rem;
            }
        }

        /* ========== RTL (Arabic) Styles ========== */
        [dir="rtl"] .main-body {
            margin-left: 0;
            margin-right: 260px;
        }

        [dir="rtl"] .sidebar {
            left: 0;
            right: 0;
        }

        [dir="rtl"] th {
            text-align: right;
        }

        [dir="rtl"] .sidebar-header {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .sidebar-nav a {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .main-header {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .header-info {
            text-align: right;
        }

        [dir="rtl"] .quick-actions a {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .stat-card {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .action-card {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .product-row {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .card-header h5 {
            text-align: right;
        }

        /* RTL Responsive */
        @media (max-width: 1024px) {
            [dir="rtl"] .main-body {
                margin-right: 80px;
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            [dir="rtl"] .main-body {
                margin-right: 0;
            }

            [dir="rtl"] .sidebar {
                top: 0;
                bottom: auto;
            }

            [dir="rtl"] .sidebar-nav ul {
                flex-direction: row;
            }

            [dir="rtl"] .sidebar-nav a {
                flex-direction: column;
            }
        }

        /* Small phones (< 480px) */
        @media (max-width: 480px) {
            .main-body {
                padding: 15px 10px;
                padding-bottom: 15px;
                margin-bottom: 65px;
            }

            .header-info h1 {
                font-size: 1.1rem;
            }

            .stat-card {
                padding: 0.6rem;
                gap: 8px;
            }

            .stat-icon {
                font-size: 1rem;
            }

            .stat-data .label {
                font-size: 0.65rem;
            }

            .stat-data .value {
                font-size: 0.9rem;
            }

            .canvas-container {
                height: 180px;
            }

            .quick-actions {
                gap: 0.5rem;
            }

            .action-card {
                padding: 0.75rem;
                font-size: 0.85rem;
                gap: 8px;
            }

            .action-card i {
                font-size: 1rem;
            }

            .sidebar-nav a i {
                font-size: 1.1rem;
            }

            .sidebar-nav span {
                font-size: 0.55rem;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Orders Revenue Chart - Line Chart
        const ordersByDay = @json($ordersByDay);
        const orderCounts = @json($orderCounts);

        const ctx1 = document.getElementById('ordersRevenueChart').getContext('2d');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ordersByDay.length > 0 ? ordersByDay : ['@lang('messages.days_mon')', '@lang('messages.days_tue')',
                    '@lang('messages.days_wed')', '@lang('messages.days_thu')', '@lang('messages.days_fri')', '@lang('messages.days_sat')',
                    '@lang('messages.days_sun')'
                ],
                datasets: [{
                    label: '@lang('messages.stats_orders')',
                    data: orderCounts.length > 0 ? orderCounts : [0, 0, 0, 0, 0, 0, 0],
                    borderColor: '#4f46e5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Popular Dishes Chart - Doughnut Chart
        const popularProductNames = @json($popularProductNames);
        const popularProductCounts = @json($popularProductCounts);

        const ctx2 = document.getElementById('popularDishesChart').getContext('2d');
        new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: popularProductNames.length > 0 ? popularProductNames : ['@lang('messages.no_dish')'],
                datasets: [{
                    data: popularProductCounts.length > 0 ? popularProductCounts : [1],
                    backgroundColor: ['#4f46e5', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
                }]
            },
            options: {
                maintainAspectRatio: false,
                cutout: '70%'
            }
        });
    </script>
</body>

</html>
