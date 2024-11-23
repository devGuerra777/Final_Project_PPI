<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'user_id',
        'image',
    ];
    /**
     * Relación con el modelo User (muchos a uno).
     * Un producto pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relación muchos a muchos (m:n): Un producto puede pertenecer a muchas categorías
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

}
