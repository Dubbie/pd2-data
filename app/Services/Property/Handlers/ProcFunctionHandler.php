<?php

namespace App\Services\Property\Handlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Services\Property\D2Stat;
use App\Services\Property\D2StatKeys;

class ProcFunctionHandler implements StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): D2Stat
    {
        $values = [
            D2StatKeys::CHANCE_TO_PROC => $descriptor->min,
            D2StatKeys::SKILL_LEVEL => $descriptor->max,
            D2StatKeys::SKILL_ID => $descriptor->param,
        ];

        return new D2Stat($propertyStat->stat, $values);
    }
}
