<?php

namespace App\Exceptions;

use App\Models\Product;
use DomainException;


class InsufficientStockException extends DomainException
{
    
    public function __construct(public readonly Product $product, public readonly int $requested)
    {
       parent::__construct(
        "Stock insuficiente para <<{$product->name}>>: disponible {$product->stock}, pedido {$requested}."
        
        );
    }
}