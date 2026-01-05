<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductDetail extends Component
{
    public Product $product;

    public $selectedSize = null;
    public $quantity = 1;

    public function mount(Product $product)
    {
        $this->product = $product;
        
        if (!$this->product->is_active) {
            abort(404);
        }
    }

    public function addToCart()
    {
        if (empty($this->product->sizes) || empty($this->selectedSize)) {
            // If product has sizes, size must be selected
             if (!empty($this->product->sizes) && !$this->selectedSize) {
                // Flash error or handle UI state (skipping for now, simple implementation)
                return;
             }
        }

        $cart = Session::get('cart', []);
        
        $cartKey = $this->product->id . '-' . ($this->selectedSize ?? 'default');

        if (isset($cart[$cartKey])) {
            $cart[$cartKey]['quantity'] += $this->quantity;
        } else {
            $cart[$cartKey] = [
                'id' => $this->product->id,
                'name' => $this->product->name,
                'price' => $this->product->sale_price ?? $this->product->price,
                'size' => $this->selectedSize,
                'image' => !empty($this->product->images) ? \Illuminate\Support\Facades\Storage::url($this->product->images[0]) : null,
                'quantity' => $this->quantity,
            ];
        }

        Session::put('cart', $cart);
        $this->dispatch('cartUpdated');
    }

    public function render()
    {
        return view('livewire.product.product-detail');
    }
}
