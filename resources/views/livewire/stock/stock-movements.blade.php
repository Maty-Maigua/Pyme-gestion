{{-- resources/views/livewire/stock/stock-movements.blade.php --}}
<div class="max-w-5xl mx-auto py-8 px-4 space-y-8">
    <h1 class="text-2xl font-semibold">Movimientos de stock</h1>

    @if (session('status'))
        <div class="p-3 bg-green-100 text-green-800 rounded">{{ session('status') }}</div>
    @endif

    <form wire:submit="save" class="grid grid-cols-1 md:grid-cols-5 gap-3 bg-white p-4 shadow rounded items-end">
        <div class="md:col-span-2">
            <label class="block text-sm">Producto</label>
            <select wire:model="product_id" class="w-full border rounded px-2 py-2">
                <option value="">Seleccionar...</option>
                @foreach ($products as $p)
                    <option value="{{ $p->id }}">{{ $p->sku }} - {{ $p->name }} (stock {{ $p->stock }})</option>
                @endforeach
            </select>
            @error('product_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm">Tipo</label>
            <select wire:model="type" class="w-full border rounded px-2 py-2">
                <option value="in">Ingreso</option>
                <option value="adjustment">Ajuste (+/-)</option>
            </select>
        </div>
        <div>
            <label class="block text-sm">Cantidad</label>
            <input type="number" wire:model="quantity" class="w-full border rounded px-2 py-2">
            @error('quantity') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Registrar</button>
        <div class="md:col-span-5">
            <input type="text" wire:model="reason" placeholder="Motivo (opcional)" class="w-full border rounded px-2 py-2">
        </div>
    </form>

    <table class="w-full text-left bg-white shadow rounded">
        <thead class="border-b">
            <tr><th class="p-3">Fecha</th><th class="p-3">Producto</th><th class="p-3">Tipo</th>
                <th class="p-3 text-right">Cant.</th><th class="p-3">Usuario</th><th class="p-3">Motivo</th></tr>
        </thead>
        <tbody>
            @foreach ($movements as $m)
                <tr wire:key="mv-{{ $m->id }}" class="border-b">
                    <td class="p-3">{{ $m->created_at->format('d/m/Y H:i') }}</td>
                    <td class="p-3">{{ $m->product->name }}</td>
                    <td class="p-3">{{ $m->type->label() }}</td>
                    <td class="p-3 text-right {{ $m->quantity < 0 ? 'text-red-600' : 'text-green-700' }}">{{ $m->quantity }}</td>
                    <td class="p-3">{{ $m->user->name }}</td>
                    <td class="p-3">{{ $m->reason }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $movements->links() }}
</div>