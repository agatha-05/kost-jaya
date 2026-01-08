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
    @keyframes success-glow {
        0% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.2); }
        50% { box-shadow: 0 0 50px rgba(34, 197, 94, 0.5); }
        100% { box-shadow: 0 0 20px rgba(34, 197, 94, 0.2); }
    }
    .animate-glow { animation: success-glow 3s infinite; }
</style>

<div class="w-full bg-[#020617] min-h-screen relative overflow-hidden">
    <div class="absolute top-[-10%] left-[-10%] w-[300px] h-[300px] bg-blue-600/20 blur-[120px] rounded-full"></div>
    <div class="absolute top-[10%] right-[-10%] w-[300px] h-[300px] bg-emerald-600/10 blur-[120px] rounded-full"></div>

    <div class="max-w-[640px] mx-auto px-6 py-16 relative">
        
        <div class="flex justify-center mb-8">
            <div class="w-24 h-24 bg-emerald-500 rounded-full flex items-center justify-center animate-glow shadow-2xl">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <div class="text-center mb-12">
            <h1 class="text-white font-black text-3xl tracking-tighter mb-2">Booking Berhasil!</h1>
            <p class="text-slate-400 font-medium">Selamat, hunian impianmu sudah siap.</p>
        </div>

        <div class="glass-card rounded-[40px] p-6 mb-8 shadow-2xl">
            <div class="flex gap-4 mb-6">
                <div class="w-24 h-24 shrink-0 rounded-[24px] overflow-hidden border border-white/10">
                    <img src="{{ asset('storage/' . $transaction->boardingHouse->thumbnail) }}" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="text-white font-bold text-lg leading-tight mb-2">{{ $transaction->boardingHouse->name }}</h2>
                    <div class="flex items-center gap-2 text-slate-400">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /></svg>
                        <span class="text-xs font-bold uppercase tracking-wider">{{ $transaction->boardingHouse->city->name }}</span>
                    </div>
                </div>
            </div>

            <div class="h-[1px] bg-white/5 w-full mb-6"></div>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Tipe Kamar</p>
                            <p class="text-white font-bold">{{ $transaction->room->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center text-blue-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                        <div>
                            <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Durasi Sewa</p>
                            <p class="text-white font-bold text-sm">
                                {{ \Carbon\Carbon::parse($transaction->start_date)->isoFormat('D MMM YYYY') }} - 
                                {{ \Carbon\Carbon::parse($transaction->start_date)->addMonths($transaction->duration)->isoFormat('D MMM YYYY') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-900/50 border border-dashed border-slate-700 rounded-3xl p-5 mb-10 text-center">
            <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mb-2">Your Booking ID</p>
            <h3 class="text-blue-400 font-mono text-2xl font-black tracking-[0.3em] uppercase">{{ $transaction->code }}</h3>
        </div>

        <div class="flex flex-col gap-4">
            <a href="{{ route('home') }}" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-extrabold py-5 rounded-[24px] text-center shadow-lg shadow-blue-600/20 transition-all active:scale-95">
                Eksplor Kos Lainnya
            </a>
            
            <form action="{{ route('check-booking.show') }}" method="POST">
                @csrf
                <input type="hidden" name="code" value="{{ $transaction->code }}">
                <input type="hidden" name="email" value="{{ $transaction->email }}">
                <input type="hidden" name="phone_number" value="{{ $transaction->phone_number }}">

                <button class="w-full bg-slate-800 hover:bg-slate-700 text-white font-bold py-5 rounded-[24px] transition-all border border-white/5 active:scale-95">
                    Lihat Detail Booking
                </button>
            </form>
        </div>
    </div>
</div>
@endsection