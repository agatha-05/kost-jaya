@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { 
        background-color: #020617; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        margin: 0;
        padding: 0;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-down { animation: fadeInDown 0.6s ease-out forwards; }
    .animate-up { animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }

    .glass-card {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
</style>

<div class="w-full bg-[#020617] min-h-screen">
    <div class="max-w-[640px] mx-auto min-h-screen pb-20 relative shadow-2xl bg-[#020617]">
        
        <div id="TopNav" class="relative flex items-center justify-between px-6 pt-12 animate-down">
            <a href="{{ route('home') }}" class="w-12 h-12 flex items-center justify-center shrink-0 rounded-2xl bg-slate-900 border border-white/10 text-white hover:bg-blue-600 transition-all shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <p class="font-bold text-white text-lg tracking-tight uppercase tracking-widest text-[10px]">Eksplorasi Kota</p> 
            <div class="w-12"></div>
        </div>

        <div id="Header" class="relative flex items-center justify-between px-6 mt-10 animate-up" style="animation-delay: 0.1s">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <h1 class="font-extrabold text-3xl text-white tracking-tighter">Kota {{ $city->name }}</h1>
                    <div class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></div>
                </div>
                <p class="text-slate-400 font-medium tracking-tight">Tersedia {{ $boardingHouses->count() }} hunian modern</p>
            </div>
            
            <div class="flex flex-col items-center p-3 rounded-[24px] glass-card border-blue-500/20 shadow-xl">
                <img src="{{ asset('assets/images/icons/star.svg') }}" class="w-6 h-6 mb-1" alt="icon">
                <p class="font-black text-white text-xs tracking-tighter">4/5</p>
            </div>
        </div>

        <section id="Result" class="relative flex flex-col gap-6 px-6 mt-10">
            @forelse ($boardingHouses as $index => $boardingHouse)
            <a href="{{ route('kos.show', $boardingHouse->slug) }}" 
               class="animate-up group" 
               style="animation-delay: {{ 0.2 + ($index * 0.1) }}s">
                
                <div class="glass-card rounded-[40px] p-4 flex gap-5 transition-all duration-500 group-hover:border-blue-500/40 group-hover:bg-slate-800/60 group-hover:-translate-y-2 shadow-xl">
                    
                    <div class="relative flex w-[130px] h-[175px] shrink-0 rounded-[32px] overflow-hidden bg-slate-800">
                        <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                             alt="{{ $boardingHouse->name }}">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 to-transparent"></div>
                    </div>

                    <div class="flex flex-col justify-between py-1 w-full text-white">
                        <div>
                            <h3 class="font-bold text-xl leading-tight group-hover:text-blue-400 transition-colors line-clamp-2">
                                {{ $boardingHouse->name }}
                            </h3>
                            
                            <div class="flex flex-col gap-2 mt-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-3.5 h-3.5" alt="icon">
                                    </div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">{{ $city->name }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-3.5 h-3.5" alt="icon">
                                    </div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">{{ $boardingHouse->capacity }} Orang</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-4">
                            <div class="flex flex-col">
                                <span class="text-[9px] text-slate-500 font-black uppercase tracking-[0.1em]">Mulai dari</span>
                                <p class="font-black text-2xl text-blue-400 tracking-tight leading-none">
                                    Rp {{ number_format($boardingHouse->price/1000, 0) }}k<span class="text-[10px] text-slate-500 font-medium lowercase">/bln</span>
                                </p>
                            </div>
                            
                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center opacity-0 group-hover:opacity-100 group-hover:translate-x-0 translate-x-4 transition-all duration-500 shadow-xl">
                                <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="flex flex-col items-center justify-center py-20 animate-up text-center px-10">
                <div class="w-24 h-24 bg-slate-900 rounded-full flex items-center justify-center mb-6 border border-white/5">
                    <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Belum ada hunian di {{ $city->name }}</h2>
                <p class="text-slate-500 text-sm mb-8">Tenang saja, kami sedang mencari hunian terbaik untuk segera ditambahkan di sini.</p>
                <a href="{{ route('home') }}" class="px-8 py-3 bg-blue-600 text-white rounded-2xl font-bold hover:bg-blue-500 transition-all shadow-lg shadow-blue-600/20">Cari di Kota Lain</a>
            </div>
            @endforelse
        </section>
    </section>
</div>
@endsection