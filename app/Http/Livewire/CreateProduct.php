<?php

namespace App\Http\Livewire;
use App\Models\Product;

use Livewire\Component;

class CreateProduct extends Component
{
    public $name, $description, $quantity, $price;

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', 'Producto creado con éxito.');

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.create-product')->layout('layouts.app');  // Especifica el layout correcto;
    }
}
