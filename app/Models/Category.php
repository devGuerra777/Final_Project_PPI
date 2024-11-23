<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Relación muchos a muchos (m:n): Una categoría tiene muchos productos
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
    
}
