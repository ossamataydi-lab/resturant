<footer class="bg-[#0f1113] text-white pt-24 pb-12 px-8 overflow-hidden border-t border-white/5">
    <div class="max-w-7xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 mb-20">

            <div class="lg:col-span-5 space-y-8">
                <a href="/" class="logo-font text-3xl font-bold tracking-tighter">
                    {{ $settings->name ?? 'Délice' }}<span class="text-[var(--gold)]">.</span>
                </a>
                <p class="text-gray-400 text-lg font-light leading-relaxed max-w-sm">
                    {{ $settings->description ?? "Une immersion sensorielle où chaque plat raconte une histoire de passion, de terroir et d'excellence." }}
                </p>
                <div class="flex space-x-5">
                    @if ($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank"
                            class="w-10 h-10 border border-white/10 flex items-center justify-center rounded-full hover:bg-[var(--gold)] hover:border-[var(--gold)] hover:text-black transition-all duration-500">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if ($settings->whatsapp)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->whatsapp) }}" target="_blank"
                            class="w-10 h-10 border border-white/10 flex items-center justify-center rounded-full hover:bg-[var(--gold)] hover:border-[var(--gold)] hover:text-black transition-all duration-500">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-3 gap-12">

                <div class="space-y-6">
                    <h4 class="text-[10px] uppercase tracking-[0.3em] text-[var(--gold)] font-bold">{{ __('messages.explore') }}</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('menu.index') }}"
                                class="text-sm font-light text-gray-400 hover:text-white transition-colors">{{ __('messages.menu') }}</a>
                        </li>
                        <li><a href="{{ route('home') }}#chef"
                                class="text-sm font-light text-gray-400 hover:text-white transition-colors">{{ __('messages.chef') }}</a>
                        </li>
                        <li><a href="{{ route('home') }}#gallery"
                                class="text-sm font-light text-gray-400 hover:text-white transition-colors">{{ __('messages.gallery') }}</a>
                        </li>
                        <li><a href="{{ route('reservation.index') }}"
                                class="text-sm font-light text-gray-400 hover:text-white transition-colors">{{ __('messages.reservation') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="text-[10px] uppercase tracking-[0.3em] text-[var(--gold)] font-bold">{{ __('messages.contact') }}</h4>
                    <ul class="space-y-4 text-sm font-light text-gray-400 leading-relaxed">
                        @if ($settings->adresse)
                            <li>{!! nl2br(e($settings->adresse)) !!}</li>
                        @endif
                        @if ($settings->phone)
                            <li class="hover:text-white transition-colors"><a
                                    href="tel:{{ $settings->phone }}">{{ $settings->phone }}</a></li>
                        @endif
                        @if ($settings->email)
                            <li class="hover:text-white transition-colors"><a
                                    href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></li>
                        @endif
                    </ul>
                </div>

                <div class="space-y-6">
                    <h4 class="text-[10px] uppercase tracking-[0.3em] text-[var(--gold)] font-bold">{{ __('messages.opening_hours') }}</h4>
                    <div class="space-y-4 text-sm font-light text-gray-400">
                        @php
                            $openingHours = $settings->opening_hours ?? [];
                            $daysKeys = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $daysAr = ['الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد'];
                            $daysEn = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $daysFr = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

                            $locale = app()->getLocale();
                            $days = $locale == 'ar' ? $daysAr : ($locale == 'fr' ? $daysFr : $daysEn);
                        @endphp

                        @if (count($openingHours) > 0)
                            @foreach ($daysKeys as $index => $day)
                                @if (isset($openingHours[$day]) && !($openingHours[$day]['closed'] ?? false))
                                    <div>
                                        <p class="text-white font-medium">{{ $days[$index] }}</p>
                                        <p>{{ $openingHours[$day]['open'] ?? '' }} —
                                            {{ $openingHours[$day]['close'] ?? '' }}</p>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div>
                                <p class="text-white font-medium">{{ __('messages.dinner') }}</p>
                                <p>{{ __('messages.tue') }} — {{ __('messages.sat') }}: 19h - 23h</p>
                            </div>
                            <div>
                                <p class="text-white font-medium">{{ __('messages.lunch') }}</p>
                                <p>{{ __('messages.sun') }}: 12h - 15h</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex space-x-8 text-[10px] uppercase tracking-widest text-gray-600">
                <a href="#" class="hover:text-white transition-colors">{{ __('messages.privacy') }}</a>
                <a href="#" class="hover:text-white transition-colors">{{ __('messages.terms') }}</a>
                <a href="{{ route('admin.Register-Login.login') }}"
                    class="hover:text-white transition-colors">{{ __('messages.admin') }}</a>
            </div>
            <p class="text-[10px] uppercase tracking-[0.2em] text-gray-600">
                © {{ date('Y') }} DÉLICE. {{ __('messages.all_rights') }}
            </p>
        </div>
    </div>
</footer>
