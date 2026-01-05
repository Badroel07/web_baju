<div class="container mx-auto px-4 lg:px-8 py-24 min-h-screen">
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    
    <h1 class="text-4xl font-display font-bold mb-8 text-white">Checkout</h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Form -->
        <div class="bg-surface-dark p-8">
            <h2 class="text-2xl font-bold text-white mb-6">Customer Information</h2>
            
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-400 mb-2">Full Name</label>
                    <input type="text" wire:model="name" class="w-full bg-gray-800 border-none text-white focus:ring-primary p-3">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-gray-400 mb-2">Email Address</label>
                    <input type="email" wire:model="email" class="w-full bg-gray-800 border-none text-white focus:ring-primary p-3">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Summary -->
        <div class="bg-surface-dark p-8 h-fit">
            <h2 class="text-2xl font-bold text-white mb-6">Order Summary</h2>
            
            <div class="space-y-4 mb-6">
                @foreach($cart as $item)
                    <div class="flex justify-between items-center text-gray-300">
                        <div>
                            <span class="block font-bold">{{ $item['name'] }}</span>
                            <span class="text-xs text-gray-500">Size: {{ $item['size'] }} x {{ $item['quantity'] }}</span>
                        </div>
                        <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-gray-700 pt-4 mb-8">
                <div class="flex justify-between text-white font-bold text-xl">
                    <span>Total</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
            </div>

            <button wire:click="processPayment" wire:loading.attr="disabled" class="w-full bg-primary text-white py-4 font-bold uppercase tracking-wide hover:bg-red-600 transition-colors disabled:opacity-50">
                <span wire:loading.remove>Place Order & Pay</span>
                <span wire:loading>Processing...</span>
            </button>
            
            @if(session()->has('error'))
                <div class="bg-red-500/10 text-red-500 p-4 mt-4 text-center">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>

@script
<script>
    Livewire.on('startPayment', (event) => {
        // Access the token from the event detail
        const token = event.token;
        
        window.snap.pay(token, {
            onSuccess: function(result) {
                // Handle success (redirect to success page or clear cart)
                window.location.href = '/'; // Or a success route
            },
            onPending: function(result) {
                // Pending
                window.location.href = '/';
            },
            onError: function(result) {
                alert("Payment failed!");
            },
            onClose: function() {
                alert('You closed the popup without finishing the payment');
            }
        });
    });
</script>
@endscript
