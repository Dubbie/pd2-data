<?php

namespace App\Services\Property;

use App\Models\PropertyDescriptor;

class PropertyDescriptorProcessor
{
    protected PropertyDescriptor $descriptor;
    protected PropertyStatProcessor $statProcessor;

    public function __construct(PropertyDescriptor $descriptor, PropertyStatProcessor $propertyStatProcessor)
    {
        $this->descriptor = $descriptor;
        $this->statProcessor = $propertyStatProcessor;
    }

    public function process()
    {
        $property = $this->descriptor->property;
        $propertyStats = $property->propertyStats;

        $processedStats = [];
        foreach ($propertyStats as $propertyStat) {
            $processed = $this->statProcessor->process($propertyStat, $this->descriptor);
            if ($processed) {
                foreach ($processed as $processedStat) {
                    $processedStats[] = $processedStat;
                }
            }
        }

        return $processedStats;
    }
}
