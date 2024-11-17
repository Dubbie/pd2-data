<?php

namespace App\Services\Property\Handlers;

use App\Models\PropertyDescriptor;
use App\Models\PropertyStat;
use App\Services\Property\D2Stat;

interface StatFunctionHandlerInterface
{
    public function handle(PropertyDescriptor $descriptor, PropertyStat $propertyStat): D2Stat;
}
