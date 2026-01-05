<div class="container mx-auto px-4 lg:px-8 py-24 min-h-screen">
    <!-- Breadcrumb -->
    <nav class="flex mb-8 text-sm text-gray-400">
        <a href="{{ route('home') }}" class="hover:text-white transition-colors" wire:navigate>Home</a>
        <span class="mx-2">/</span>
        <span class="text-white">{{ $product->name }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Gallery -->
        <div class="space-y-4" x-data="{ activeImage: '{{ !empty($product->images) ? \Illuminate\Support\Facades\Storage::url($product->images[0]) : '' }}' }">
            <div class="aspect-[3/4] bg-gray-800 overflow-hidden relative rounded-sm">
                <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
            
            @if(!empty($product->images) && count($product->images) > 1)
                <div class="grid grid-cols-4 gap-4">
                    @foreach($product->images as $image)
                        <button class="aspect-square bg-gray-800 overflow-hidden rounded-sm border-2 border-transparent hover:border-primary transition-all"
                                @click="activeImage = '{{ \Illuminate\Support\Facades\Storage::url($image) }}'">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($image) }}" alt="Thumbnail" class="w-full h-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Info -->
        <div class="text-text-dark">
            <div class="mb-2">
                <span class="inline-block py-1 px-2 text-xs font-bold tracking-widest uppercase bg-gray-800 text-gray-300">
                    {{ $product->category->name }}
                </span>
            </div>

            <h1 class="text-4xl lg:text-5xl font-display font-bold mb-4">{{ $product->name }}</h1>
            
            <div class="flex items-baseline mb-6 gap-4">
                <span class="text-3xl font-bold text-primary">${{ number_format($product->price, 2) }}</span>
                @if($product->sale_price)
                    <span class="text-lg text-gray-500 line-through">${{ number_format($product->sale_price, 2) }}</span>
                @endif
            </div>

            <div class="prose prose-invert prose-lg text-gray-300 mb-8">
                {!! $product->description !!}
            </div>

            <!-- Sizes -->
            @if(!empty($product->sizes))
                <div class="mb-8">
                    <h3 class="text-sm font-bold uppercase tracking-wider mb-3">Select Size</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($product->sizes as $size)
                            <button 
                                wire:click="$set('selectedSize', '{{ $size }}')"
                                class="w-12 h-12 flex items-center justify-center border transition-all font-medium rounded-sm {{ $selectedSize === $size ? 'border-primary bg-primary text-white' : 'border-gray-600 hover:border-white hover:bg-white hover:text-black' }}">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                    @if(!$selectedSize && !empty($product->sizes)) 
                        <span class="text-red-500 text-sm mt-2 block" x-show="$wire.selectedSize == null">Please select a size</span>
                    @endif
                </div>
            @endif

            <!-- Add to Cart -->
            <div class="flex gap-4">
                <button wire:click="addToCart" class="flex-1 bg-primary text-white py-4 px-8 font-bold uppercase tracking-wide hover:bg-red-600 transition-colors">
                    Add to Cart
                </button>
                <button class="w-16 flex items-center justify-center border border-gray-600 hover:border-white transition-colors text-white">
                    <span class="material-icons-outlined">favorite_border</span>
                </button>
            </div>
            
            <!-- Metadata -->
            <div class="mt-12 pt-8 border-t border-gray-800 text-sm text-gray-500 space-y-2">
                <p>SKU: UQ-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p>Stock: {{ $product->stock }} items left</p>
            </div>
        </div>
    </div>
</div>
