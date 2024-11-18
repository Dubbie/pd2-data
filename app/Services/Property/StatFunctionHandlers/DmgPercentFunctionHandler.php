<?php

namespace App\Services\Property\StatFunctionHandlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Models\Stat;
use App\Services\Property\D2Stat;
use App\Services\Property\D2StatKeys;

class DmgPercentFunctionHandler implements StatFunctionHandlerInterface
{
    private const MIN_NAME = "item_mindamage_percent";

    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): array
    {
        $min = Stat::find(self::MIN_NAME);

        return [new D2Stat($min, [
            D2StatKeys::MIN => $descriptor->min,
            D2StatKeys::MAX => $descriptor->max,
        ])];
    }
}
