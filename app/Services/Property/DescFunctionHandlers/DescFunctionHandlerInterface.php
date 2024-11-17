<?php

namespace App\Services\Property\DescFunctionHandlers;

use App\Services\Property\D2Stat;

interface DescFunctionHandlerInterface
{
    public function handle(D2Stat $d2stat): string;
}
