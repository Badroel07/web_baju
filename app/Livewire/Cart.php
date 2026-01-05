<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Cart extends Component
{
    public $cart = [];
    public $total = 0;

    protected $listeners = ['cartUpdated' => 'loadCart'];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cart = Session::get('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->cart)->sum(function($item) {
            return $item['price'] * $item['quantity'];
        });
    }

    public function removeFromCart($key)
    {
        if (isset($this->cart[$key])) {
            unset($this->cart[$key]);
            Session::put('cart', $this->cart);
            $this->calculateTotal();
            $this->dispatch('cartUpdated');
        }
    }

    public function updateQuantity($key, $quantity)
    {
        if (isset($this->cart[$key]) && $quantity > 0) {
            $this->cart[$key]['quantity'] = $quantity;
            Session::put('cart', $this->cart);
            $this->calculateTotal();
            $this->dispatch('cartUpdated');
        }
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
