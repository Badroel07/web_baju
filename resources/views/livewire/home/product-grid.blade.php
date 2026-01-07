<div id="products" class="bg-background-light dark:bg-background-dark">
    <!-- Section Header -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-end mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Trending Minggu Ini</h2>
            <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white flex items-center">
                Lihat Semua <span class="material-icons-outlined text-base ml-1">arrow_forward</span>
            </a>
        </div>

        <!-- Category Filter -->
        <div class="flex space-x-4 overflow-x-auto pb-4 mb-8 border-b border-gray-200 dark:border-gray-800">
            <button wire:click="setCategory('all')" 
                    class="whitespace-nowrap pb-2 px-1 border-b-2 text-sm font-medium transition-colors {{ $activeCategory === 'all' ? 'border-gray-900 dark:border-white text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Semua
            </button>
            <button wire:click="setCategory('outerwear')" 
                    class="whitespace-nowrap pb-2 px-1 border-b-2 text-sm font-medium transition-colors {{ $activeCategory === 'outerwear' ? 'border-gray-900 dark:border-white text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Outerwear
            </button>
            <button wire:click="setCategory('tshirts')" 
                    class="whitespace-nowrap pb-2 px-1 border-b-2 text-sm font-medium transition-colors {{ $activeCategory === 'tshirts' ? 'border-gray-900 dark:border-white text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                T-Shirts
            </button>
            <button wire:click="setCategory('pants')" 
                    class="whitespace-nowrap pb-2 px-1 border-b-2 text-sm font-medium transition-colors {{ $activeCategory === 'pants' ? 'border-gray-900 dark:border-white text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Pants
            </button>
            <button wire:click="setCategory('accessories')" 
                    class="whitespace-nowrap pb-2 px-1 border-b-2 text-sm font-medium transition-colors {{ $activeCategory === 'accessories' ? 'border-gray-900 dark:border-white text-gray-900 dark:text-white' : 'border-transparent text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300' }}">
                Accessories
            </button>
        </div>

        <!-- Product Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-y-10 gap-x-6 xl:gap-x-8">
            @forelse($products as $product)
                <div class="group relative hover:-translate-y-1 transition-transform duration-200">
                    <!-- Product Image -->
                    <a href="{{ route('product.show', $product['slug']) }}" wire:navigate>
                        <div class="aspect-[3/4] bg-gray-200 dark:bg-accent-dark overflow-hidden group-hover:opacity-90 transition-opacity">
                            @if($product['image'])
                                <img src="{{ $product['image'] }}" 
                                     alt="{{ $product['name'] }}" 
                                     class="w-full h-full object-center object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <span class="material-icons-outlined text-6xl">image</span>
                                </div>
                            @endif
                            @if($product['badge'])
                                <div class="absolute top-2 left-2 bg-black dark:bg-white text-white dark:text-black text-xs font-bold px-2 py-1 uppercase">
                                    {{ $product['badge'] }}
                                </div>
                            @endif
                        </div>
                    </a>

                    <!-- Product Info -->
                    <div class="mt-4 flex justify-between">
                        <div>
                            <h3 class="text-sm text-gray-700 dark:text-gray-200">
                                <a href="{{ route('product.show', $product['slug']) }}" wire:navigate>
                                    {{ $product['name'] }}
                                </a>
                            </h3>
                        </div>
                        <div class="flex flex-col items-end">
                            @if($product['sale_price'] && $product['sale_price'] > $product['price'])
                                <p class="text-xs text-gray-400 line-through">Rp{{ number_format($product['sale_price'], 0, ',', '.') }}</p>
                            @endif
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500 dark:text-gray-400">
                    <span class="material-icons-outlined text-4xl mb-2">inventory_2</span>
                    <p>Belum ada produk tersedia</p>
                </div>
            @endforelse
        </div>

        <!-- Load More -->
        @if(count($products) >= $limit)
            <div class="mt-16 text-center">
                <button wire:click="loadMore" 
                        class="inline-block border border-gray-900 dark:border-white px-10 py-3 text-sm font-medium text-gray-900 dark:text-white hover:bg-gray-900 hover:text-white dark:hover:bg-white dark:hover:text-black transition-colors">
                    Muat Lebih Banyak
                </button>
            </div>
        @endif
    </section>
</div>
