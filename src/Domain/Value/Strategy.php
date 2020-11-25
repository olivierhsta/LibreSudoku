<?php

namespace App\Domain\Value;

use MyCLabs\Enum\Enum;

class Strategy extends Enum
{
    const ONE_CHOICE = 'onechoice';

    const ELIMINATION = 'elimination';
}
