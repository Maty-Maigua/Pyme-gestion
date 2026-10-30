<div class="max-w-xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-6">
        {{ $category ? 'Editar categoría' : 'Nueva categoría' }}
    </h1>

    <form wire:submit="save"
          class="bg-white shadow rounded p-6">

        <div>
            <label class="block mb-1">
                Nombre
            </label>

            <input
                type="text"
                wire:model="name"
                class="w-full border rounded px-3 py-2"
            >

            @error('name')
                <p class="text-red-600 text-sm">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div class="flex gap-3 mt-4">
            <button
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded">
                Guardar
            </button>

            <a
                href="{{ route('categories.index') }}"
                wire:navigate
                class="px-4 py-2 border rounded">
                Cancelar
            </a>
        </div>

    </form>

</div>
