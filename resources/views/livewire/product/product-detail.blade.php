<div>
    <livewire:partials.navbar />

    <main class="flex-1 w-full max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-12 py-6 pt-24">
        <!-- Breadcrumbs -->
        <div class="flex flex-wrap items-center gap-2 text-sm text-gray-500 mb-6">
            <a class="hover:text-gray-900 transition-colors" href="{{ route('home') }}" wire:navigate>Home</a>
            <span class="text-gray-400">/</span>
            @if($product->category)
                <a class="hover:text-gray-900 transition-colors" href="#">{{ $product->category->name }}</a>
                <span class="text-gray-400">/</span>
            @endif
            <span class="text-gray-800 font-medium">{{ $product->name }}</span>
        </div>

        <div class="lg:grid lg:grid-cols-12 lg:gap-12 relative">
            <!-- Left Column: Product Gallery -->
            <div class="lg:col-span-7 xl:col-span-8 flex flex-col gap-4" x-data="{ activeImage: '{{ !empty($product->images) ? Storage::url($product->images[0]) : '' }}' }">
                <!-- Main Hero Image -->
                <div class="w-full aspect-[4/5] sm:aspect-[16/9] lg:aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden relative group">
                    <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    
                    @if($product->sale_price)
                        <div class="absolute top-4 left-4 bg-gray-900 text-white text-xs font-bold uppercase py-2 px-4 rounded">
                            Sale
                        </div>
                    @endif
                    
                    @if($product->stock <= 5 && $product->stock > 0)
                        <div class="absolute bottom-4 left-4 bg-black/70 backdrop-blur px-3 py-1 rounded text-xs font-medium text-white">
                            Only {{ $product->stock }} left in stock
                        </div>
                    @endif
                </div>

                <!-- Secondary Images Grid -->
                @if(!empty($product->images) && count($product->images) > 1)
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                            <button class="w-full aspect-[3/4] bg-gray-100 rounded-lg overflow-hidden group cursor-pointer border-2 transition-all duration-300"
                                    :class="activeImage === '{{ Storage::url($image) }}' ? 'border-gray-900' : 'border-transparent hover:border-gray-300'"
                                    @click="activeImage = '{{ Storage::url($image) }}'">
                                <img src="{{ Storage::url($image) }}" alt="Product thumbnail" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Column: Sticky Product Details -->
            <div class="lg:col-span-5 xl:col-span-4 mt-8 lg:mt-0">
                <div class="sticky top-24 flex flex-col gap-6">
                    
                    <!-- Header Info -->
                    <div class="border-b border-gray-200 pb-6">
                        <div class="flex justify-between items-start mb-2">
                            <h1 class="text-3xl md:text-4xl font-display font-bold tracking-tight text-gray-900 leading-tight uppercase">
                                {{ $product->name }}
                            </h1>
                            <button class="text-gray-400 hover:text-gray-900 transition-colors p-2">
                                <span class="material-icons-outlined">share</span>
                            </button>
                        </div>
                        
                        <div class="flex items-end gap-3 mb-4">
                            <span class="text-3xl font-display font-bold text-gray-900">Rp{{ number_format($product->price ?? 0, 0, ',', '.') }}</span>
                            @if($product->sale_price)
                                <span class="text-sm text-gray-400 mb-1 line-through">Rp{{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                <span class="text-xs font-bold bg-gray-100 text-gray-700 px-2 py-0.5 rounded mb-1">SALE</span>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="flex items-center gap-2">
                            @if($product->stock > 0)
                                <span class="w-2 h-2 rounded-full bg-gray-900"></span>
                                <span class="text-sm text-gray-700 font-medium">In Stock</span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                <span class="text-sm text-gray-400 font-medium">Out of Stock</span>
                            @endif
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-sm leading-relaxed text-gray-600">
                        {{ Str::limit(strip_tags($product->description), 200) }}
                    </p>

                    <!-- Size Selector -->
                    @if(!empty($product->sizes))
                        <div>
                            <div class="flex justify-between mb-3">
                                <span class="text-sm font-bold text-gray-900">Size: 
                                    <span class="font-normal text-gray-500">{{ $selectedSize ?? 'Select' }}</span>
                                </span>
                                <button class="text-xs underline text-gray-500 hover:text-gray-900 transition-colors">Size Chart</button>
                            </div>
                            <div class="grid grid-cols-6 gap-2">
                                @foreach($product->sizes as $size)
                                    <button wire:click="$set('selectedSize', '{{ $size }}')"
                                            class="h-12 rounded border text-sm font-medium transition-all duration-200
                                            {{ $selectedSize === $size 
                                                ? 'border-gray-900 bg-gray-900 text-white' 
                                                : 'border-gray-300 bg-white text-gray-700 hover:border-gray-400' 
                                            }}">
                                        {{ $size }}
                                    </button>
                                @endforeach
                            </div>
                            @if(!$selectedSize && !empty($product->sizes))
                                <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                    <span class="material-icons-outlined text-sm">info</span>
                                    Please select a size
                                </p>
                            @endif
                        </div>
                    @endif

                    <!-- Quantity Selector -->
                    <div>
                        <span class="text-sm font-bold text-gray-900 mb-3 block">Quantity</span>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center bg-white border border-gray-300 rounded-lg overflow-hidden">
                                <button wire:click="$decrement('quantity')" 
                                        class="w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition-colors text-gray-700 disabled:opacity-50"
                                        {{ $quantity <= 1 ? 'disabled' : '' }}>
                                    <span class="material-icons-outlined text-sm">remove</span>
                                </button>
                                <span class="w-12 text-center font-display text-lg text-gray-900 font-bold select-none">{{ $quantity }}</span>
                                <button wire:click="$increment('quantity')" 
                                        class="w-12 h-12 flex items-center justify-center hover:bg-gray-100 transition-colors text-gray-700">
                                    <span class="material-icons-outlined text-sm">add</span>
                                </button>
                            </div>
                            <span class="text-sm text-gray-500">
                                <span class="text-gray-900 font-medium">{{ $product->stock }}</span> available
                            </span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-3 pt-2">
                        <button wire:click="addToCart" 
                                class="flex-1 h-14 bg-gray-900 hover:bg-gray-800 active:scale-[0.98] text-white font-bold text-sm tracking-wide rounded-lg flex items-center justify-center gap-2 transition-all shadow-lg uppercase">
                            <span class="material-icons-outlined">shopping_bag</span>
                            Add to Cart
                        </button>
                        <button class="h-14 w-14 border border-gray-300 hover:border-gray-900 hover:text-gray-900 rounded-lg flex items-center justify-center text-gray-500 transition-colors bg-white">
                            <span class="material-icons-outlined">favorite_border</span>
                        </button>
                    </div>

                    <!-- Buy Now Button -->
                    <button wire:click="buyNow" 
                            class="w-full h-14 border-2 border-gray-900 text-gray-900 hover:bg-gray-900 hover:text-white font-bold text-sm tracking-wide rounded-lg flex items-center justify-center gap-2 transition-all uppercase">
                        Buy Now
                        <span class="material-icons-outlined">arrow_forward</span>
                    </button>

                    <!-- Accordions -->
                    <div class="divide-y divide-gray-200 border-t border-gray-200 mt-4">
                        <!-- Description -->
                        <details class="group py-4" open>
                            <summary class="flex items-center justify-between font-bold text-sm text-gray-900 hover:text-gray-600 transition-colors cursor-pointer list-none">
                                Description
                                <span class="material-icons-outlined transition-transform group-open:rotate-180">expand_more</span>
                            </summary>
                            <div class="pt-3 text-sm text-gray-600 leading-relaxed prose max-w-none">
                                {!! $product->description !!}
                            </div>
                        </details>

                        <!-- Shipping & Returns -->
                        <details class="group py-4">
                            <summary class="flex items-center justify-between font-bold text-sm text-gray-900 hover:text-gray-600 transition-colors cursor-pointer list-none">
                                Shipping & Returns
                                <span class="material-icons-outlined transition-transform group-open:rotate-180">expand_more</span>
                            </summary>
                            <div class="pt-3 text-sm text-gray-600 leading-relaxed">
                                Free shipping on orders over $99. Returns accepted within 30 days of purchase with original tags attached.
                            </div>
                        </details>
                    </div>

                    <!-- Trust Badges -->
                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200 text-xs text-gray-500 uppercase tracking-wider font-medium">
                        <div class="flex items-center gap-2">
                            <span class="material-icons-outlined text-base text-gray-700">verified</span>
                            Authentic
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-icons-outlined text-base text-gray-700">local_shipping</span>
                            Free Shipping
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-icons-outlined text-base text-gray-700">autorenew</span>
                            Easy Returns
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
