@extends('layouts.app')

@section('content')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body { background-color: #020617; font-family: 'Plus Jakarta Sans', sans-serif; }
    .glass-card {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    /* Custom Accordion Logic with CSS only for extra speed */
    .acc-content { max-height: 0; overflow: hidden; transition: all 0.5s cubic-bezier(0, 1, 0, 1); }
    input:checked ~ .acc-content { max-height: 1000px; transition: all 0.5s cubic-bezier(1, 0, 1, 0); padding-top: 24px; }
    input:checked ~ label img { transform: rotate(180deg); }
    
    @keyframes pulse-orange { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }
    .animate-status-pending { animation: pulse-orange 2s infinite; }
</style>

<div class="w-full bg-[#020617] min-h-screen">
    <div class="max-w-[640px] mx-auto pb-32 relative">
        
        <div id="TopNav" class="relative flex items-center justify-between px-6 pt-12">
            <a href="{{ route('check-booking') }}" class="w-12 h-12 flex items-center justify-center shrink-0 rounded-2xl bg-slate-900 border border-white/10 text-white hover:bg-blue-600 transition-all shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <p class="font-bold text-white text-lg tracking-tight">Detail Booking</p> 
            <div class="w-12"></div>
        </div>

        <div class="px-6 mt-8">
            <div class="glass-card rounded-[40px] p-5 shadow-2xl overflow-hidden relative">
                <div class="absolute top-5 right-5 z-10">
                    @if ($transaction->status === 'PENDING')
                        <span class="px-4 py-2 rounded-full bg-orange-500/20 text-orange-400 text-[10px] font-black uppercase tracking-widest border border-orange-500/30 animate-status-pending">Pending</span>
                    @else
                        <span class="px-4 py-2 rounded-full bg-emerald-500/20 text-emerald-400 text-[10px] font-black uppercase tracking-widest border border-emerald-500/30 shadow-[0_0_15px_rgba(52,211,153,0.2)]">Successful</span>
                    @endif
                </div>

                <div class="flex flex-col gap-6">
                    <div class="flex gap-5">
                        <div class="w-28 h-32 shrink-0 rounded-[28px] overflow-hidden border border-white/5">
                            <img src="{{ asset('storage/' . $transaction->boardingHouse->thumbnail) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col justify-center gap-2">
                            <h2 class="text-white font-bold text-lg leading-tight line-clamp-2">{{ $transaction->boardingHouse->name }}</h2>
                            <div class="flex items-center gap-2 text-slate-400">
                                <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-4 h-4 brightness-200">
                                <p class="text-[11px] font-bold uppercase tracking-wide">{{ $transaction->boardingHouse->city->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="h-[1px] bg-white/5 w-full"></div>

                    <div class="flex gap-5">
                        <div class="w-28 h-32 shrink-0 rounded-[28px] overflow-hidden border border-white/5 relative">
                            <img src="{{ asset('storage/' . $transaction->room->roomimages->first()->image) }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent opacity-60"></div>
                        </div>
                        <div class="flex flex-col justify-center gap-3">
                            <p class="text-white font-bold text-md tracking-tight">{{ $transaction->room->name }}</p>
                            <div class="flex flex-wrap gap-3">
                                <div class="flex items-center gap-1.5 bg-slate-800/50 px-3 py-1.5 rounded-xl border border-white/5">
                                    <img src="{{ asset('assets/images/icons/profile-2user.svg') }}" class="w-3.5 h-3.5 opacity-70">
                                    <span class="text-[10px] text-slate-300 font-bold">{{ $transaction->room->capacity }} Ppl</span>
                                </div>
                                <div class="flex items-center gap-1.5 bg-slate-800/50 px-3 py-1.5 rounded-xl border border-white/5">
                                    <img src="{{ asset('assets/images/icons/3dcube.svg') }}" class="w-3.5 h-3.5 opacity-70">
                                    <span class="text-[10px] text-slate-300 font-bold">{{ $transaction->room->square_feet }} sqft</span>
                                </div>
                            </div>
                            <p class="text-blue-400 font-black text-lg">Rp {{ number_format($transaction->room->price_per_month, 0, ',', '.') }}<span class="text-[10px] text-slate-500 font-medium">/bulan</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="px-6 mt-6 space-y-4">
            
            <div class="glass-card rounded-[32px] p-6 relative">
                <input type="checkbox" id="acc-customer" class="absolute hidden peer" checked>
                <label for="acc-customer" class="flex items-center justify-between cursor-pointer">
                    <p class="font-bold text-white tracking-tight">Informasi Penyewa</p>
                    <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-6 h-6 transition-all duration-300 brightness-200">
                </label>
                <div class="acc-content peer-checked:block">
                    <div class="space-y-4 border-t border-white/5 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Nama Lengkap</span>
                            <span class="text-white font-semibold text-sm">{{ $transaction->name }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Email</span>
                            <span class="text-white font-semibold text-sm">{{ $transaction->email }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">WhatsApp</span>
                            <span class="text-white font-semibold text-sm">{{ $transaction->phone_number }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-[32px] p-6 relative">
                <input type="checkbox" id="acc-booking" class="absolute hidden peer">
                <label for="acc-booking" class="flex items-center justify-between cursor-pointer">
                    <p class="font-bold text-white tracking-tight">Jadwal Sewa</p>
                    <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-6 h-6 transition-all duration-300 brightness-200 rotate-180">
                </label>
                <div class="acc-content peer-checked:block">
                    <div class="space-y-4 border-t border-white/5 pt-4">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Booking ID</span>
                            <span class="text-blue-400 font-mono font-black tracking-widest text-sm">{{ $transaction->code }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Durasi</span>
                            <span class="text-white font-semibold text-sm">{{ $transaction->duration }} Bulan</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Mulai Sewa</span>
                            <span class="text-white font-semibold text-sm">{{ \Carbon\Carbon::parse($transaction->start_date)->isoformat('D MMMM YYYY') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="glass-card rounded-[32px] p-6 relative">
                <input type="checkbox" id="acc-payment" class="absolute hidden peer" checked>
                <label for="acc-payment" class="flex items-center justify-between cursor-pointer">
                    <p class="font-bold text-white tracking-tight">Rincian Pembayaran</p>
                    <img src="{{ asset('assets/images/icons/arrow-up.svg') }}" class="w-6 h-6 transition-all duration-300 brightness-200">
                </label>
                
                @php
                    $subtotal = $transaction->room->price_per_month * $transaction->duration;
                    $tax = $subtotal * 0.11;
                    $insurance = $subtotal * 0.1;
                    $total = $subtotal + $tax + $insurance;
                    $downPayment = $total * 0.3;
                @endphp

                <div class="acc-content peer-checked:block">
                    <div class="space-y-4 border-t border-white/5 pt-4">
                        <div class="flex justify-between items-center p-3 rounded-2xl bg-slate-800/40 border border-white/5">
                            <span class="text-slate-400 text-xs font-bold">Metode</span>
                            <span class="text-blue-400 font-black text-xs uppercase">{{ $transaction->payment_method === 'full_payment' ? 'Full Payment 100%' : 'Down Payment 30%' }}</span>
                        </div>
                        <div class="flex justify-between items-center px-1">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Subtotal</span>
                            <span class="text-white font-semibold text-sm">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center px-1">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">PPN 11%</span>
                            <span class="text-white font-semibold text-sm">Rp {{ number_format($tax, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center px-1">
                            <span class="text-slate-500 text-xs font-bold uppercase tracking-widest">Insurance</span>
                            <span class="text-white font-semibold text-sm">Rp {{ number_format($insurance, 0, ',', '.') }}</span>
                        </div>
                        <div class="h-[1px] bg-white/5 w-full my-2"></div>
                        <div class="flex justify-between items-center px-1">
                            <span class="text-white font-black text-sm uppercase tracking-tighter">Total Bayar</span>
                            <span class="text-blue-400 font-black text-xl tracking-tight">
                                Rp {{ number_format($transaction->payment_method === 'full_payment' ? $total : $downPayment, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="fixed bottom-8 left-0 right-0 z-30 px-6">
            <div class="max-w-[592px] mx-auto">
                <a href="https://wa.me/628123456789?text=Halo,%20saya%20ingin%20tanya%20tentang%20booking%20{{ $transaction->code }}" 
                   class="flex w-full items-center justify-center gap-3 rounded-[24px] py-5 bg-blue-600 hover:bg-blue-500 text-white font-black text-lg transition-all shadow-[0_20px_40px_rgba(37,99,235,0.3)] active:scale-95">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.52c1.54.914 3.1 1.403 4.851 1.403 5.317 0 9.643-4.326 9.646-9.643.002-5.317-4.325-9.643-9.644-9.643-2.574 0-4.996 1.002-6.814 2.824-1.82 1.822-2.824 4.242-2.825 6.816-.001 1.859.504 3.468 1.464 5.087l-.988 3.613 3.71-.974z"/></svg>
                    Hubungi Customer Service
                </a>
            </div>
        </div>
    </div>
</div>
@endsection