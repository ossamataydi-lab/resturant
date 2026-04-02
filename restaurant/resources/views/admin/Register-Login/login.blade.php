<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Délice - Admin Access</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600&family=Playfair+Display:ital,wght@1,600&display=swap"
        rel="stylesheet">
</head>

<body class="bg-[#fcfaf8] antialiased font-['Plus_Jakarta_Sans'] overflow-hidden">

    <div class="fixed inset-0 pointer-events-none">
        <div
            class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-[#f3e9dc] rounded-full blur-[120px] opacity-60">
        </div>
        <div
            class="absolute bottom-[-5%] left-[-5%] w-[400px] h-[400px] bg-[#e8f0fe] rounded-full blur-[100px] opacity-40">
        </div>
    </div>

    <div class="min-h-screen flex items-center justify-center px-6 relative z-10">
        <div class="w-full max-w-[420px]">

            <div class="text-center mb-10">
                <h1 class="text-5xl font-bold tracking-tighter text-[#2d2d2d] font-serif italic">
                    Délice<span class="text-[#c5a059]">.</span>
                </h1>
                <p class="text-[#a8a8a8] uppercase tracking-[0.5em] text-[9px] mt-4 font-bold pl-2">Administration Luxe
                </p>
            </div>

            <div
                class="bg-white/80 backdrop-blur-2xl border border-white p-10 shadow-[0_20px_50px_rgba(197,160,89,0.1)] rounded-[40px]">

                <div class="mb-10 text-center">
                    <h2 class="text-[#2d2d2d] text-xl font-semibold tracking-tight">Bonjour</h2>
                    <p class="text-[#8e8e8e] text-xs mt-2 font-light">Identifiez-vous pour gérer votre établissement</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 rounded-xl p-4 flex items-center gap-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <p class="text-green-800 text-sm font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('postLogin') }}" class="space-y-6">
                    @csrf

                    <div class="space-y-2">
                        <label class="text-[10px] text-[#c5a059] font-bold tracking-widest ml-1 uppercase">Email</label>
                        <input type="email" name="email" required
                            class="w-full bg-[#f8f9fa] border border-[#eee] rounded-2xl px-6 py-4 text-[#2d2d2d] text-sm focus:outline-none focus:border-[#c5a059] focus:bg-white transition-all duration-300 placeholder:text-[#ccc]"
                            placeholder="admin@delice.fr">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[10px] text-[#c5a059] font-bold tracking-widest ml-1 uppercase">Mot de
                            passe</label>
                        <input type="password" name="password" required
                            class="w-full bg-[#f8f9fa] border border-[#eee] rounded-2xl px-6 py-4 text-[#2d2d2d] text-sm focus:outline-none focus:border-[#c5a059] focus:bg-white transition-all duration-300"
                            placeholder="••••••••">
                    </div>

                    <button type="submit"
                        class="w-full bg-[#2d2d2d] text-white font-bold text-[11px] uppercase tracking-[0.2em] py-5 rounded-2xl transition-all duration-500 hover:bg-[#c5a059] hover:shadow-lg hover:shadow-[#c5a059]/20 transform hover:-translate-y-1">
                        Ouvrir la session
                    </button>
                </form>
                <div class="mt-8 pt-6 border-t border-gray-100/50">
                    <div class="flex flex-col items-center gap-4">

                        <a href="{{ route('admin.Register-Login.register') }}"
                            class="text-[11px] text-[#c5a059] hover:text-[#2d2d2d] transition-all uppercase tracking-[0.2em] font-bold">
                            Créer un compte
                        </a>

                        <a href="/"
                            class="group text-[10px] text-[#a8a8a8] hover:text-[#2d2d2d] transition-all uppercase tracking-widest font-semibold flex items-center gap-2">
                            <svg class="w-3 h-3 transform group-hover:-translate-x-1 transition-transform"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Retour au site
                        </a>

                    </div>
                </div>

                <p class="text-center mt-12 text-[9px] text-[#b5b5b5] tracking-[0.4em] uppercase">
                    Élégance & Performance
                </p>
            </div>
        </div>

</body>

</html>
