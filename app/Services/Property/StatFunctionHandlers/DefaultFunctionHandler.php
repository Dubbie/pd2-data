<?php

namespace App\Services\Property\StatFunctionHandlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Services\Property\D2Stat;
use App\Services\Property\D2StatKeys;

class DefaultFunctionHandler implements StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): D2Stat
    {
        $values = [
            D2StatKeys::MIN => $descriptor->min,
            D2StatKeys::MAX => $descriptor->max,
            D2StatKeys::PARAM => $descriptor->param,
        ];

        return new D2Stat($propertyStat->stat, $values);
    }
}
