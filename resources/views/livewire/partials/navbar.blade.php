<div>
    <!-- Gradient Shadow Overlay for Navbar -->
    <div class="fixed top-0 left-0 right-0 z-40 h-32 bg-gradient-to-b from-black/60 via-black/30 to-transparent pointer-events-none"></div>

    <header class="fixed top-0 left-0 right-0 z-50 w-full transition-all duration-300 bg-transparent">
        <div class="container mx-auto px-4 lg:px-8 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex-shrink-0" wire:navigate>
                <div class="logo-box">
                    <span>UQ</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-12 font-display font-medium tracking-wide text-sm uppercase">
                <a href="#" class="nav-link text-white transition-colors drop-shadow-md">Wanita</a>
                <a href="#" class="nav-link text-white transition-colors drop-shadow-md">Pria</a>
                <a href="#" class="nav-link text-white transition-colors drop-shadow-md">Anak</a>
                <a href="#" class="nav-link text-white transition-colors drop-shadow-md">Bayi</a>
            </nav>

            <!-- Icons -->
            <div class="flex items-center space-x-6">
                <button class="text-white hover:text-gray-300 transition-colors drop-shadow-md">
                    <span class="material-icons-outlined text-2xl">search</span>
                </button>
                <button class="text-white hover:text-gray-300 transition-colors hidden sm:block drop-shadow-md">
                    <span class="material-icons-outlined text-2xl">favorite_border</span>
                </button>
                <button class="text-white hover:text-gray-300 transition-colors hidden sm:block drop-shadow-md">
                    <span class="material-icons-outlined text-2xl">person_outline</span>
                </button>
                <a href="{{ route('cart') }}" class="text-white hover:text-gray-300 transition-colors relative drop-shadow-md" wire:navigate>
                    <span class="material-icons-outlined text-2xl">shopping_cart</span>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-white text-black text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>
                <button class="md:hidden text-white hover:text-gray-300 transition-colors drop-shadow-md">
                    <span class="material-icons-outlined text-2xl">menu</span>
                </button>
            </div>
        </div>
    </header>
</div>
