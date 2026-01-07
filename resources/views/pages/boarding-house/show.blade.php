@extends('layouts.app')

@section('content')
<div class="max-w-[640px] mx-auto min-h-screen bg-[#0F172A] pb-40 font-['Plus_Jakarta_Sans'] text-slate-200">
    
    <div class="relative h-[400px] w-full overflow-hidden group">
        <div id="Gallery" class="swiper-gallery h-full w-full">
            <div class="swiper-wrapper"> 
                @foreach ($boardingHouse->rooms as $room)
                    @foreach ($room->roomImages as $roomImage) 
                        <div class="swiper-slide h-full">
                            <img src="{{ asset('storage/' . $roomImage->image) }}" class="w-full h-full object-cover" alt="gallery">
                            <div class="absolute inset-0 bg-black/20"></div>
                        </div>
                    @endforeach
                @endforeach
            </div> 
            <div class="swiper-pagination !bottom-16"></div>
        </div>

        <div class="absolute top-8 left-6 right-6 flex justify-between items-center z-20">
            <a href="{{ route('home') }}" class="group relative w-12 h-12 flex items-center justify-center bg-slate-900/40 backdrop-blur-xl rounded-2xl border border-white/20 text-white shadow-xl transition-all duration-300 hover:w-24 hover:bg-blue-600">
                <div class="flex items-center">
                    <svg class="w-6 h-6 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                    </svg>
                    <span class="max-w-0 overflow-hidden text-[10px] font-bold uppercase tracking-widest transition-all duration-300 group-hover:max-w-xs group-hover:ml-2">Back</span>
                </div>
            </a>

            <p class="font-bold text-white tracking-widest uppercase text-xs drop-shadow-md">Details</p>

            <button class="w-12 h-12 flex items-center justify-center bg-slate-900/40 backdrop-blur-xl rounded-2xl border border-white/20 text-white shadow-xl active:scale-90 transition-transform">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
            </button>
        </div>
    </div>

    <main class="relative -mt-12 px-5 z-30 animate-slide-up">
        <div class="bg-slate-900 rounded-[40px] p-7 shadow-2xl border border-white/5">
            
            <div class="mb-6">
                <div class="flex justify-between items-start gap-4 mb-2">
                    <h1 class="text-2xl font-extrabold text-white leading-tight uppercase">{{ $boardingHouse->name }}</h1>
                    <div class="flex items-center gap-1 bg-yellow-400/10 px-3 py-1 rounded-full border border-yellow-400/20">
                        <svg class="w-3 h-3 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-xs font-black text-yellow-600">4.8</span>
                    </div>
                </div>
                <p class="flex items-center gap-2 text-slate-400 font-semibold text-sm">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                    Kota {{ $boardingHouse->city->name }}
                </p>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-8">
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl border border-white/5">
                    <div class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center shadow-sm text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"/></svg>
                    </div>
                    <span class="text-slate-300 font-bold text-xs uppercase tracking-tight">Wifi</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl border border-white/5">
                    <div class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center shadow-sm text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <span class="text-slate-300 font-bold text-xs uppercase tracking-tight">Air Cond</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl border border-white/5">
                    <div class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center shadow-sm text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <span class="text-slate-300 font-bold text-xs uppercase tracking-tight">People</span>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white/5 rounded-2xl border border-white/5">
                    <div class="w-9 h-9 bg-slate-800 rounded-xl flex items-center justify-center shadow-sm text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <span class="text-slate-300 font-bold text-xs uppercase tracking-tight">Privacy</span>
                </div>
            </div>

            <hr class="border-white/5 mb-8">

            <div id="About-Section" class="mb-10">
                <h2 class="text-lg font-black text-white mb-3 uppercase tracking-wider">About</h2>
                <div class="text-slate-400 font-medium leading-[1.8] text-sm">
                    {!! $boardingHouse->description !!}
                </div>
            </div>

            <div id="Tabs" class="swiper-tab w-full overflow-hidden mb-6">
                <div class="swiper-wrapper py-2">
                    <div class="swiper-slide !w-fit px-1">
                        <button class="tab-link px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 bg-blue-600 text-white transition-all duration-300 active" data-target-tab="#Bonus-Tab">Bonus</button>
                    </div>
                    <div class="swiper-slide !w-fit px-1">
                        <button class="tab-link px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 text-slate-500 bg-white/5 transition-all duration-300" data-target-tab="#Testimonials-Tab">Reviews</button>
                    </div>
                    <div class="swiper-slide !w-fit px-1">
                        <button class="tab-link px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 text-slate-500 bg-white/5 transition-all duration-300" data-target-tab="#Rules-Tab">Rules</button>
                    </div>
                    <div class="swiper-slide !w-fit px-1">
                        <button class="tab-link px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 text-slate-500 bg-white/5 transition-all duration-300" data-target-tab="#Contact-Tab">Contact</button>
                    </div>
                    <div class="swiper-slide !w-fit px-1">
                        <button class="tab-link px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest border border-white/10 text-slate-500 bg-white/5 transition-all duration-300" data-target-tab="#Rewards-Tab">Rewards</button>
                    </div>
                </div>
            </div>

            <div id="TabsContent" class="min-h-[150px]">
                <div id="Bonus-Tab" class="tab-content animate-fade-in flex flex-col gap-4">
                    @foreach ($boardingHouse->bonuses as $bonus)
                    <div class="flex items-center bg-white/5 rounded-3xl p-3 gap-4 border border-white/5">
                        <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden">
                            <img src="{{ asset('storage/' . $bonus->image) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="font-black text-white text-sm">{{ $bonus->name }}</p>
                            <p class="text-[11px] text-slate-500 font-semibold mt-1">{{ $bonus->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div id="Testimonials-Tab" class="tab-content hidden animate-fade-in flex flex-col gap-4">
                    @foreach ($boardingHouse->testimonials as $testimonial)
                    <div class="bg-white/5 rounded-3xl border border-white/5 p-5">
                        <div class="flex items-center gap-3 mb-3">
                            <img src="{{ asset('storage/' . $testimonial->photo) }}" class="w-10 h-10 rounded-xl object-cover border border-white/20">
                            <div>
                                <p class="font-black text-white text-xs uppercase">{{ $testimonial->name }}</p>
                                <p class="text-[9px] text-blue-500 font-bold uppercase tracking-tighter">{{ $testimonial->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 font-semibold italic leading-relaxed">"{{ $testimonial->content }}"</p>
                    </div>
                    @endforeach
                </div>

                <div id="Rules-Tab" class="tab-content hidden animate-fade-in">
                    <div class="bg-white/5 p-5 rounded-3xl border border-white/5">
                        <p class="text-sm font-semibold text-white mb-3">Room Rules & Regulations:</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-xs text-slate-400 font-bold">
                                <span class="w-6 h-6 flex items-center justify-center bg-red-500/10 text-red-500 rounded-full text-[10px]">1</span> NO SMOKING
                            </li>
                            <li class="flex items-center gap-3 text-xs text-slate-400 font-bold">
                                <span class="w-6 h-6 flex items-center justify-center bg-red-500/10 text-red-500 rounded-full text-[10px]">2</span> NO PETS
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="Contact-Tab" class="tab-content hidden animate-fade-in text-sm text-slate-400 font-bold">Informasi kontak pengelola...</div>
                <div id="Rewards-Tab" class="tab-content hidden animate-fade-in text-sm text-slate-400 font-bold">Daftar reward member...</div>
            </div>
        </div>
    </main>

    <div class="fixed bottom-0 left-0 right-0 z-50 px-6 pb-8 bg-gradient-to-t from-[#0F172A] to-transparent pt-10">
        <div class="max-w-[500px] mx-auto bg-slate-900 rounded-[35px] p-5 shadow-2xl flex items-center justify-between border border-white/10 ring-4 ring-slate-900/50">
            <div class="pl-2">
                <p class="text-slate-500 text-[9px] font-black uppercase tracking-[2px]">Monthly Rent</p>
                <div class="flex items-baseline gap-1">
                    <span class="text-white font-[900] text-xl">Rp {{ number_format($boardingHouse->price, 0, ',', '.') }}</span>
                    <span class="text-slate-500 text-[10px] font-bold">/bln</span>
                </div>
            </div>
            <a href="{{ route('kos.rooms', $boardingHouse->slug) }}" class="bg-blue-600 hover:bg-blue-500 text-white px-8 py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest transition-all shadow-lg active:scale-95 flex items-center gap-2">
                Book Now
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </a>
        </div>
    </div>
</div>

<style>
    /* Animasi masuk konten utama */
    .animate-slide-up { 
        animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }
    @keyframes slideUp { 
        from { opacity: 0; transform: translateY(40px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .animate-fade-in { animation: fadeIn 0.4s ease-out; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
    
    .tab-link.active {
        background-color: #2563EB !important; /* blue-600 */
        color: white !important;
        border-color: #3B82F6 !important;
    }

    /* Kustomisasi indikator slider agar terlihat di tema gelap */
    .swiper-pagination-bullet { background: #475569 !important; opacity: 1 !important; }
    .swiper-pagination-bullet-active { background: #3B82F6 !important; width: 24px !important; border-radius: 4px !important; }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto Slider Initialization
        const swiper = new Swiper('#Gallery', {
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            effect: 'slide'
        });

        // Tab Switching Logic (Diperbaiki untuk konsistensi tema gelap)
        document.querySelectorAll('.tab-link').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.tab-link').forEach(btn => {
                    btn.classList.remove('active', 'bg-blue-600', 'text-white', 'border-blue-500');
                    btn.classList.add('text-slate-500', 'bg-white/5', 'border-white/10');
                });

                document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));

                const target = document.querySelector(button.dataset.targetTab);
                target.classList.remove('hidden');

                button.classList.add('active', 'bg-blue-600', 'text-white', 'border-blue-500');
                button.classList.remove('text-slate-500', 'bg-white/5', 'border-white/10');
            });
        });
    });
</script>
@endsection