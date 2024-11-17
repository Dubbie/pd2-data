<?php

namespace App\Services\Property;

class StatGroupingHandler
{
    public function group(array $processedStats)
    {
        $standalone = [];

        foreach ($processedStats as $stat) {
            $standalone[] = $stat;
        }

        return $standalone;
    }
}
