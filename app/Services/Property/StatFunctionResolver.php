<?php

namespace App\Services\Property;

use App\Services\Property\Handlers\DefaultFunctionHandler;
use App\Services\Property\Handlers\ProcFunctionHandler;
use App\Services\Property\Handlers\StatFunctionHandlerInterface;

class StatFunctionResolver
{
    protected array $handlers = [];

    public function __construct()
    {
        $this->handlers = [
            11 => new ProcFunctionHandler()
        ];
    }

    public function resolve(int $function): StatFunctionHandlerInterface
    {
        return $this->handlers[$function] ?? new DefaultFunctionHandler();
    }
}
