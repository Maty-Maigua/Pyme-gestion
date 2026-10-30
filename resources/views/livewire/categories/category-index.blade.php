<div class="max-w-4xl mx-auto py-8 px-4">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Categorías</h1>

        <a href="{{ route('categories.create') }}"
           wire:navigate
           class="px-4 py-2 bg-indigo-600 text-white rounded">
            Nueva categoría
        </a>
    </div>

    <input
        type="search"
        wire:model.live.debounce.300ms="search"
        placeholder="Buscar categoría..."
        class="w-full border rounded px-3 py-2 mb-4"
    >

    <table class="w-full bg-white shadow rounded">
        <thead class="border-b">
            <tr>
                <th class="p-3 text-left">Nombre</th>
                <th class="p-3 text-right">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr class="border-b">
                    <td class="p-3">
                        {{ $category->name }}
                    </td>

                    <td class="p-3 text-right">
                        <a
                            href="{{ route('categories.edit',$category) }}"
                            wire:navigate
                            class="text-indigo-600">
                            Editar
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="p-4 text-center">
                        Sin resultados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $categories->links() }}
    </div>

</div>
