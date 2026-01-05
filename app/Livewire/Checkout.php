<?php

namespace App\Livewire;

use App\Http\Controllers\PaymentController;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Checkout extends Component
{
    public $name;
    public $email;
    public $address; // Optional if not using shipping calculation
    public $cart = [];
    public $total = 0;

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        
        if (empty($this->cart)) {
            return redirect()->route('home');
        }

        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function processPayment()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(), // Nullable
                'customer_name' => $this->name,
                'customer_email' => $this->email,
                'total_price' => $this->total,
                'status' => 'pending',
            ]);

            // Create Order Items
            foreach ($this->cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'size' => $item['size'],
                ]);
            }

            // Get Snap Token
            $paymentController = new PaymentController();
            $snapToken = $paymentController->getSnapToken($order);

            DB::commit();

            // Clear Cart
            // Session::forget('cart'); // Clear after successful payment or now? 
            // Better clear now or after success. For Snap popup, usually we keep it until success.
            // But for simplicity, let's keep it until we confirm.
            // Actually, we should redirect to "Pending Payment" page or show Popup.
            
            $this->dispatch('startPayment', token: $snapToken);

        } catch (\Exception $e) {
            DB::rollBack();
            // Handle error
            session()->flash('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
