<div class="p-8 bg-gradient-to-r from-indigo-100 via-purple-100 to-indigo-200 shadow-lg rounded-lg max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800 text-center">Detalle del Producto</h1>

    @if (session()->has('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg p-6">
        @if ($isEditing)
            <!-- Formulario de edición -->
            <form wire:submit.prevent="updateProduct" class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input 
                        wire:model="name" 
                        id="name" 
                        type="text" 
                        class="mt-1 block w-full border {{ $errors->has('name') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
                    @error('name') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                    <textarea 
                        wire:model="description" 
                        id="description" 
                        rows="3" 
                        class="mt-1 block w-full border {{ $errors->has('description') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    ></textarea>
                    @error('description') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                    <input 
                        wire:model="quantity" 
                        id="quantity" 
                        type="number" 
                        class="mt-1 block w-full border {{ $errors->has('quantity') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
                    @error('quantity') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input 
                        wire:model="price" 
                        id="price" 
                        type="number" 
                        step="0.01" 
                        class="mt-1 block w-full border {{ $errors->has('price') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
                    @error('price') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>
                <div>
                    <label for="categories" class="block text-sm font-medium text-gray-700">Categorías</label>
                    <select 
                        wire:model="selectedCategories" 
                        id="categories" 
                        multiple 
                        class="mt-1 block w-full border {{ $errors->has('selectedCategories') ? 'border-red-500' : 'border-gray-300' }} rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                    >
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedCategories') 
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <div class="flex justify-between mt-4">
                    <!-- Botón Guardar -->
                    <button 
                        type="submit" 
                        style="background-color: green; color: white; padding: 10px; border-radius: 5px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                        Guardar
                    </button>
                    <!-- Botón Cancelar -->
                    <button type="button" wire:click="cancelEditing" class="bg-gray-500 text-white px-6 py-3 rounded-md hover:bg-gray-600 transition duration-300 focus:outline-none focus:ring-2 focus:ring-gray-300">Cancelar</button>
                </div>
            </form>
        @else
            <!-- Mostrar detalles del producto -->
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
                <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-gray-700">Categorías:</h2>
                <ul class="list-disc ml-6 text-lg text-gray-600">
                    @forelse ($product->categories as $category)
                        <li>{{ $category->name }}</li>
                    @empty
                        <li>No hay categorías asociadas</li>
                    @endforelse
                </ul>
                </div>
            </div>

            <!-- Botones de acciones -->
            <div class="mt-6 text-center">
                <button 
                    wire:click="enableEditing" 
                    style="background-color: green; color: white; padding: 10px; border-radius: 5px; font-weight: bold; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">
                    Editar
                </button>
                <a href="{{ route('products.index') }}" class="ml-4 bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-indigo-300">Volver a la Lista</a>
            </div>
        @endif
    </div>
</div>
