<?php

namespace App\Services\Property;

use Exception;
use JsonSerializable;

class D2Modifier implements JsonSerializable
{
    private array $stats;
    private string $name;
    private string $template;

    public function __construct(string $name, array $stats)
    {
        $this->name = $name;
        $this->stats = $stats;
        $this->template = $this->generateTemplate();
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'stats' => $this->stats,
            'template' => $this->template,
        ];
    }

    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }

    private function generateTemplate()
    {
        if (count($this->stats) > 1) {
            throw new Exception("Unhandled multi-stat modifier");
        }

        $d2stat = $this->stats[0];

        // use the resolver
        $resolver = new DescFunctionResolver();
        $handler = $resolver->resolve($d2stat->stat->description->function);

        return $handler->handle($d2stat);
    }
}
