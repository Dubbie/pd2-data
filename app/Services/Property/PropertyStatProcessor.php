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
        $handler = $this->functionResolver->resolve($propertyStat->function);

        return $handler->handle($descriptor, $propertyStat);
    }
}
