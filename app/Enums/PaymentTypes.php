<?php

namespace App\Enums;

enum PaymentTypes : string
{
    case CASH = 'CASH';
    case ONLINE = 'ONLINE';
}
