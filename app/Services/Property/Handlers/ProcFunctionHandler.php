<?php

namespace App\Services\Property\Handlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Services\Property\D2Stat;

class ProcFunctionHandler implements StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): D2Stat
    {
        $values = [
            'chanceToProc' => $descriptor->min,
            'skillLevel' => $descriptor->max,
            'skillId' => $descriptor->param,
        ];

        return new D2Stat($propertyStat->stat, $values);
    }
}
