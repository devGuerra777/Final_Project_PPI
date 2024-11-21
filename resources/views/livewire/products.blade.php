<div class="p-6 bg-white shadow-md rounded-lg max-w-6xl mx-auto">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">Lista de Productos</h1>

    <!-- Formulario para crear o actualizar productos -->
    <form wire:submit.prevent="saveProduct" class="space-y-4 mb-6">
        <div>
            <label class="block text-sm font-medium {{ $errors->has('name') ? 'text-red-500' : 'text-gray-700' }}">Nombre:</label>
            <input type="text" wire:model="name" class="w-full mt-1 p-2 border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Descripción:</label>
            <textarea wire:model="description" class="w-full mt-1 p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>
        <div>
            <label class="block text-sm font-medium {{ $errors->has('quantity') ? 'text-red-500' : 'text-gray-700' }}">Cantidad:</label>
            <input type="number" wire:model="quantity" class="w-full mt-1 p-2 border {{ $errors->has('quantity') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('quantity')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Agrupamos el campo de Precio y el botón en un grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium {{ $errors->has('price') ? 'text-red-500' : 'text-gray-700' }}">Precio:</label>
                <input type="text" wire:model="price" class="w-full mt-1 p-2 border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                @error('price')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botón separado -->
            <div class="flex items-end">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition w-full">
                    {{ $product_id ? 'Actualizar Producto' : 'Agregar Producto' }}
                </button>
            </div>
        </div>
    </form>

    <!-- Lista de productos -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-300 bg-white shadow-lg rounded-lg mx-auto">
            <thead class="bg-indigo-500 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Nombre</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Descripción</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Cantidad</th>
                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Precio</th>
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
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button wire:click="editProduct({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900">Editar</button>
                            <button wire:click="deleteProduct({{ $product->id }})" class="ml-4 text-red-600 hover:text-red-900">Eliminar</button>
                            <a href="{{ route('products.show', $product->id) }}" class="ml-4 text-blue-600 hover:text-blue-900">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
