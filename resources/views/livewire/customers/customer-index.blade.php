<div class="max-w-6xl mx-auto py-8 px-4">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">
            Clientes
        </h1>

        <a href="{{ route('customers.create') }}"
           wire:navigate
           class="px-4 py-2 bg-indigo-600 text-white rounded">
            Nuevo cliente
        </a>
    </div>

    <input
        type="search"
        wire:model.live.debounce.300ms="search"
        placeholder="Buscar cliente..."
        class="w-full border rounded px-3 py-2 mb-4"
    >

    <table class="w-full bg-white shadow rounded">

        <thead class="border-b">
            <tr>
                <th class="p-3">Nombre</th>
                <th class="p-3">CUIT</th>
                <th class="p-3">Email</th>
                <th class="p-3"></th>
            </tr>
        </thead>

        <tbody>
            @forelse($customers as $customer)

                <tr class="border-b">

                    <td class="p-3">
                        {{ $customer->name }}
                    </td>

                    <td class="p-3">
                        {{ $customer->cuit }}
                    </td>

                    <td class="p-3">
                        {{ $customer->email }}
                    </td>

                    <td class="p-3 text-right">
                        <a
                            href="{{ route('customers.edit',$customer) }}"
                            wire:navigate
                            class="text-indigo-600">
                            Editar
                        </a>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4"
                        class="text-center p-4">
                        Sin resultados
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="mt-4">
        {{ $customers->links() }}
    </div>

</div>