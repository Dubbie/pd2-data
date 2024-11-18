<?php

namespace App\Services\Property;

use App\Services\Property\DescFunctionHandlers\DescFunction15Handler;
use App\Services\Property\DescFunctionHandlers\DescFunction1Handler;
use App\Services\Property\DescFunctionHandlers\DescFunction2Handler;
use App\Services\Property\DescFunctionHandlers\DescFunction3Handler;
use App\Services\Property\DescFunctionHandlers\DescFunctionHandlerInterface;
use Exception;

class DescFunctionResolver
{
    protected array $handlers = [];

    public function __construct()
    {
        $this->handlers = [
            1 => new DescFunction1Handler(),
            2 => new DescFunction2Handler(),
            3 => new DescFunction3Handler(),
            12 => new DescFunction1Handler(),
            15 => new DescFunction15Handler(),
        ];
    }

    public function resolve(int $function): DescFunctionHandlerInterface
    {
        if (!isset($this->handlers[$function])) {
            throw new Exception("Desc func " . $function . " handler not implemented.");
        }

        return $this->handlers[$function];
    }
}
