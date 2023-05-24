<?php

namespace App\Http\Livewire\Pembeli\Product;

use Livewire\Component;

class View extends Component
{
    public $category;
    public $product;

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.pembeli.product.view', [
            'category' => $this->category,
            'product' => $this->product,
        ]);
    }
}
