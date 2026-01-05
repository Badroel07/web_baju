<?php

namespace App\Livewire\Home;

use App\Models\Category;
use Livewire\Component;

class CategoryGrid extends Component
{
    public function render()
    {
        return view('livewire.home.category-grid', [
            'categories' => Category::active()->take(4)->get()
        ]);
    }
}
