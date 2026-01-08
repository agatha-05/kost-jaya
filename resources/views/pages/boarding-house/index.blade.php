@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { 
        background-color: #020617; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        color: #F8FAFC;
    }

    /* Animasi muncul dari bawah */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fadeInUp 0.6s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        opacity: 0;
    }

    .glass-card {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Glow Effect Background */
    .glow-spot {
        position: absolute;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.15) 0%, rgba(2, 6, 23, 0) 70%);
        border-radius: 50%;
        z-index: 0;
    }
</style>

<div class="max-w-[640px] mx-auto min-h-screen pb-20 bg-[#020617] relative overflow-hidden">
    <div class="glow-spot -top-20 -right-20"></div>
    <div class="glow-spot top-1/2 -left-40"></div>

    <div id="TopNav" class="relative flex items-center justify-between px-6 mt-10 animate-fade-in" style="animation-delay: 0.1s">
        <a href="{{ route('find-kos') }}" class="w-12 h-12 flex items-center justify-center shrink-0 rounded-2xl bg-slate-900 border border-white/10 text-white hover:bg-blue-600 transition-all duration-300 shadow-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <p class="font-bold text-lg tracking-tight">Search Results</p> 
        <div class="w-12"></div> </div>

    <div id="Header" class="relative flex flex-col gap-2 px-6 mt-8 animate-fade-in" style="animation-delay: 0.2s">
        <div class="flex items-end gap-3">
            <h1 class="font-extrabold text-4xl text-white tracking-tighter">Hasil Cari</h1>
            <div class="h-2 w-2 rounded-full bg-blue-500 mb-3 animate-pulse"></div>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold uppercase tracking-widest">
                {{ $boardingHouses->count() }} Kos Tersedia
            </span>
        </div>
    </div>

    <section id="Results" class="relative flex flex-col gap-5 px-6 mt-8 mb-10">
        @forelse ($boardingHouses as $index => $boardingHouse)
        <a href="{{ route('kos.show', $boardingHouse->slug) }}" 
           class="animate-fade-in group" 
           style="animation-delay: {{ 0.3 + ($index * 0.1) }}s">
            
            <div class="glass-card rounded-[40px] p-4 flex gap-5 transition-all duration-500 group-hover:border-blue-500/40 group-hover:bg-slate-800/60 group-hover:-translate-y-1 shadow-2xl">
                
                <div class="relative flex w-[130px] h-[170px] shrink-0 rounded-[32px] overflow-hidden shadow-inner">
                    <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                         alt="thumbnail">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent"></div>
                    
                    <div class="absolute bottom-3 left-0 right-0 text-center">
                        <span class="text-[10px] font-bold text-white bg-blue-600/80 backdrop-blur-sm px-2 py-1 rounded-lg">Verified</span>
                    </div>
                </div>

                <div class="flex flex-col justify-between py-1 w-full">
                    <div class="flex flex-col gap-2">
                        <h3 class="font-bold text-xl leading-tight text-white group-hover:text-blue-400 transition-colors line-clamp-2">
                            {{ $boardingHouse->name }}
                        </h3>
                        
                        <div class="flex flex-col gap-2 mt-1">
                            <div class="flex items-center gap-2 text-slate-400">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                                <p class="text-xs font-semibold tracking-wide uppercase">{{ $boardingHouse->city->name }}</p>
                            </div>
                            <div class="flex items-center gap-2 text-slate-400">
                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <p class="text-xs font-semibold">{{ $boardingHouse->capacity }} Orang</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex flex-col">
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Harga</p>
                            <p class="font-black text-xl text-blue-400">
                                Rp {{ number_format($boardingHouse->price/1000, 0) }}k<span class="text-xs text-slate-500 font-medium">/bln</span>
                            </p>
                        </div>
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center translate-x-4 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500 shadow-[0_0_20px_rgba(37,99,235,0.4)]">
                            <svg class="w-5 h-5 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        @empty
        <div class="flex flex-col items-center justify-center py-20 animate-fade-in">
            <div class="w-24 h-24 bg-slate-900 rounded-full flex items-center justify-center mb-4 border border-white/5 shadow-2xl">
                <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <p class="text-slate-400 font-bold">Maaf, kos tidak ditemukan.</p>
            <a href="{{ route('find-kos') }}" class="mt-4 text-blue-500 font-bold hover:underline">Cari lagi</a>
        </div>
        @endforelse
    </section>
</div>

@include('includes.navigation')

@endsection