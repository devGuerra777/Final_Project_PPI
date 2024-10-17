<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'quantity',
        'price',
        'user_id',
    ];
    /**
     * Relación con el modelo User (muchos a uno).
     * Un producto pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
