<?php

namespace App\Services\Property\StatFunctionHandlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Services\Property\D2Stat;
use App\Services\Property\D2StatKeys;
use Exception;

class DefaultFunctionHandler implements StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): array
    {
        $values = [
            D2StatKeys::MIN => $descriptor->min,
            D2StatKeys::MAX => $descriptor->max,
            D2StatKeys::PARAM => $descriptor->param,
        ];

        if (!$propertyStat->stat) {
            throw new Exception("No stat set for property stat! Stat function: " . $propertyStat->function);
        }

        return [new D2Stat($propertyStat->stat, $values)];
    }
}
