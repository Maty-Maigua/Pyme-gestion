<?php
namespace App\Enums;

enum MovementType: string
{
    case In = 'in';
    case Out = 'out';
    case Adjustment = 'adjustment';

    public function label(): string
    {
        return match ($this) {
            self::In => 'Ingreso',
            self::Out => 'Egreso',
            self::Adjustment => 'Ajuste',
        };
    }
}