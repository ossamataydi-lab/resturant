@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-bg: #0f172a;
            --main-bg: #f8fafc;
            --accent: #4f46e5;
            --accent-hover: #4338ca;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --border-color: #e2e8f0;
            --success: #10b981;
            --danger: #ef4444;
        }

        nav#navbar {
            display: none !important;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--main-bg) !important;
            font-family: 'Inter', sans-serif !important;
        }

        footer {
            display: none !important;
        }

        .settings-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .settings-wrapper.rtl {
            direction: rtl;
        }

        .settings-sidebar {
            width: 280px;
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            height: 100vh;
            z-index: 100;
            padding: 1.5rem 1rem;
        }

        .settings-wrapper.rtl .settings-sidebar {
            right: 0;
            left: auto;
        }

        .settings-sidebar-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 2rem;
            padding: 0 10px;
        }

        .settings-wrapper.rtl .settings-sidebar-header {
            flex-direction: row-reverse;
        }

        .settings-logo-box {
            background: var(--accent);
            width: 35px;
            height: 35px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            font-weight: 800;
        }

        .settings-logo-text {
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .settings-nav {
            list-style: none;
            padding: 0;
        }

        .settings-nav li {
            margin-bottom: 4px;
        }

        .settings-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 1rem;
            color: #94a3b8;
            text-decoration: none;
            border-radius: 10px;
            transition: 0.3s;
            font-weight: 500;
        }

        .settings-wrapper.rtl .settings-nav a {
            flex-direction: row-reverse;
        }

        .settings-nav li.active a,
        .settings-nav a:hover {
            background: #1e293b;
            color: white;
        }

        .settings-nav li.active a {
            background: var(--accent);
        }

        .settings-nav i {
            font-size: 1.1rem;
            width: 24px;
        }

        .settings-main {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 2rem;
            background: var(--main-bg);
            min-height: 100vh;
        }

        .settings-wrapper.rtl .settings-main {
            margin-left: 0;
            margin-right: 280px;
        }

        .settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .settings-wrapper.rtl .settings-header {
            flex-direction: row-reverse;
        }

        .settings-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .status-badge.open {
            background: #dcfce7;
            color: #15803d;
        }

        .status-badge.closed {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .settings-card {
            background: var(--white);
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .settings-section {
            padding: 2rem;
            border-bottom: 1px solid var(--border-color);
        }

        .settings-section:last-of-type {
            border-bottom: none;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-wrapper.rtl .section-title {
            flex-direction: row-reverse;
        }

        .section-title i {
            color: var(--accent);
        }

        .media-hub {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .settings-wrapper.rtl .media-hub {
            direction: rtl;
        }

        .logo-upload {
            text-align: center;
        }

        .logo-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #f1f5f9;
            border: 3px dashed var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            overflow: hidden;
            cursor: pointer;
            transition: 0.3s;
        }

        .logo-preview:hover {
            border-color: var(--accent);
            background: #eef2ff;
        }

        .logo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .logo-preview i {
            font-size: 3rem;
            color: var(--text-muted);
        }

        .logo-label {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            display: block;
        }

        .cover-upload {
            flex: 1;
        }


        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .settings-wrapper.rtl .form-grid {
            direction: rtl;
        }

        .form-group {
            margin-bottom: 0;
        }

        .form-group.full-width {
            grid-column: span 2;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            font-size: 0.95rem;
            transition: 0.3s;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .form-input:disabled {
            background: #f1f5f9;
            color: var(--text-muted);
            cursor: not-allowed;
        }

        textarea.form-input {
            resize: vertical;
            min-height: 100px;
        }

        .toggle-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .settings-wrapper.rtl .toggle-wrapper {
            flex-direction: row-reverse;
        }

        .toggle-label {
            font-weight: 500;
            color: var(--text-dark);
        }

        .toggle-switch {
            position: relative;
            width: 52px;
            height: 28px;
        }

        .toggle-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: #cbd5e1;
            border-radius: 28px;
            transition: 0.3s;
        }

        .toggle-slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background: white;
            border-radius: 50%;
            transition: 0.3s;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .toggle-switch input:checked+.toggle-slider {
            background: var(--accent);
        }

        .toggle-switch input:checked+.toggle-slider:before {
            transform: translateX(24px);
        }

        .hours-table {
            width: 100%;
            border-collapse: collapse;
        }

        .hours-table th {
            text-align: left;
            padding: 1rem;
            color: var(--text-muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            font-weight: 600;
            border-bottom: 2px solid var(--border-color);
        }

        .settings-wrapper.rtl .hours-table th {
            text-align: right;
        }

        .hours-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .hours-table tr:last-child td {
            border-bottom: none;
        }

        .day-label {
            font-weight: 600;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-wrapper.rtl .day-label {
            flex-direction: row-reverse;
        }

        .day-label i {
            color: var(--accent);
        }

        .time-inputs {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .settings-wrapper.rtl .time-inputs {
            flex-direction: row-reverse;
        }

        .time-input {
            width: 120px;
            padding: 10px 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .time-separator {
            color: var(--text-muted);
            font-weight: 500;
        }

        .closed-label {
            font-size: 0.85rem;
            color: var(--danger);
            font-weight: 600;
            background: #fee2e2;
            padding: 6px 12px;
            border-radius: 6px;
        }

        .map-container {
            height: 300px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            margin-top: 1rem;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .coords-inputs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1rem;
        }

        .action-bar {
            position: sticky;
            bottom: 0;
            background: var(--white);
            padding: 1.5rem 2rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            box-shadow: 0 -4px 6px -1px rgb(0 0 0 / 0.05);
        }

        .settings-wrapper.rtl .action-bar {
            flex-direction: row-reverse;
        }

        .btn {
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: 0.3s;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--accent);
            color: white;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-secondary {
            background: #f1f5f9;
            color: var(--text-dark);
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .toast {
            position: fixed;
            bottom: 30px;
            right: 30px;
            padding: 16px 24px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            transform: translateY(100px);
            opacity: 0;
            transition: 0.4s;
        }

        .settings-wrapper.rtl .toast {
            right: auto;
            left: 30px;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.success {
            background: linear-gradient(45deg, #10b981, #34ce57);
        }

        .toast.error {
            background: linear-gradient(45deg, #ef4444, #f87171);
        }

        input[type="file"] {
            display: none;
        }

        /* Language Selector */
        .language-selector {
            display: flex;
            gap: 5px;
            background: white;
            padding: 4px 8px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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

        @media (max-width: 1024px) {
            .settings-sidebar {
                width: 70px;
            }

            .settings-sidebar .settings-logo-text,
            .settings-sidebar .settings-nav span {
                display: none;
            }

            .settings-main {
                margin-left: 70px;
                width: calc(100% - 70px);
            }

            .settings-wrapper.rtl .settings-main {
                margin-left: 0;
                margin-right: 70px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full-width {
                grid-column: span 1;
            }

            .media-hub {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="settings-wrapper {{ $currentLocale == 'ar' ? 'rtl' : 'ltr' }}">
        <aside class="settings-sidebar">
            <div class="settings-sidebar-header">
                <div class="settings-logo-box">D</div>
                <span class="settings-logo-text">@lang('messages.restaurant_settings')</span>
            </div>

            <ul class="settings-nav">
                <li class="active">
                    <a href="#general" onclick="switchTab('general')">
                        <i class="bi bi-gear"></i>
                        <span>@lang('messages.general_info')</span>
                    </a>
                </li>
                <li>
                    <a href="#location" onclick="switchTab('location')">
                        <i class="bi bi-geo-alt"></i>
                        <span>@lang('messages.location')</span>
                    </a>
                </li>
                <li>
                    <a href="#hours" onclick="switchTab('hours')">
                        <i class="bi bi-clock"></i>
                        <span>@lang('messages.operating_hours')</span>
                    </a>
                </li>
                <li class="nav-separator" style="height: 1px; background: #334155; margin: 1.5rem 0;"></li>
                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-arrow-left"></i>
                        <span>@lang('messages.back_to_dashboard')</span>
                    </a>
                </li>
            </ul>
        </aside>

        <main class="settings-main">
            <div class="settings-header">
                <div style="display: flex; align-items: center; gap: 20px; flex: 1;">
                    <div>
                        <h1>@lang('messages.restaurant_settings')</h1>
                        <p style="color: var(--text-muted); margin-top: 4px;">@lang('messages.manage_restaurant_info')</p>
                    </div>

                </div>
                <div class="status-badge {{ $settings && $settings->is_active ? 'open' : 'closed' }}">
                    <span class="status-dot"></span>
                    {{ $settings && $settings->is_active ? __('messages.open') : __('messages.closed') }}
                </div>
            </div>

            <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data"
                class="settings-card">
                @csrf
                @method('PUT')

                <div id="general" class="settings-section">
                    <h3 class="section-title">
                        <i class="bi bi-shop"></i>
                        @lang('messages.general_info')
                    </h3>

                    <div class="media-hub">
                        <div class="logo-upload">
                            <label class="logo-label">@lang('messages.logo')</label>
                            <div class="logo-preview" onclick="document.getElementById('logo-input').click()">
                                @if ($settings && $settings->logo)
                                    <img src="{{ asset('storage/' . $settings->logo) }}" alt="Logo">
                                @else
                                    <i class="bi bi-image"></i>
                                @endif
                            </div>
                            <input type="file" id="logo-input" name="logo" accept="image/*"
                                onchange="previewImage(this, '.logo-preview')">
                            <small style="color: var(--text-muted);">@lang('messages.click_to_upload')</small>
                        </div>


                    </div>

                    <div class="toggle-wrapper">
                        <span class="toggle-label">@lang('messages.restaurant_active')</span>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1"
                                {{ $settings && $settings->is_active ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">@lang('messages.restaurant_name')</label>
                            <input type="text" name="name" class="form-input" value="{{ $settings->name ?? '' }}"
                                placeholder="Le Délice Gourmand" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.phone')</label>
                            <input type="tel" name="phone" class="form-input" value="{{ $settings->phone ?? '' }}"
                                placeholder="+33 1 23 45 67 89" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.email')</label>
                            <input type="email" name="email" class="form-input" value="{{ $settings->email ?? '' }}"
                                placeholder="admin@gmail.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.address')</label>
                            <input type="text" name="adresse" class="form-input"
                                value="{{ $settings->adresse ?? '' }}" placeholder="45 Rue du Bon Goût, 75000 Paris">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.whatsapp')</label>
                            <input type="text" name="whatsapp" class="form-input"
                                value="{{ $settings->whatsapp ?? '' }}" placeholder="Link WhatsApp">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.instagram')</label>
                            <input type="text" name="instagram" class="form-input"
                                value="{{ $settings->instagram ?? '' }}" placeholder="Link Instagram">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.prep_time')</label>
                            <input type="number" name="prep_time" class="form-input"
                                value="{{ $settings->prep_time ?? 30 }}" min="1">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.min_order')</label>
                            <input type="number" name="min_order" class="form-input"
                                value="{{ $settings->min_order ?? 0 }}" min="0" step="0.01">
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.currency')</label>
                            <select name="signe_price" class="form-input">
                                <option value="$" {{ ($settings->signe_price ?? '$') == '$' ? 'selected' : '' }}>$
                                    (@lang('messages.dollar'))</option>
                                <option value="€" {{ ($settings->signe_price ?? '$') == '€' ? 'selected' : '' }}>€
                                    (@lang('messages.euro'))</option>
                                <option value="MAD" {{ ($settings->signe_price ?? '$') == 'MAD' ? 'selected' : '' }}>
                                    MAD (@lang('messages.dirham'))</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">@lang('messages.delivery_radius')</label>
                            <input type="number" name="delivery_radius" class="form-input"
                                value="{{ $settings->delivery_radius ?? '' }}" min="0" step="0.1">
                        </div>

                        <div class="form-group full-width">
                            <label class="form-label">@lang('messages.description')</label>
                            <textarea name="description" class="form-input" placeholder="Décrivez votre restaurant...">{{ $settings->description ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div id="location" class="settings-section">
                    <h3 class="section-title">
                        <i class="bi bi-geo-alt"></i>
                        @lang('messages.location')
                    </h3>

                    <div class="form-group full-width">
                        <label class="form-label">@lang('messages.address')</label>
                        <input type="text" name="address" class="form-input" value="{{ $settings->address ?? '' }}"
                            placeholder="123 Rue de la Gastronomie, Paris, France">
                    </div>

                    <div class="map-container">
                        <iframe id="map-iframe"
                            src="https://maps.google.com/maps?q={{ $settings->lat ?? '48.858370' }},{{ $settings->lng ?? '2.292293' }}&z=15&output=embed&t={{ time() }}"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <div class="coords-inputs">
                        <div class="form-group">
                            <label class="form-label">@lang('messages.latitude')</label>
                            <input type="text" name="lat" id="lat" class="form-input"
                                value="{{ $settings->lat ?? '' }}" placeholder="48.858370" oninput="updateMap()">
                        </div>
                        <div class="form-group">
                            <label class="form-label">@lang('messages.longitude')</label>
                            <input type="text" name="lng" id="lng" class="form-input"
                                value="{{ $settings->lng ?? '' }}" placeholder="2.292293" oninput="updateMap()">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 1rem;">
                        <button type="button" class="btn btn-secondary" onclick="reverseGeocode()">
                            <i class="bi bi-geo-alt"></i>
                            @lang('messages.get_address_from_coords')
                        </button>
                    </div>
                </div>

                <div id="hours" class="settings-section">
                    <h3 class="section-title">
                        <i class="bi bi-clock"></i>
                        @lang('messages.operating_hours')
                    </h3>

                    <table class="hours-table">
                        <thead>
                            <tr>
                                <th style="width: 30%;">@lang('messages.day')</th>
                                <th style="width: 40%;">@lang('messages.opening_hours')</th>
                                <th style="width: 30%;">@lang('messages.status')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $daysAr = ['الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'];
                                $daysFr = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
                                $openingHours = $settings->opening_hours ?? [];
                            @endphp

                            @foreach ($days as $index => $day)
                                <tr>
                                    <td>
                                        <span class="day-label">
                                            <i class="bi bi-calendar-day"></i>
                                            {{ $currentLocale == 'ar' ? $daysAr[$index] : ($currentLocale == 'fr' ? $daysFr[$index] : $day) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="time-inputs">
                                            <input type="time" name="opening_hours[{{ $day }}][open]"
                                                class="time-input day-{{ $index }}-open"
                                                value="{{ isset($openingHours[$day]['open']) ? $openingHours[$day]['open'] : '09:00' }}">
                                            <span class="time-separator">@lang('messages.to')</span>
                                            <input type="time" name="opening_hours[{{ $day }}][close]"
                                                class="time-input day-{{ $index }}-close"
                                                value="{{ isset($openingHours[$day]['close']) ? $openingHours[$day]['close'] : '22:00' }}">
                                        </div>
                                    </td>
                                    <td>
                                        <label class="toggle-switch" style="display: inline-flex;">
                                            <input type="checkbox" name="opening_hours[{{ $day }}][closed]"
                                                value="1"
                                                {{ isset($openingHours[$day]['closed']) && $openingHours[$day]['closed'] ? 'checked' : '' }}
                                                onchange="toggleDayClosed({{ $index }}, this.checked)">
                                            <span class="toggle-slider"></span>
                                        </label>
                                        <span class="closed-label" id="closed-label-{{ $index }}"
                                            style="display: none;">@lang('messages.closed_day')</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="action-bar">
                    <button type="button" class="btn btn-secondary" onclick="location.reload()">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        @lang('messages.cancel')
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i>
                        @lang('messages.save_changes')
                    </button>
                </div>
            </form>
        </main>
    </div>

    @if (session('success'))
        <div class="toast success show" id="toast">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    <script>
        function switchTab(tabId) {
            document.querySelectorAll('.settings-nav li').forEach(li => li.classList.remove('active'));
            event.target.closest('li').classList.add('active');
            document.getElementById(tabId).scrollIntoView({
                behavior: 'smooth'
            });
        }

        function previewImage(input, previewClass) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.querySelector(previewClass);
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function toggleDayClosed(index, isClosed) {
            const openInput = document.querySelector(`.day-${index}-open`);
            const closeInput = document.querySelector(`.day-${index}-close`);
            const closedLabel = document.getElementById(`closed-label-${index}`);

            if (isClosed) {
                openInput.disabled = true;
                closeInput.disabled = true;
                openInput.style.opacity = '0.5';
                closeInput.style.opacity = '0.5';
                closedLabel.style.display = 'inline-block';
            } else {
                openInput.disabled = false;
                closeInput.disabled = false;
                openInput.style.opacity = '1';
                closeInput.style.opacity = '1';
                closedLabel.style.display = 'none';
            }
        }

        document.querySelectorAll('[name^="opening_hours"][name$="[closed]"]').forEach((checkbox, index) => {
            toggleDayClosed(index, checkbox.checked);
        });

        function updateMap() {
            const lat = document.getElementById('lat').value || '48.858370';
            const lng = document.getElementById('lng').value || '2.292293';
            const mapIframe = document.getElementById('map-iframe');
            const newSrc = `https://maps.google.com/maps?q=${lat},${lng}&z=15&output=embed`;
            mapIframe.src = newSrc;
        }

        function reverseGeocode() {
            const lat = document.getElementById('lat').value;
            const lng = document.getElementById('lng').value;
            const addressInput = document.querySelector('input[name="address"]');

            if (!lat || !lng) {
                alert('Veuillez d\'abord entrer les coordonnées de latitude et longitude.');
                return;
            }

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if (data.display_name) {
                        addressInput.value = data.display_name;
                    } else {
                        alert('Impossible de trouver une adresse pour ces coordonnées.');
                    }
                })
                .catch(err => {
                    alert('Erreur lors de la géolocalisation.');
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const lat = document.getElementById('lat').value;
            const lng = document.getElementById('lng').value;
            if (lat || lng) {
                updateMap();
            }
        });

        setTimeout(() => {
            const toast = document.getElementById('toast');
            if (toast) {
                toast.classList.remove('show');
            }
        }, 3000);
    </script>
@endsection
