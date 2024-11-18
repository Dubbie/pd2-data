<?php

namespace App\Services\Property;

use App\Services\Property\StatFunctionHandlers\DefaultFunctionHandler;
use App\Services\Property\StatFunctionHandlers\DmgMaxFunctionHandler;
use App\Services\Property\StatFunctionHandlers\DmgMinFunctionHandler;
use App\Services\Property\StatFunctionHandlers\DmgPercentFunctionHandler;
use App\Services\Property\StatFunctionHandlers\ProcFunctionHandler;
use App\Services\Property\StatFunctionHandlers\StatFunctionHandlerInterface;

class StatFunctionResolver
{
    protected array $handlers = [];

    public function __construct()
    {
        $this->handlers = [
            5 => new DmgMinFunctionHandler(),
            6 => new DmgMaxFunctionHandler(),
            7 => new DmgPercentFunctionHandler(),
            11 => new ProcFunctionHandler()
        ];
    }

    public function resolve(int $function): StatFunctionHandlerInterface
    {
        return $this->handlers[$function] ?? new DefaultFunctionHandler();
    }
}
