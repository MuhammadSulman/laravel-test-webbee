<?php

namespace App\Enums;

use App\Enums\Contracts\GenericContract;
use App\Enums\Traits\Generic;

enum SeatType: string implements GenericContract
{
    use Generic;

    case COUPLE = 'couple';
    case SUPER = 'super';
    case STANDARD = 'standard';
}
