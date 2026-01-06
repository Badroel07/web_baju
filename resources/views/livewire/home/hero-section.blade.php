<div class="h-screen w-full overflow-hidden" 
     x-data="{
        currentIndex: 0,
        products: window.heroProducts || [],
        isAnimating: false,
        touchStartY: 0,
        useTransition: true,
        init() {
            window.heroProducts = @js($products);
            this.products = window.heroProducts;
            

        },
        goToProduct(index) {
            // Allow index to go to products.length (the clone)
            if (this.isAnimating || index < 0 || index > this.products.length) return;
            
            this.isAnimating = true;
            this.currentIndex = index;
            
            // If we moved to the clone (visual match of index 0)
            if (index === this.products.length) {
                setTimeout(() => {
                    this.useTransition = false; // Disable transition for instant jump
                    this.currentIndex = 0;      // Jump to real first item
                    
                    // Re-enable transition after small delay
                    requestAnimationFrame(() => {
                        requestAnimationFrame(() => {
                            this.useTransition = true;
                            this.isAnimating = false;
                        });
                    });
                }, 700); // Wait for slide animation to finish
            } else {
                setTimeout(() => this.isAnimating = false, 700);
            }
        },
        nextProduct() {
            this.goToProduct(this.currentIndex + 1);
        },
        prevProduct() {
            if (this.currentIndex > 0) {
                this.goToProduct(this.currentIndex - 1);
            }
        },
        handleWheel(e) {
            // e.preventDefault(); // Optional: remove if blocking normal page scroll is annoying
            // Check if scrolling down
            if (e.deltaY > 0) {
                if (!this.isAnimating) {
                    this.nextProduct();
                }
            } else {
                if (!this.isAnimating) {
                    this.prevProduct();
                }
            }
        },
        handleTouchStart(e) {
            this.touchStartY = e.touches[0].clientY;
        },
        handleTouchEnd(e) {
            const touchEndY = e.changedTouches[0].clientY;
            const diff = this.touchStartY - touchEndY;
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    this.nextProduct();
                } else {
                    this.prevProduct();
                }
            }
        },
        goToDetail(slug) {
            if (slug && slug !== '#') {
                window.location.href = '/product/' + slug;
            }
        }
     }"
     @wheel.prevent="handleWheel"
     @touchstart="handleTouchStart"
     @touchend="handleTouchEnd"
     @keydown.arrow-down.window="nextProduct()"
     @keydown.arrow-up.window="prevProduct()">
    
    <!-- Products Container - Vertical Scroll -->
    <div class="relative h-full w-full ease-out"
         :class="useTransition ? 'transition-transform duration-700' : ''"
         :style="'transform: translateY(-' + (currentIndex * 100) + '%)'">
        
        <!-- Real Products -->
        @foreach($products as $index => $product)
            <section class="h-screen w-full relative flex-shrink-0">
                <!-- Background Image -->
                <div class="absolute inset-0 cursor-pointer" 
                     @click="goToDetail('{{ $product['slug'] }}')">
                    <img src="{{ $product['image'] }}" 
                         alt="{{ $product['title'] }}" 
                         class="w-full h-full object-cover">
                </div>

                <!-- Gradient Overlays -->
                <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-transparent pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>

                <!-- Product Info - Left Bottom -->
                <div class="absolute left-0 bottom-0 z-20 p-8 lg:p-16 max-w-xl pointer-events-none">
                    <!-- Badge -->
                    <div class="mb-4">
                        <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-white/80">
                            {{ $product['badge'] ?? 'New Collection' }}
                        </span>
                    </div>
                    
                    <!-- Product Name -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white leading-tight mb-4 drop-shadow-lg">
                        {{ $product['title'] }}
                    </h1>
                    
                    <!-- Description -->
                    <p class="text-base md:text-lg text-white/90 mb-6 leading-relaxed drop-shadow-md max-w-md">
                        {{ $product['description'] }}
                    </p>
                    
                    <!-- Price -->
                    <div class="mb-8">
                        <span class="text-3xl md:text-4xl font-display font-bold text-white drop-shadow-lg">
                            {{ $product['price'] }}
                        </span>
                        @if(!empty($product['oldPrice']))
                            <span class="ml-3 text-lg text-white/60 line-through">
                                {{ $product['oldPrice'] }}
                            </span>
                        @endif
                    </div>
                </div>
            </section>
        @endforeach

        <!-- CLONE First Product (for seamless loop) -->
        @if(count($products) > 0)
            @php $product = $products[0]; @endphp
            <section class="h-screen w-full relative flex-shrink-0" aria-hidden="true">
                <div class="absolute inset-0 cursor-pointer" 
                     @click="goToDetail('{{ $product['slug'] }}')">
                    <img src="{{ $product['image'] }}" 
                         alt="{{ $product['title'] }}" 
                         class="w-full h-full object-cover">
                </div>
                <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-transparent to-transparent pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent pointer-events-none"></div>
                <div class="absolute left-0 bottom-0 z-20 p-8 lg:p-16 max-w-xl pointer-events-none">
                    <div class="mb-4">
                        <span class="inline-block text-xs font-bold tracking-[0.2em] uppercase text-white/80">
                            {{ $product['badge'] ?? 'New Collection' }}
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-display font-bold text-white leading-tight mb-4 drop-shadow-lg">
                        {{ $product['title'] }}
                    </h1>
                    <p class="text-base md:text-lg text-white/90 mb-6 leading-relaxed drop-shadow-md max-w-md">
                        {{ $product['description'] }}
                    </p>
                    <div class="mb-8">
                        <span class="text-3xl md:text-4xl font-display font-bold text-white drop-shadow-lg">
                            {{ $product['price'] }}
                        </span>
                        @if(!empty($product['oldPrice']))
                            <span class="ml-3 text-lg text-white/60 line-through">
                                {{ $product['oldPrice'] }}
                            </span>
                        @endif
                    </div>
                </div>
            </section>
        @endif
    </div>

    <!-- Navigation Dots - Right Side -->
    <div class="fixed right-6 lg:right-12 top-1/2 transform -translate-y-1/2 z-40 flex flex-col gap-3">
        @foreach($products as $index => $product)
            <button class="w-1.5 h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                    :class="(currentIndex === {{ $index }} || (currentIndex === products.length && {{ $index }} === 0))
                        ? 'bg-white scale-150' 
                        : 'bg-white/40 hover:bg-white/70'"
                    @click="goToProduct({{ $index }})"></button>
        @endforeach
    </div>

    <!-- Scroll Indicator - Only show on first product (real or clone reset) -->
    <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-40 animate-bounce"
         x-show="currentIndex === 0"
         x-transition>
        <div class="flex flex-col items-center text-white/60">
            <span class="text-xs uppercase tracking-widest mb-2">Scroll</span>
            <span class="material-icons-outlined text-3xl">keyboard_arrow_down</span>
        </div>
    </div>

    <!-- Product Counter -->
    <div class="fixed bottom-8 right-6 lg:right-12 z-40 text-white/60 font-display text-sm">
        <span class="text-white font-bold text-lg" x-text="(currentIndex === products.length ? 1 : currentIndex + 1)"></span>
        <span class="mx-1">/</span>
        <span x-text="products.length"></span>
    </div>
</div>
