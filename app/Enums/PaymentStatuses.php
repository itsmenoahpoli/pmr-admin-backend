<?php

namespace App\Enums;

enum PaymentStatuses : string
{
    case PENDING = 'CASH';
    case PAID = 'PAID';
    case CANCELLED = 'CANCELLED';
    case VOIDED = 'VOIDED';
    case REFUNDED = 'REFUNDED';
}
