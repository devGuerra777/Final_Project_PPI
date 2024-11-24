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
            'name' => $this->faker->words(3, true), // Nombre aleatorio
            'description' => $this->faker->sentence(), // Descripción aleatoria
            'quantity' => $this->faker->numberBetween(1, 100), // Stock aleatorio
            'price' => $this->faker->randomFloat(2, 10, 1000), // Precio aleatorio
            'user_id' => User::inRandomOrder()->firstOrFail()->id,
            'image' => $this->faker->imageUrl(640, 480, 'products', true), // URL de imagen
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
