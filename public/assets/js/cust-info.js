const swiperTabs = new Swiper('.swiper', {
    slidesPerView: "auto",
    spaceBetween: 12,
    slidesOffsetAfter: 20,
    slidesOffsetBefore: 20,
    grabCursor: true,
    freeMode: true
});

const datesElement = document.querySelector('.select-dates');
const today = new Date();
const endDate = new Date(2026, 11, 31); 
let content = '';

// Helper untuk nama hari
const dayNames = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

for (let d = new Date(today); d <= endDate; d.setDate(d.getDate() + 1)) {
    const month = d.toLocaleString('default', { month: 'short' });
    const dayNum = d.getDate();
    const dayName = dayNames[d.getDay()];
    const year = d.getFullYear();

    // Nilai input H+1 sesuai logika asli Anda
    const realDate = new Date(d.getTime() + 1000 * 60 * 60 * 24).toISOString().split('T')[0];

    content += `
        <div class="swiper-slide !w-fit py-4">
            <label class="relative group cursor-pointer flex flex-col items-center">
                <input type="radio" name="start_date" class="peer absolute opacity-0" value="${realDate}" required>
                
                <div class="w-16 h-24 flex flex-col items-center justify-center rounded-[2rem] bg-slate-800/40 border border-white/5 backdrop-blur-md transition-all duration-500 
                            peer-checked:bg-blue-600 peer-checked:border-blue-400 peer-checked:shadow-[0_0_25px_rgba(37,99,235,0.5)] peer-checked:-translate-y-2
                            group-hover:border-blue-500/50">
                    
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 peer-checked:text-blue-100 mb-1 transition-colors">
                        ${dayName}
                    </span>
                    
                    <span class="text-xl font-[1000] text-white transition-all peer-checked:scale-110">
                        ${dayNum}
                    </span>
                    
                    <span class="text-[9px] font-bold uppercase text-slate-600 peer-checked:text-blue-200 mt-1 transition-colors">
                        ${month}
                    </span>

                </div>

                <div class="w-1.5 h-1.5 rounded-full bg-blue-500 mt-3 opacity-0 scale-0 transition-all duration-300 peer-checked:opacity-100 peer-checked:scale-100 shadow-[0_0_10px_#3b82f6]"></div>
            </label>
        </div>`;
}

datesElement.innerHTML = content;
swiperTabs.update();

// --- LOGIKA DURASI DAN HARGA ---
const minusButton = document.getElementById('Minus');
const plusButton = document.getElementById('Plus');
const durationInput = document.getElementById('Duration');
const priceElement = document.getElementById('price');
const maxDuration = 999; 

function updatePrice() {
    let duration = parseInt(durationInput.value, 10);
    if (!isNaN(duration) && duration >= 1 && duration <= maxDuration) {
        const totalPrice = defaultPrice * duration;
        priceElement.innerHTML = `Rp ${totalPrice.toLocaleString('id-ID')}`;
    }
}

// Event Listeners tetap sama untuk fungsionalitas
minusButton.addEventListener('click', () => {
    let value = parseInt(durationInput.value, 10);
    if (value > 1) durationInput.value = --value;
    updatePrice();
});

plusButton.addEventListener('click', () => {
    let value = parseInt(durationInput.value, 10);
    if (value < maxDuration) durationInput.value = ++value;
    updatePrice();
});

updatePrice();