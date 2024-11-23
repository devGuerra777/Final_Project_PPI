<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    // El modelo asociado a esta factory
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),  // Genera un nombre de producto
            'description' => $this->faker->sentence(),  // Descripción del producto
            'quantity' => $this->faker->numberBetween(1, 100),  // Cantidad en stock
            'price' => $this->faker->randomFloat(2, 1, 1000),  // Precio del producto
            'user_id' => User::factory(),  // Asocia un usuario aleatorio
        ];
    }

    /**
     * Crea productos con categorías asociadas
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withCategories()
    {
        return $this->afterCreating(function (Product $product) {
            $categories = Category::all();
            $product->categories()->attach(
                $categories->random(min(1, $categories->count()))->pluck('id')->toArray()
            );
        });
    }
}
