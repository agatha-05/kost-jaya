@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

<div class="min-h-screen bg-[#020617] text-slate-300 pb-40 overflow-x-hidden font-sans">
    
    <div class="fixed top-[-10%] left-[-10%] w-[40%] h-[40%] bg-blue-900/20 blur-[120px] rounded-full"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-indigo-900/10 blur-[120px] rounded-full"></div>

    <div id="TopNav" class="relative flex items-center justify-between px-6 pt-10" data-aos="fade-down">
        <a href="{{ Route('booking.information', $boardingHouse->slug) }}"
            class="w-12 h-12 flex items-center justify-center rounded-2xl bg-blue-500 border border-blue-400 shadow-[0_0_20px_rgba(59,130,246,0.4)] hover:bg-blue-400 transition-all active:scale-95 z-10">
            <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" class="w-6 h-6 brightness-0 invert" alt="back">
        </a>
        <h1 class="text-sm font-bold tracking-[0.2em] uppercase text-white">Review & Checkout</h1>
        <div class="w-11"></div>
    </div>

    <div class="relative px-5 mt-8 max-w-lg mx-auto space-y-6">
        
        <div class="flex flex-col gap-4" data-aos="zoom-in">
            <div class="relative w-full h-[200px] rounded-[35px] overflow-hidden border border-white/10 shadow-2xl">
                <img src="{{ asset('storage/' . $boardingHouse->thumbnail) }}" class="w-full h-full object-cover" alt="boarding house thumbnail">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                <div class="absolute bottom-5 left-6">
                    <h2 class="font-bold text-white text-xl leading-tight">{{ $boardingHouse->name }}</h2>
                    <div class="flex items-center gap-2 mt-1 opacity-80">
                        <img src="{{ asset('assets/images/icons/location.svg') }}" class="w-3.5 h-3.5 brightness-200" alt="loc">
                        <span class="text-xs uppercase tracking-wider font-semibold text-white">Kota {{ $boardingHouse->city->name }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900/80 border border-white/10 rounded-[30px] p-4 backdrop-blur-md flex items-center gap-4">
                <div class="w-20 h-20 shrink-0 rounded-2xl overflow-hidden ring-2 ring-white/5">
                    <img src="{{ asset('storage/' . $room->roomimages->first()->image) }}" class="w-full h-full object-cover" alt="room image">
                </div>
                <div class="flex flex-col justify-center flex-1">
                    <p class="text-[10px] text-blue-400 font-extrabold uppercase tracking-widest mb-1">Room Selected</p>
                    <h3 class="font-bold text-white text-base">{{ $room->name }}</h3>
                    <p class="text-sm font-black text-white mt-1">Rp {{ number_format($room->price_per_month, 0, ',', '.') }}<span class="text-[10px] text-slate-500 font-medium lowercase">/month</span></p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div class="group bg-slate-900/40 border border-white/5 rounded-[30px] p-6 hover:border-blue-500/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-blue-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <span class="font-bold text-white">Customer Information</span>
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center"><span class="text-sm text-slate-500">Name</span><span class="text-sm font-semibold text-slate-200">{{ $transaction['name'] }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-sm text-slate-500">Email</span><span class="text-sm font-semibold text-slate-200">{{ $transaction['email'] }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-sm text-slate-500">Phone</span><span class="text-sm font-semibold text-blue-400 tracking-tighter">{{ $transaction['phone_number'] }}</span></div>
                </div>
            </div>

            <div class="group bg-slate-900/40 border border-white/5 rounded-[30px] p-6 hover:border-emerald-500/30 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <span class="font-bold text-white">Booking Duration</span>
                </div>
                <div class="flex items-center justify-between gap-4">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">Start Date</span>
                        <span class="text-sm font-bold text-white">{{ \Carbon\Carbon::parse($transaction['start_date'])->isoformat('D MMM YYYY') }}</span>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="h-[2px] w-full bg-slate-800 relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-emerald-500 to-transparent"></div>
                        </div>
                        <span class="text-[10px] text-emerald-400 font-black mt-1 uppercase">{{ $transaction['duration'] }} Months</span>
                    </div>
                    <div class="flex flex-col text-right">
                        <span class="text-[10px] text-slate-500 uppercase font-bold tracking-tighter">End Date</span>
                        <span class="text-sm font-bold text-white">{{ \Carbon\Carbon::parse($transaction['start_date'])->addMonths(intval($transaction['duration']))->isoformat('D MMM YYYY') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('booking.payment', $boardingHouse->slug) }}" method="POST" class="mt-8 space-y-6">
            @csrf
            <div id="PaymentOptions" class="bg-slate-900/60 rounded-[40px] border border-white/10 p-2" data-aos="fade-up">
                <div class="flex p-1.5 gap-1.5">
                    <label class="tab-link relative flex-1 cursor-pointer" data-target-tab="#DownPayment-Tab">
                        <input type="radio" name="payment_method" value="down_payment" class="absolute opacity-0 peer" checked>
                        <div class="py-4 text-center rounded-[30px] transition-all duration-500 peer-checked:bg-blue-600 peer-checked:shadow-xl peer-checked:shadow-blue-600/20">
                            <p class="font-bold text-xs peer-checked:text-white transition-colors">Down Payment</p>
                        </div>
                    </label>
                    <label class="tab-link relative flex-1 cursor-pointer" data-target-tab="#FullPayment-Tab">
                        <input type="radio" name="payment_method" value="full_payment" class="absolute opacity-0 peer">
                        <div class="py-4 text-center rounded-[30px] transition-all duration-500 peer-checked:bg-blue-600 peer-checked:shadow-xl peer-checked:shadow-blue-600/20">
                            <p class="font-bold text-xs peer-checked:text-white transition-colors">Full Payment</p>
                        </div>
                    </label>
                </div>

                @php
                    $subtotal = $room->price_per_month * $transaction['duration'];
                    $tax = $subtotal * 0.11;
                    $insurance = $subtotal * 0.1;
                    $total = $subtotal + $tax + $insurance;
                    $downPayment = $total * 0.3;
                @endphp

                <div class="p-6 pt-2 space-y-4">
                    <div id="DownPayment-Tab" class="tab-content animate-in">
                        <p class="text-xs text-slate-500 mb-5 leading-relaxed bg-white/5 p-3 rounded-xl border border-white/5">💡 Anda bisa survey lokasi terlebih dahulu dan melunasi sisa pembayaran di tempat.</p>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Sub Total</span><span class="font-semibold text-white font-mono">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Tax (11%)</span><span class="font-semibold text-white font-mono">Rp {{ number_format($tax, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between text-sm border-b border-white/5 pb-3"><span class="text-slate-500">Insurance</span><span class="font-semibold text-white font-mono">Rp {{ number_format($insurance, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between items-center pt-2"><span class="font-bold text-blue-400">Total DP (30%)</span><p id="downPaymentPrice" class="text-xl font-black text-white">Rp {{ number_format($downPayment, 0, ',', '.') }}</p></div>
                        </div>
                    </div>

                    <div id="FullPayment-Tab" class="tab-content hidden animate-in">
                        <p class="text-xs text-slate-500 mb-5 leading-relaxed bg-white/5 p-3 rounded-xl border border-white/5">💡 Pembayaran lunas di awal memberikan Anda prioritas utama tanpa biaya tambahan lagi.</p>
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Sub Total</span><span class="font-semibold text-white font-mono">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Tax (11%)</span><span class="font-semibold text-white font-mono">Rp {{ number_format($tax, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between text-sm border-b border-white/5 pb-3"><span class="text-slate-500">Insurance</span><span class="font-semibold text-white font-mono">Rp {{ number_format($insurance, 0, ',', '.') }}</span></div>
                            <div class="flex justify-between items-center pt-2"><span class="font-bold text-blue-400">Grand Total</span><p id="fullPaymentPrice" class="text-xl font-black text-white">Rp {{ number_format($total, 0, ',', '.') }}</p></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-[#020617] via-[#020617]/95 to-transparent z-50">
                <div class="max-w-lg mx-auto flex items-center justify-between bg-slate-800/80 backdrop-blur-2xl border border-white/10 rounded-[35px] p-5 shadow-[0_-20px_50px_rgba(0,0,0,0.5)]">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-slate-500 font-black uppercase tracking-widest">Amount to Pay</span>
                        <p id="priceDisplay" class="text-2xl font-black text-white tracking-tighter">Rp 0</p>
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 px-10 rounded-3xl transition-all active:scale-95 shadow-lg shadow-blue-600/30">
                        Pay Now
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .animate-in { animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endsection

@section('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true, easing: 'ease-out-quad' });
        
        const tabs = document.querySelectorAll('.tab-link');
        const contents = document.querySelectorAll('.tab-content');
        const priceDisplay = document.getElementById('priceDisplay');

        function syncPrice() {
            const activeTab = document.querySelector('.tab-content:not(.hidden)');
            const activePriceText = activeTab.querySelector('p[id$="Price"]').innerText;
            priceDisplay.innerText = activePriceText;
        }

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-target-tab');
                contents.forEach(c => c.classList.add('hidden'));
                document.querySelector(target).classList.remove('hidden');
                syncPrice();
            });
        });
        
        syncPrice();
    });
</script>
@endsection