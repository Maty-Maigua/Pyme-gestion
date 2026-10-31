<?php

namespace App\Services;

use App\Enums\MovementType;
use App\Exceptions\InsufficientStockException;
use App\Models\{Invoice, Product, StockMovement};
use Illuminate\Support\Facades\Auth;

class StockService
{
    public function register(
        Product $product,
        MovementType $type,
        int $quantity,
        ?string $reason = null,
        ?Invoice $invoice = null,
        ?int $userId = null,
    ): StockMovement {
        $delta = match ($type){
            MovementType::In => abs($quantity),
            MovementType::Out => -abs($quantity),
            MovementType::Adjustment => $quantity,
        };

        if ($product->stock + $delta < 0){
            throw new InsufficientStockException($product, abs($delta));
        }

        $product->stock += $delta;
        $product->save();

        return StockMovement::create([
            'product_id' => $product->id,
            'user_id' => $userId ?? Auth::id(),
            'invoice_id' => $invoice?->id,
            'type' => $type,
            'quantity' => $delta,
            'reason' => $reason,
        ]);
    }
}