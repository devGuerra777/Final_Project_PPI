<?php

namespace Tests\Feature;

use App\Models\Product;
use Livewire\Livewire;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_route_access_and_text_display()
    {
        // Enviar la solicitud GET a la ruta '/products'
        $response = $this->get('/products/create'); // Ajusta la ruta según sea necesario

        // Asegurar que la respuesta sea exitosa (código 200)
        $response->assertStatus(200);

        // Asegurar que el texto esperado se encuentra en la respuesta
        $response->assertSee('Productos'); // Ajusta el texto esperado según la página
    }
    public function test_product_creation_and_redirection()
    {
        // Datos válidos para el producto
    $productData = [
        'name' => 'Producto de prueba',
        'description' => 'xd',
        'quantity' => 10,
        'price' => 99.99,
    ];

    // Simula la acción de creación del producto mediante Livewire
    Livewire::test(\App\Http\Livewire\CreateProduct::class) // Asegúrate de que el nombre del componente sea correcto
        ->set('name', $productData['name'])
        ->set('description', $productData['description'])
        ->set('quantity', $productData['quantity'])
        ->set('price', $productData['price'])
        ->call('store') // Llamar al método 'store'
        ->assertRedirect(route('products.index')); // Verificar la redirección

    // Asegurar que el producto se haya creado en la base de datos
    $this->assertDatabaseHas('products', [
        'name' => $productData['name'],
        'description' => $productData['description'],
        'quantity' => $productData['quantity'],
        'price' => $productData['price'],
    ]);
    }



    public function test_validation_error_on_product_creation()
    {
        // Enviar la petición con datos incorrectos (nombre vacío, cantidad inválida)
        Livewire::test('CreateProduct') // Ajusta 'product-form' al nombre del componente de Livewire si es necesario
            ->set('name', '') // Nombre vacío
            ->set('quantity', 0) // Cantidad no válida
            ->set('price', 99.99)
            ->set('categories', []) // Sin categorías
            ->call('store') // Llamar al método 'store'
            ->assertHasErrors(['name', 'quantity', 'categories']); // Validar que los errores estén presentes para esos campos

        // También se podría hacer un test más detallado para cada campo individualmente si es necesario
    }
    
public function test_delete_product()
{
    // Crear un producto de prueba
    $product = Product::factory()->create();

    // Verificar que el producto exista antes de eliminarlo
    $this->assertDatabaseHas('products', ['id' => $product->id]);

    // Llamar al componente Livewire para eliminar el producto
    Livewire::test('products') // Componente Livewire donde se gestiona la lista de productos
        ->call('deleteProduct', $product->id); // Llamamos al método 'deleteProduct' con el ID del producto

    // Verificar que el producto haya sido eliminado de la base de datos
    $this->assertDatabaseMissing('products', ['id' => $product->id]);

    // Verificar que la lista de productos en el componente haya sido actualizada
    $this->assertCount(0, Product::all()); // Si solo había ese producto, el conteo debe ser 0, ajusta según el número de productos existentes


}


}
