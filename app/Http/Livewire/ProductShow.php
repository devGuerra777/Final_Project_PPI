<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductShow extends Component
{
    public $product;
    public $name, $description, $quantity, $price;
    public $isEditing = false; // Controla el modo de edición

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->quantity = $this->product->quantity;
        $this->price = $this->product->price;
    }

    public function enableEditing()
    {
        $this->isEditing = true;
    }

    public function cancelEditing()
    {
        $this->isEditing = false;
        $this->resetFields();
    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);

        $this->isEditing = false;
        session()->flash('message', 'Producto actualizado con éxito.');
    }

    public function resetFields()
    {
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->quantity = $this->product->quantity;
        $this->price = $this->product->price;
    }

    public function render()
    {
        return view('livewire.product-show')->layout('layouts.app');
    }
}
