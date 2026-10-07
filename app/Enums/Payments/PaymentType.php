<?php

namespace App\Enums\Payments;

enum PaymentType: string
{
    case JEWEL = 'joia';
    case RENTAL = 'locacao';

    public function label(): string
    {
        return match ($this) {
            self::JEWEL => 'Jóia',
            self::RENTAL => 'Locação',
        };
    }
}
