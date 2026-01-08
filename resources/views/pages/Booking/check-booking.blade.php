@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<div class="w-full min-h-screen bg-[#0F172A] selection:bg-blue-500/30 overflow-x-hidden relative">
    
    <div class="absolute top-[-10%] right-[-10%] w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[10%] left-[-10%] w-[300px] h-[300px] bg-blue-400/5 rounded-full blur-[100px]"></div>

    <div id="PageWrapper" class="max-w-[640px] mx-auto min-h-screen pb-32 font-['Plus_Jakarta_Sans'] text-slate-200 relative z-10 animate-page-in">
        
        <div class="relative flex flex-col gap-4 pt-20 px-6 text-center" data-aos="fade-down">
            <div class="flex justify-center mb-2">
                <div class="w-16 h-16 bg-blue-600/20 rounded-[22px] border border-blue-500/30 flex items-center justify-center shadow-[0_0_30px_rgba(37,99,235,0.2)]">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
            <h1 class="font-[1000] text-3xl leading-tight text-white uppercase tracking-tighter">
                Check Your<br><span class="text-blue-500">Booking Details</span>
            </h1>
            <p class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">Masukkan detail pesanan Anda</p>
        </div>

        <div class="px-5 mt-12" data-aos="zoom-in-up" data-aos-delay="100">
            <form action="{{ route('check-booking.show') }}" method="POST"
                  class="flex flex-col rounded-[40px] border border-white/10 p-8 gap-8 bg-slate-800/40 backdrop-blur-xl shadow-2xl relative overflow-hidden">
                @csrf
                
                <div class="absolute top-0 left-0 w-full h-[2px] bg-gradient-to-r from-transparent via-blue-500/50 to-transparent"></div>

                <div class="flex flex-col gap-2">
                    <h2 class="font-black text-white text-sm uppercase tracking-widest flex items-center gap-2">
                        <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                        Verification
                    </h2>
                </div>

                <div id="InputContainer" class="flex flex-col gap-6">
                    <div class="group flex flex-col gap-2">
                        <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Booking ID</p>
                        <label class="flex items-center w-full rounded-[25px] p-4 gap-4 bg-slate-900/50 border border-white/5 focus-within:border-blue-500 focus-within:bg-blue-600/5 transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/note-favorite-grey.svg') }}" class="w-5 h-5 opacity-40 group-focus-within:opacity-100 transition-opacity" alt="icon">
                            <input type="text" name="code" class="bg-transparent outline-none w-full font-bold text-white placeholder:text-slate-600 text-sm" placeholder="Contoh: KOS-12345" value="{{ old('code') }}">
                        </label>
                        @error('code') <span class="text-[10px] text-red-500 font-bold uppercase ml-4 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="group flex flex-col gap-2">
                        <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Email Address</p>
                        <label class="flex items-center w-full rounded-[25px] p-4 gap-4 bg-slate-900/50 border border-white/5 focus-within:border-blue-500 focus-within:bg-blue-600/5 transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-5 h-5 opacity-40 group-focus-within:opacity-100 transition-opacity" alt="icon">
                            <input type="email" name="email" class="bg-transparent outline-none w-full font-bold text-white placeholder:text-slate-600 text-sm" placeholder="Email saat mendaftar" value="{{ old('email') }}">
                        </label>
                        @error('email') <span class="text-[10px] text-red-500 font-bold uppercase ml-4 mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="group flex flex-col gap-2">
                        <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Phone Number</p>
                        <label class="flex items-center w-full rounded-[25px] p-4 gap-4 bg-slate-900/50 border border-white/5 focus-within:border-blue-500 focus-within:bg-blue-600/5 transition-all duration-300">
                            <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-5 h-5 opacity-40 group-focus-within:opacity-100 transition-opacity" alt="icon">
                            <input type="tel" name="phone_number" class="bg-transparent outline-none w-full font-bold text-white placeholder:text-slate-600 text-sm" placeholder="Nomor WhatsApp" value="{{ old('phone_number') }}">
                        </label>
                        @error('phone_number') <span class="text-[10px] text-red-500 font-bold uppercase ml-4 mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if (session('error'))
                        <div class="p-4 rounded-2xl bg-red-500/10 border border-red-500/20 text-center text-red-400 text-[11px] font-black uppercase tracking-wider">
                            {{ session('error') }}
                        </div>
                    @endif

                    <button type="submit"
                            class="group relative w-full h-16 bg-blue-600 rounded-[22px] font-black text-white uppercase tracking-[0.2em] text-xs shadow-[0_20px_40px_rgba(37,99,235,0.3)] transition-all duration-300 hover:bg-blue-500 active:scale-95 flex items-center justify-center gap-3 overflow-hidden mt-4">
                        <span class="relative z-10">Track My Booking</span>
                        <svg class="w-5 h-5 relative z-10 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="fixed bottom-0 left-0 right-0 z-[100]">
        @include('includes.navigation')
    </div>
</div>

<style>
    /* Transisi Halaman */
    .animate-page-in {
        animation: pageIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes pageIn {
        from { opacity: 0; transform: translateY(20px); filter: blur(10px); }
        to { opacity: 1; transform: translateY(0); filter: blur(0); }
    }

    /* Override navigation style if needed to match dark theme */
    #Nav-Menu {
        background: rgba(15, 23, 42, 0.8) !important;
        backdrop-filter: blur(20px);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    ::-webkit-scrollbar { display: none; }
</style>

@endsection

@section('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-expo'
        });
    });
</script>
@endsection