<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-5xl bg-white shadow-md rounded-md p-6">
        <h1 class="text-2xl font-bold text-center mb-6 text-gray-700">Productos Eliminados</h1>

        @if(session()->has('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.remove()">×</span>
            </div>
        @endif

        @if($trashedProducts->isEmpty())
            <div class="text-center text-gray-500">
                <p>No hay productos eliminados.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">ID</th>
                            <th class="px-4 py-2 text-left text-gray-700">Nombre</th>
                            <th class="px-4 py-2 text-left text-gray-700">Descripción</th>
                            <th class="px-4 py-2 text-left text-gray-700">Cantidad</th>
                            <th class="px-4 py-2 text-left text-gray-700">Precio</th>
                            <th class="px-4 py-2 text-center text-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trashedProducts as $product)
                            <tr class="border-t">
                                <td class="px-4 py-2">{{ $product->id }}</td>
                                <td class="px-4 py-2">{{ $product->name }}</td>
                                <td class="px-4 py-2">{{ $product->description }}</td>
                                <td class="px-4 py-2">{{ $product->quantity }}</td>
                                <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-2 text-center space-x-2">
                                    <button 
                                        wire:click="restore({{ $product->id }})" 
                                        class="inline-block bg-blue-500 px-4 py-1 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">
                                        Restaurar
                                    </button>
                                    <button 
                                        onclick="confirmDelete({{ $product->id }})" 
                                        class="inline-block bg-red-500 text-white px-4 py-1 rounded-md shadow hover:bg-red-600 focus:outline-none focus:ring focus:ring-red-300">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <!-- Modal de Confirmación de Eliminación -->
        <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" aria-modal="true" role="dialog">
            <div class="flex items-center justify-center min-h-screen">
                <div class="bg-white rounded-lg shadow-lg p-6 w-96">
                    <h2 class="text-lg font-medium text-gray-700 mb-4">Confirmar Eliminación</h2>
                    <p class="text-sm text-gray-600 mb-6">¿Estás seguro de que deseas eliminar este producto de manera permanente? Esta acción no se puede deshacer.</p>
                    <div class="flex justify-end space-x-4">
                        <button 
                            onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-300 rounded-md text-gray-700 hover:bg-gray-400">
                            Cancelar
                        </button>
                        <button 
                            wire:click="forceDelete(selectedProductId)" 
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let selectedProductId = null;

    function confirmDelete(productId) {
        selectedProductId = productId;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
