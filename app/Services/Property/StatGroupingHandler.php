<?php

namespace App\Services\Property;

class StatGroupingHandler
{
    public function group(array $processedStats)
    {
        $standalone = [];

        foreach ($processedStats as $stat) {
            $modifier = new D2Modifier($stat->stat->name, [$stat]);
            $standalone[] = $modifier;
        }

        return $standalone;
    }
}
