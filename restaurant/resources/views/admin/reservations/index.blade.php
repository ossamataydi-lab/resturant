@extends('layouts.app')

@section('content')
    <div class="admin-layout {{ $currentLocale == 'ar' ? 'rtl' : 'ltr' }}">

        <!-- MAIN CONTENT -->
        <main class="main-content">

            <!-- TOPBAR -->
            <div class="topbar">
                <div style="display: flex; align-items: center; gap: 20px;">
                    <h4>@lang('messages.reservations')</h4>
                </div>
                <div style="display: flex; align-items: center; gap: 20px;">

                    {{-- <div class="notification-wrapper">
                        <div class="bell-icon" id="bellBtn">
                            🔔
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <span class="count">{{ auth()->user()->unreadNotifications->count() }}</span>
                            @endif
                        </div>

                        <div class="notification-dropdown" id="notificationMenu">
                            <h6>@lang('messages.new_notifications')</h6>
                            <div class="notification-list">
                                @forelse(auth()->user()->unreadNotifications as $notification)
                                    <div class="notification-item">
                                        <p>{{ $notification->data['message'] }}
                                            <strong>{{ $notification->data['customer_name'] }}</strong>
                                        </p>
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                @empty
                                    <div class="notification-item py-3 text-center">@lang('messages.no_notifications')</div>
                                @endforelse
                            </div>
                        </div>

                    </div> --}}


                </div>
            </div>

            <!-- STATS -->
            <div class="stats-grid">
                <div class="stat-card">
                    <h3>{{ $reservations->count() }}</h3>
                    <p>@lang('messages.total_reservations')</p>
                </div>

                <div class="stat-card warning">
                    <h3>{{ $reservations->where('status', 'pending')->count() }}</h3>
                    <p>@lang('messages.pending')</p>
                </div>

                <div class="stat-card success">
                    <h3>{{ $reservations->where('status', 'confirmed')->count() }}</h3>
                    <p>@lang('messages.confirmed')</p>
                </div>
            </div>

            <!-- TABLE -->
            <div class="table-card">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('messages.client')</th>
                            <th>@lang('messages.date')</th>
                            <th>@lang('messages.guests')</th>
                            <th>@lang('messages.phone')</th>
                            <th>@lang('messages.status')</th>
                            <th>@lang('messages.action')</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($reservations as $index => $res)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                <td class="client-cell">
                                    <div class="avatar">
                                        {{ strtoupper(substr($res->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <strong>{{ $res->name }}</strong>
                                        <small>#{{ $res->id }}</small>
                                    </div>
                                </td>

                                <td>
                                    {{ $res->reservation_date }}
                                    <small>{{ $res->reservation_time }}</small>
                                </td>

                                <td>{{ $res->guest_count }}</td>
                                <td>{{$res->phone}} </td>

                                <td>
                                    <span class="status {{ $res->status }}">
                                        @lang('messages.' . $res->status)
                                    </span>
                                </td>

                                <td class="actions">
                                    @if ($res->status == 'pending')
                                        <form method="POST" action="{{ route('admin.reservations.update', $res->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button name="status" value="confirmed" class="btn-success">✔</button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.reservations.update', $res->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <button name="status" value="cancelled" class="btn-danger">✖</button>
                                    </form>

                                    <form method="POST" action="{{ route('admin.reservations.destroy', $res->id) }}" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">🗑</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="empty">
                                    @lang('messages.no_reservations')
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </main>
    </div>


    <style>
        /* LAYOUT */
        .admin-layout {
            display: flex;
            min-height: 100vh;
            background: #f5f7fb;
            font-family: 'Inter', sans-serif;
        }

        /* RTL Support */
        .admin-layout.rtl {
            direction: rtl;
        }

        .admin-layout.rtl .topbar > div:first-child {
            flex-direction: row-reverse;
        }

        .admin-layout.rtl .topbar > div:last-child {
            flex-direction: row-reverse;
        }

        .admin-layout.rtl .notification-wrapper {
            position: relative;
        }

        .admin-layout.rtl .notification-dropdown {
            right: auto !important;
            left: 0 !important;
        }

        .admin-layout.rtl .bell-icon .count {
            right: auto;
            left: -5px;
        }

        .admin-layout.rtl .client-cell {
            flex-direction: row-reverse;
        }

        .admin-layout.rtl .avatar {
            margin-left: 15px;
            margin-right: 0;
        }

        .admin-layout.rtl .topbar {
            flex-direction: row-reverse;
        }

        .admin-layout.rtl .language-selector {
            flex-direction: row-reverse;
        }

        .admin-layout.rtl .stats-grid {
            direction: rtl;
        }

        .admin-layout.rtl .stat-card {
            text-align: right;
        }

        .admin-layout.rtl .table-card {
            direction: rtl;
        }

        .admin-layout.rtl table {
            direction: rtl;
        }

        .admin-layout.rtl th,
        .admin-layout.rtl td {
            text-align: right;
        }

        .admin-layout.rtl .actions {
            flex-direction: row-reverse;
        }

        .admin-layout.rtl .notification-dropdown {
            right: auto;
            left: 0;
        }

        .admin-layout.rtl .notification-wrapper {
            position: relative;
        }

        .admin-layout.rtl .bell-icon .count {
            right: auto;
            left: -5px;
        }

        .admin-layout.rtl .notification-item {
            text-align: right;
        }

        .admin-layout.rtl .empty {
            text-align: center;
        }

        /* MAIN */
        .main-content {
            flex: 1;
            padding: 30px;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top:100px;
            margin-bottom: 30px;
        }

        /* Language Selector */
        .language-selector {
            display: flex;
            gap: 5px;
            background: white;
            padding: 4px 8px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .lang-link {
            padding: 6px 12px;
            border-radius: 6px;
            text-decoration: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
        }

        .lang-link:hover {
            background: #f0f0f0;
            color: #1e1e1e;
        }

        .lang-link.active {
            background: #667eea;
            color: white;
        }

        /* NOTIFICATIONS */
        .notification-wrapper {

            position: relative;
            cursor: pointer;
        }

        .bell-icon {
            font-size: 22px;
            position: relative;
        }

        .bell-icon .count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 50%;
            border: 2px solid #fff;
        }

        .notification-dropdown {
            position: absolute;
            right: 0;
            top: 45px;
            width: 300px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
            display: none;
            z-index: 1000;
            overflow: hidden;
        }

        .notification-dropdown h6 {
            padding: 15px;
            margin: 0;
            background: #f8f9fa;
            border-bottom: 1px solid #eee;
        }

        .notification-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f1f1;
            transition: background 0.3s;
        }

        .notification-item:hover {
            background: #f9f9f9;
        }

        .notification-item p {
            margin: 0;
            font-size: 13px;
            color: #333;
        }

        .notification-item small {
            color: #888;
            font-size: 11px;
        }

        .notification-dropdown.show {
            display: block;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* STATS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-left: 4px solid #db0e0e;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .admin-layout.rtl .stat-card {
            border-left: none;
            border-right: 4px solid #db0e0e;
        }

        .stat-card.warning {
            border-left: 4px solid #ffc107;
        }

        .admin-layout.rtl .stat-card.warning {
            border-left: none;
            border-right: 4px solid #ffc107;
        }

        .stat-card.success {
            border-left: 4px solid #28a745;
        }

        .admin-layout.rtl .stat-card.success {
            border-left: none;
            border-right: 4px solid #28a745;
        }

        /* TABLE */
        .table-card {
            background: white;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th, td {
            padding: 15px;
            text-align: left;
        }

        .admin-layout.rtl th,
        .admin-layout.rtl td {
            text-align: right;
        }

        tbody tr {
            border-bottom: 1px solid #eee;
        }

        tbody tr:hover {
            background: #f9fafc;
        }

        /* CLIENT CELL */
        .client-cell {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #667eea;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* STATUS */
        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
        }

        .status.pending {
            background: #fff3cd;
            color: #856404;
        }

        .status.confirmed {
            background: #d4edda;
            color: #155724;
        }

        .status.cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        /* ACTIONS */
        .actions {
            display: flex;
            gap: 8px;
        }

        .btn-success, .btn-danger {
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-delete {
            border: none;
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            background: #6c757d;
            color: white;
        }

        .btn-delete:hover {
            background: #5a6268;
        }

        /* EMPTY */
        .empty {
            text-align: center;
            padding: 40px;
            color: #888;
        }

        /* RESPONSIVE */
        @media(max-width: 992px) {
            .sidebar {
                display: none;
            }

            .admin-layout {
                flex-direction: column;
            }

            .admin-layout.rtl {
                flex-direction: column;
            }
        }
    </style>

    <script>
        document.getElementById('bellBtn').addEventListener('click', function() {
            document.getElementById('notificationMenu').classList.toggle('show');
        });
        window.onclick = function(event) {
            if (!event.target.matches('.bell-icon')) {
                var dropdowns = document.getElementsByClassName("notification-dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
@endsection
