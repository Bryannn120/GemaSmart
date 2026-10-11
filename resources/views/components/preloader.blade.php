<!-- Preloader Component -->
<div id="gema-smart-preloader" class="fixed inset-0 z-[10000] bg-surface flex flex-col items-center justify-center transition-all duration-700 ease-in-out">
    <div class="relative w-28 h-28 flex items-center justify-center">
        <!-- Spinning Outer Ring -->
        <div class="absolute inset-0 rounded-full border-[4px] border-surface-variant border-t-primary border-r-primary shadow-lg animate-spin"></div>
        
        <!-- Pulsing Inner Ring -->
        <div class="absolute inset-2 rounded-full border-[3px] border-transparent border-b-gold-accent border-l-gold-accent shadow-sm animate-[spin_1.5s_reverse_infinite]"></div>
        
        <!-- Inner Logo -->
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-inner z-10 animate-pulse">
            <img src="{{ asset('gemas.jpg') }}" alt="Gema Smart Logo" class="w-12 h-12 object-contain drop-shadow-sm">
        </div>
    </div>
    
    <div class="mt-8 flex flex-col items-center gap-2">
        <h2 class="font-headline-sm text-primary font-extrabold tracking-widest uppercase flex items-center gap-1">
            Gema Smart <span class="text-gold-accent">Sumbawa</span>
        </h2>
        <div class="flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-primary animate-bounce" style="animation-delay: 0s;"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-primary animate-bounce" style="animation-delay: 0.15s;"></span>
            <span class="w-1.5 h-1.5 rounded-full bg-primary animate-bounce" style="animation-delay: 0.3s;"></span>
        </div>
    </div>
</div>

<script>
    // Hilangkan Preloader saat halaman selesai dimuat (DOM, Gambar, Script)
    window.addEventListener('load', function () {
        const preloader = document.getElementById('gema-smart-preloader');
        if (preloader) {
            // Beri sedikit jeda agar animasi terlihat (opsional, jika load terlalu cepat)
            setTimeout(() => {
                preloader.classList.add('opacity-0', 'scale-105', '-translate-y-2');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 700); // Tunggu sampai durasi transisi CSS habis
            }, 300);
        }
    });

    // Fallback jika window.onload macet / tidak berjalan
    setTimeout(() => {
        const preloader = document.getElementById('gema-smart-preloader');
        if (preloader && preloader.style.display !== 'none') {
            preloader.classList.add('opacity-0');
            setTimeout(() => preloader.style.display = 'none', 700);
        }
    }, 5000); // Maksimal 5 detik
</script>
