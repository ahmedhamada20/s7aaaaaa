<?php

namespace App\Http\Livewire\Website;

use App\Models\Product;
use Livewire\Component;

class ProductModelShow extends Component
{
    public $ProductModelCount = false;
    public $ProductModel = [];
    public $quantity = 1;

    protected $listeners = ['showProductModel'];


    public function decQunitiny()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function incQunitiny()
    {
        if ($this->ProductModel->quantity > $this->quantity) {
            $this->quantity++;
        }else{
            $this->alert('warning', 'The world has warned you.');
        }
    }

    public function showProductModel($slug)
    {
        $this->ProductModelCount = true;
        $this->ProductModel = Product::withAvg('reviews', 'rating')->whereSlug($slug)->Status()->HasQuantity()->ActiveCategory()->firstOrfail();
    }

    public function render()
    {
        return view('livewire.website.product-model-show');
    }
}
