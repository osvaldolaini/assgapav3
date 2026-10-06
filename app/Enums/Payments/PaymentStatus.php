<?php

namespace App\Enums\Payments;

enum PaymentStatus: string
{
    case WAITING = 'waiting';
    case PAID = 'paid';
    case RELEASED = 'released';

    public function label(): string
    {
        return match ($this) {
            self::WAITING => 'Aguardando',
            self::PAID => 'Pago',
            self::RELEASED => 'Liberado',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::WAITING => 'warning',
            self::PAID => 'success',
            self::RELEASED => 'info',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::WAITING => 'clock',
            self::PAID => 'check-circle',
            self::RELEASED => 'unlock',
        };
    }
}
