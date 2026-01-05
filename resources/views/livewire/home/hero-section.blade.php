<div>
    <script>
        window.heroProducts = @json($products);
    </script>
    <section class="relative h-screen w-full overflow-hidden flex items-center"
        x-data="{
            currentSlide: 0,
            products: window.heroProducts || [],
            init() {
                if (this.products.length > 0) {
                    setInterval(() => {
                        this.currentSlide = (this.currentSlide + 1) % this.products.length;
                    }, 8000);
                }
            },
            goToDetail() {
                let slug = this.products[this.currentSlide]?.slug;
                if (slug && slug !== '#') {
                    window.location.href = '/product/' + slug;
                }
            }
        }">
        
        <!-- Background Images (Carousel) -->
        <template x-for="(product, index) in products" :key="index">
            <div class="absolute inset-0 z-0 transition-opacity duration-1000"
                 :class="currentSlide === index ? 'opacity-100' : 'opacity-0'">
                <img :src="product.image" 
                     :alt="product.title" 
                     class="w-full h-full object-cover object-top opacity-80">
            </div>
        </template>

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 z-10 bg-gradient-to-r from-black/90 via-black/60 to-transparent"></div>

        <!-- Content -->
        <div class="relative z-20 container mx-auto px-4 lg:px-8 mt-16">
            <div class="max-w-xl text-left">
                <span class="inline-block py-1 px-2 mb-4 text-xs font-bold tracking-widest uppercase bg-primary text-white transition-all duration-500"
                      x-text="products[currentSlide]?.badge"></span>
                <h1 class="text-5xl md:text-7xl font-display font-medium leading-tight mb-4 text-white drop-shadow-sm transition-all duration-500"
                    x-html="products[currentSlide]?.title"></h1>
                <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed font-light max-w-md transition-all duration-500"
                   x-text="products[currentSlide]?.description"></p>
                
                <!-- Pricing -->
                <div class="flex items-baseline mb-10">
                    <span class="text-4xl font-display font-bold text-white transition-all duration-500"
                          x-text="products[currentSlide]?.price"></span>
                    <span class="ml-3 text-sm text-gray-400 line-through transition-all duration-500"
                          x-text="products[currentSlide]?.oldPrice"></span>
                </div>

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Add to Cart: Transparent to White Fill with Icons on Hover -->
                    <button class="btn-scale-fill group bg-transparent border border-white py-4 px-10 font-bold uppercase tracking-wide text-white transition-all duration-300 hover:bg-white hover:text-black flex items-center gap-2">
                        <span class="material-icons-outlined text-xl opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">add</span>
                        <span>Add to Cart</span>
                        <span class="material-icons-outlined text-xl opacity-0 translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0">shopping_cart</span>
                    </button>
                    
                    <!-- View Details: Expanding Pill Effect -->
                    <button class="btn-expand-pill border border-white py-4 px-10 font-bold uppercase tracking-wide text-white transition-colors duration-300 flex items-center gap-2 hover:text-black" @click="goToDetail()">
                        <span>View Details</span>
                        <span class="material-icons-outlined arrow-icon text-xl">arrow_forward</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bounce Arrow -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 animate-bounce hidden md:block">
            <span class="material-icons-outlined text-4xl text-white opacity-50">keyboard_arrow_down</span>
        </div>

        <!-- Side Navigation (Arrows + Dots) -->
        <div class="absolute right-8 top-1/2 transform -translate-y-1/2 z-30 hidden lg:flex flex-col items-center gap-3">
            <!-- Up Arrow -->
            <button class="p-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110"
                    @click="currentSlide = (currentSlide - 1 + products.length) % products.length">
                <span class="material-icons-outlined text-xl text-white">keyboard_arrow_up</span>
            </button>
            
            <!-- Dots -->
            <div class="flex flex-col gap-3 py-2">
                <template x-for="(product, index) in products" :key="index">
                    <button class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300 border-2"
                            :class="currentSlide === index ? 'bg-white border-white scale-125' : 'bg-transparent border-white/50 hover:border-white hover:bg-white/30'"
                            @click="currentSlide = index"></button>
                </template>
            </div>
            
            <!-- Down Arrow -->
            <button class="p-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm rounded-full transition-all duration-300 hover:scale-110"
                    @click="currentSlide = (currentSlide + 1) % products.length">
                <span class="material-icons-outlined text-xl text-white">keyboard_arrow_down</span>
            </button>
        </div>
    </section>
</div>

