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
    private const MAX_NAME = "item_maxdamage_percent";

    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): array
    {
        $min = Stat::find(self::MIN_NAME);
        $max = Stat::find(self::MAX_NAME);

        $stats = [$min, $max];

        $d2stats = [];
        foreach ($stats as $stat) {
            $isMin = $stat->name === self::MIN_NAME;

            $d2stats[] = new D2Stat($stat, [
                D2StatKeys::MIN => $isMin ? $descriptor->min : $descriptor->max,
                D2StatKeys::MAX => $isMin ? $descriptor->min : $descriptor->max,
            ]);
        }

        return $d2stats;
    }
}
