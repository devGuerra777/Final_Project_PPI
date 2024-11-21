<div class="p-8 bg-gradient-to-r from-indigo-100 via-purple-100 to-indigo-200 shadow-lg rounded-lg max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Detalle del Producto</h1>

    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="flex flex-col md:flex-row gap-6 items-center">

            <!-- Detalles del producto -->
            <div class="w-full md:w-2/3">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700">Nombre:</h2>
                        <p class="text-lg text-gray-600">{{ $product->name }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700">Descripción:</h2>
                        <p class="text-lg text-gray-600">{{ $product->description }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700">Cantidad:</h2>
                        <p class="text-lg text-gray-600">{{ $product->quantity }}</p>
                    </div>
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-700">Precio:</h2>
                        <p class="text-lg text-gray-600">${{ number_format($product->price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón de Volver -->
        <div class="mt-6 text-center">
            <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-300">
                Volver a la Lista
            </a>
        </div>
    </div>
</div>
