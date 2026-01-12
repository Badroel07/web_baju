<div class="container mx-auto px-4 lg:px-8 py-24 min-h-screen">
    <h1 class="text-4xl font-display font-bold mb-8 text-white">Shopping Cart</h1>

    @if(count($cart) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $key => $item)
                    <div class="bg-surface-dark p-4 flex gap-4 items-center">
                        <div class="w-20 h-24 bg-gray-800 flex-shrink-0">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-white font-bold">{{ $item['name'] }}</h3>
                            <p class="text-sm text-gray-400">Size: {{ $item['size'] }}</p>
                            <p class="text-primary font-bold">Rp{{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button wire:click="updateQuantity('{{ $key }}', {{ $item['quantity'] - 1 }})" class="w-6 h-6 flex items-center justify-center bg-gray-600 text-white rounded-full hover:bg-gray-500">-</button>
                            <span class="text-white w-4 text-center">{{ $item['quantity'] }}</span>
                            <button wire:click="updateQuantity('{{ $key }}', {{ $item['quantity'] + 1 }})" class="w-6 h-6 flex items-center justify-center bg-gray-600 text-white rounded-full hover:bg-gray-500">+</button>
                        </div>
                        <button wire:click="removeFromCart('{{ $key }}')" class="text-gray-500 hover:text-red-500 ml-4">
                            <span class="material-icons-outlined">delete</span>
                        </button>
                    </div>
                @endforeach
            </div>

            <div class="bg-surface-dark p-6 h-fit sticky top-24">
                <h3 class="text-xl font-bold text-white mb-4">Summary</h3>
                <div class="flex justify-between text-gray-400 mb-2">
                    <span>Subtotal</span>
                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-white font-bold text-lg mb-6 border-t border-gray-700 pt-4">
                    <span>Total</span>
                    <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="block w-full bg-white text-gray-900 text-center py-3 font-bold uppercase tracking-wider hover:bg-gray-100 transition-colors">
                    Checkout
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-20 text-gray-400">
            <span class="material-icons-outlined text-6xl mb-4">shopping_cart</span>
            <p class="text-xl">Your cart is empty.</p>
            <a href="{{ route('home') }}" class="inline-block mt-4 text-primary hover:underline">Continue Shopping</a>
        </div>
    @endif
</div>
