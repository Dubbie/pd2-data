<?php

namespace App\Services\Property\StatFunctionHandlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;

interface StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): array;
}
