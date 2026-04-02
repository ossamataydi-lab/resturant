@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #1e1e1e;
            --accent-color: #7f56d9;
            --text-main: #101828;
            --border-color: #eaecf0;
            --bg-subtle: #f9fafb;
        }

        body {
            background-color: #f8f9fc !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-main);
        }

        /* RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        [dir="rtl"] .admin-container {
            direction: rtl;
        }

        [dir="rtl"] .form-box {
            text-align: right;
        }

        [dir="rtl"] .form-header {
            text-align: center;
        }

        [dir="rtl"] .me-1 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .ms-2 {
            margin-left: 0 !important;
            margin-right: 0.5rem !important;
        }

        [dir="rtl"] .d-flex.gap-3 {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .d-flex.align-items-center.justify-content-between {
            flex-direction: row-reverse;
        }

        [dir="rtl"] .row {
            direction: rtl;
        }

        [dir="rtl"] .col-md-6,
        [dir="rtl"] .col-12 {
            text-align: right;
        }

        [dir="rtl"] .label-custom {
            text-align: right;
            display: block;
        }

        [dir="rtl"] .input-custom,
        [dir="rtl"] .select-custom,
        [dir="rtl"] .textarea-custom {
            text-align: right;
            direction: rtl;
        }

        [dir="rtl"] .image-upload-wrapper {
            text-align: center;
        }

        [dir="rtl"] .current-image-section {
            text-align: right;
        }

        [dir="rtl"] .current-image-container {
            text-align: right;
        }

        [dir="rtl"] .badge-chef {
            text-align: center;
        }

        [dir="rtl"] .form-icon {
            direction: rtl;
        }

        [dir="rtl"] .btn-cancel,
        [dir="rtl"] .btn-submit,
        [dir="rtl"] .btn-delete {
            text-align: center;
        }

        [dir="rtl"] .pt-4 {
            padding-top: 1rem !important;
        }

        [dir="rtl"] .border-top {
            border-top: 1px solid #dee2e6 !important;
        }

        [dir="rtl"] .mt-3 {
            margin-top: 1rem !important;
        }

        [dir="rtl"] .mb-4 {
            margin-bottom: 1rem !important;
        }

        [dir="rtl"] .mb-5 {
            margin-bottom: 1.25rem !important;
        }

        .admin-container {
            padding: 60px 0;
            display: flex;
            justify-content: center;
        }

        .form-box {
            background: #ffffff;
            border-radius: 24px;
            padding: 48px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-color);
            width: 100%;
            max-width: 850px;
            margin: 0 auto;
        }

        .form-header {
            margin-bottom: 40px;
            text-align: center;
        }

        .label-custom {
            display: block;
            color: #344054;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .input-custom,
        .select-custom,
        .textarea-custom {
            width: 100%;
            height: 52px;
            padding: 12px 18px;
            border: 1px solid #d0d5dd;
            border-radius: 12px;
            font-size: 1rem;
            transition: 0.2s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .textarea-custom {
            height: auto;
            min-height: 120px;
            resize: vertical;
        }

        .input-custom:focus,
        .select-custom:focus,
        .textarea-custom:focus {
            border-color: var(--accent-color);
            box-shadow: 0px 0px 0px 4px rgba(158, 119, 237, 0.15);
            outline: none;
        }

        /* RTL input fixes */
        [dir="rtl"] .input-custom,
        [dir="rtl"] .select-custom,
        [dir="rtl"] .textarea-custom {
            text-align: right;
        }

        .image-upload-wrapper {
            border: 2px dashed #eaecf0;
            border-radius: 16px;
            padding: 35px;
            text-align: center;
            cursor: pointer;
            background: var(--bg-subtle);
            transition: 0.3s;
            position: relative;
        }

        .image-upload-wrapper:hover {
            border-color: var(--accent-color);
            background: #f9f5ff;
        }

        .image-upload-wrapper.has-image {
            padding: 20px;
        }

        .preview-image {
            max-width: 100%;
            max-height: 250px;
            border-radius: 12px;
            display: none;
        }

        .preview-image.visible {
            display: block;
        }

        .upload-placeholder {
            transition: 0.3s;
        }

        .upload-placeholder.hidden {
            display: none;
        }

        .btn-submit {
            background: var(--primary-color);
            color: white;
            padding: 16px 30px;
            border-radius: 12px;
            font-weight: 700;
            border: none;
            transition: 0.3s;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background: #000;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background: white;
            color: #344054;
            padding: 16px 30px;
            border-radius: 12px;
            font-weight: 600;
            border: 1px solid #d0d5dd;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-cancel:hover {
            background: #f9fafb;
            border-color: #7f56d9;
        }

        .current-image-section {
            margin-bottom: 20px;
        }

        .current-image-label {
            font-size: 0.875rem;
            color: #667386;
            margin-bottom: 8px;
        }

        .current-image-container {
            position: relative;
            display: inline-block;
        }

        .current-chef-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--accent-color);
        }

        .badge-chef {
            display: inline-block;
            background: linear-gradient(135deg, #7f56d9, #9f67e8);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #7f56d9, #9f67e8);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 1.75rem;
            color: white;
        }

        .btn-delete {
            background: white;
            color: #dc2626;
            padding: 16px 30px;
            border-radius: 12px;
            font-weight: 600;
            border: 1px solid #fecaca;
            text-decoration: none;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-delete:hover {
            background: #fef2f2;
            border-color: #dc2626;
        }

        .btn-delete-confirm {
            background: #dc2626;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
            cursor: pointer;
        }

        .btn-delete-confirm:hover {
            background: #b91c1c;
        }

        .current-image-preview {
            max-width: 100%;
            max-height: 250px;
            border-radius: 12px;
        }
    </style>

    <div class="admin-container" {{ $currentLocale == 'ar' ? 'dir=rtl' : '' }}>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="form-box">
                        <div class="form-header">
                            <div class="form-icon">
                                <i class="fas fa-hat-chef"></i>
                            </div>
                            <h2 style="font-size: 2.2rem; letter-spacing: -1px;">
                                {{ $chef ? __('messages.update_chef') : __('messages.add_chef') }}
                            </h2>
                            <p class="text-muted">@lang('messages.chef_info')</p>
                            @if ($chef)
                                <span class="badge-chef">
                                    <i class="fas fa-check-circle me-1"></i> @lang('messages.chef_configured')
                                </span>
                            @endif
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success mb-4 rounded-4"
                                style="background: #ecfdf3; border: 1px solid #6ee7b7; color: #065f46;">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger mb-4 rounded-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ $chef ? route('admin.chef.update', $chef) : route('admin.chef.store') }}"
                            method="POST" enctype="multipart/form-data" id="chefForm">
                            @csrf
                            @if ($chef)
                                @method('PUT')
                            @endif

                            <!-- Current Image Display -->
                            @if ($chef && $chef->image_path)
                                <div class="current-image-section">
                                    <p class="current-image-label">
                                        <i class="fas fa-image me-1"></i> @lang('messages.current_chef_image')
                                    </p>
                                    <div class="current-image-container">
                                        <img src="{{ asset('storage/' . $chef->image_path) }}" alt="{{ $chef->name }}"
                                            class="current-chef-image">
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="label-custom">
                                        <i class="fas fa-user me-2" style="color: #7f56d9;"></i>@lang('messages.chef_name')
                                    </label>
                                    <input type="text" name="name" class="input-custom"
                                        placeholder="@lang('messages.chef_name')" value="{{ $chef ? $chef->name : '' }}" required>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="label-custom">
                                        <i class="fas fa-star me-2" style="color: #7f56d9;"></i>@lang('messages.chef_philosophy')
                                    </label>
                                    <input type="text" name="philosophy" class="input-custom"
                                        placeholder="@lang('messages.chef_philosophy')"
                                        value="{{ $chef ? $chef->philosophy : '' }}">
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="label-custom">
                                        <i class="fas fa-align-left me-2" style="color: #7f56d9;"></i>@lang('messages.chef_description')
                                    </label>
                                    <textarea name="description" class="textarea-custom" rows="4"
                                        placeholder="@lang('messages.chef_description')" required>{{ $chef ? $chef->description : '' }}</textarea>
                                </div>

                                <div class="col-12 mb-5">
                                    <label class="label-custom">
                                        <i class="fas fa-camera me-2" style="color: #7f56d9;"></i>@lang('messages.chef_photo')
                                    </label>
                                    <div class="image-upload-wrapper {{ $chef && $chef->image_path ? 'has-image' : '' }}"
                                        id="drop-zone" onclick="document.getElementById('imageInput').click()">

                                        <div class="upload-placeholder" id="upload-placeholder">
                                            <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-muted"></i>
                                            <p class="mb-0 text-muted" id="file-name">
                                                @lang('messages.click_to_add_photo')
                                            </p>
                                            <p class="mb-0 text-muted" style="font-size: 0.8rem; margin-top: 8px;">
                                                @lang('messages.image_formats')
                                            </p>
                                        </div>

                                        <img src="" alt="Preview" class="preview-image" id="imagePreview">

                                        <input type="file" name="image" id="imageInput" hidden accept="image/*"
                                            {{ $chef ? '' : 'required' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                <div class="d-flex gap-3">
                                    <a href="{{ route('admin.dashboard') }}" class="btn-cancel">
                                        <i class="fas fa-arrow-left me-2"></i> @lang('messages.back')
                                    </a>
                                </div>
                                <div class="d-flex gap-3">
                                    <button type="submit" class="btn-submit" form="chefForm">
                                        <i class="fas fa-{{ $chef ? 'save' : 'plus' }} me-2"></i>
                                        {{ $chef ? __('messages.update_chef_btn') : __('messages.save_chef') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        @if ($chef)
                            <form action="{{ route('admin.chef.destroy', $chef) }}" method="POST" class="mt-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete w-100"
                                    onclick="return confirm('@lang('messages.confirm_delete_chef')')">
                                    <i class="fas fa-trash me-2"></i> @lang('messages.delete_chef')
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show current image on page load if editing a chef
        document.addEventListener('DOMContentLoaded', function() {
            @if ($chef && $chef->image_path)
                const currentImageSrc = "{{ asset('storage/' . $chef->image_path) }}";
                const preview = document.getElementById('imagePreview');
                const dropZone = document.getElementById('drop-zone');
                const uploadPlaceholder = document.getElementById('upload-placeholder');
                const fileName = document.getElementById('file-name');

                preview.src = currentImageSrc;
                preview.classList.add('visible');
                uploadPlaceholder.classList.add('hidden');
                dropZone.classList.add('has-image');
                fileName.innerHTML = '🟢 @lang('messages.current_image')';
                dropZone.style.borderColor = "#7f56d9";
                dropZone.style.background = "#f9f5ff";
            @endif
        });

        document.getElementById('imageInput').onchange = function(event) {
            const file = event.target.files[0];
            if (file) {
                const fileName = file.name;
                document.getElementById('file-name').innerHTML = "🟢 @lang('messages.file_selected') " + fileName;
                document.getElementById('drop-zone').style.borderColor = "#7f56d9";
                document.getElementById('drop-zone').style.background = "#f9f5ff";

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('imagePreview');
                    preview.src = e.target.result;
                    preview.classList.add('visible');
                    document.getElementById('upload-placeholder').classList.add('hidden');
                    document.getElementById('drop-zone').classList.add('has-image');
                }
                reader.readAsDataURL(file);
            }
        };
    </script>
@endsection

