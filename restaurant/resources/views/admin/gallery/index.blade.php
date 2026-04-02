@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
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

    [dir="rtl"] .page-header {
        flex-direction: column;
    }

    [dir="rtl"] .page-header-left {
        text-align: center;
    }

    [dir="rtl"] .page-title,
    [dir="rtl"] .page-subtitle {
        text-align: center;
    }

    [dir="rtl"] .language-selector {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .upload-header {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .upload-icon {
        margin-right: 0;
        margin-left: 16px;
    }

    [dir="rtl"] .upload-title,
    [dir="rtl"] .upload-subtitle {
        text-align: right;
    }

    [dir="rtl"] .row {
        direction: rtl;
    }

    [dir="rtl"] .col-md-6 {
        text-align: right;
    }

    [dir="rtl"] .label-custom {
        text-align: right;
    }

    [dir="rtl"] .input-custom {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .image-upload-wrapper {
        text-align: center;
    }

    [dir="rtl"] .d-flex {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .justify-content-end {
        justify-content: flex-start !important;
    }

    [dir="rtl"] .section-header {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .section-title {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .gallery-title {
        text-align: right;
    }

    [dir="rtl"] .gallery-description {
        text-align: right;
    }

    [dir="rtl"] .gallery-content {
        text-align: right;
    }

    [dir="rtl"] .empty-state {
        text-align: center;
    }

    [dir="rtl"] .alert {
        text-align: right;
        flex-direction: row-reverse;
    }

    [dir="rtl"] .alert ul {
        text-align: right;
        padding-right: 0;
    }

    [dir="rtl"] .me-2 {
        margin-left: 0.5rem !important;
        margin-right: 0 !important;
    }

    [dir="rtl"] .me-1 {
        margin-left: 0.25rem !important;
        margin-right: 0 !important;
    }

    [dir="rtl"] .mt-2 {
        margin-top: 0.5rem !important;
    }

    .admin-container {
        padding: 40px 0;
    }

    .page-header {
        margin-top: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }

    .page-header-left {
        text-align: center;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        letter-spacing: -0.5px;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #667085;
        font-size: 1rem;
    }

    /* Language Selector */
    .language-selector {
        display: flex;
        gap: 8px;
        background: white;
        padding: 5px 10px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .lang-link {
        padding: 8px 14px;
        border-radius: 8px;
        text-decoration: none;
        color: #667085;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .lang-link:hover {
        background: #f0f0f0;
        color: #1e1e1e;
    }

    .lang-link.active {
        background: var(--accent-color);
        color: white;
    }

    .upload-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        margin-bottom: 40px;
        margin-left: auto;
        margin-right: auto;
        max-width: 700px;
    }

    .upload-header {
        display: flex;
        align-items: center;
        margin-bottom: 24px;
    }

    .upload-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #7f56d9 0%, #9e77ed 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        margin-right: 16px;
    }

    .upload-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .upload-subtitle {
        color: #667085;
        font-size: 0.875rem;
        margin: 4px 0 0 0;
    }

    .label-custom {
        display: block;
        color: #344054;
        font-weight: 600;
        margin-bottom: 8px;
        font-size: 0.875rem;
    }

    .input-custom, .textarea-custom {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #d0d5dd;
        border-radius: 12px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        background: #ffffff;
    }

    .input-custom:focus, .textarea-custom:focus {
        border-color: var(--accent-color);
        box-shadow: 0px 0px 0px 4px rgba(158, 119, 237, 0.15);
        outline: none;
    }

    [dir="rtl"] .input-custom {
        text-align: right;
        direction: rtl;
    }

    [dir="rtl"] .upload-card {
        margin-left: auto;
        margin-right: auto;
    }

    [dir="rtl"] .d-flex.justify-content-end {
        justify-content: flex-start !important;
    }

    [dir="rtl"] .row {
        direction: rtl;
    }

    [dir="rtl"] .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    [dir="rtl"] .image-upload-wrapper {
        text-align: center;
    }

    [dir="rtl"] .btn-submit {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .gallery-section {
        text-align: right;
    }

    [dir="rtl"] .gallery-grid {
        direction: rtl;
    }

    [dir="rtl"] .section-header {
        flex-direction: row-reverse;
    }

    [dir="rtl"] .gallery-item {
        text-align: right;
    }

    [dir="rtl"] .gallery-content {
        text-align: right;
    }

    [dir="rtl"] .gallery-title,
    [dir="rtl"] .gallery-description {
        text-align: right;
    }

    [dir="rtl"] .empty-state {
        text-align: center;
    }

    .textarea-custom {
        resize: vertical;
        min-height: 100px;
    }

    .image-upload-wrapper {
        border: 2px dashed #d0d5dd;
        border-radius: 16px;
        padding: 40px;
        text-align: center;
        cursor: pointer;
        background: var(--bg-subtle);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .image-upload-wrapper:hover {
        border-color: var(--accent-color);
        background: #f9f5ff;
    }

    .image-upload-wrapper.has-image {
        border-color: #12b76a;
        background: #f6fef9;
    }

    .upload-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 12px;
        margin-bottom: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-submit:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    .gallery-section {
        margin-top: 40px;
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .gallery-count {
        background: var(--accent-color);
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .gallery-item {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
    }

    .gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .gallery-image-wrapper {
        position: relative;
        padding-top: 75%;
        overflow: hidden;
        background: var(--bg-subtle);
    }

    .gallery-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .gallery-item:hover .gallery-image {
        transform: scale(1.05);
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .btn-delete {
        background: #dc2626;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-delete:hover {
        background: #b91c1c;
        transform: scale(1.05);
    }

    .gallery-content {
        padding: 20px;
    }

    .gallery-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
    }

    .gallery-description {
        color: #667085;
        font-size: 0.875rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #ffffff;
        border-radius: 20px;
        border: 2px dashed #d0d5dd;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--bg-subtle);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        color: #667085;
        font-size: 2rem;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-main);
    }

    .empty-text {
        color: #667085;
        font-size: 0.95rem;
    }

    .alert {
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
    }

    .alert-success {
        background: #f6fef9;
        border: 1px solid #b2f0d3;
        color: #027a48;
    }

    .alert-danger {
        background: #fef3f2;
        border: 1px solid #fecdca;
        color: #b42318;
    }

    @media (max-width: 768px) {
        .gallery-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 16px;
        }

        .upload-card {
            padding: 24px;
        }

        .page-header {
            flex-direction: column;
        }

        .language-selector {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="admin-container" {{ $currentLocale == 'ar' ? 'dir=rtl' : '' }}>
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header">
            <div class="page-header-left">
                <h1 class="page-title">📸 @lang('messages.gallery_management')</h1>
                <p class="page-subtitle">@lang('messages.gallery_subtitle')</p>
            </div>
        </div>

        {{-- Success/Error Messages --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Upload Form --}}
        <div class="upload-card">
            <div class="upload-header">
                <div class="upload-icon">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
                <div>
                    <h3 class="upload-title">@lang('messages.add_photo')</h3>
                    <p class="upload-subtitle">@lang('messages.accepted_formats')</p>
                </div>
            </div>

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="label-custom">@lang('messages.title_optional')</label>
                        <input type="text" name="title" class="input-custom" placeholder="@lang('messages.title_placeholder')">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="label-custom">@lang('messages.description_optional')</label>
                        <input type="text" name="description" class="input-custom" placeholder="@lang('messages.description_placeholder')">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="label-custom">@lang('messages.image_required')</label>
                    <div class="image-upload-wrapper" id="drop-zone" onclick="document.getElementById('imageInput').click()">
                        <div id="upload-placeholder">
                            <i class="fas fa-cloud-upload-alt fa-3x mb-3 text-muted"></i>
                            <p class="mb-1 text-muted" style="font-size: 1.1rem; font-weight: 500;">@lang('messages.click_or_drag')</p>
                            <p class="text-muted" style="font-size: 0.875rem;">@lang('messages.file_formats')</p>
                        </div>
                        <div id="upload-preview" style="display: none;">
                            <img id="preview-image" class="upload-preview" alt="Preview">
                            <p class="mb-0 text-success" style="font-weight: 500;">
                                <i class="fas fa-check-circle me-2"></i><span id="file-name"></span>
                            </p>
                        </div>
                        <input type="file" name="image" id="imageInput" hidden accept="image/*" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-plus"></i> @lang('messages.add_to_gallery')
                    </button>
                </div>
            </form>
        </div>

        {{-- Gallery Grid --}}
        <div class="gallery-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-images" style="color: var(--accent-color);"></i>
                    @lang('messages.gallery_photos')
                    <span class="gallery-count">{{ $galleries->count() }}</span>
                </h2>
            </div>

            @if($galleries->count() > 0)
                <div class="gallery-grid">
                    @foreach($galleries as $gallery)
                        <div class="gallery-item">
                            <div class="gallery-image-wrapper">
                                <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->title }}" class="gallery-image">
                                <div class="gallery-overlay">
                                    <form action="{{ route('admin.gallery.destroy', $gallery) }}" method="POST" onsubmit="return confirm('@lang('messages.confirm_delete_photo')');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="fas fa-trash-alt"></i> @lang('messages.delete_photo')
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="gallery-content">
                                @if($gallery->title)
                                    <h4 class="gallery-title">{{ $gallery->title }}</h4>
                                @endif
                                @if($gallery->description)
                                    <p class="gallery-description">{{ $gallery->description }}</p>
                                @endif
                                <p class="text-muted mt-2" style="font-size: 0.75rem;">
                                    <i class="far fa-clock me-1"></i> {{ $gallery->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="far fa-images"></i>
                    </div>
                    <h3 class="empty-title">@lang('messages.no_gallery_photos')</h3>
                    <p class="empty-text">@lang('messages.add_first_photo')</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Image preview functionality
    document.getElementById('imageInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('upload-placeholder').style.display = 'none';
                document.getElementById('upload-preview').style.display = 'block';
                document.getElementById('file-name').textContent = file.name;
                document.getElementById('drop-zone').classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
    });

    // Drag and drop functionality
    const dropZone = document.getElementById('drop-zone');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.style.borderColor = '#7f56d9';
        dropZone.style.background = '#f9f5ff';
    }

    function unhighlight(e) {
        if (!document.getElementById('drop-zone').classList.contains('has-image')) {
            dropZone.style.borderColor = '#d0d5dd';
            dropZone.style.background = '#f9fafb';
        }
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('imageInput').files = files;

        // Trigger change event manually
        const event = new Event('change');
        document.getElementById('imageInput').dispatchEvent(event);
    }
</script>
@endsection

