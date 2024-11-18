<?php

namespace App\Services\Property;

use JsonSerializable;

class D2Modifier implements JsonSerializable
{
    public array $stats;
    public string $name;
    public array $vars;
    public string $template;
    public int $priority;

    public function __construct(string $name, array $stats, int $priority, array $vars = [])
    {
        $this->name = $name;
        $this->stats = $stats;
        $this->priority = $priority;
        $this->vars = $vars;
        $this->template = $this->generateTemplate();
    }

    public function toArray()
    {
        return [
            'name' => $this->name,
            'stats' => $this->stats,
            'vars' => $this->vars,
            'priority' => $this->priority,
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
