<div class="max-w-2xl mx-auto py-8 px-4">

    <h1 class="text-2xl font-semibold mb-6">
        {{ $customer ? 'Editar cliente' : 'Nuevo cliente' }}
    </h1>

    <form wire:submit="save"
          class="space-y-4 bg-white shadow rounded p-6">

        <div>
            <label>Nombre</label>

            <input
                type="text"
                wire:model="name"
                class="w-full border rounded px-3 py-2">

            @error('name')
                <p class="text-red-600 text-sm">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label>CUIT</label>

            <input
                type="text"
                wire:model="cuit"
                placeholder="20-12345678-9"
                class="w-full border rounded px-3 py-2">

            @error('cuit')
                <p class="text-red-600 text-sm">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label>Email</label>

            <input
                type="email"
                wire:model="email"
                class="w-full border rounded px-3 py-2">

            @error('email')
                <p class="text-red-600 text-sm">
                    {{ $message }}
                </p>
            @enderror
        </div>

        <div>
            <label>Teléfono</label>

            <input
                type="text"
                wire:model="phone"
                class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label>Dirección</label>

            <textarea
                wire:model="address"
                class="w-full border rounded px-3 py-2"></textarea>
        </div>

        <div class="flex gap-3">
            <button
                type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded">
                Guardar
            </button>

            <a
                href="{{ route('customers.index') }}"
                wire:navigate
                class="px-4 py-2 border rounded">
                Cancelar
            </a>
        </div>

    </form>

</div>
