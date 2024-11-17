<?php

namespace App\Services\Property;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;

class PropertyStatProcessor
{
    protected StatFunctionResolver $functionResolver;

    public function __construct(StatFunctionResolver $functionResolver)
    {
        $this->functionResolver = $functionResolver;
    }

    public function process(PropertyStat $propertyStat, PropertyDescriptor $descriptor)
    {
        if (!$propertyStat->stat) {
            // Flexible dmg related issue. skip these for now
            return null;
        }

        $handler = $this->functionResolver->resolve($propertyStat->function);

        return $handler->handle($descriptor, $propertyStat);
    }
}
