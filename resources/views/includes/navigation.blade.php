<div class="fixed bottom-0 left-0 right-0 z-50 flex justify-center items-end pb-4 pointer-events-none">
    <div class="w-full max-w-[640px] px-6 pointer-events-auto">
        <div class="bg-[#003153] rounded-[35px] shadow-[0_-10px_40px_rgba(0,0,0,0.15)] flex justify-around items-center h-20 relative px-4 border-t border-white/5">
            
            <a href="{{ route('home') }}" class="relative flex flex-col items-center justify-center w-16 transition-all duration-500">
                @if(request()->routeIs('home'))
                    <div class="absolute -top-10 w-16 h-16 bg-[#0076B6] rounded-full shadow-[0_10px_25px_rgba(0,118,182,0.5)] flex items-center justify-center border-4 border-[#F8FAFC] transition-all duration-500 animate-bounce-subtle">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="mt-8 text-white text-[10px] font-bold tracking-widest uppercase opacity-100 transition-opacity">Home</span>
                @else
                    <svg class="w-6 h-6 text-[#7C9ED9] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span class="text-[#7C9ED9] text-[8px] font-bold uppercase mt-1">Home</span>
                @endif
            </a>

            <a href="{{ route('find-kos') }}" class="relative flex flex-col items-center justify-center w-16 transition-all duration-500">
                @if(request()->routeIs('find-kos'))
                    <div class="absolute -top-10 w-16 h-16 bg-[#0076B6] rounded-full shadow-[0_10px_25px_rgba(0,118,182,0.5)] flex items-center justify-center border-4 border-[#F8FAFC] transition-all duration-500 animate-bounce-subtle">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <span class="mt-8 text-white text-[10px] font-bold tracking-widest uppercase">Find</span>
                @else
                    <svg class="w-6 h-6 text-[#7C9ED9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span class="text-[#7C9ED9] text-[8px] font-bold uppercase mt-1">Find</span>
                @endif
            </a>

            <a href="{{ route('check-booking') }}" class="relative flex flex-col items-center justify-center w-16 transition-all duration-500">
                @if(request()->routeIs('check-booking'))
                    <div class="absolute -top-10 w-16 h-16 bg-[#0076B6] rounded-full shadow-[0_10px_25px_rgba(0,118,182,0.5)] flex items-center justify-center border-4 border-[#F8FAFC] transition-all duration-500 animate-bounce-subtle">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="mt-8 text-white text-[10px] font-bold tracking-widest uppercase">Orders</span>
                @else
                    <svg class="w-6 h-6 text-[#7C9ED9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <span class="text-[#7C9ED9] text-[8px] font-bold uppercase mt-1">Orders</span>
                @endif
            </a>

            <a href="#" class="flex flex-col items-center justify-center w-16">
                <svg class="w-6 h-6 text-[#7C9ED9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <span class="text-[#7C9ED9] text-[8px] font-bold uppercase mt-1">Help</span>
            </a>

        </div>
    </div>
</div>

<style>
    @keyframes bounceSubtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-bounce-subtle {
        animation: bounceSubtle 3s ease-in-out infinite;
    }
</style>