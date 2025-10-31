<?php

namespace App\Enums;

use App\Traits\OptionEnum;
use BenSampo\Enum\Enum;

/**
 * @method static static User()
 * @method static static Admin()
 */
final class TransactionType extends Enum
{
    use OptionEnum;

    const KOTOR = 'KOTOR';
    const RETUR = 'RETUR';
    const REWASH = 'REWASH';
}
