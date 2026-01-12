<?php

namespace App\Livewire\Home;

use App\Models\Product;
use Livewire\Component;

class ProductGrid extends Component
{
    public $products = [];
    public $activeCategory = 'all';
    public $limit = 8;

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $query = Product::query()->latest();
        
        if ($this->activeCategory !== 'all') {
            // Filter by category if needed
            // $query->where('category', $this->activeCategory);
        }

        $this->products = $query->take($this->limit)->get()->map(function ($product) {
            $images = $product->images ?? [];
            $firstImage = !empty($images) ? $images[0] : null;
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'image' => $firstImage ? \Storage::disk('public')->url($firstImage) : null,
                'badge' => $product->created_at->diffInDays(now()) < 7 ? 'New Arrival' : null,
            ];
        })->toArray();
    }

    public function setCategory($category)
    {
        $this->activeCategory = $category;
        $this->loadProducts();
    }

    public function loadMore()
    {
        $this->limit += 8;
        $this->loadProducts();
    }

    public function render()
    {
        return view('livewire.home.product-grid');
    }
}
