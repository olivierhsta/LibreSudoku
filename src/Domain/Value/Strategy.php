<?php

namespace App\Domain\Value;

use MyCLabs\Enum\Enum;

class Strategy extends Enum
{
    /**
     * @var string
     */
    const ONE_CHOICE = 'onechoice';

    /**
     * @var string
     */
    const ELIMINATION = 'elimination';
}
