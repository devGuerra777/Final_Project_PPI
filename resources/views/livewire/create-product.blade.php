<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Crear Nuevo Producto</h1>

    <!-- Formulario para crear un nuevo producto -->
    <form wire:submit.prevent="store" class="bg-white p-6 rounded-lg shadow-md">
        <!-- Campo Nombre -->
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="text" id="name" wire:model="name"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
            @error('name')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo Descripción -->
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea id="description" wire:model="description"
                      class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2"></textarea>
            @error('description')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo Cantidad -->
        <div class="mb-4">
            <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
            <input type="number" id="quantity" wire:model="quantity"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
            @error('quantity')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Campo Precio -->
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="text" id="price" wire:model="price"
                   class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-2">
            @error('price')
            <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Botones -->
        <div class="flex justify-end space-x-4">
            <button type="button" onclick="window.history.back()"
                    class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                Cancelar
            </button>
            <button type="submit"
                    class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">
                Guardar
            </button>
        </div>
    </form>
</div>
