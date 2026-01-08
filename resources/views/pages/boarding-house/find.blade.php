@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<div class="min-h-screen bg-[#020617] text-slate-300 pb-20 overflow-x-hidden font-sans">
    
    <div class="fixed top-[-10%] left-[-10%] w-[50%] h-[50%] bg-blue-900/20 blur-[120px] rounded-full"></div>

    <div class="relative flex flex-col gap-10 pt-16 px-5 max-w-lg mx-auto">
        
        <div class="flex flex-col gap-3 items-center text-center" data-aos="fade-down">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-500/10 border border-blue-500/20 mb-2">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                </span>
                <p class="text-[10px] font-bold text-blue-400 uppercase tracking-[0.2em]">Premium Selection</p>
            </div>
            <h1 class="font-black text-4xl leading-tight text-white tracking-tight">
                Find Your <br>
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-indigo-400">Dream Living</span>
            </h1>
        </div>

        <form action="{{ route('find-kos.results') }}" 
              class="relative flex flex-col rounded-[40px] border border-white/10 p-8 gap-6 bg-slate-900/40 backdrop-blur-2xl shadow-2xl"
              data-aos="zoom-in">
            
            <div id="InputContainer" class="flex flex-col gap-6">
                
                <div class="flex flex-col w-full gap-3 group">
                    <p class="font-bold text-xs text-slate-500 uppercase tracking-widest ml-1">Koskos Name</p>
                    <div class="flex items-center w-full rounded-2xl p-4 gap-4 bg-slate-800/40 border border-white/5 group-focus-within:border-blue-500/50 transition-all">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" class="outline-none w-full bg-transparent font-semibold text-white placeholder:text-slate-600" placeholder="Type name...">
                    </div>
                </div>

                <div class="flex flex-col w-full gap-3 group">
                    <p class="font-bold text-xs text-slate-500 uppercase tracking-widest ml-1">Location</p>
                    <div class="relative flex items-center w-full rounded-2xl p-4 gap-4 bg-slate-800/40 border border-white/5 group-focus-within:border-blue-500/50 transition-all">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <select name="city" class="appearance-none outline-none w-full bg-transparent font-semibold text-white cursor-pointer z-10">
                            <option value="" class="bg-[#020617]">Select City</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}" class="bg-[#020617]">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-3 group">
                    <p class="font-bold text-xs text-slate-500 uppercase tracking-widest ml-1">Type & Category</p>
                    <div class="relative flex items-center w-full rounded-2xl p-4 gap-4 bg-slate-800/40 border border-white/5 group-focus-within:border-blue-500/50 transition-all">
                        <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <select name="category" class="appearance-none outline-none w-full bg-transparent font-semibold text-white cursor-pointer z-10">
                            <option value="" class="bg-[#020617]">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" class="bg-[#020617]">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 ml-auto text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-3">
                    <p class="font-bold text-xs text-slate-500 uppercase tracking-widest ml-1">Monthly Budget</p>
                    <div class="flex gap-4">
                        <div class="flex-1 relative group">
                            <input type="number" name="min_price" placeholder="Min" class="w-full rounded-xl p-3 pl-10 bg-slate-800/30 border border-white/5 focus:border-blue-500/50 outline-none text-sm font-bold text-white transition-all">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-black text-blue-500">RP</span>
                        </div>
                        <div class="flex-1 relative group">
                            <input type="number" name="max_price" placeholder="Max" class="w-full rounded-xl p-3 pl-10 bg-slate-800/30 border border-white/5 focus:border-blue-500/50 outline-none text-sm font-bold text-white transition-all">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-black text-blue-500">RP</span>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="mt-4 flex w-full justify-center items-center gap-3 rounded-2xl py-5 bg-blue-600 hover:bg-blue-500 text-white font-black uppercase tracking-widest text-xs transition-all active:scale-95 shadow-[0_20px_40px_rgba(37,99,235,0.3)]">
                    Explore Results
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>
        </form>
    </div>

    @include('includes.navigation')
</div>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true });
    });
</script>
@endsection