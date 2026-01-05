<?php

namespace App\Livewire\Home;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class HeroSection extends Component
{
    public function render()
    {
        $products = Product::active()->latest()->take(3)->get()->map(function($product) {
            $images = $product->images ?? [];
            $image = !empty($images) ? Storage::url($images[0]) : 'https://via.placeholder.com/1920x1080?text=No+Image';
            
            return [
                'id' => $product->id,
                'image' => $image,
                'badge' => 'New Arrival',
                'title' => $product->name,
                'description' => Str::limit(strip_tags($product->description), 150),
                'price' => '$' . number_format($product->price, 2),
                'oldPrice' => $product->sale_price ? '$' . number_format($product->sale_price, 2) : null,
                'slug' => $product->slug,
            ];
        });

        // Fallback for empty DB (Development only)
        if ($products->isEmpty()) {
            $products = collect([
                [
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA3pdvuBIlm3TkJhzB9M_TwpeApwfiYUns4Od32KxfFxGeYwP-Noj4d4CuEV3vv0N7a1criNyc3fYgwLXDdeOxjttZKnkAWG_vfX8H2krYPm6dwxXgjBszv5_llbW_xmbXUWRYpiY9qunhNKvw9lpOZ_8w9WxtDyrhJANoxUvCM-xnyRS1MT_NvpLZ7aH5pugG5Acc2k3rCsL2SdXhNUU5L2s0J5FfGKS5CRVSFY3wC1HkqbvdzPuggzWrek-DR4XmISVRi3KjPJUQ',
                    'badge' => 'New Arrival',
                    'title' => 'Zip Short<br>Blouson',
                    'description' => 'A practical jacket with a relaxed silhouette & slightly cropped cut.',
                    'price' => '$49.90',
                    'oldPrice' => '$69.90',
                    'slug' => '#',
                ]
            ]);
        }

        return view('livewire.home.hero-section', [
            'products' => $products
        ]);
    }
}
