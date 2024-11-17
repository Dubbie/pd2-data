<?php

namespace App\Services\Property;

use App\Models\Stat;
use JsonSerializable;

class D2Stat implements JsonSerializable
{
    private Stat $stat;
    private array $values;

    public function __construct(Stat $stat, array $values)
    {
        $this->stat = $stat;
        $this->values = $values;
    }

    public function toArray()
    {
        return [
            'stat' => $this->stat,
            'values' => $this->values
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}
