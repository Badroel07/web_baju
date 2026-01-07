<div class="pt-16">
    <!-- Hero Section -->
    <section class="relative bg-gray-900 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            @if(count($products) > 0 && !empty($products[0]['image']))
                <img src="{{ $products[0]['image'] }}" 
                     alt="Hero background" 
                     class="w-full h-full object-cover opacity-60 dark:opacity-40">
            @else
                <div class="w-full h-full bg-gray-800"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/50 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-48 flex flex-col justify-center h-full">
            <div class="max-w-xl">
                <span class="text-white font-bold tracking-wider uppercase text-sm mb-2 block">Koleksi Terbaru 2026</span>
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl mb-6">
                    Mendefinisikan Ulang<br>Kenyamanan Modern
                </h1>
                <p class="mt-4 text-xl text-gray-300 max-w-lg mb-8">
                    Temukan koleksi LifeWear terbaru kami. Pakaian sehari-hari yang simpel, berkualitas tinggi, dengan sentuhan keindahan praktis.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#products" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium text-black bg-white hover:bg-gray-200 md:py-4 md:text-lg transition-colors">
                        Lihat Koleksi
                    </a>
                    <a href="#" class="inline-flex items-center justify-center px-8 py-3 border border-white text-base font-medium text-white hover:bg-white/10 md:py-4 md:text-lg transition-colors">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Banner -->
    <div class="bg-black text-white text-center py-3 px-4 text-sm font-medium">
        <p>Gratis Ongkir untuk semua pesanan di atas Rp500.000. <a href="#" class="underline decoration-1 underline-offset-2 hover:opacity-80">Pelajari Lebih Lanjut</a></p>
    </div>
</div>
