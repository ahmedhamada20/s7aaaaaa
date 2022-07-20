<?php

namespace App\Http\Livewire\Website;

use App\Models\Product;
use Livewire\Component;
use Ramsey\Collection\Collection;

class FeatureProduct extends Component
{

    public function render()
    {
        return view('livewire.website.feature-product', [
            'feature_products' => Product::with('photo')->inRandomOrder()->Feature()->Status()->ActiveCategory()->HasQuantity()->take(8)->get(),
        ]);
    }
}
