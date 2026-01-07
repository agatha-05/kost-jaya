@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { 
        background-color: #F8FAFC; 
        font-family: 'Plus Jakarta Sans', sans-serif; 
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-card { animation: slideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; }
</style>

<div class="max-w-[640px] mx-auto min-h-screen pb-40 bg-white shadow-2xl relative">
    
    <header class="pt-10 px-6 flex justify-between items-start animate-card">
        <div class="flex flex-col">
            <span class="text-[#7C9ED9] text-xs font-extrabold uppercase tracking-[0.2em] mb-1">Premium Living</span>
            <h1 class="text-3xl font-extrabold text-[#003153] leading-tight">Cari Kos Modern<br>Tanpa Ribet.</h1>
        </div>
        <div class="w-12 h-12 rounded-2xl bg-[#0076B6] flex items-center justify-center shadow-[0_10px_20px_rgba(0,118,182,0.3)]">
            <span class="text-white font-bold text-lg">A</span>
        </div>
    </header>

    <div class="mt-8 px-6 animate-card" style="animation-delay: 0.1s">
        <form action="{{ route('find-kos') }}" method="GET" class="relative group">
            <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-[#7C9ED9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Mau ngekos di mana hari ini?" 
                class="w-full pl-12 pr-16 py-5 bg-[#F8FAFC] border-2 border-transparent focus:border-[#0076B6] focus:bg-white rounded-[24px] text-[#003153] font-semibold placeholder-[#7C9ED9] transition-all outline-none shadow-sm">
            
            <button type="submit" class="absolute inset-y-2 right-2 px-5 bg-[#0076B6] text-white rounded-[20px] font-bold text-xs hover:bg-[#00356B] transition-colors shadow-lg">
                Cari
            </button>
        </form>
    </div>

    <section class="mt-10 animate-card" style="animation-delay: 0.2s">
        <div class="px-6 flex items-center justify-between mb-5">
            <div class="flex flex-col">
                <h2 class="text-[#003153] font-extrabold text-xl tracking-tight">Kategori Hunian</h2>
                <div class="h-1 w-8 bg-[#0076B6] rounded-full mt-1"></div>
            </div>
            <a href="{{ route('all-categories') }}" class="text-[#0076B6] font-bold text-sm flex items-center gap-1 group/all">
                Lihat Semua 
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover/all:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="flex overflow-x-auto gap-4 px-6 pb-6 no-scrollbar">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}" class="flex-none group">
                <div class="relative w-32 h-40 bg-white rounded-[32px] overflow-hidden border border-[#7C9ED9]/20 shadow-[0_4px_15px_rgba(0,53,107,0.03)] group-hover:shadow-[0_20px_30px_rgba(0,118,182,0.15)] transition-all duration-500 group-hover:-translate-y-2">
                    <div class="absolute -top-4 -right-4 w-16 h-16 bg-[#F8FAFC] rounded-full group-hover:bg-[#0076B6]/10 transition-colors duration-500"></div>
                    <div class="relative h-full flex flex-col items-center justify-center p-4">
                        <div class="w-16 h-16 rounded-2xl bg-[#F8FAFC] flex items-center justify-center mb-4 group-hover:rotate-12 group-hover:scale-110 transition-all duration-500 shadow-sm group-hover:shadow-[#0076B6]/20">
                            <img src="{{ asset('storage/' . $category->image) }}" class="w-10 h-10 object-contain" alt="{{ $category->name }}">
                        </div>
                        <span class="text-[#003153] font-bold text-xs uppercase tracking-widest group-hover:text-[#0076B6] transition-colors text-center">
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
                <h2 class="text-[#003153] font-extrabold text-2xl tracking-tight">Paling Banyak Dicari</h2>
                <div class="h-1.5 w-12 bg-gradient-to-r from-[#0076B6] to-[#7C9ED9] rounded-full mt-1"></div>
            </div>
            <a href="#" class="group/btn flex items-center gap-2 text-[#0076B6] font-bold text-sm bg-[#0076B6]/5 px-4 py-2 rounded-full hover:bg-[#0076B6] hover:text-white transition-all duration-300">
                Lihat Semua
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>

        <div class="flex overflow-x-auto gap-7 px-6 pb-10 no-scrollbar items-center">
            @foreach($popularBoardingHouses as $kos)
            <a href="{{ route('kos.show', $kos->slug) }}" class="flex-none w-[300px] group relative">
                <div class="relative h-[420px] w-full rounded-[48px] overflow-hidden shadow-[0_20px_50px_rgba(0,53,107,0.15)] transition-all duration-700 group-hover:shadow-[0_30px_60px_rgba(0,118,182,0.25)] group-hover:-translate-y-2">
                    <img src="{{ asset('storage/' . $kos->thumbnail) }}" class="absolute w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#003153] via-[#003153]/20 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>
                    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-transparent to-transparent opacity-50"></div>
                    <div class="absolute top-6 left-6 flex gap-2">
                        <div class="bg-white/20 backdrop-blur-xl px-4 py-2 rounded-2xl border border-white/30 flex items-center gap-2">
                            <span class="relative flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#0076B6] opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-[#0076B6]"></span>
                            </span>
                            <span class="text-white text-[10px] font-black uppercase tracking-widest">Terpopuler</span>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-8 transform transition-transform duration-500 group-hover:translate-y-[-10px]">
                        <h3 class="text-white font-black text-2xl mb-2 leading-tight drop-shadow-lg group-hover:text-[#7C9ED9] transition-colors">
                            {{ $kos->name }}
                        </h3>
                        <div class="flex items-center gap-2 text-white/80 mb-6 drop-shadow-md font-medium">
                            <div class="p-1.5 bg-white/10 rounded-lg backdrop-blur-sm">
                                <svg class="w-4 h-4 text-[#7C9ED9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <span class="text-xs tracking-wide">{{ $kos->city->name }}</span>
                        </div>
                        <div class="flex items-center justify-between gap-4">
                            <div class="flex flex-col">
                                <span class="text-white/50 text-[10px] font-bold uppercase tracking-widest">Start from</span>
                                <div class="flex items-baseline gap-1">
                                    <span class="text-white font-black text-2xl">Rp {{ number_format($kos->price/1000) }}k</span>
                                    <span class="text-white/60 text-xs font-medium">/bln</span>
                                </div>
                            </div>
                            <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center transform scale-0 group-hover:scale-100 transition-all duration-500 shadow-xl">
                                <svg class="w-6 h-6 text-[#003153]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -z-10 bottom-[-15px] left-1/2 -translate-x-1/2 w-[80%] h-10 bg-[#0076B6]/20 blur-2xl rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            </a>
            @endforeach
        </div>
    </section>

    <section class="mt-8 px-6 animate-card" style="animation-delay: 0.4s">
        <h2 class="text-[#003153] font-extrabold text-xl mb-6">Kota Favorit</h2>
        <div class="grid grid-cols-2 gap-4">
            @foreach($cities as $city)
            <a href="{{ route('city.show', $city->slug) }}" class="relative h-32 rounded-[30px] overflow-hidden group shadow-md">
                <img src="{{ asset('storage/' . $city->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-125">
                <div class="absolute inset-0 bg-[#00356B]/40 group-hover:bg-[#0076B6]/60 transition-all duration-500 flex items-center justify-center">
                    <span class="text-white font-extrabold text-sm uppercase tracking-widest">{{ $city->name }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    <section id="AllKos" class="mt-12 px-6 animate-card" style="animation-delay: 0.5s">
        <div class="flex items-center justify-between mb-8">
            <div class="flex flex-col">
                <h2 class="text-[#003153] font-extrabold text-2xl tracking-tight">Pilihan Terbaik</h2>
                <p class="text-[#7C9ED9] text-xs font-semibold mt-1">Hunian eksklusif khusus untuk Anda</p>
            </div>
            <div class="w-10 h-10 bg-[#F8FAFC] rounded-xl flex items-center justify-center border border-[#7C9ED9]/20">
                <svg class="w-5 h-5 text-[#003153]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                </svg>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            @foreach($boardingHouse as $item)
            <a href="{{ route('kos.show', $item->slug) }}" class="group relative flex flex-col sm:flex-row items-center p-3 bg-white rounded-[40px] border border-transparent hover:border-[#7C9ED9]/30 transition-all duration-500 hover:shadow-[0_30px_60px_rgba(0,53,107,0.1)]">
                <div class="relative w-full sm:w-32 h-32 rounded-[32px] overflow-hidden shrink-0 shadow-md">
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute top-2 left-2">
                        <span class="bg-[#003153]/60 backdrop-blur-md text-white text-[8px] font-bold px-2 py-1 rounded-lg uppercase tracking-tighter">Verified</span>
                    </div>
                </div>
                <div class="flex-1 px-5 py-2 w-full">
                    <div class="flex justify-between items-start mb-1">
                        <h3 class="text-[#003153] font-extrabold text-lg group-hover:text-[#0076B6] transition-colors line-clamp-1">
                            {{ $item->name }}
                        </h3>
                        <div class="flex items-center gap-1 bg-[#F8FAFC] px-2 py-1 rounded-lg">
                            <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-[10px] font-bold text-[#003153]">4.8</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1.5 text-[#7C9ED9] text-[11px] font-bold uppercase tracking-wide mb-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $item->city->name }}
                    </div>
                    <div class="flex items-center justify-between mt-auto">
                        <p class="text-[#0076B6] font-black text-xl leading-none">
                            Rp {{ number_format($item->price/1000) }}k <span class="text-[10px] text-[#7C9ED9] font-medium uppercase tracking-tighter">/ bln</span>
                        </p>
                        <div class="flex gap-2 opacity-60 group-hover:opacity-100 transition-opacity">
                            <div class="p-1.5 bg-[#F8FAFC] rounded-lg">
                                <img src="{{ asset('assets/images/icons/wifi.svg') }}" class="w-3 h-3 grayscale group-hover:grayscale-0 transition-all">
                            </div>
                            <div class="p-1.5 bg-[#F8FAFC] rounded-lg">
                                <img src="{{ asset('assets/images/icons/air-conditioner.svg') }}" class="w-3 h-3 grayscale group-hover:grayscale-0 transition-all">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute -right-2 top-1/2 -translate-y-1/2 w-12 h-12 bg-[#003153] rounded-2xl flex items-center justify-center shadow-xl opacity-0 translate-x-4 group-hover:opacity-100 group-hover:translate-x-0 transition-all duration-500">
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