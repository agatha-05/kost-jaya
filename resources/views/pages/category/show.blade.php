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
            <p class="font-bold text-white text-lg tracking-tight">Kategori Hunian</p> 
            <div class="w-12"></div>
        </div>

        <div id="Header" class="relative flex items-center justify-between px-6 mt-10 animate-up" style="animation-delay: 0.1s">
            <div class="flex flex-col gap-2">
                <div class="flex items-center gap-3">
                    <h1 class="font-extrabold text-3xl text-white tracking-tighter">Kos {{ $category->name }}</h1>
                    <div class="h-2 w-2 rounded-full bg-blue-500 animate-pulse"></div>
                </div>
                <p class="text-slate-400 font-medium tracking-tight">Menampilkan {{ $boardingHouses->count() }} pilihan terbaik</p>
            </div>
            
            <div class="flex flex-col items-center p-3 rounded-[24px] glass-card border-blue-500/20 shadow-xl">
                <svg class="w-5 h-5 text-yellow-500 mb-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <p class="font-black text-white text-[10px] uppercase tracking-tighter">Premium</p>
            </div>
        </div>

        <section id="Result" class="relative flex flex-col gap-6 px-6 mt-10 mb-10">
            @forelse ($boardingHouses as $index => $boardingHouse)
            <a href="{{ route('kos.show', $boardingHouse->slug) }}" 
               class="animate-up group" 
               style="animation-delay: {{ 0.2 + ($index * 0.1) }}s">
                
                <div class="glass-card rounded-[40px] p-4 flex gap-5 transition-all duration-500 group-hover:border-blue-500/40 group-hover:bg-slate-800/60 group-hover:-translate-y-2 shadow-xl">
                    
                    <div class="relative flex w-[130px] h-[175px] shrink-0 rounded-[32px] overflow-hidden">
                        <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                             alt="thumbnail">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 to-transparent"></div>
                        <div class="absolute bottom-3 left-0 right-0 flex justify-center">
                            <span class="text-[9px] font-black text-white bg-blue-600 px-3 py-1 rounded-full uppercase tracking-tighter shadow-lg">Verified</span>
                        </div>
                    </div>

                    <div class="flex flex-col justify-between py-1 w-full">
                        <div>
                            <h3 class="font-bold text-xl leading-tight text-white group-hover:text-blue-400 transition-colors line-clamp-2">
                                {{ $boardingHouse->name }}
                            </h3>
                            
                            <div class="flex flex-col gap-2 mt-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                    </div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">{{ $boardingHouse->city->name }}</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg bg-blue-500/10 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <p class="text-[11px] font-bold uppercase tracking-wide text-slate-400">{{ $boardingHouse->capacity }} Orang</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-4">
                            <div class="flex flex-col">
                                <span class="text-[9px] text-slate-500 font-black uppercase tracking-[0.1em]">Mulai dari</span>
                                <p class="font-black text-2xl text-blue-400 tracking-tight leading-none">
                                    Rp {{ number_format($boardingHouse->price/1000, 0) }}k<span class="text-[10px] text-slate-500 font-medium">/bln</span>
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
            <div class="flex flex-col items-center justify-center py-20 animate-up text-center">
                <div class="w-24 h-24 bg-slate-900 rounded-full flex items-center justify-center mb-6 border border-white/5">
                    <svg class="w-12 h-12 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white mb-2">Belum Ada Kos</h2>
                <a href="{{ route('home') }}" class="px-8 py-4 bg-blue-600 text-white rounded-2xl font-bold">Kembali</a>
            </div>
            @endforelse
        </section>
    </div>
</div>
@endsection