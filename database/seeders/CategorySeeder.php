<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Frituras']);
        Category::create(['name' => 'Lacteos']);
        Category::create(['name' => 'Bebidas']);
        Category::create(['name' => 'Altos costos']);
    }
}
