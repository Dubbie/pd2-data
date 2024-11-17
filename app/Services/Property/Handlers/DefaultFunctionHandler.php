<?php

namespace App\Services\Property\Handlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Services\Property\D2Stat;

class DefaultFunctionHandler implements StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): D2Stat
    {
        $values = [
            'min' => $descriptor->min,
            'max' => $descriptor->max,
            'param' => $descriptor->param,
        ];

        return new D2Stat($propertyStat->stat, $values);
    }
}