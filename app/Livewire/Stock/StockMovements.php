<?php

namespace App\Livewire\Stock;

use App\Enums\MovementType;
use App\Exceptions\InsufficientStockException;
use App\Models\{Product, StockMovement};
use App\Services\StockService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class StockMovements extends Component
{
    use WithPagination;

    public ?int $product_id = null;
    public string $type = 'in';
    public int $quantity = 1;
    public string $reason = '';

    protected function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:in,adjustment'],
            'quantity' => ['required', 'integer', 'not_in:0'],
            'reason' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function save(StockService $stock): void
    {
        $this->validate();

        try{
            DB::transaction(function () use ($stock){
                $product = Product::lockForUpdate()->findOrFail($this->product_id);
                $stock->register(
                    $product,
                    MovementType::from($this->type),
                    $this->quantity,
                    $this->reason ?: null,
                );
            });
        }catch(InsufficientStockException $e){
            $this->addError('quantity', $e->getMessage());
            return;
        }
        $this->reset('quantity', 'reason');
        $this->quantity = 1;
        session()->flash('status', 'Movimiento registrado.');

    }

    public function render()
    {
        return view('livewire.stock.stock-movements', [
            'products' => Product::active()->orderBy('name')->get(['id', 'name', 'sku', 'stock']),
            'movements' => StockMovement::with(['product', 'user'])->latest()->paginate(15),
        ]);
    }
}
