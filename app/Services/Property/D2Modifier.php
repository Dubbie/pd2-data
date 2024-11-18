<?php

namespace App\Services\Property;

use Exception;
use JsonSerializable;

class D2Modifier implements JsonSerializable
{
    private array $stats;
    private string $name;
    private array $vars;
    private string $template;

    public function __construct(string $name, array $stats, array $vars = [])
    {
        $this->name = $name;
        $this->stats = $stats;
        $this->vars = $vars;
        $this->template = $this->generateTemplate();
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'stats' => $this->stats,
            'vars' => $this->vars,
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
            switch ($this->name) {
                case 'dmg_percent':
                    return $this->handleDmgPercent();
                default:
                    return "Unhandled group " . $this->name;
            }
        }

        $d2stat = $this->stats[0];

        // use the resolver
        $resolver = new DescFunctionResolver();
        $handler = $resolver->resolve($d2stat->stat->description->function);

        return $handler->handle($d2stat);
    }

    private function handleDmgPercent()
    {
        return "+{{dmg}}% Enhanced Damage";
    }
}
