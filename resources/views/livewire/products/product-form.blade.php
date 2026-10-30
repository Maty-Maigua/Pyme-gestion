
<div class="max-w-2xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-semibold mb-6">
        {{ $product ? 'Editar producto' : 'Nuevo producto' }}
    </h1>

    <form wire:submit="save" class="space-y-4 bg-white p-6 shadow rounded">
        <div>
            <label class="block text-sm font-medium">Categoría</label>
            <select wire:model="category_id" class="w-full border rounded px-3 py-2">
                <option value="">Seleccionar...</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">SKU</label>
            <input type="text" wire:model="sku" class="w-full border rounded px-3 py-2">
            @error('sku') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium">Nombre</label>
            <input type="text" wire:model="name" class="w-full border rounded px-3 py-2">
            @error('name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Precio</label>
                <input type="number" step="0.01" wire:model="price" class="w-full border rounded px-3 py-2">
                @error('price') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Costo</label>
                <input type="number" step="0.01" wire:model="cost" class="w-full border rounded px-3 py-2">
                @error('cost') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Stock</label>
                <input type="number" wire:model="stock" class="w-full border rounded px-3 py-2">
                @error('stock') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium">Stock mínimo</label>
                <input type="number" wire:model="min_stock" class="w-full border rounded px-3 py-2">
                @error('min_stock') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <label class="flex items-center gap-2">
            <input type="checkbox" wire:model="active"> Activo
        </label>

        <div class="flex gap-3">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Guardar</button>
            <a href="{{ route('products.index') }}" wire:navigate class="px-4 py-2 border rounded">Cancelar</a>
        </div>
    </form>
</div>
