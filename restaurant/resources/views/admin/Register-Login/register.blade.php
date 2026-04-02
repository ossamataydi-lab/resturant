<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Délice - Inscription Staff</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:italic,wght@700&family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body>

<div class="min-h-screen bg-[#fcfaf8] flex items-center justify-center px-6 py-12 relative overflow-hidden">

    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-[-15%] left-[-10%] w-[600px] h-[600px] bg-[#f3e9dc]/50 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-5%] w-[500px] h-[500px] bg-[#e8f0fe]/40 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-[550px] w-full relative z-10">

        <div class="text-center mb-10">
            <h1 class="text-5xl font-serif tracking-tight text-[#2d2d2d] mb-3">
                Délice<span class="text-[#c5a059]">.</span>
            </h1>
            <p class="text-[10px] text-[#a8a8a8] uppercase tracking-[0.5em] font-bold">Espace Collaborateurs</p>
        </div>

        <div class="bg-white/90 backdrop-blur-2xl border border-white p-10 md:p-14 shadow-[0_40px_100px_rgba(0,0,0,0.03)] rounded-[50px]">

            <div class="text-center mb-10">
                <h3 class="text-[#2d2d2d] text-2xl font-medium tracking-tight">Nouveau Profil Staff</h3>
                <div class="w-10 h-[2px] bg-[#c5a059]/30 mx-auto mt-4"></div>
            </div>

            <form method="POST" action="{{ route('postRegister') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <div class="space-y-2">
                        <label class="text-[9px] text-[#c5a059] font-black tracking-[0.15em] ml-1 uppercase" for="name">Nom Complet</label>
                        <input type="text" name="name" id="name" required
                            class="w-full bg-gray-50/50 border border-gray-100 rounded-2xl px-6 py-4 text-sm text-[#2d2d2d] focus:outline-none focus:ring-1 focus:ring-[#c5a059]/50 focus:bg-white transition-all"
                            placeholder="Jean Dupont">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] text-[#c5a059] font-black tracking-[0.15em] ml-1 uppercase" for="email">Email Professionnel</label>
                    <input type="email" name="email" id="email" required
                        class="w-full bg-gray-50/50 border border-gray-100 rounded-2xl px-6 py-4 text-sm text-[#2d2d2d] focus:outline-none focus:ring-1 focus:ring-[#c5a059]/50 focus:bg-white transition-all"
                        placeholder="admin@delice.fr">
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] text-[#c5a059] font-black tracking-[0.15em] ml-1 uppercase" for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-gray-50/50 border border-gray-100 rounded-2xl px-6 py-4 text-sm text-[#2d2d2d] focus:outline-none focus:ring-1 focus:ring-[#c5a059]/50 focus:bg-white transition-all"
                        placeholder="••••••••">
                </div>

                <div class="space-y-2">
                    <label class="text-[9px] text-[#c5a059] font-black tracking-[0.15em] ml-1 uppercase" for="role">Rôle au sein de l'établissement</label>
                    <div class="relative">
                        <select name="role" id="role" required
                            class="w-full appearance-none bg-gray-50/50 border border-gray-100 rounded-2xl px-6 py-4 text-sm text-[#2d2d2d] focus:outline-none focus:ring-1 focus:ring-[#c5a059]/50 cursor-pointer">
                            <option value="chef">Chef de Cuisine</option>
                            <option value="admin">Administrateur</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-6 text-[#c5a059]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit"
                        class="w-full bg-[#2d2d2d] text-white font-bold text-[11px] uppercase tracking-[0.3em] py-5 rounded-2xl shadow-xl hover:bg-[#c5a059] transition-all duration-500 transform active:scale-[0.98]">
                        Créer mon profil
                    </button>
                </div>
            </form>

            <div class="mt-12 pt-8 border-t border-gray-50 flex flex-col items-center gap-6">
                <p class="text-[11px] text-[#a8a8a8] font-medium">
                    Déjà membre ?
                    <a href="{{ route('admin.Register-Login.login') }}" class="text-[#c5a059] font-black uppercase tracking-widest ml-2 hover:text-[#2d2d2d] transition-colors">Se connecter</a>
                </p>
                <a href="/" class="group flex items-center gap-2 text-[10px] text-gray-300 hover:text-[#2d2d2d] transition-all uppercase tracking-widest font-bold">
                    <svg class="w-3 h-3 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M10 19l-7-7m0 0l7-7m-7 7h18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Retour au site
                </a>
            </div>
        </div>

        <p class="text-center mt-12 text-[8px] text-gray-400 tracking-[0.6em] uppercase font-light">
            Art de vivre & Gastronomie
        </p>
    </div>
</div>

</body>
</html>
