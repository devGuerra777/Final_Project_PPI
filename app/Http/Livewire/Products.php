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
        $this->products = Product::all();
    }

    // Método para crear un nuevo producto
    public function store()
    {
        // Validación de los campos
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Crear un nuevo producto
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => auth()->id(), // Asignar el user_id del usuario autenticado
        ]);

        // Actualizar la lista de productos después de guardar
        $this->products = Product::all();

        // Limpiar el formulario
        $this->resetForm();
    }

    // Método para actualizar un producto existente
    public function update()
    {
        // Validación de los campos
        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Buscar el producto y actualizarlo
        $product = Product::find($this->product_id);

        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => auth()->id(), // Asignar el user_id del usuario autenticado
        ]);

        // Actualizar la lista de productos después de actualizar
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
        return view('livewire.products')->layout('layouts.app');
    }


}