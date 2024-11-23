<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class Products extends Component
{
    public $products; // Variable para almacenar la lista de productos
    public $name, $description, $quantity, $price; // Propiedades del formulario
    public $product_id; // ID del producto para edición

    public function mount()
    {
        // Al cargar el componente, obtiene los productos de la base de datos
        $this->products = Product::with('categories')->get();
    }

    // Método para eliminar un producto
    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        $this->products = Product::all(); // Actualiza la lista de productos
    }

    public function render()
    {
        return view('livewire.products')->layout('layouts.app');
    }


}