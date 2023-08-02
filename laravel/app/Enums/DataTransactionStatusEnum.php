<?php

namespace App\Enums;

enum DataTransactionStatusEnum: int
{
    case  AUTHORIZED = 1;
    case  DECLINE = 2;
    case REFUNDED = 3;
}
