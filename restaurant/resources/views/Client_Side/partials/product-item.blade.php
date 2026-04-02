<div class="product-card" onclick="selectProduct({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->price }}, '{{ $product->image ?? '' }}')">
    <img src="{{ asset($product->image ?? 'images/default-food.jpg') }}" alt="{{ $product->name }}" class="product-image">
    <div class="product-info">
        <div class="product-name">{{ $product->name }}</div>
        <div class="d-flex justify-content-between align-items-center">
            <span class="product-price">{{ number_format($product->price, 2) }} {{ $settings->signe_price ?? 'DH' }}</span>
            @if($product->status)
                <span style="font-size: 0.7rem; color: #28a745; background: #e8f5e9; padding: 3px 8px; border-radius: 10px;">
                    <i class="fas fa-check"></i> Dispo
                </span>
            @else
                <span style="font-size: 0.7rem; color: #dc3545; background: #fce4e4; padding: 3px 8px; border-radius: 10px;">
                    <i class="fas fa-times"></i> Non
                </span>
            @endif
        </div>
        @if($product->status)
        <div class="qty-controls">
            <button class="qty-btn" onclick="event.stopPropagation(); updateQuantity({{ $product->id }}, -1)">
                <i class="fas fa-minus"></i>
            </button>
            <span class="qty-value" id="qty-{{ $product->id }}">0</span>
            <button class="qty-btn" onclick="event.stopPropagation(); updateQuantity({{ $product->id }}, 1)">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        @endif
    </div>
</div>
