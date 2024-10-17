<?php

/*namespace App\Livewire;

use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        return view('livewire.products');
    }
}*/

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
        $this->products = Product::all();
    }

    // Método para crear o actualizar un producto
    public function saveProduct()
{
    // Validación de los campos
    $this->validate([
        'name' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ]);

    // Si estamos actualizando un producto existente
    if ($this->product_id) {
        $product = Product::find($this->product_id);

        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => auth()->id(), // Asignar el user_id del usuario autenticado
        ]);
    } else {
        // Si estamos creando un nuevo producto
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => auth()->id(), // Asignar el user_id del usuario autenticado
        ]);
    }

    // Actualizar la lista de productos después de guardar
    $this->products = Product::all();

    // Limpiar el formulario
    $this->resetForm();
}

    // Método para eliminar un producto
    public function deleteProduct($id)
    {
        Product::find($id)->delete();
        $this->products = Product::all(); // Actualiza la lista de productos
    }

    // Método para editar un producto
    public function editProduct($id)
    {
        $product = Product::find($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->quantity = $product->quantity;
        $this->price = $product->price;
    }

    // Método para limpiar el formulario
    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->quantity = '';
        $this->price = '';
        $this->product_id = null;
    }

    public function render()
    {
        return view('livewire.products')->layout('layouts.app');  // Especifica el layout correcto
    }
}
