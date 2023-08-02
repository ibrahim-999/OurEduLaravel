<?php

namespace App\Enums;

enum StatusCodeTypeEnum: string
{
    case AUTHORIZED = 'authorized';
    case DECLINE = 'decline';
    case REFUNDED = 'refunded';

}
