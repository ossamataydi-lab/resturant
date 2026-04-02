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

    .admin-container {
        padding: 40px 0;
    }

    .admin-container.rtl {
        direction: rtl;
    }

    .page-header {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-top: 50px;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 20px;
        text-align: center;
    }

    .admin-container.rtl .page-header {
        flex-direction: row-reverse;
    }

    .page-header-left h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .page-header-left p {
        color: #667085;
        margin: 0;
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

    .admin-container.rtl .language-selector {
        flex-direction: row-reverse;
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

    .form-box {
        background: #ffffff;
        border-radius: 24px;
        max-width: 700px;
        margin: 0 auto;
        padding: 40px;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
    }

    .admin-container.rtl .form-box {
        text-align: right;
    }

    .form-header {
        margin-bottom: 32px;
        text-align: center;
    }

    .label-custom {
        display: block;
        color: #344054;
        font-weight: 600;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .input-custom, .select-custom {
        width: 100%;
        height: 52px;
        padding: 12px 18px;
        border: 1px solid #d0d5dd;
        border-radius: 12px;
        font-size: 1rem;
        transition: 0.2s ease;
    }

    .input-custom:focus, .select-custom:focus {
        border-color: var(--accent-color);
        box-shadow: 0px 0px 0px 4px rgba(158, 119, 237, 0.15);
        outline: none;
    }

    .image-upload-wrapper {
        border: 2px dashed #eaecf0;
        border-radius: 16px;
        padding: 35px;
        text-align: center;
        cursor: pointer;
        background: var(--bg-subtle);
        transition: 0.3s;
    }

    .image-upload-wrapper:hover {
        border-color: var(--accent-color);
        background: #f9f5ff;
    }

    .btn-submit {
        background: var(--primary-color);
        color: white;
        padding: 16px 30px;
        border-radius: 12px;
        font-weight: 700;
        border: none;
        transition: 0.3s;
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
    }

    .admin-container.rtl .btn-cancel i {
        margin-left: 8px;
        margin-right: 0;
    }

    .admin-container.rtl .btn-submit i {
        margin-left: 8px;
        margin-right: 0;
    }

    .admin-container.rtl .me-2 {
        margin-left: 8px;
        margin-right: 0;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
        }

        .admin-container.rtl .page-header {
            flex-direction: column;
        }

        .language-selector {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="admin-container {{ $currentLocale == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        {{-- Page Header with Language Selector --}}
        <div class="page-header">
            <div class="page-header-left">
                <h1>👨‍🍳 @lang('messages.add_new_product')</h1>
                <p>@lang('messages.add_new_product_desc')</p>
            </div>

        </div>

        {{-- Form --}}
        <div class="form-box">
            @if ($errors->any())
                <div class="alert alert-danger mb-4 rounded-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="label-custom">@lang('messages.product_name')</label>
                        <input type="text" name="name" class="input-custom" placeholder="@lang('messages.product_name_placeholder')" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="label-custom">@lang('messages.category')</label>
                        <select name="category_id" class="select-custom" required>
                            <option value="">@lang('messages.select_category')</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="label-custom">@lang('messages.price') (@lang('messages.price_unit'))</label>
                        <input type="number" step="0.01" name="price" class="input-custom" placeholder="@lang('messages.price_placeholder')" required>
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="label-custom">@lang('messages.availability')</label>
                        <select name="status" class="select-custom">
                            <option value="1">✅ @lang('messages.in_stock')</option>
                            <option value="0">❌ @lang('messages.out_of_stock')</option>
                        </select>
                    </div>

                    <div class="col-12 mb-4">
                        <label class="label-custom">@lang('messages.description')</label>
                        <textarea name="description" class="input-custom" rows="4" style="height: auto;" placeholder="@lang('messages.description_placeholder')"></textarea>
                    </div>

                    <div class="col-12 mb-5">
                        <label class="label-custom">@lang('messages.product_image')</label>
                        <div class="image-upload-wrapper" id="drop-zone" onclick="document.getElementById('imageInput').click()">
                            <i class="fas fa-cloud-upload-alt fa-2x mb-2 text-muted"></i>
                            <p class="mb-0 text-muted" id="file-name">@lang('messages.click_to_add_photo')</p>
                            <input type="file" name="image" id="imageInput" hidden accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                    <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                        <i class="fas fa-arrow-left me-2"></i> @lang('messages.cancel')
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-check me-2"></i> @lang('messages.save_product')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('imageInput').onchange = function() {
        if (this.files && this.files[0]) {
            const fileName = this.files[0].name;
            document.getElementById('file-name').innerHTML = "🟢 @lang('messages.file_selected') " + fileName;
            document.getElementById('drop-zone').style.borderColor = "#7f56d9";
            document.getElementById('drop-zone').style.background = "#f9f5ff";
        }
    };
</script>
@endsection

