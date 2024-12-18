<?php

namespace App\Http\Livewire;
use App\Models\Product;
use App\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;

use Livewire\Component;

class CreateProduct extends Component
{

    use WithFileUploads;

    public $name, $description, $quantity, $price,$image;

    public $categories = []; // Para almacenar las categorías seleccionadas
    public $categoriesList; // Para cargar todas las categorías disponibles

    public function mount()
    {
        $this->categoriesList = Category::all(); // Carga las categorías
    }

    public function store()
    {
        Log::info('Datos recibidos antes de procesar:', ['categories' => $this->categories]);

        // Convertir categorías a un arreglo de IDs si es necesario
        $categoryIds = is_array($this->categories) 
            ? $this->categories 
            : (is_object($this->categories) && method_exists($this->categories, 'pluck') 
                ? $this->categories->pluck('id')->toArray() 
                : []);

        Log::info('IDs de categorías procesados:', ['ids' => $categoryIds]);

        $this->validate([
            'name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:2048', // Máximo 2MB
        ]);

        // Guarda la imagen en storage/public/products y retorna el nombre del archivo
        $imagePath = $this->image ? $this->image->store('products', 'public') : null;

        // Crear el producto
        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'user_id' => auth()->id(),
            'image' => $imagePath,
        ]);

        // Asociar las categorías
        $product->categories()->attach($categoryIds);

        session()->flash('message', 'Producto creado con éxito.');

        return redirect()->route('products.index');
    }

    

    public function render()
    {
        return view('livewire.create-product')->layout('layouts.app');  // Especifica el layout correcto;
    }
}
