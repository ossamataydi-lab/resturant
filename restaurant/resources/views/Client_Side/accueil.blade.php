@extends('layouts.app')

@section('content')

    <section id="menu" class="py-24" style="background: linear-gradient(135deg, var(--light-color) 0%, #f9f9f9 100%);">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)] rounded-full mb-4 shadow-lg">
                    <i class="fas fa-utensils text-3xl text-black"></i>
                </div>
                <h2 class="text-4xl font-serif mb-4 uppercase tracking-widest" style="color: var(--primary-color);">{{ __('messages.our_menu') }}</h2>
                <p class="text-gray-500 max-w-xl mx-auto">{{ __('messages.choose_your_dishes') }}</p>
                <div class="h-1 w-24 mx-auto mt-4" style="background-color: var(--accent-color);"></div>
            </div>

            @foreach ($categories as $category)
                <div class="mb-20">
                    <h3 class="text-2xl font-serif mb-10 border-b pb-2 italic text-center md:text-left"
                        style="color: var(--secondary-color); border-color: var(--accent-color);">
                        {{ $category->name }}
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                        @foreach ($category->products->take(3) as $product)
                            <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border transform hover:-translate-y-2"
                                style="border-color: var(--light-color);">
                                <div class="relative h-64 overflow-hidden group">
                                    <img src="{{ $product->image ? asset($product->image) : 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80' }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                        alt="{{ $product->name }}">

                                    <div class="absolute top-4 right-4 px-4 py-1.5 rounded-full font-bold shadow-lg text-white transform transition-transform duration-300 hover:scale-105"
                                        style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                                        <span class="mr-1">{{ $settings->signe_price ?? '€' }}</span>{{ number_format($product->price, 2) }}
                                    </div>
                                    <!-- Category Badge -->
                                    <div class="absolute top-4 left-4 px-3 py-1 rounded-lg text-xs font-semibold bg-white/90 backdrop-blur-sm shadow" style="color: var(--primary-color);">
                                        {{ $category->name }}
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h4 class="text-xl font-bold mb-2" style="color: var(--dark-color);">
                                        {{ $product->name }}</h4>
                                    <p class="text-sm leading-relaxed mb-4" style="color: var(--text-color);">
                                        {{ $product->description }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <button
                                            class="font-bold text-sm hover:underline uppercase tracking-wider transition transform hover:scale-105 quick-view-btn"
                                            style="color: var(--primary-color);"
                                            onclick="openQuickView('{{ $product->id }}', '{{ addslashes($product->name) }}', '{{ addslashes($product->description ?? '') }}', '{{ $product->price }}', '{{ asset($product->image ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=800&q=80') }}', '{{ $settings->signe_price ?? '€' }}')">
                                            <i class="fas fa-eye mr-1"></i>{{ __('messages.details') }}
                                        </button>
                                        <form action="{{ route('commande') }}" method="GET" class="inline">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit"
                                                class="px-5 py-2 rounded-lg font-bold text-sm uppercase tracking-wider transition hover:shadow-lg transform hover:scale-105"
                                                style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: rgb(238, 255, 0);">
                                                <i class="fas fa-shopping-bag mr-1"></i>{{ __('messages.order_now') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="text-center">
                <p class="italic font-medium" style="color: var(--text-color);">
                    📅 {{ __('messages.menu_updated') }} <span style="color: var(--primary-color);">{{ date('d/m/Y') }}</span>
                </p>
            </div>
        </div>
    </section>

    <section id="chef" class="py-24 relative overflow-hidden"
        style="background: linear-gradient(135deg, #fafafa 0%, #f0f0f0 100%);">
        <div class="absolute top-0 right-0 w-96 h-96 opacity-5">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#c5a059"
                    d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,79.6,-46.9C87.4,-34.7,90.1,-20.4,87.9,-6.8C85.7,6.8,78.6,19.7,70,31.4C61.3,43.1,51.1,53.6,39.6,62.3C28.1,71,15.3,77.9,1.3,75.8C-12.7,73.7,-27.9,62.6,-40.3,50.8C-52.7,39,-62.3,26.5,-68.2,12.4C-74.1,-1.7,-76.3,-17.4,-71.8,-31.4C-67.3,-45.4,-56.1,-57.7,-43.5,-65.7C-30.9,-73.7,-16.9,-77.4,-2.4,-75.2C12.1,-73,29.6,-64.9,44.7,-76.4Z"
                    transform="translate(100 100)" />
            </svg>
        </div>
        <div class="absolute bottom-0 left-0 w-64 h-64 opacity-5">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#c5a059"
                    d="M44.7,-76.4C58.9,-69.2,71.8,-59.1,79.6,-46.9C87.4,-34.7,90.1,-20.4,87.9,-6.8C85.7,6.8,78.6,19.7,70,31.4C61.3,43.1,51.1,53.6,39.6,62.3C28.1,71,15.3,77.9,1.3,75.8C-12.7,73.7,-27.9,62.6,-40.3,50.8C-52.7,39,-62.3,26.5,-68.2,12.4C-74.1,-1.7,-76.3,-17.4,-71.8,-31.4C-67.3,-45.4,-56.1,-57.7,-43.5,-65.7C-30.9,-73.7,-16.9,-77.4,-2.4,-75.2C12.1,-73,29.6,-64.9,44.7,-76.4Z"
                    transform="translate(100 100)" />
            </svg>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            @if ($chef)
                <div class="text-center mb-16">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <div class="h-px w-12 bg-[var(--gold)]"></div>
                        <span class="text-xs font-semibold tracking-[0.3em] uppercase text-[var(--gold)]">{{ __('messages.the_team') }}</span>
                        <div class="h-px w-12 bg-[var(--gold)]"></div>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-light tracking-tight"
                        style="font-family: 'Playfair Display', serif; color: var(--dark);">
                        {{ __('messages.our_chef') }}
                    </h2>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20 max-w-6xl mx-auto">
                    <div class="w-full lg:w-5/12">
                        <div class="relative">
                            <div class="absolute -top-3 -left-3 w-full h-full border-2 z-0"
                                style="border-color: var(--gold);"></div>
                            <div class="absolute -bottom-3 -right-3 w-full h-full border-2 z-0"
                                style="border-color: var(--gold);"></div>

                            <div class="relative z-10 overflow-hidden rounded-sm shadow-2xl">
                                <img src="{{ asset('storage/' . $chef->image_path) }}"
                                    class="w-full h-[500px] object-cover transition-transform duration-700 hover:scale-105"
                                    alt="{{ $chef->name }}">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 hover:opacity-100 transition-opacity duration-500">
                                </div>
                            </div>

                            <div class="absolute -bottom-6 -right-6 z-20 bg-white p-6 shadow-xl">
                                <div class="text-center">
                                    <span class="block text-3xl font-bold" style="color: var(--gold);">15+</span>
                                <span class="text-xs uppercase tracking-wider text-gray-500">{{ __('messages.years_experience') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-7/12">
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-4xl md:text-5xl font-light mb-3"
                                    style="font-family: 'Playfair Display', serif; color: var(--dark);">
                                    {{ $chef->name }}
                                </h3>
                                <p class="text-sm font-medium tracking-[0.2em] uppercase" style="color: var(--gold);">
                                    {{ __('messages.owner_chef') }}
                                </p>
                            </div>

                            <p class="text-lg leading-relaxed text-gray-600 italic">
                                "{{ $chef->description }}"
                            </p>

                            @if ($chef->philosophy)
                                <div class="relative p-8 bg-white border-l-4 shadow-lg"
                                    style="border-left-color: var(--gold);">
                                    <div class="absolute -top-3 left-6">
                                        <span class="bg-white px-3 text-xs font-semibold tracking-widest uppercase"
                                            style="color: var(--gold);">
                                            <i class="fas fa-quote-left mr-2"></i>{{ __('messages.philosophy') }}
                                        </span>
                                    </div>
                                    <p class="text-lg font-light leading-relaxed" style="color: var(--dark);">
                                        "{{ $chef->philosophy }}"
                                    </p>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>

                <div class="mt-20 flex flex-wrap justify-center gap-8 md:gap-16">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-3 flex items-center justify-center border border-gray-300 rounded-full">
                            <i class="fas fa-award text-xl" style="color: var(--gold);"></i>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-gray-500">{{ __('messages.michelin_guide') }}</span>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-3 flex items-center justify-center border border-gray-300 rounded-full">
                            <i class="fas fa-star text-xl" style="color: var(--gold);"></i>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-gray-500">{{ __('messages.chef_of_year') }}</span>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-16 h-16 mx-auto mb-3 flex items-center justify-center border border-gray-300 rounded-full">
                            <i class="fas fa-utensils text-xl" style="color: var(--gold);"></i>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-gray-500">{{ __('messages.french_cuisine') }}</span>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="gallery" class="py-24 bg-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-serif mb-12 uppercase tracking-widest" style="color: var(--primary-color);">{{ __('messages.photo_gallery') }}</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @forelse($galleries as $image)
                    <div class="h-64 overflow-hidden rounded-lg shadow-lg group">
                        <img src="{{ asset('storage/' . $image->image_path) }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-125 cursor-pointer"
                            alt="Gallery">
                    </div>
                @empty
                    <p class="col-span-full" style="color: var(--text-color);">{{ __('messages.no_photos_yet') }}</p>
                @endforelse
            </div>
        </div>
    </section>

    @if ($setting)
        @php
            $hasValidCoords = $setting->lat && $setting->lng && is_numeric($setting->lat) && is_numeric($setting->lng);
            $mapLat = $hasValidCoords ? $setting->lat : '48.85837007928746';
            $mapLng = $hasValidCoords ? $setting->lng : '2.292292615582855';
            $mapTimestamp = time();
        @endphp
        <section id="location" class="py-24"
            style="background: linear-gradient(135deg, var(--light-color) 0%, #f9f9f9 100%);">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-0 shadow-2xl rounded-3xl overflow-hidden">
                    <div class="p-12 text-black"
                        style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);">
                        <h2 class="text-3xl font-serif mb-8 uppercase tracking-widest">{{ __('messages.find_us') }}</h2>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <i class="fas fa-map-marker-alt mt-1 text-2xl"></i>
                                <p class="text-lg">{{ $setting->adresse ?? __('messages.address_not_set') }}</p>
                            </div>
                            <div class="flex items-start gap-4">
                                <i class="fas fa-phone mt-1 text-2xl"></i>
                                <p class="text-lg">{{ $setting->phone ?? __('messages.phone_not_set') }}</p>
                            </div>
                        </div>
                        <div class="mt-12">
                            <a href="{{ route('reservation.index') }}"
                                class="inline-block px-10 py-4 rounded-full font-bold hover:bg-white hover:text-black transition-all uppercase tracking-widest shadow-lg"
                                style="background-color: white; color: var(--primary-color);">
                                {{ __('messages.reserve_button') }}
                            </a>
                        </div>
                    </div>
                    <div class="h-[400px] md:h-auto">
                        <iframe id="client-map-iframe" width="100%" height="100%" frameborder="0" style="border:0"
                            src="https://maps.google.com/maps?q={{ $mapLat }},{{ $mapLng }}&z=15&output=embed&t={{ $mapTimestamp }}"
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Quick View Modal -->
    <div id="quickViewModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" onclick="closeQuickView()"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-2xl">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden m-4 relative">
                <button onclick="closeQuickView()" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center hover:bg-red-500 hover:text-white transition-all shadow-lg">
                    <i class="fas fa-times"></i>
                </button>
                <div id="quickViewContent" class="flex flex-col md:flex-row">
                    <!-- Content loaded dynamically -->
                </div>
            </div>
        </div>
    </div>

    <style>
        #quickViewModal {
            animation: fadeIn 0.3s ease;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        #quickViewModal.show .bg-white {
            animation: slideUp 0.3s ease;
        }
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>

    <script>
        function openQuickView(id, name, description, price, image, currency) {
            const modal = document.getElementById('quickViewModal');
            const content = document.getElementById('quickViewContent');

            const descText = description && description.trim() ? description : 'Aucune description disponible pour ce plat.';

            content.innerHTML = `
                <div class="w-full md:w-1/2">
                    <img src="${image}" alt="${name}" class="w-full h-64 md:h-full object-cover">
                </div>
                <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold text-white bg-gradient-to-r from-[var(--primary-color)] to-[var(--secondary-color)]">
                            ${currency}${parseFloat(price).toFixed(2)}
                        </span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4" style="color: var(--dark-color);">${name}</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">${descText}</p>
                    <form action="{{ route('commande') }}" method="GET">
                        @csrf
                        <input type="hidden" name="product_id" value="${id}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full py-3 rounded-xl font-bold uppercase tracking-wider transition-all hover:shadow-lg transform hover:scale-[1.02]"
                            style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white;">
                            <i class="fas fa-shopping-bag mr-2"></i>Commander
                        </button>
                    </form>
                </div>
            `;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeQuickView() {
            const modal = document.getElementById('quickViewModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeQuickView();
            }
        });
    </script>

@endsection
