<?php

namespace App\Domain\Value;

use MyCLabs\Enum\Enum;

/**
 * @method static Strategy ONE_CHOICE()
 * @method static Strategy ELIMINATION()
 */
class Strategy extends Enum
{
    /**
     * @var string
     */
    const NULL = 'null';

    /**
     * @var string
     */
    const ONE_CHOICE = 'onechoice';

    /**
     * @var string
     */
    const ELIMINATION = 'elimination';
}
