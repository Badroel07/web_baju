<header class="fixed top-0 left-0 right-0 z-40 w-full transition-all duration-300 bg-black/80 backdrop-blur-md border-b border-gray-800">
    <div class="container mx-auto px-4 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex-shrink-0" wire:navigate>
            <div class="logo-box">
                <span>UQ</span>
            </div>
        </a>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-12 font-display font-medium tracking-wide text-sm uppercase">
            <a href="#" class="nav-link text-white hover:text-primary transition-colors">Women</a>
            <a href="#" class="nav-link text-white hover:text-primary transition-colors">Men</a>
            <a href="#" class="nav-link text-white hover:text-primary transition-colors">Kids</a>
            <a href="#" class="nav-link text-white hover:text-primary transition-colors">Baby</a>
        </nav>

        <!-- Icons -->
        <div class="flex items-center space-x-6">
            <button class="text-white hover:text-primary transition-colors">
                <span class="material-icons-outlined text-2xl">search</span>
            </button>
            <button class="text-white hover:text-primary transition-colors hidden sm:block">
                <span class="material-icons-outlined text-2xl">favorite_border</span>
            </button>
            <button class="text-white hover:text-primary transition-colors hidden sm:block">
                <span class="material-icons-outlined text-2xl">person_outline</span>
            </button>
            <a href="{{ route('cart') }}" class="text-white hover:text-primary transition-colors relative" wire:navigate>
                <span class="material-icons-outlined text-2xl">shopping_cart</span>
                @if($cartCount > 0)
                    <span class="absolute -top-2 -right-2 bg-primary text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            <button class="md:hidden text-white hover:text-primary transition-colors">
                <span class="material-icons-outlined text-2xl">menu</span>
            </button>
        </div>
    </div>
</header>
