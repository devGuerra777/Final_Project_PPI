<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;

class ProductShow extends Component
{
    public $product;
    public $name, $description, $quantity, $price;
    public $isEditing = false; // Controla el modo de edición
    public $categories;
    public $selectedCategories = [];

    public function mount($id)
    {
        $this->product = Product::with('categories')->findOrFail($id); // Incluye las categorías
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->quantity = $this->product->quantity;
        $this->price = $this->product->price;
        // Carga las categorías disponibles y seleccionadas
        $this->categories = Category::all();
        $this->selectedCategories = $this->product->categories->pluck('id')->toArray();
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
            'selectedCategories' => 'array', // Validación para categorías
        ]);

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);

        // Sincronizar categorías
        $this->product->categories()->sync($this->selectedCategories);

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
