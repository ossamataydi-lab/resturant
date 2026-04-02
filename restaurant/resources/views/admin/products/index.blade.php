@extends('layouts.app')

@section('content')
<div id="admin-studio-v6" class="{{ $currentLocale == 'ar' ? 'rtl' : 'ltr' }}">

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap');

#admin-studio-v6 {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 50%, #f1f5f9 100%);
    min-height: 100vh;
    padding: 30px 15px;
    color: #0f172a;
}

#admin-studio-v6.rtl {
    direction: rtl;
}

.container { max-width: 1300px; margin: auto;padding-top: 100px; }

/* ===== HEADER ===== */
.header-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    flex-wrap: wrap;
    gap: 20px;
}

#admin-studio-v6.rtl .header-top {
    flex-direction: row-reverse;
}

.header-title h1 {
    font-size: 2.2rem;
    font-weight: 900;
    margin: 0;
}

.header-title p {
    color: #64748b;
    margin-top: 6px;
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

#admin-studio-v6.rtl .language-selector {
    flex-direction: row-reverse;
}

.lang-link {
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    color: #64748b;
    font-weight: 600;
    font-size: 0.85rem;
    transition: all 0.3s ease;
}

.lang-link:hover {
    background: #f0f0f0;
    color: #1e1e1e;
}

.lang-link.active {
    background: #6366f1;
    color: white;
}

.btn-primary-gradient {
    background: linear-gradient(135deg, #4f46e5, #6366f1);
    color: white !important;
    padding: 14px 24px;
    border-radius: 14px;
    font-weight: 700;
    text-decoration: none;
    transition: 0.3s ease;
    box-shadow: 0 10px 25px rgba(79,70,229,0.3);
    display: inline-block;
    text-align: center;
}

.btn-primary-gradient:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(79,70,229,0.4);
}

/* ===== STATS ===== */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 20px;
    margin-bottom: 35px;
}

#admin-studio-v6.rtl .stats-grid {
    direction: rtl;
}

.stat-card {
    background: white;
    padding: 22px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(15,23,42,0.05);
}

#admin-studio-v6.rtl .stat-card {
    text-align: right;
}

.stat-card h2 {
    font-size: 1.8rem;
    font-weight: 900;
    margin: 0;
}

.stat-card p {
    margin-top: 5px;
    color: #64748b;
}

/* ===== FILTER ===== */
.filter-card {
    background: rgba(255,255,255,0.85);
    backdrop-filter: blur(10px);
    padding: 20px;
    border-radius: 20px;
    display: grid;
    grid-template-columns: 2fr 1fr 1fr auto;
    gap: 15px;
    margin-bottom: 40px;
}

#admin-studio-v6.rtl .filter-card {
    direction: rtl;
}

.input-modern {
    padding: 12px 15px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    background: #fff;
    transition: 0.3s;
    width: 100%;
}

.input-modern:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99,102,241,0.1);
}

/* ===== PRODUCTS ===== */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px,1fr));
    gap: 25px;
}

.product-card {
    background: white;
    border-radius: 22px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(15,23,42,0.05);
    transition: all 0.35s cubic-bezier(.4,0,.2,1);
    display: flex;
    flex-direction: column;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px rgba(15,23,42,0.1);
}

.img-wrapper {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover img {
    transform: scale(1.08);
}

/* Overlay */
.img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15,23,42,0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    opacity: 0;
    transition: 0.3s;
}

.product-card:hover .img-overlay {
    opacity: 1;
}

.overlay-btn {
    background: white;
    padding: 8px 14px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    color: #0f172a;
}

/* Content */
.card-content {
    padding: 20px;
    flex-grow: 1;
}

#admin-studio-v6.rtl .card-content {
    text-align: right;
}

.card-category {
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    color: #6366f1;
}

.card-title {
    font-size: 1.2rem;
    font-weight: 800;
    margin: 8px 0;
}

.card-desc {
    font-size: 0.9rem;
    color: #64748b;
    margin-bottom: 15px;
}

.price-text {
    font-size: 1.5rem;
    font-weight: 900;
}

/* Footer */
.card-footer {
    display: flex;
    gap: 10px;
    padding: 16px;
    background: #f8fafc;
}

#admin-studio-v6.rtl .card-footer {
    flex-direction: row-reverse;
}

.btn-edit {
    flex: 2;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;
    font-weight: 600;
    background: #eef2ff;
    color: #3730a3 !important;
}

.btn-delete {
    flex: 1;
    padding: 10px;
    border-radius: 10px;
    background: #fee2e2;
    border: none;
    cursor: pointer;
    color: #b91c1c;
    font-weight: 600;
}

/* Empty */
.empty-state {
    text-align: center;
    background: white;
    padding: 60px 20px;
    border-radius: 20px;
}

/* Pagination */
.pagination-container {
    margin-top: 40px;
    display: flex;
    justify-content: center;
}

#admin-studio-v6.rtl .pagination-container {
    justify-content: center;
}

/* ========================= */
/* ===== RESPONSIVE ======== */
/* ========================= */

@media (max-width: 992px) {
    .filter-card {
        grid-template-columns: 1fr 1fr;
    }
}

@media (max-width: 768px) {
    .header-top {
        flex-direction: column;
        align-items: flex-start;
    }

    #admin-studio-v6.rtl .header-top {
        flex-direction: column;
    }

    .btn-primary-gradient {
        width: 100%;
    }

    .language-selector {
        width: 100%;
        justify-content: center;
    }
}

@media (max-width: 600px) {
    .filter-card {
        grid-template-columns: 1fr;
    }

    .filter-card button {
        width: 100%;
    }

    .img-wrapper {
        height: 180px;
    }

    .card-footer {
        flex-direction: column;
    }

    #admin-studio-v6.rtl .card-footer {
        flex-direction: column;
    }

    .btn-edit,
    .btn-delete {
        width: 100%;
    }

    .price-text {
        font-size: 1.3rem;
    }

    .stat-card h2 {
        font-size: 1.5rem;
    }
}

</style>

<div class="container">

    <div class="header-top">
        <div class="header-title">
            <h1>@lang('messages.product_management')</h1>
            <p>@lang('messages.product_management_desc')</p>
        </div>
            <a href="{{ route('admin.products.create') }}" class="btn-primary-gradient">
                @lang('messages.add_product')
            </a>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats-grid">
        <div class="stat-card">
            <h2>{{ $products->count() }}</h2>
            <p>@lang('messages.total_products')</p>
        </div>
        <div class="stat-card">
            <h2>{{ $products->where('status',1)->count() }}</h2>
            <p>@lang('messages.available')</p>
        </div>
        <div class="stat-card">
            <h2>{{ $products->where('status',0)->count() }}</h2>
            <p>@lang('messages.unavailable')</p>
        </div>
        <div class="stat-card">
            <h2>{{ $categories->count() }}</h2>
            <p>@lang('messages.categories')</p>
        </div>
    </div>

    {{-- Filter --}}
    <form method="GET" class="filter-card">
        <input type="text" name="search" placeholder="@lang('messages.search_product')" class="input-modern">
        <select name="category" class="input-modern">
            <option value="">@lang('messages.all_categories')</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <select name="status" class="input-modern">
            <option value="">@lang('messages.all_status')</option>
            <option value="1">@lang('messages.available')</option>
            <option value="0">@lang('messages.unavailable')</option>
        </select>
        <button class="btn-primary-gradient">@lang('messages.filter')</button>
    </form>

    {{-- Products --}}
    <div class="products-grid">
        @forelse($products as $product)
            <div class="product-card">
                <div class="img-wrapper">
                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=400&q=80' }}" alt="{{ $product->name }}">
                    <div class="img-overlay">
                        <a href="{{ route('admin.products.edit',$product->id) }}" class="overlay-btn">@lang('messages.edit')</a>
                    </div>
                </div>

                <div class="card-content">
                    <div class="card-category">{{ $product->category->name }}</div>
                    <div class="card-title">{{ $product->name }}</div>
                    <div class="card-desc">{{ Str::limit($product->description,90) }}</div>
                    <div class="price-text">{{ number_format($product->price,2) }} MAD</div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('admin.products.edit',$product->id) }}" class="btn-edit">@lang('messages.edit')</a>
                    <form action="{{ route('admin.products.destroy',$product->id) }}" method="POST" style="flex:1;">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">@lang('messages.delete')</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <h2>@lang('messages.no_products')</h2>
                <p>@lang('messages.no_products_message')</p>
            </div>
        @endforelse
    </div>

    <div class="pagination-container">
        {{ $products->links() }}
    </div>
</div>
@endsection
