<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Délice KDS | Professional Kitchen System</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-main: #060709;
            --bg-card: #111418;
            --bg-header: #111418;
            --text-main: #f0f6fc;
            --text-muted: #8b949e;
            --accent-danger: #ff4757;
            --accent-info: #00a8ff;
            --accent-success: #2ed573;
            --accent-warning: #ffa502;
            --glass-border: rgba(255, 255, 255, 0.05);
            --card-shadow: 0 15px 50px rgba(0, 0, 0, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Plus Jakarta Sans', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        /* HEADER */
        .kds-header {
            height: 85px;
            background: var(--bg-header);
            padding: 0 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
        }

        .brand-box {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-logo {
            background: linear-gradient(135deg, var(--accent-danger), #ff6b81);
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.4rem;
            box-shadow: 0 0 25px rgba(255, 71, 87, 0.3);
        }

        .brand-text h1 {
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .live-indicator {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 10px;
            color: var(--accent-success);
            font-weight: bold;
        }

        .pulse-dot {
            width: 6px;
            height: 6px;
            background: var(--accent-success);
            border-radius: 50%;
            animation: pulse 1.5s infinite;
        }

        .stats-container {
            display: flex;
            background: #000;
            padding: 8px 25px;
            border-radius: 100px;
            border: 1px solid var(--glass-border);
            gap: 30px;
        }

        .stat-box {
            text-align: center;
        }

        .stat-label {
            font-size: 9px;
            color: var(--text-muted);
            text-transform: uppercase;
            font-weight: 800;
        }

        .stat-value {
            font-size: 1.1rem;
            font-weight: 800;
            display: block;
        }

        /* CONTROLS (CLOCK, FULLSCREEN, LOGOUT) */
        .header-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        #liveClock {
            font-family: 'Courier New', monospace;
            font-size: 1.4rem;
            font-weight: 800;
            color: var(--accent-danger);
            background: #000;
            padding: 5px 15px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
        }

        .control-btn {
            background: rgba(255, 255, 255, 0.03);
            color: var(--text-main);
            border: 1px solid var(--glass-border);
            width: 42px;
            height: 42px;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        .btn-logout:hover {
            background: var(--accent-danger);
            color: white;
            border-color: var(--accent-danger);
        }

        /* GRID & COLUMNS */
        .kds-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 0.8fr;
            gap: 25px;
            padding: 25px;
            height: calc(100vh - 85px);
        }

        .column-wrapper {
            background: rgba(17, 20, 24, 0.4);
            border-radius: 28px;
            display: flex;
            flex-direction: column;
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
        }

        .column-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--glass-border);
        }

        .column-header h2 {
            font-size: 1rem;
            font-weight: 800;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .badge-count {
            background: #1e2227;
            padding: 4px 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 800;
        }

        .scroll-area {
            padding: 20px;
            overflow-y: auto;
            flex-grow: 1;
        }

        /* CARDS */
        .order-card {
            background: var(--bg-card);
            border-radius: 22px;
            margin-bottom: 20px;
            border: 1px solid var(--glass-border);
            animation: slideUp 0.5s ease-out;
        }

        .card-top {
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 22px 22px 0 0;
        }

        .order-num {
            font-weight: 800;
            font-size: 1.3rem;
        }

        .order-timer {
            font-size: 0.9rem;
            color: var(--accent-warning);
            font-weight: 700;
        }

        .order-meta {
            padding: 6px 20px;
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            background: var(--accent-info);
            color: #fff;
        }

        .items-list {
            padding: 15px 20px;
            list-style: none;
        }

        .item-row {
            display: flex;
            gap: 15px;
            margin-bottom: 12px;
            align-items: center;
        }

        .item-image {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .item-qty {
            background: #1e2227;
            color: var(--accent-warning);
            min-width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: 800;
        }

        .item-name {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .card-actions {
            padding: 0 20px 20px 20px;
        }

        .btn-main {
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 15px;
            font-weight: 800;
            font-size: 11px;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-start {
            background: linear-gradient(45deg, var(--accent-danger), #ff6b81);
            color: white;
        }

        .btn-ready {
            background: linear-gradient(45deg, var(--accent-info), #00d2ff);
            color: white;
        }

        .btn-done {
            background: var(--accent-success);
            color: white;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes pulse {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>

    <audio id="notificationSound" preload="auto">
        <source src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" type="audio/mpeg">
    </audio>

    <header class="kds-header">
        <div class="brand-box">
            <div class="brand-logo"><i class="fas fa-utensils"></i></div>
            <div class="brand-text">
                <h1>DÉLICE <span style="color:var(--accent-danger)">KDS</span></h1>
                <div class="live-indicator"><span class="pulse-dot"></span> LIVE SYSTEM</div>
            </div>
        </div>

        <div class="stats-container">
            <div class="stat-box">
                <span class="stat-label">Attente</span>
                <span id="newCount" class="stat-value" style="color:var(--accent-danger)">{{ $orders->count() }}</span>
            </div>
            <div class="stat-box">
                <span class="stat-label">En Cours</span>
                <span class="stat-value" style="color:var(--accent-info)">{{ $preparingOrders->count() }}</span>
            </div>
            <div class="stat-box">
                <span class="stat-label">Prêts</span>
                <span class="stat-value" style="color:var(--accent-success)">{{ $readyOrders->count() }}</span>
            </div>
        </div>

        <div class="header-controls">
            <div id="liveClock">00:00:00</div>

            <button class="control-btn" onclick="toggleFullScreen()" title="Plein écran">
                <i class="fas fa-expand"></i>
            </button>

            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="control-btn btn-logout" title="Déconnexion">
                    <i class="fas fa-power-off"></i>
                </button>
            </form>
        </div>
    </header>

    <main class="kds-grid">

        <section class="column-wrapper" style="border-top: 6px solid var(--accent-danger);">
            <div class="column-header">
                <h2><i class="fas fa-bell" style="color:var(--accent-danger)"></i> À PRÉPARER</h2>
                <span class="badge-count">{{ $orders->count() }}</span>
            </div>
            <div class="scroll-area">
                @foreach ($orders as $order)
                    <article class="order-card">
                        <div class="card-top">
                            <span class="order-num">#{{ $order->id }}</span>
                            <span class="order-timer"><i class="far fa-clock"></i>
                                {{ $order->created_at->format('H:i') }}</span>
                        </div>
                        <div class="order-meta"
                            style="background: {{ $order->type == 'Takeaway' ? '#6c5ce7' : 'var(--accent-info)' }}">
                            {{ $order->type }} {{ $order->table_number ? ' — Table ' . $order->table_number : '' }}
                        </div>
                        <ul class="items-list">
                            @foreach ($order->orderItems as $item)
                                <li class="item-row">
                                    <img src="{{ $item->Product && $item->Product->image ? asset($item->Product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=100&q=80' }}"
                                         alt="{{ $item->Product->name ?? 'Dish' }}"
                                         class="item-image">
                                    <span class="item-qty">{{ $item->quantity }}</span>
                                    <span class="item-name">{{ $item->Product->name ?? 'Unknown Dish' }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-actions">
                            <form action="{{ route('admin.kitchen.update', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="status" value="preparing">
                                <button type="submit" class="btn-main btn-start">Commencer</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="column-wrapper" style="border-top: 6px solid var(--accent-info);">
            <div class="column-header">
                <h2><i class="fas fa-spinner fa-spin" style="color:var(--accent-info)"></i> CUISSON</h2>
                <span class="badge-count">{{ $preparingOrders->count() }}</span>
            </div>
            <div class="scroll-area">
                @foreach ($preparingOrders as $order)
                    <article class="order-card" style="border-left: 5px solid var(--accent-info);">
                        <div class="card-top">
                            <span class="order-num">#{{ $order->id }}</span>
                            <span class="order-timer" style="color: var(--accent-info)">
                                <i class="fas fa-stopwatch"></i> {{ $order->updated_at->diffInMinutes() }} MIN
                            </span>
                        </div>
                        <ul class="items-list">
                            @foreach ($order->orderItems as $item)
                                <li class="item-row">
                                    <img src="{{ $item->Product && $item->Product->image ? asset($item->Product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=100&q=80' }}"
                                         alt="{{ $item->Product->name ?? 'Dish' }}"
                                         class="item-image">
                                    <span class="item-qty" style="color:var(--accent-info)">{{ $item->quantity }}</span>
                                    <span class="item-name">{{ $item->Product->name ?? 'Unknown Dish' }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-actions">
                            <form action="{{ route('admin.kitchen.update', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="status" value="ready">
                                <button type="submit" class="btn-main btn-ready">Prêt</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="column-wrapper" style="border-top: 6px solid var(--accent-success);">
            <div class="column-header">
                <h2><i class="fas fa-check-circle" style="color:var(--accent-success)"></i> PRÊT</h2>
                <span class="badge-count">{{ $readyOrders->count() }}</span>
            </div>
            <div class="scroll-area">
                @foreach ($readyOrders as $order)
                    <article class="order-card">
                        <div class="card-top">
                            <span class="order-num">#{{ $order->id }}</span>
                            <span class="order-timer" style="color: var(--accent-success);">
                                <i class="fas fa-check"></i> PRÊT
                            </span>
                        </div>
                        <div class="order-meta" style="background: var(--accent-success);">
                            {{ $order->type }} {{ $order->table_number ? ' — Table ' . $order->table_number : '' }}
                        </div>
                        <ul class="items-list">
                            @foreach ($order->orderItems as $item)
                                <li class="item-row">
                                    <img src="{{ $item->Product && $item->Product->image ? asset($item->Product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=100&q=80' }}"
                                         alt="{{ $item->Product->name ?? 'Dish' }}"
                                         class="item-image">
                                    <span class="item-qty" style="color:var(--accent-success)">{{ $item->quantity }}</span>
                                    <span class="item-name">{{ $item->Product->name ?? 'Unknown Dish' }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="card-actions">
                            <form action="{{ route('admin.kitchen.update', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="status" value="completed">
                                <button type="submit" class="btn-main" style="background: var(--accent-success);">Terminé</button>
                            </form>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

    </main>

    <script>

        function updateClock() {
            const now = new Date();
            document.getElementById('liveClock').innerText = now.toLocaleTimeString('fr-FR');
        }
        setInterval(updateClock, 1000);
        updateClock();


        function toggleFullScreen() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen();
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        window.onload = function() {
            const newOrdersCount = parseInt(document.getElementById('newCount').innerText);
            if (newOrdersCount > 0) {
                const audio = document.getElementById('notificationSound');
                audio.play().catch(e => console.log("Audio play deferred"));
            }
        };

        setTimeout(() => {
            window.location.reload();
        }, 35000);
    </script>
</body>

</html>
