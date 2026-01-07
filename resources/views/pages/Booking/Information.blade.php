@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<div class="w-full min-h-screen bg-[#0F172A] selection:bg-blue-500/30 overflow-x-hidden">
    
    <div id="PageWrapper" class="max-w-[640px] mx-auto min-h-screen pb-32 font-['Plus_Jakarta_Sans'] text-slate-200 relative animate-page-in">
        
        <div class="absolute top-[-5%] left-[-10%] w-[300px] h-[300px] bg-blue-600/10 rounded-full blur-[120px]"></div>

        <div id="TopNav" class="relative flex items-center justify-between px-6 pt-12 pb-6 z-50" data-aos="fade-down">
            <a href="{{ Route('kos.rooms', $boardingHouse->slug) }}" 
               class="page-link group w-12 h-12 flex items-center justify-center rounded-2xl bg-white/5 border border-white/10 backdrop-blur-md hover:bg-blue-600 transition-all duration-300">
                <svg class="w-6 h-6 text-white group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <p class="font-black uppercase tracking-[0.2em] text-[11px] text-slate-400">Customer Information</p>
            <div class="w-12"></div>
        </div>

        <div id="Header" class="relative px-5 mb-8" data-aos="zoom-in-up" data-aos-delay="100">
            <div class="relative overflow-hidden rounded-[35px] bg-slate-800/40 p-5 border border-white/10 backdrop-blur-xl shadow-2xl">
                <div class="flex gap-4 mb-4">
                    <div class="w-20 h-20 shrink-0 rounded-[20px] overflow-hidden border border-white/5">
                        <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" class="w-full h-full object-cover" alt="thumbnail">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="font-bold text-white text-base leading-tight uppercase tracking-tight line-clamp-1">
                            {{ $boardingHouse->name }}
                        </h1>
                        <p class="text-[10px] font-bold text-blue-400 uppercase mt-1 tracking-widest">{{ $boardingHouse->city->name }} • {{ $boardingHouse->category->name }}</p>
                    </div>
                </div>
                
                <div class="h-[1px] w-full bg-gradient-to-r from-transparent via-white/10 to-transparent my-4"></div>

                <div class="flex gap-4">
                    <div class="w-20 h-24 shrink-0 rounded-[20px] overflow-hidden border border-white/5">
                        <img src="{{ asset('storage/' . $room->roomimages->first()->image) }}" class="w-full h-full object-cover" alt="room">
                    </div>
                    <div class="flex flex-col justify-center flex-1">
                        <h2 class="font-black text-white text-sm uppercase leading-tight">{{ $room->name }}</h2>
                        <div class="flex gap-3 mt-2">
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter flex items-center gap-1">
                                <svg class="w-3 h-3 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857"/></svg>
                                {{ $room->capacity }} Ppl
                            </span>
                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-tighter flex items-center gap-1">
                                <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                {{ $room->square_feet }} SQFT
                            </span>
                        </div>
                        <p class="text-blue-400 font-black text-sm mt-2">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}<span class="text-[10px] text-slate-500 font-bold">/bln</span></p>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('booking.information.save', $boardingHouse->slug) }}" method="POST" class="relative">
            @csrf
            
            <div class="px-6 mb-6" data-aos="fade-right" data-aos-delay="200">
                <h3 class="font-black text-white uppercase tracking-[0.15em] text-sm flex items-center gap-3">
                    <span class="w-8 h-[2px] bg-blue-500"></span>
                    Your Information
                </h3>
                <p class="text-xs text-slate-500 font-bold uppercase mt-1">Lengkapi data diri untuk reservasi</p>
            </div>

            <div id="InputContainer" class="flex flex-col gap-6 px-5 mb-10">
                <div class="group flex flex-col gap-2" data-aos="fade-up" data-aos-delay="300">
                    <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Complete Name</p>
                    <label class="flex items-center w-full rounded-[25px] p-4 gap-4 bg-slate-800/30 border border-white/5 focus-within:border-blue-500 focus-within:bg-blue-600/5 focus-within:shadow-[0_0_20px_rgba(59,130,246,0.1)] transition-all duration-300">
                        <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-5 h-5 opacity-40 group-focus-within:opacity-100 transition-opacity" alt="icon">
                        <input type="text" name="name" class="bg-transparent outline-none w-full font-bold text-white placeholder:text-slate-600 placeholder:font-medium text-sm" placeholder="Write your full name" value="{{ old('name') }}">
                    </label>
                    @error('name') <span class="text-[10px] text-red-500 font-bold uppercase ml-4 mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="group flex flex-col gap-2" data-aos="fade-up" data-aos-delay="400">
                    <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Email Address</p>
                    <label class="flex items-center w-full rounded-[25px] p-4 gap-4 bg-slate-800/30 border border-white/5 focus-within:border-blue-500 focus-within:bg-blue-600/5 transition-all duration-300">
                        <img src="{{ asset('assets/images/icons/sms.svg') }}" class="w-5 h-5 opacity-40 group-focus-within:opacity-100" alt="icon">
                        <input type="email" name="email" class="bg-transparent outline-none w-full font-bold text-white placeholder:text-slate-600 text-sm" placeholder="Email for confirmation" value="{{ old('email') }}">
                    </label>
                </div>

                <div class="group flex flex-col gap-2" data-aos="fade-up" data-aos-delay="500">
                    <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Phone No</p>
                    <label class="flex items-center w-full rounded-[25px] p-4 gap-4 bg-slate-800/30 border border-white/5 focus-within:border-blue-500 focus-within:bg-blue-600/5 transition-all duration-300">
                        <img src="{{ asset('assets/images/icons/call.svg') }}" class="w-5 h-5 opacity-40 group-focus-within:opacity-100" alt="icon">
                        <input type="tel" name="phone_number" class="bg-transparent outline-none w-full font-bold text-white placeholder:text-slate-600 text-sm" placeholder="WhatsApp number" value="{{ old('phone_number') }}">
                    </label>
                </div>

                <div class="flex items-center justify-between px-4 py-6 rounded-[30px] bg-blue-600/5 border border-blue-500/20" data-aos="fade-up" data-aos-delay="600">
                    <div>
                        <p class="font-black text-white text-sm uppercase">Duration</p>
                        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Sewa per Bulan</p>
                    </div>
                    <div class="flex items-center gap-6 bg-slate-900/50 p-2 rounded-2xl border border-white/5">
                        <button type="button" id="Minus" class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-800 hover:bg-slate-700 transition-colors">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"/></svg>
                        </button>
                        <input id="Duration" type="text" value="1" name="duration" class="bg-transparent outline-none w-8 text-center font-black text-xl text-blue-500" readonly>
                        <button type="button" id="Plus" class="w-10 h-10 flex items-center justify-center rounded-xl bg-blue-600 hover:bg-blue-500 transition-colors shadow-[0_0_15px_rgba(37,99,235,0.4)]">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                        </button>
                    </div>
                </div>

                <div class="flex flex-col gap-4" data-aos="fade-up" data-aos-delay="700">
                    <p class="font-bold text-[11px] text-slate-400 uppercase tracking-widest ml-4">Moving Date</p>
                    <div class="swiper w-full !overflow-visible">
                        <div class="swiper-wrapper select-dates">
                            </div>
                    </div>
                </div>
            </div>

            <div id="BottomNav" class="fixed bottom-0 left-0 right-0 z-[100] w-full max-w-[640px] mx-auto p-6 bg-gradient-to-t from-[#0F172A] via-[#0F172A]/90 to-transparent">
                <div class="flex items-center justify-between rounded-[32px] p-4 bg-slate-900 border border-white/10 shadow-[0_20px_50px_rgba(0,0,0,0.5)] backdrop-blur-md">
                    <div class="flex flex-col pl-4">
                        <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Grand Total</span>
                        <p id="price" class="font-black text-xl text-white tracking-tighter">
                            </p>
                    </div>
                    <button type="submit" class="h-14 px-8 rounded-2xl bg-blue-600 hover:bg-blue-500 font-black text-white uppercase tracking-widest text-xs transition-all duration-300 hover:shadow-[0_0_20px_rgba(37,99,235,0.4)] flex items-center gap-3">
                        Book Now
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Transisi Halaman */
    .animate-page-in { animation: pageIn 0.8s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes pageIn {
        from { opacity: 0; transform: translateY(15px); filter: blur(4px); }
        to { opacity: 1; transform: translateY(0); filter: blur(0); }
    }

    /* Styling Swiper Dates (Disesuaikan agar matching) */
    .swiper-slide { width: auto !important; }
    .date-card.active {
        background: #2563eb !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.2);
    }
    
    ::-webkit-scrollbar { display: none; }
    /* Styling khusus untuk Swiper Dates agar terlihat Premium */
.swiper-wrapper.select-dates {
    padding: 10px 0;
}

/* State Default Tanggal */
.date-card {
    width: 65px !important;
    height: 90px !important;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: rgba(30, 41, 59, 0.5); /* slate-800/50 */
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
}

.date-card p {
    transition: all 0.3s;
}

/* State Saat Tanggal Dipilih (Active) */
.date-card.active {
    background: #2563eb !important; /* Blue-600 */
    border-color: #60a5fa !important;
    box-shadow: 0 0 25px rgba(37, 99, 235, 0.4);
    transform: translateY(-5px) scale(1.05);
}

.date-card.active p.text-slate-500 {
    color: rgba(255, 255, 255, 0.8) !important;
}

.date-card.active p.text-white {
    transform: scale(1.1);
}

/* Mencegah teks terpilih (highlight) saat diklik cepat */
.date-card {
    user-select: none;
    -webkit-tap-highlight-color: transparent;
}
.swiper {
    overflow: visible !important; /* Agar cahaya glow tidak terpotong saat slide */
}
</style>

@endsection

@section('scripts')
<script>
    const defaultPrice = {{ $room->price_per_month }};
</script>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="{{ asset('assets/js/cust-info.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true });
    });
</script>
@endsection