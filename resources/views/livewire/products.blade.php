<div class="p-6 bg-white shadow-md rounded-lg max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Lista de Productos</h1>

    <!-- Botón para agregar producto -->
    <div class="mb-4 text-right">
        <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
            Agregar Producto
        </a>
        <a href="{{ route('products.trashed') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
            Productos Eliminados
        </a>
    </div>

    <!-- Lista de productos -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300 bg-white shadow-lg rounded-lg mx-auto">
            <thead class="bg-indigo-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Precio</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Categorías</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr class="hover:bg-indigo-100 transition">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->description }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @if($product->categories->isNotEmpty())
                                {{ $product->categories->pluck('name')->join(', ') }}
                            @else
                                <span class="text-gray-400">Sin Categorías</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:text-blue-900">Ver</a>
                            <button wire:click="deleteProduct({{ $product->id }})" class="ml-4 text-red-600 hover:text-red-900">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
