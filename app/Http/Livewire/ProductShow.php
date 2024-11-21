<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductShow extends Component
{
    public $product;

    public function mount($id)
    {
        // Cargar el producto por su ID
        $this->product = Product::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.product-show')->layout('layouts.app');  // Especifica el layout correcto
    }
}
