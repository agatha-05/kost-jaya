@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<div class="w-full min-h-screen bg-[#0F172A] selection:bg-blue-500/30">
    
    <div id="PageWrapper" class="max-w-[640px] mx-auto min-h-screen pb-32 font-['Plus_Jakarta_Sans'] text-slate-200 relative overflow-hidden animate-page-in">
        
        <div class="absolute top-[-10%] left-[-20%] w-[300px] h-[300px] bg-blue-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[20%] right-[-20%] w-[250px] h-[250px] bg-blue-400/5 rounded-full blur-[100px]"></div>

        <div id="TopNav" class="relative flex items-center justify-between px-6 pt-12 pb-6 z-50" data-aos="fade-down">
            <a href="{{ route('kos.show', $boardingHouse->slug) }}" 
               class="page-link group w-12 h-12 flex items-center justify-center rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:bg-blue-600 transition-all duration-300">
                <svg class="w-6 h-6 text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <p class="font-black uppercase tracking-[0.2em] text-[11px] text-slate-400">Choose Available Room</p>
            <div class="w-12"></div>
        </div>

        <div id="Header" class="relative px-5 mb-10" data-aos="zoom-in-up" data-aos-delay="100">
            <div class="relative overflow-hidden group rounded-[35px] bg-slate-800/40 p-4 border border-white/10 backdrop-blur-xl shadow-2xl">
                <div class="flex gap-5 relative z-10">
                    <div class="w-[100px] h-[110px] shrink-0 rounded-[25px] overflow-hidden border border-white/5">
                        <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" alt="thumbnail">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="font-black text-lg text-white leading-tight mb-2 uppercase tracking-tight line-clamp-2">
                            {{ $boardingHouse->name }}
                        </h1>
                        <div class="flex flex-col gap-1">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">{{ $boardingHouse->city->name }}</p>
                            </div>
                            <p class="text-[10px] font-black text-blue-400 uppercase tracking-tighter">{{ $boardingHouse->category->name }} Exclusive</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('booking', $boardingHouse->slug) }}" class="relative flex flex-col gap-6 px-5 pb-20">
            @csrf
            <input type="hidden" name="boarding_house_id" value="{{ $boardingHouse->id }}">
            
            <div class="flex items-center justify-between mb-2" data-aos="fade-right" data-aos-delay="200">
                <h2 class="font-black text-white uppercase tracking-[0.15em] text-sm flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-blue-500"></span>
                    Available Rooms
                </h2>
            </div>

            <div id="RoomsContainer" class="flex flex-col gap-5">
                @foreach ($boardingHouse->rooms as $index => $room)
                <label class="relative group cursor-pointer block" data-aos="fade-up" data-aos-delay="{{ 300 + ($index * 100) }}">
                    <input type="radio" name="room_id" class="peer absolute opacity-0" value="{{ $room->id }}" required>
                    
                    <div class="relative overflow-hidden rounded-[35px] bg-slate-800/30 border border-white/5 p-4 transition-all duration-500 
                                peer-checked:bg-blue-600/20 peer-checked:border-blue-500 peer-checked:shadow-[0_0_30px_rgba(59,130,246,0.2)]
                                hover:bg-slate-800/50 group-active:scale-[0.98]">
                        
                        <div class="flex gap-4">
                            <div class="relative w-[130px] h-[160px] shrink-0 rounded-[28px] overflow-hidden">
                                <img src="{{ asset('storage/' . $room->roomimages->first()->image) }}" 
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" alt="room">
                            </div>

                            <div class="flex flex-col justify-between py-1 w-full">
                                <div>
                                    <h3 class="font-black text-white text-lg leading-tight uppercase mb-3 transition-colors peer-checked:text-blue-400">
                                        {{ $room->name }}
                                    </h3>
                                    
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-3 text-slate-400">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                                            <span class="text-[11px] font-bold uppercase tracking-wider">{{ $room->capacity }} People</span>
                                        </div>
                                        <div class="flex items-center gap-3 text-slate-400">
                                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                            <span class="text-[11px] font-bold uppercase tracking-wider">{{ $room->square_feet }} SQFT</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 flex items-baseline gap-1">
                                    <span class="text-xl font-[1000] text-white">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}</span>
                                    <span class="text-[10px] font-bold text-slate-500 uppercase">/bln</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>
                @endforeach
            </div>

            <div id="BottomButton" class="fixed bottom-8 left-0 right-0 px-6 z-[100] w-full max-w-[640px] mx-auto">
                <button type="submit" 
                        class="group relative w-full h-16 bg-blue-600 rounded-[22px] font-black text-white uppercase tracking-[0.2em] text-xs shadow-[0_20px_40px_rgba(37,99,235,0.3)] transition-all duration-300 hover:bg-blue-500 active:scale-95 flex items-center justify-center gap-3 overflow-hidden">
                    <span class="relative z-10">Continue Booking</span>
                    <svg class="w-5 h-5 relative z-10 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Tambahan agar body tidak ada margin putih */
    body { background-color: #0F172A; margin: 0; padding: 0; }

    /* Transisi Antar Halaman */
    .animate-page-in {
        animation: pageIn 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .animate-page-out {
        animation: pageOut 0.6s cubic-bezier(0.7, 0, 0.84, 0) forwards;
    }

    @keyframes pageIn {
        from { opacity: 0; transform: scale(1.02) translateY(10px); filter: blur(4px); }
        to { opacity: 1; transform: scale(1) translateY(0); filter: blur(0); }
    }
    @keyframes pageOut {
        from { opacity: 1; transform: scale(1) translateY(0); filter: blur(0); }
        to { opacity: 0; transform: scale(0.98) translateY(-10px); filter: blur(4px); }
    }

    /* Scrollbar Hidden */
    ::-webkit-scrollbar { display: none; }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-quad'
        });

        const pageWrapper = document.getElementById('PageWrapper');
        
        document.querySelectorAll('.page-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.href;
                pageWrapper.classList.add('animate-page-out');
                setTimeout(() => {
                    window.location.href = target;
                }, 400);
            });
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            // Animasi keluar saat lanjut booking
            pageWrapper.classList.add('animate-page-out');
        });
    });
</script>
@endsection