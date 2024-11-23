<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;





//TODO FALTA POR CREAR LA VISTA Y LA LOGICA PARA HACER USO DE LA RELACION M:N MUCHOS A MUCHOS 
//DE LA TABLA PIVOTE QUE HACEMOS USO CATEGORIAS, YA CREEAMOS LAS SEEDES ACOMODAMOS EL LAYOUT Y DEFINIMOS LAS RELACIONES EN EL MODELO

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

    public function render()
    {
        return view('livewire.products')->layout('layouts.app');
    }


}