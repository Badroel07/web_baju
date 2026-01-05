<?php

namespace App\Livewire\Partials;

use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Navbar extends Component
{
    public $cartCount = 0;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $cart = Session::get('cart', []);
        $this->cartCount = collect($cart)->sum('quantity');
    }

    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
