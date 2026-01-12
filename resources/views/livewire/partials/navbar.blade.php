<div class="fixed top-0 left-0 right-0 z-50" x-data="{ mobileMenuOpen: false }">
    <!-- Navbar -->
    <nav class="bg-surface-light dark:bg-surface-dark shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo & Nav Links -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-2 cursor-pointer" wire:navigate>
                        <span class="material-icons-outlined text-3xl dark:text-white">checkroom</span>
                        <span class="font-bold text-xl tracking-tight uppercase dark:text-white">Urban Essentials</span>
                    </a>
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                            Women
                        </a>
                        <a href="#" class="border-primary dark:border-white text-gray-900 dark:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                            Men
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                            Kids
                        </a>
                        <a href="#" class="border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors">
                            Sale
                        </a>
                    </div>
                </div>

                <!-- Search & Icons -->
                <div class="flex items-center space-x-4 sm:space-x-6">
                    <!-- Search Bar -->
                    <form class="hidden lg:block relative text-gray-400 focus-within:text-gray-600 dark:focus-within:text-gray-200" action="#" method="get">
                        <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center">
                            <span class="material-icons-outlined text-lg">search</span>
                        </div>
                        <input type="text" 
                               name="q" 
                               autocomplete="on"
                               placeholder="Search by keyword" 
                               class="block w-full bg-gray-100 dark:bg-accent-dark border-transparent focus:border-gray-500 dark:focus:border-gray-500 focus:ring-0 text-gray-900 dark:text-gray-100 sm:text-sm py-2 pl-10 pr-3 placeholder-gray-500 dark:placeholder-gray-400 transition-colors">
                    </form>

                    <!-- Icons -->
                    <div class="flex items-center space-x-2 sm:space-x-4">
                        <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 dark:hover:text-white focus:outline-none hidden sm:block">
                            <span class="material-icons-outlined">person_outline</span>
                        </button>
                        <button class="p-1 rounded-full text-gray-400 hover:text-gray-500 dark:hover:text-white focus:outline-none hidden sm:block">
                            <span class="material-icons-outlined">favorite_border</span>
                        </button>
                        <a href="{{ route('cart') }}" class="p-1 rounded-full text-gray-400 hover:text-gray-500 dark:hover:text-white focus:outline-none relative" wire:navigate>
                            <span class="material-icons-outlined">shopping_bag</span>
                            @if($cartCount > 0)
                                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white transform translate-x-1/4 -translate-y-1/4 bg-black dark:bg-white dark:text-black rounded-full">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden p-1 rounded-full text-gray-400 hover:text-gray-500 dark:hover:text-white focus:outline-none">
                            <span class="material-icons-outlined" x-text="mobileMenuOpen ? 'close' : 'menu'">menu</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div x-show="mobileMenuOpen" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             x-cloak
             class="md:hidden border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-accent-dark rounded-md">Men</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-accent-dark rounded-md">Women</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-accent-dark rounded-md">Kids</a>
                <a href="#" class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-accent-dark rounded-md">Sale</a>
            </div>
        </div>
    </nav>
</div>
