<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Mail\ProductDeleteAlert;
use Illuminate\Support\Facades\Mail;


class TrashedProducts extends Component
{
    public $trashedProducts;

    public function mount()
    {
        $this->loadTrashedProducts();
    }

    public function loadTrashedProducts()
    {
        $this->trashedProducts = Product::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('success', 'Producto restaurado con éxito.');
        $this->loadTrashedProducts();
    }

    public function forceDelete($id)
    {   //Obtener el producto a eliminar
        $product = Product::withTrashed()->findOrFail($id);

        // Enviar correo al administrador
        Mail::to('admin@gmail.com')->send(new ProductDeleteAlert($product));
        
        $product->forceDelete();
        session()->flash('success', 'Producto eliminado permanentemente.');
        $this->loadTrashedProducts();
    }

    public function render()
    {
        return view('livewire.trashed-products')->layout('layouts.app');
    }
}
