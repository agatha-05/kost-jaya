@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Mengubah body agar full gelap, menghilangkan putih di kiri kanan */
    body { 
        background-color: #020617; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        margin: 0;
        padding: 0;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }

    /* Glassmorphism Effect untuk Dark Mode */
    .glass-card {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
</style>

<div class="max-w-[640px] mx-auto min-h-screen pb-40 bg-[#020617] relative">
    
    <header class="pt-10 px-6 flex justify-between items-start animate-card">
        <div class="flex flex-col">
            <span class="text-blue-400 text-xs font-extrabold uppercase tracking-[0.2em] mb-1">Premium Living</span>
            <h1 class="text-3xl font-extrabold text-white leading-tight">Cari Kos Modern<br><span class="text-blue-500">Tanpa Ribet.</span></h1>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-blue-600 flex items-center justify-center shadow-[0_10px_20px_rgba(37,99,235,0.3)]">
            <span class="text-white font-bold text-lg">A</span>
        </div>
    </header>

    <div class="mt-8 px-6 animate-card" style="animation-delay: 0.1s">
        <form action="{{ route('find-kos') }}" method="GET" class="relative group">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Mau ngekos di mana hari ini?" 
                class="w-full pl-12 pr-16 py-5 bg-slate-900/50 border-2 border-white/5 focus:border-blue-500 focus:bg-slate-900 rounded-[24px] text-white font-semibold placeholder-slate-500 transition-all outline-none shadow-sm">
            
            <button type="submit" class="absolute inset-y-2 right-2 px-5 bg-blue-600 text-white rounded-[20px] font-bold text-xs hover:bg-blue-500 transition-colors shadow-lg">
                Cari
            </button>
        </form>
    </div>

    <section class="mt-10 animate-card" style="animation-delay: 0.2s">
        <div class="px-6 flex items-center justify-between mb-5">
            <div class="flex flex-col">
                <h2 class="text-white font-extrabold text-xl tracking-tight">Kategori Hunian</h2>
                <div class="h-1 w-8 bg-blue-600 rounded-full mt-1"></div>
            </div>
            <a href="{{ route('all-categories') }}" class="text-blue-400 font-bold text-sm flex items-center gap-1 group/all">
                Lihat Semua 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover/all:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="flex overflow-x-auto gap-4 px-6 pb-6 no-scrollbar">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="flex-none group">
                <div class="relative w-32 h-40 glass-card rounded-[32px] overflow-hidden transition-all duration-500 group-hover:-translate-y-2 group-hover:shadow-[0_20px_30px_rgba(37,99,235,0.15)]">
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-white/5 rounded-full group-hover:bg-blue-500/10 transition-colors duration-500"></div>
                    <div class="relative h-full flex flex-col items-center justify-center p-4">
                        <div class="w-16 h-16 rounded-2xl bg-slate-800 flex items-center justify-center mb-4 group-hover:rotate-12 group-hover:scale-110 transition-all duration-500 shadow-sm">
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-10 h-10 object-contain brightness-110" alt="{{ $category->name }}">
                        </div>
                        <span class="text-slate-300 font-bold text-xs uppercase tracking-widest group-hover:text-blue-400 transition-colors text-center">
                            {{ $category->name }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <section class="mt-12 animate-card" style="animation-delay: 0.3s">
        <div class="flex justify-between items-center px-6 mb-6">
            <div class="flex flex-col">
                <h2 class="text-white font-extrabold text-2xl tracking-tight">Paling Banyak Dicari</h2>
                <div class="h-1.5 w-12 bg-gradient-to-r from-blue-600 to-blue-400 rounded-full mt-1"></div>
            </div>
            <a href="#" class="text-blue-400 text-xs font-bold uppercase tracking-widest hover:text-white transition-colors">Lihat Semua</a>
        </div>

        <div class="flex overflow-x-auto gap-7 px-6 pb-10 no-scrollbar items-center">
            @foreach($popularBoardingHouses as $kos)
            <a href="{{ route('kos.show', $kos->slug) }}" class="flex-none w-[280px] group relative">
                <div class="relative h-[400px] w-full rounded-[48px] overflow-hidden shadow-2xl transition-all duration-700 group-hover:-translate-y-3 border border-white/10">
                    
                    <img src="{{ asset('storage/' . $kos->thumbnail) }}" class="absolute w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110 opacity-90">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020617] via-[#020617]/20 to-black/30 group-hover:via-[#020617]/40 transition-all duration-500"></div>
                    
                    <div class="absolute top-6 left-6">
                        <div class="bg-blue-600/90 backdrop-blur-md px-4 py-2 rounded-2xl border border-white/20 flex items-center gap-2 shadow-lg">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                            </span>
                            <span class="text-white text-[10px] font-black uppercase tracking-widest">Terpopuler</span>
                        </div>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-8 transform transition-all duration-500">
                        <h3 class="text-white font-black text-2xl mb-2 leading-tight drop-shadow-lg group-hover:text-blue-400 transition-colors">
                            {{ $kos->name }}
                        </h3>
                        
                        <div class="flex items-center gap-2 text-slate-300 mb-6 font-medium">
                            <div class="p-1.5 bg-blue-500/20 rounded-lg backdrop-blur-sm border border-blue-500/20">
                                <svg class="w-3.5 h-3.5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <span class="text-xs tracking-wide shadow-sm">{{ $kos->city->name }}</span>
                        </div>

                        <div class="flex items-center justify-between gap-4 border-t border-white/10 pt-5">
                            <div class="flex flex-col">
                                <span class="text-slate-400 text-[9px] font-bold uppercase tracking-[0.15em]">Mulai dari</span>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-white font-black text-2xl tracking-tight">Rp {{ number_format($kos->price/1000) }}k</span>
                                    <span class="text-slate-400 text-[10px] font-medium">/bln</span>
                                </div>
                            </div>
                            
                            <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center transform scale-0 group-hover:scale-100 transition-all duration-500 shadow-[0_10px_20px_rgba(255,255,255,0.2)]">
                                <svg class="w-5 h-5 text-[#020617]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="absolute -z-10 bottom-0 left-1/2 -translate-x-1/2 w-[70%] h-10 bg-blue-600/30 blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            </a>
            @endforeach
        </div>
    </section>

    <section class="mt-12 px-6 animate-card" style="animation-delay: 0.4s">
        <div class="flex items-center justify-between mb-6">
            <div class="flex flex-col">
                <h2 class="text-white font-extrabold text-2xl tracking-tight">Kota Favorit</h2>
                <div class="h-1.5 w-10 bg-gradient-to-r from-blue-600 to-transparent rounded-full mt-1"></div>
            </div>
            <span class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em]">Destinasi Populer</span>
        </div>

        <div class="grid grid-cols-2 gap-5">
            @foreach($cities as $city)
            <a href="{{ route('city.show', $city->slug) }}" class="group relative h-36 rounded-[35px] overflow-hidden border border-white/5 shadow-2xl transition-all duration-500 hover:-translate-y-1">
                
                <img src="{{ asset('storage/' . $city->image) }}" 
                     class="w-full h-full object-cover transition-transform duration-[1.5s] group-hover:scale-125 brightness-[0.7] group-hover:brightness-[0.5]">
                
                <div class="absolute inset-0 bg-gradient-to-t from-[#020617] via-[#020617]/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <div class="absolute inset-0 flex flex-col items-center justify-center p-4">
                    <span class="text-white font-black text-sm uppercase tracking-[0.25em] drop-shadow-[0_5px_15px_rgba(0,0,0,0.5)] group-hover:text-blue-400 transition-colors duration-300">
                        {{ $city->name }}
                    </span>
                    
                    <div class="w-0 h-0.5 bg-blue-500 mt-2 group-hover:w-8 transition-all duration-500 rounded-full"></div>
                </div>

                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 shadow-[inset_0_0_40px_rgba(37,99,235,0.2)]"></div>
            </a>
            @endforeach
        </div>
    </section>
    
    <section id="AllKos" class="mt-12 px-6 animate-card" style="animation-delay: 0.5s">
        <div class="flex items-center justify-between mb-8">
            <div class="flex flex-col">
                <h2 class="text-white font-extrabold text-2xl tracking-tight">Pilihan Terbaik</h2>
                <p class="text-slate-500 text-xs font-semibold mt-1">Hunian eksklusif khusus untuk Anda</p>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            @foreach($boardingHouse as $item)
            <a href="{{ route('kos.show', $item->slug) }}" class="group relative flex flex-col sm:flex-row items-center p-3 glass-card rounded-[40px] border border-transparent hover:border-blue-500/30 transition-all duration-500 hover:shadow-[0_30px_60px_rgba(37,99,235,0.1)]">
                <div class="relative w-full sm:w-32 h-32 rounded-[32px] overflow-hidden shrink-0 shadow-md">
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-all duration-700 group-hover:scale-110">
                    <div class="absolute top-2 left-2">
                        <span class="bg-blue-600/60 backdrop-blur-md text-white text-[8px] font-bold px-2 py-1 rounded-lg uppercase tracking-tighter">Verified</span>
                    </div>
                </div>
                <div class="flex-1 px-5 py-2 w-full">
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-white font-extrabold text-lg group-hover:text-blue-400 transition-colors line-clamp-1">
                            {{ $item->name }}
                        </h3>
                        <div class="flex items-center gap-1 bg-slate-800 px-2 py-1 rounded-lg">
                            <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-[10px] font-bold text-white">4.8</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 text-slate-500 text-[11px] font-bold uppercase tracking-wide mb-3">
                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $item->city->name }}
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <p class="text-blue-400 font-black text-xl leading-none">
                            Rp {{ number_format($item->price/1000) }}k <span class="text-[10px] text-slate-500 font-medium uppercase tracking-tighter">/ bln</span>
                        </p>
                    </div>
                </div>
                <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center shadow-xl opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    @include('includes.navigation')

</div>
@endsection