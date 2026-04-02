<!DOCTYPE html>
<html lang="{{ $currentLocale ?? 'fr' }}" dir="{{ $currentLocale == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang('messages.orders_management') | Délice Restaurant</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #ff6b35;
            --primary-dark: #e55a2b;
            --secondary: #2d3436;
            --bg-main: #f8f9fa;
            --bg-card: #ffffff;
            --text-main: #2d3436;
            --text-muted: #636e72;
            --success: #00b894;
            --warning: #fdcb6e;
            --danger: #d63031;
            --info: #0984e3;
            --purple: #6c5ce7;
            --border: #dfe6e9;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] body {
            direction: rtl;
        }

        [dir="rtl"] .header {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .header-left {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .header h1 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .language-selector {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .header-stats {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .stat-item {
            text-align: center;
        }

        [dir="rtl"] .tabs-container {
            direction: rtl;
        }

        [dir="rtl"] .tabs {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .tab {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .content {
            direction: rtl;
        }

        [dir="rtl"] .alert {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .orders-grid {
            direction: rtl;
        }

        [dir="rtl"] .order-card {
            text-align: right;
        }

        [dir="rtl"] .order-header {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .client-info {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .order-item {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .item-info {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .order-footer {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .order-actions {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .modal-content {
            text-align: right;
        }

        [dir="rtl"] .modal-buttons {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .empty-state {
            text-align: center;
        }

        /* HEADER */
        .header {
            background: linear-gradient(135deg, var(--secondary) 0%, #1e272e 100%);
            padding: 25px 40px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header h1 i { color: var(--primary); }

        /* Language Selector */
        .language-selector {
            display: flex;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            padding: 5px 10px;
            border-radius: 8px;
        }

        .lang-link {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: rgba(255,255,255,0.7);
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .lang-link:hover {
            background: rgba(255,255,255,0.2);
            color: white;
        }

        .lang-link.active {
            background: var(--primary);
            color: white;
        }

        .header-stats {
            display: flex;
            gap: 25px;
        }

        .stat-item {
            text-align: center;
            background: rgba(255,255,255,0.1);
            padding: 10px 20px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
        }

        .stat-item .count {
            font-size: 1.5rem;
            font-weight: 800;
            display: block;
        }

        .stat-item .label {
            font-size: 0.75rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* TABS */
        .tabs-container {
            background: var(--bg-card);
            padding: 20px 40px 0;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .tabs {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding-bottom: 0;
        }

        .tab {
            padding: 12px 24px;
            border: none;
            background: transparent;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-muted);
            cursor: pointer;
            border-radius: 10px 10px 0 0;
            transition: all 0.3s ease;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .tab:hover {
            background: var(--bg-main);
            color: var(--text-main);
        }

        .tab.active {
            background: var(--primary);
            color: white;
        }

        .tab .badge {
            background: rgba(0,0,0,0.15);
            padding: 2px 8px;
            border-radius: 20px;
            font-size: 0.75rem;
        }

        .tab.active .badge {
            background: rgba(255,255,255,0.25);
        }

        /* CONTENT AREA */
        .content {
            padding: 30px 40px;
        }

        /* ALERTS */
        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-success {
            background: rgba(0, 184, 148, 0.15);
            color: #00b894;
            border: 1px solid rgba(0, 184, 148, 0.3);
        }

        .alert-danger {
            background: rgba(214, 48, 49, 0.15);
            color: #d63031;
            border: 1px solid rgba(214, 48, 49, 0.3);
        }

        /* ORDERS GRID */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .order-card {
            background: var(--bg-card);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            animation: fadeIn 0.4s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .order-header {
            padding: 18px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(to right, rgba(255,107,53,0.08), transparent);
            border-bottom: 1px solid var(--border);
        }

        .order-id {
            font-size: 1.2rem;
            font-weight: 800;
            color: var(--secondary);
        }

        .order-date {
            font-size: 0.8rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .order-type {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .type-delivery {
            background: rgba(108, 92, 231, 0.15);
            color: #6c5ce7;
        }

        .type-takeaway {
            background: rgba(9, 132, 227, 0.15);
            color: #0984e3;
        }

        .order-body {
            padding: 20px;
        }

        .client-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .client-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1rem;
        }

        .client-name {
            font-weight: 600;
            color: var(--text-main);
        }

        .client-email {
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .order-items {
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
        }

        .item-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-qty {
            background: var(--bg-main);
            padding: 4px 10px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 0.85rem;
            color: var(--primary);
        }

        .item-name {
            font-weight: 500;
        }

        .item-price {
            font-weight: 600;
            color: var(--text-muted);
        }

        .order-footer {
            padding: 15px 20px;
            background: var(--bg-main);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-total {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--secondary);
        }

        .order-status {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .status-pending {
            background: rgba(253, 203, 110, 0.2);
            color: #e17055;
        }

        .status-preparing {
            background: rgba(9, 132, 227, 0.15);
            color: #0984e3;
        }

        .status-ready {
            background: rgba(0, 184, 148, 0.15);
            color: #00b894;
        }

        .status-completed {
            background: rgba(99, 110, 114, 0.15);
            color: #636e72;
        }

        /* ACTIONS */
        .order-actions {
            padding: 15px 20px;
            display: flex;
            gap: 10px;
            border-top: 1px solid var(--border);
        }

        .btn {
            flex: 1;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-update {
            background: var(--primary);
            color: white;
        }

        .btn-update:hover {
            background: var(--primary-dark);
        }

        .btn-deliver {
            background: var(--success);
            color: white;
        }

        .btn-deliver:hover {
            background: #00a885;
        }

        .btn-delete {
            background: rgba(214, 48, 49, 0.1);
            color: var(--danger);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.3;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            margin-bottom: 10px;
            color: var(--text-main);
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
            }

            .header-stats {
                width: 100%;
                justify-content: space-around;
            }

            .tabs-container {
                padding: 15px 20px 0;
            }

            .content {
                padding: 20px;
            }

            .orders-grid {
                grid-template-columns: 1fr;
            }
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            animation: modalIn 0.3s ease;
        }

        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .modal h3 {
            margin-bottom: 15px;
            font-size: 1.2rem;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .modal-buttons .btn {
            flex: 1;
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="header-left">
            <h1><i class="fas fa-clipboard-list"></i> @lang('messages.orders_management')</h1>
            <div class="language-selector">
                <a href="{{ route('language.switch', ['locale' => 'fr', 'redirect' => url()->current()]) }}"
                   class="lang-link {{ $currentLocale == 'fr' ? 'active' : '' }}">FR</a>
                <a href="{{ route('language.switch', ['locale' => 'en', 'redirect' => url()->current()]) }}"
                   class="lang-link {{ $currentLocale == 'en' ? 'active' : '' }}">EN</a>
                <a href="{{ route('language.switch', ['locale' => 'ar', 'redirect' => url()->current()]) }}"
                   class="lang-link {{ $currentLocale == 'ar' ? 'active' : '' }}">AR</a>
            </div>
        </div>
        <div class="header-stats">
            <div class="stat-item">
                <span class="count">{{ $counts['all'] }}</span>
                <span class="label">@lang('messages.total')</span>
            </div>
            <div class="stat-item">
                <span class="count" style="color: #e17055;">{{ $counts['pending'] }}</span>
                <span class="label">@lang('messages.pending')</span>
            </div>
            <div class="stat-item">
                <span class="count" style="color: #0984e3;">{{ $counts['preparing'] }}</span>
                <span class="label">@lang('messages.preparing')</span>
            </div>
            <div class="stat-item">
                <span class="count" style="color: #00b894;">{{ $counts['ready'] }}</span>
                <span class="label">@lang('messages.ready')</span>
            </div>
            <div class="stat-item">
                <span class="count" style="color: #636e72;">{{ $counts['completed'] }}</span>
                <span class="label">@lang('messages.completed')</span>
            </div>
        </div>
    </header>

    <div class="tabs-container">
        <div class="tabs">
            <a href="{{ route('admin.commandes.index') }}" class="tab {{ !$status ? 'active' : '' }}">
                <i class="fas fa-list"></i> @lang('messages.all_orders')
                <span class="badge">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'pending']) }}" class="tab {{ $status == 'pending' ? 'active' : '' }}">
                <i class="fas fa-clock"></i> @lang('messages.pending')
                <span class="badge">{{ $counts['pending'] }}</span>
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'preparing']) }}" class="tab {{ $status == 'preparing' ? 'active' : '' }}">
                <i class="fas fa-fire"></i> @lang('messages.preparing')
                <span class="badge">{{ $counts['preparing'] }}</span>
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'ready']) }}" class="tab {{ $status == 'ready' ? 'active' : '' }}">
                <i class="fas fa-check"></i> @lang('messages.ready')
                <span class="badge">{{ $counts['ready'] }}</span>
            </a>
            <a href="{{ route('admin.commandes.index', ['status' => 'completed']) }}" class="tab {{ $status == 'completed' ? 'active' : '' }}">
                <i class="fas fa-truck"></i> @lang('messages.completed')
                <span class="badge">{{ $counts['completed'] }}</span>
            </a>
        </div>
    </div>

    <main class="content">
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="empty-state">
                <i class="fas fa-shopping-basket"></i>
                <h3>@lang('messages.no_orders')</h3>
                <p>@lang('messages.no_orders_message')</p>
            </div>
        @else
            <div class="orders-grid">
                @foreach($orders as $order)
                    <article class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">@lang('messages.order_id'){{ $order->id }}</div>
                                <div class="order-date">{{ $order->created_at->format('d/m/Y à H:i') }}</div>
                            </div>
                            <span class="order-type type-{{ $order->type }}">
                                {{ $order->type == 'delivery' ? __('messages.delivery') : __('messages.takeaway') }}
                            </span>
                        </div>

                        <div class="order-body">
                            <div class="client-info">
                                <div class="client-avatar">
                                    {{ $order->user ? strtoupper(substr($order->user->name, 0, 1)) : 'G' }}
                                </div>
                                <div>
                                    <div class="client-name">{{ $order->user->name ?? __('messages.guest') }}</div>
                                    <div class="client-email">{{ $order->user->email ?? __('messages.client') }}</div>
                                </div>
                            </div>

                            <div class="order-items">
                                @foreach($order->orderItems as $item)
                                    <div class="order-item">
                                        <div class="item-info">
                                            <span class="item-qty">{{ $item->quantity }}x</span>
                                            <span class="item-name">{{ $item->product->title ?? 'Produit' }}</span>
                                        </div>
                                        <span class="item-price">{{ number_format($item->price * $item->quantity, 2) }} {{ $settings->signe_price ?? 'DH' }}</span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="order-footer">
                                <span class="order-total">{{ number_format($order->total_price, 2) }} {{ $settings->signe_price ?? 'DH' }}</span>
                                <span class="order-status status-{{ $order->status }}">
                                    @switch($order->status)
                                        @case('pending') @lang('messages.pending') @break
                                        @case('preparing') @lang('messages.preparing') @break
                                        @case('ready') @lang('messages.ready') @break
                                        @case('completed') @lang('messages.completed') @break
                                        @default {{ $order->status }}
                                    @endswitch
                                </span>
                            </div>

                            <div class="order-actions">
                                @if($order->status != 'completed')
                                    <form action="{{ route('admin.commandes.updateStatus', $order->id) }}" method="POST">
                                        @csrf
                                        @if($order->status == 'pending')
                                            <input type="hidden" name="status" value="preparing">
                                            <button type="submit" class="btn btn-update">
                                                <i class="fas fa-fire"></i> @lang('messages.prepare')
                                            </button>
                                        @elseif($order->status == 'preparing')
                                            <input type="hidden" name="status" value="ready">
                                            <button type="submit" class="btn btn-update">
                                                <i class="fas fa-check"></i> @lang('messages.ready')
                                            </button>
                                        @elseif($order->status == 'ready')
                                            <input type="hidden" name="status" value="completed">
                                            <button type="submit" class="btn btn-deliver">
                                                <i class="fas fa-truck"></i> @lang('messages.deliver')
                                            </button>
                                        @endif
                                    </form>
                                @endif

                                <button class="btn btn-delete" onclick="confirmDelete({{ $order->id }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <h3><i class="fas fa-exclamation-triangle" style="color: var(--danger);"></i> @lang('messages.confirm_delete_order')</h3>
            <p>@lang('messages.confirm_delete_order')</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-buttons">
                    <button type="button" class="btn" onclick="closeModal()" style="background: var(--bg-main); color: var(--text-main);">@lang('messages.cancel')</button>
                    <button type="submit" class="btn btn-delete">@lang('messages.delete')</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function confirmDelete(orderId) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = `/admin/commandes/${orderId}`;
            modal.classList.add('active');
        }

        function closeModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>

