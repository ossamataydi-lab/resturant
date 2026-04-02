@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Prevent horizontal scrolling */
        html, body {
            overflow-x: hidden;
        }

        body {
            background-color: #f8fafc !important;
            font-family: 'Outfit', sans-serif;
        }

        /* RTL Support */
        [dir="rtl"] .input-wrapper i {
            left: auto;
            right: 15px;
        }

        [dir="rtl"] .custom-input {
            padding: 15px 45px 15px 15px;
            text-align: right;
        }

        [dir="rtl"] .categories-table th,
        [dir="rtl"] .categories-table td {
            text-align: right;
        }

        [dir="rtl"] .actions {
            direction: rtl;
        }

        [dir="rtl"] .categories-header {
            flex-direction: row-reverse;
        }

        .wrapper {
            min-height: 80vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            padding: 20px;
            gap: 30px;
        }

        .form-card {
            background: #ffffff;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.02);
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .form-card.hidden {
            display: none;
        }

        .form-header {
            background: #fff;
            padding: 40px 40px 20px 40px;
            text-align: center;
        }

        .icon-box {
            width: 70px;
            height: 70px;
            background: #f1f5f9;
            color: #4f46e5;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 20px;
        }

        .form-header h4 {
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #64748b;
            font-size: 0.9rem;
        }

        .form-body {
            padding: 20px 40px 40px 40px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #334155;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
        }

        .custom-input {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
            color: #1e293b;
        }

        .custom-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-custom {
            padding: 15px;
            border-radius: 15px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #64748b;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        .btn-submit {
            background: #4f46e5;
            color: white;
        }

        .btn-submit:hover {
            background: #4338ca;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
        }

        /* Error Message */
        .error-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 0.85rem;
        }

        /* Success Message */
        .success-alert {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 15px 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            max-width: 500px;
        }

        .success-alert i {
            font-size: 1.2rem;
        }

        /* Categories Table */
        .categories-section {
            width: 100%;
            max-width: 900px;
        }

        .categories-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .categories-header h3 {
            color: #1e293b;
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }

        .toggle-form-btn {
            background: #4f46e5;
            color: white;
            padding: 12px 25px;
            border-radius: 15px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }

        .toggle-form-btn:hover {
            background: #4338ca;
            transform: translateY(-2px);
        }

        .categories-table {
            width: 100%;
            background: #ffffff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        .categories-table table {
            width: 100%;
            border-collapse: collapse;
        }

        .categories-table th {
            background: #f8fafc;
            padding: 18px 20px;
            text-align: left;
            font-weight: 600;
            color: #475569;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .categories-table td {
            padding: 18px 20px;
            border-top: 1px solid #f1f5f9;
            color: #334155;
        }

        .categories-table tr:hover {
            background: #f8fafc;
        }

        .category-name {
            font-weight: 600;
            color: #1e293b;
        }

        .category-slug {
            color: #64748b;
            font-size: 0.85rem;
            font-family: monospace;
            background: #f1f5f9;
            padding: 4px 10px;
            border-radius: 6px;
        }

        .category-count {
            background: #f0f9ff;
            color: #0369a1;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .action-btn {
            padding: 8px 15px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
            font-family: 'Outfit', sans-serif;
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 60px 40px;
            color: #64748b;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #cbd5e1;
        }

        .empty-state p {
            margin: 5px 0;
        }

        .empty-state p:first-of-type {
            font-size: 1.1rem;
            font-weight: 600;
            color: #475569;
        }
    </style>

    <div class="wrapper">
        <!-- Success Message -->
        @if (session('success'))
            <div class="success-alert">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session('error'))
            <div class="error-alert" style="width: 100%; max-width: 500px;">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <!-- Add Category Form -->
        <div class="form-card" id="categoryForm">
            <div class="form-header">
                <div class="icon-box">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h4>{{ __('messages.add_category') }}</h4>
                <p>{{ __('messages.create_category_desc') }}</p>
            </div>

            <div class="form-body">
                @if ($errors->any())
                    <div class="error-alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('messages.category_name') }}</label>
                        <div class="input-wrapper">
                            <i class="fas fa-edit"></i>
                            <input type="text" name="name" class="custom-input" placeholder="{{ __('messages.category_placeholder') }}"
                                value="{{ old('name') }}" required>
                        </div>
                    </div>

                    <div class="actions">
                        <a href="{{ route('admin.dashboard') }}" class="btn-custom btn-cancel">
                            {{ __('messages.back') }}
                        </a>
                        <button type="submit" class="btn-custom btn-submit">
                            <i class="fas fa-plus"></i> {{ __('messages.create') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Categories List Section -->
        <div class="categories-section">
            <div class="categories-header">
                <h3><i class="fas fa-list"></i> {{ __('messages.categories_list') }}</h3>
                <button type="button" onclick="toggleForm()" class="toggle-form-btn">
                    <i class="fas fa-plus"></i> {{ __('messages.add') }}
                </button>
            </div>

            @if ($categories->count() > 0)
                <div class="categories-table">
                    <table>
                        <thead>
                            <tr>
                                <th>{{ __('messages.category_name') }}</th>
                                <th>Slug</th>
                                <th>{{ __('messages.products') }}</th>
                                <th>{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="category-name">{{ $category->name }}</td>
                                    <td><span class="category-slug">{{ $category->slug }}</span></td>
                                    <td>
                                        <span class="category-count">
                                            {{ $category->products->count() }} {{ __('messages.products') }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn btn-delete"
                                                onclick="return confirm('{{ __('messages.confirm_delete') }}')">
                                                <i class="fas fa-trash"></i> {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p>{{ __('messages.no_categories') }}</p>
                    <p>{{ __('messages.click_to_add') }}</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Show form automatically if there are validation errors
        @if ($errors->any())
            document.getElementById('categoryForm').classList.remove('hidden');
        @endif

        // Show form automatically if there's a success message
        @if (session('success'))
            document.getElementById('categoryForm').classList.remove('hidden');
        @endif

        // Show form automatically if there's an error message
        @if (session('error'))
            document.getElementById('categoryForm').classList.remove('hidden');
        @endif

        // Show toast notifications for success/error messages
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('success') }}', true);
            });
        @endif

        @if (session('error'))
            document.addEventListener('DOMContentLoaded', function() {
                showToast('{{ session('error') }}', false);
            });
        @endif
    </script>
@endsection

