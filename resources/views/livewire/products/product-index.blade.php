{{-- resources/views/livewire/products/product-index.blade.php --}}
<div class="max-w-6xl mx-auto py-8 px-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-semibold">Productos</h1>
        <a href="{{ route('products.create') }}" wire:navigate
           class="px-4 py-2 bg-indigo-600 text-white rounded">Nuevo producto</a>
    </div>

    @if (session('status'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
    @endif

    <input type="search" wire:model.live.debounce.300ms="search"
           placeholder="Buscar por nombre o SKU..."
           class="w-full mb-4 border rounded px-3 py-2">

    <table class="w-full text-left bg-white shadow rounded">
        <thead class="border-b">
            <tr>
                <th class="p-3">SKU</th>
                <th class="p-3">Nombre</th>
                <th class="p-3">Categoría</th>
                <th class="p-3 text-right">Precio</th>
                <th class="p-3 text-right">Stock</th>
                <th class="p-3"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr wire:key="product-{{ $product->id }}" class="border-b">
                    <td class="p-3">{{ $product->sku }}</td>
                    <td class="p-3">{{ $product->name }}</td>
                    <td class="p-3">{{ $product->category->name }}</td>
                    <td class="p-3 text-right">$ {{ number_format($product->price, 2, ',', '.') }}</td>
                    <td class="p-3 text-right {{ $product->isLowStock() ? 'text-red-600 font-semibold' : '' }}">
                        {{ $product->stock }}
                    </td>
                    <td class="p-3 text-right space-x-3">
                        <a href="{{ route('products.edit', $product) }}" wire:navigate class="text-indigo-600">Editar</a>
                        @can('delete', $product)
                            <button wire:click="delete({{ $product->id }})"
                                    wire:confirm="¿Eliminar este producto?"
                                    class="text-red-600">Eliminar</button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="p-6 text-center text-gray-500">Sin resultados.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">{{ $products->links() }}</div>
</div>
